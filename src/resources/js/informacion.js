document.addEventListener('DOMContentLoaded', function () {
    const inputBusqueda = document.getElementById('busqueda-recurso');
    const inputCiudad = document.getElementById('busqueda-ciudad');
    const btnBuscar = document.getElementById('btn-buscar-recursos');
    const resultados = document.getElementById('resultados-recursos');
    const mensaje = document.getElementById('mensaje-recursos');

    if (!inputBusqueda || !inputCiudad || !btnBuscar) {
        return;
    }

    function pintarResultados(datos) {
        resultados.innerHTML = '';

        if (datos.length === 0) {
            resultados.innerHTML = '<p>No se han encontrado resultados.</p>';
            return;
        }

        let html = '<div class="list-group">';

        datos.forEach(lugar => {
            const nombre = lugar.display_name;
            const lat = lugar.lat;
            const lon = lugar.lon;
            const enlace = `https://www.openstreetmap.org/?mlat=${lat}&mlon=${lon}#map=16/${lat}/${lon}`;

            html += `
                <div class="list-group-item recurso-item">
                    <h5>${nombre.split(',')[0]}</h5>
                    <p class="mb-2">${nombre}</p>
                    <a href="${enlace}" target="_blank" class="btn btn-outline-primary btn-sm">
                        Ver en mapa
                    </a>
                </div>
            `;
        });

        html += '</div>';
        resultados.innerHTML = html;
    }

    btnBuscar.addEventListener('click', function () {
        const busqueda = inputBusqueda.value.trim();
        const ciudad = inputCiudad.value.trim();

        if (busqueda === '' || ciudad === '') {
            mensaje.innerHTML = '<div class="alert alert-warning">Rellena la búsqueda y la ciudad.</div>';
            return;
        }

        btnBuscar.disabled = true;
        btnBuscar.textContent = 'Buscando...';
        mensaje.innerHTML = '';
        resultados.innerHTML = '';

        const consulta = encodeURIComponent(`${busqueda} ${ciudad} España`);
        const url = `https://nominatim.openstreetmap.org/search?q=${consulta}&format=json&limit=8&addressdetails=1`;

        fetch(url, {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            pintarResultados(data);
        })
        .catch(error => {
            mensaje.innerHTML = '<div class="alert alert-danger">No se ha podido realizar la búsqueda.</div>';
        })
        .finally(() => {
            btnBuscar.disabled = false;
            btnBuscar.textContent = 'Buscar';
        });
    });
});