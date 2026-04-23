document.addEventListener('DOMContentLoaded', function () {
    const celdas = document.querySelectorAll('.celda-agenda');
    const botonesColor = document.querySelectorAll('.color-btn');
    const btnGuardar = document.getElementById('btn-guardar-agenda');
    const btnLimpiar = document.getElementById('btn-limpiar-celda');
    const mensajeAgenda = document.getElementById('mensaje-agenda');
    const textoCeldaSeleccionada = document.getElementById('celda-seleccionada-texto');
    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    if (!celdas.length || !csrfToken) {
        return;
    }

    let celdaActiva = null;
    let colorSeleccionado = '#ffffff';
    let cambiosPendientes = [];

    function mostrarMensaje(tipo, texto) {
        if (!mensajeAgenda) {
            return;
        }

        mensajeAgenda.innerHTML = `<div class="alert alert-${tipo}">${texto}</div>`;

        setTimeout(() => {
            mensajeAgenda.innerHTML = '';
        }, 2000);
    }

    function marcarCambio(celda) {
        const dia = celda.dataset.dia;
        const hora = celda.dataset.hora;
        const filaOrden = celda.dataset.fila;
        const contenido = celda.innerText.trim();
        const color = celda.style.backgroundColor || '';

        celda.classList.add('celda-agenda-modificada');

        const indiceExistente = cambiosPendientes.findIndex(item => item.dia === dia && item.hora === hora);

        const nuevoCambio = {
            dia: dia,
            hora: hora,
            fila_orden: parseInt(filaOrden),
            contenido: contenido,
            color: color
        };

        if (indiceExistente >= 0) {
            cambiosPendientes[indiceExistente] = nuevoCambio;
        } else {
            cambiosPendientes.push(nuevoCambio);
        }
    }

    function seleccionarCelda(celda) {
        celdas.forEach(item => item.classList.remove('celda-agenda-activa'));

        celdaActiva = celda;
        celda.classList.add('celda-agenda-activa');
        textoCeldaSeleccionada.textContent = `${celda.dataset.dia} - ${celda.dataset.hora}`;
    }

    celdas.forEach(celda => {
        celda.addEventListener('click', function () {
            seleccionarCelda(this);
        });

        celda.addEventListener('input', function () {
            marcarCambio(this);
        });
    });

    botonesColor.forEach(boton => {
        boton.addEventListener('click', function () {
            botonesColor.forEach(b => b.classList.remove('activo'));
            this.classList.add('activo');

            colorSeleccionado = this.dataset.color;

            if (celdaActiva) {
                celdaActiva.style.backgroundColor = colorSeleccionado;
                marcarCambio(celdaActiva);
            }
        });
    });

    if (botonesColor.length > 0) {
        botonesColor[0].classList.add('activo');
    }

    btnGuardar.addEventListener('click', function () {
        if (cambiosPendientes.length === 0) {
            mostrarMensaje('warning', 'No hay cambios pendientes.');
            return;
        }

        fetch('/api/agenda/guardar', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                celdas: cambiosPendientes
            })
        })
        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            celdas.forEach(celda => celda.classList.remove('celda-agenda-modificada'));
            cambiosPendientes = [];
            mostrarMensaje('success', 'Cambios guardados correctamente.');
        })
        .catch(error => {
            mostrarMensaje('danger', 'Error al guardar los cambios.');
        });
    });

    btnLimpiar.addEventListener('click', function () {
        if (!celdaActiva) {
            mostrarMensaje('warning', 'Primero selecciona una celda.');
            return;
        }

        const dia = celdaActiva.dataset.dia;
        const hora = celdaActiva.dataset.hora;

        celdaActiva.innerText = '';
        celdaActiva.style.backgroundColor = '#ffffff';
        marcarCambio(celdaActiva);

        fetch('/api/agenda/limpiar', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                dia: dia,
                hora: hora
            })
        })
        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            mostrarMensaje('success', 'Celda limpiada correctamente.');
        })
        .catch(error => {
            mostrarMensaje('danger', 'Error al limpiar la celda.');
        });
    });
});