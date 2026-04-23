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

        circulo.style.background = `conic-gradient(
            royalblue 0deg ${grados}deg,
            red ${grados}deg 360deg
        )`;

        if (tiempoTexto) {
            tiempoTexto.textContent = formatearTiempo(restante);
        }
    }

    function seleccionarItem(item) {
        document.querySelectorAll('.timer-item').forEach(el => {
            el.classList.remove('timer-item-activo');
        });

        item.classList.add('timer-item-activo');
        itemActivo = item;
        tiempoSeleccionado = parseInt(item.dataset.tiempo);

        if (tiempoTexto) {
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
                circulo.style.background = 'green';
                tiempoTexto.textContent = 'Finalizado';
                tiempoTexto.style.color = 'green';
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
                        tiempoTexto.textContent = 'Selecciona un temporizador';
                        tiempoTexto.style.color = '';
                        circulo.style.background = `conic-gradient(
                            royalblue 0deg 290deg,
                            red 290deg 325deg,
                            red 325deg 345deg,
                            red 345deg 360deg
                        )`;
                        clearInterval(intervalo);
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