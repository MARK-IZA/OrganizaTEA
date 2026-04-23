document.addEventListener('DOMContentLoaded', function () {
    const celdas = document.querySelectorAll('.celda-agenda');
    const colorPicker = document.getElementById('color-agenda');
    const mensajeAgenda = document.getElementById('mensaje-agenda');
    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    if (!celdas.length || !colorPicker || !csrfToken) {
        return;
    }

    celdas.forEach(celda => {
        celda.addEventListener('focus', function () {
            this.dataset.colorAnterior = this.style.backgroundColor;
        });

        celda.addEventListener('blur', function () {
            const contenido = this.innerText.trim();
            const dia = this.dataset.dia;
            const hora = this.dataset.hora;
            const filaOrden = this.dataset.fila;
            const color = colorPicker.value;

            this.style.backgroundColor = color;

            fetch('/agenda', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    dia: dia,
                    hora: hora,
                    fila_orden: filaOrden,
                    contenido: contenido,
                    color: color
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
                if (mensajeAgenda) {
                    mensajeAgenda.innerHTML = '<div class="alert alert-success">Celda guardada correctamente.</div>';

                    setTimeout(() => {
                        mensajeAgenda.innerHTML = '';
                    }, 1500);
                }
            })
            .catch(error => {
                if (mensajeAgenda) {
                    mensajeAgenda.innerHTML = '<div class="alert alert-danger">Error al guardar la celda.</div>';
                }
            });
        });
    });
});