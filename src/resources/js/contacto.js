document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-contacto');
    const mensaje = document.getElementById('mensaje-contacto');
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    const textarea = document.getElementById('comentario');
    const contador = document.getElementById('contador');

    if (textarea && contador) {
        contador.textContent = textarea.value.length;

        textarea.addEventListener('input', function () {
            contador.textContent = this.value.length;
        });
    }

    if (!form || !csrfToken) {
        return;
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('/contacto', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            mensaje.innerHTML = '<div class="alert alert-success">Mensaje enviado correctamente.</div>';
            form.reset();

            if (contador) {
                contador.textContent = '0';
            }

            setTimeout(() => {
                mensaje.innerHTML = '';
            }, 2500);
        })
        .catch(error => {
            mensaje.innerHTML = '<div class="alert alert-danger">No se ha podido enviar el mensaje.</div>';
        });
    });
});