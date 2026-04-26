document.addEventListener('DOMContentLoaded', function () {
    const circulo = document.getElementById('circulo');
    const tiempoTexto = document.getElementById('tiempo-restante');
    const btnIniciar = document.getElementById('btn-iniciar');
    const lista = document.getElementById('lista-temporizadores');
    const form = document.getElementById('form-temporizador');
    const mensajeError = document.getElementById('mensaje-error');

    if (!circulo || !lista || !form) {
        return;
    }

    let intervalo = null;
    let tiempoSeleccionado = null;
    let itemActivo = null;

    function ponerCirculoBase() {
        circulo.classList.remove('circulo-activo', 'circulo-finalizado');
        circulo.classList.add('circulo-base');

        if (tiempoTexto) {
            tiempoTexto.classList.remove('timer-finalizado');
        }
    }

    function formatearTiempo(segundos) {
        let h = Math.floor(segundos / 3600);
        let m = Math.floor((segundos % 3600) / 60);
        let s = segundos % 60;

        return (
            String(h).padStart(2, '0') + ':' +
            String(m).padStart(2, '0') + ':' +
            String(s).padStart(2, '0')
        );
    }

    function actualizarCirculo(restante, total) {
        let porcentaje = restante / total;
        let grados = porcentaje * 360;

        circulo.classList.remove('circulo-base', 'circulo-finalizado');
        circulo.classList.add('circulo-activo');
        circulo.style.setProperty('--grados', grados + 'deg');

        if (tiempoTexto) {
            tiempoTexto.classList.remove('timer-finalizado');
            tiempoTexto.textContent = formatearTiempo(restante);
        }
    }

    function seleccionarItem(item) {
        document.querySelectorAll('.timer-item').forEach(el => {
            el.classList.remove('timer-item-activo');
        });

        clearInterval(intervalo);

        item.classList.add('timer-item-activo');
        itemActivo = item;
        tiempoSeleccionado = parseInt(item.dataset.tiempo);

        if (tiempoTexto) {
            tiempoTexto.classList.remove('timer-finalizado');
            tiempoTexto.textContent = item.dataset.nombre + ' - ' + formatearTiempo(tiempoSeleccionado);
        }

        actualizarCirculo(tiempoSeleccionado, tiempoSeleccionado);
    }

    function iniciarTemporizador() {
        if (!tiempoSeleccionado) {
            return;
        }

        let tiempoTotal = tiempoSeleccionado;
        let tiempoRestante = tiempoSeleccionado;

        clearInterval(intervalo);

        actualizarCirculo(tiempoRestante, tiempoTotal);

        intervalo = setInterval(() => {
            tiempoRestante--;

            if (tiempoRestante <= 0) {
                tiempoRestante = 0;
                clearInterval(intervalo);

                circulo.classList.remove('circulo-activo', 'circulo-base');
                circulo.classList.add('circulo-finalizado');

                if (tiempoTexto) {
                    tiempoTexto.textContent = 'Finalizado';
                    tiempoTexto.classList.add('timer-finalizado');
                }

                return;
            }

            actualizarCirculo(tiempoRestante, tiempoTotal);
        }, 1000);
    }

    function crearHtmlTimer(timer) {
        return `
            <li class="list-group-item d-flex justify-content-between align-items-center timer-item"
                data-id="${timer.id}"
                data-nombre="${timer.nombre}"
                data-tiempo="${timer.duracion_segundos}">
                <span>
                    <strong>${timer.nombre}</strong> - ${timer.duracion_segundos} segundos
                </span>

                <button type="button"
                    class="btn btn-danger btn-sm btn-eliminar-timer"
                    data-id="${timer.id}">
                    Eliminar
                </button>
            </li>
        `;
    }

    ponerCirculoBase();

    lista.addEventListener('click', function (e) {
        const botonEliminar = e.target.closest('.btn-eliminar-timer');
        const item = e.target.closest('.timer-item');

        if (botonEliminar) {
            e.stopPropagation();

            const id = botonEliminar.dataset.id;

            fetch(`/temporizador/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.ok) {
                    botonEliminar.closest('.timer-item').remove();

                    if (lista.children.length === 0) {
                        lista.innerHTML = '<li class="list-group-item" id="sin-temporizadores">No hay temporizadores guardados.</li>';
                    }

                    if (itemActivo && itemActivo.dataset.id === id) {
                        tiempoSeleccionado = null;
                        itemActivo = null;
                        clearInterval(intervalo);

                        ponerCirculoBase();

                        if (tiempoTexto) {
                            tiempoTexto.textContent = 'Selecciona un temporizador';
                        }
                    }
                }
            });

            return;
        }

        if (item) {
            seleccionarItem(item);
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        mensajeError.innerHTML = '';

        const formData = new FormData(form);

        fetch('/temporizador', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(async res => {
            const data = await res.json();

            if (!res.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            const vacio = document.getElementById('sin-temporizadores');

            if (vacio) {
                vacio.remove();
            }

            lista.insertAdjacentHTML('beforeend', crearHtmlTimer(data.timer));

            form.reset();
            document.getElementById('horas').value = 0;
            document.getElementById('minutos').value = 0;
            document.getElementById('segundos').value = 5;
        })
        .catch(error => {
            let mensaje = 'Ha ocurrido un error.';

            if (error.mensaje) {
                mensaje = error.mensaje;
            }

            mensajeError.innerHTML = `
                <div class="alert alert-danger">${mensaje}</div>
            `;
        });
    });

    btnIniciar.addEventListener('click', iniciarTemporizador);
});