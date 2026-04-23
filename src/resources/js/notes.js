document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-nota');
    const listaNotas = document.getElementById('lista-notas');
    const mensajeNotas = document.getElementById('mensaje-notas');
    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    if (!form || !listaNotas || !csrfToken) {
        return;
    }

    function mostrarMensaje(tipo, texto) {
        mensajeNotas.innerHTML = `<div class="alert alert-${tipo}">${texto}</div>`;

        setTimeout(() => {
            mensajeNotas.innerHTML = '';
        }, 2000);
    }

    function crearNotaHtml(note) {
        const fechaTexto = note.fecha ? note.fecha : 'Sin fecha';
        const descripcionTexto = note.descripcion ? note.descripcion : '';

        return `
            <div class="col-md-3 mb-4 nota-item"
                 data-id="${note.id}"
                 data-titulo="${note.titulo}"
                 data-fecha="${note.fecha ?? ''}"
                 data-descripcion="${descripcionTexto}">
                <div class="note-card">
                    <h5 class="nota-titulo">${note.titulo}</h5>
                    <p><strong>Fecha:</strong> <span class="nota-fecha">${fechaTexto}</span></p>
                    <p class="nota-descripcion">${descripcionTexto}</p>

                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button"
                                class="btn btn-warning btn-sm btn-editar-nota"
                                data-id="${note.id}">
                            Editar
                        </button>

                        <button type="button"
                                class="btn btn-danger btn-sm btn-eliminar-nota"
                                data-id="${note.id}">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    function ponerModoVista(nota, noteActualizada) {
        const fechaTexto = noteActualizada.fecha ? noteActualizada.fecha : 'Sin fecha';
        const descripcionTexto = noteActualizada.descripcion ? noteActualizada.descripcion : '';

        nota.dataset.titulo = noteActualizada.titulo;
        nota.dataset.fecha = noteActualizada.fecha ?? '';
        nota.dataset.descripcion = descripcionTexto;

        nota.querySelector('.note-card').innerHTML = `
            <h5 class="nota-titulo">${noteActualizada.titulo}</h5>
            <p><strong>Fecha:</strong> <span class="nota-fecha">${fechaTexto}</span></p>
            <p class="nota-descripcion">${descripcionTexto}</p>

            <div class="d-flex gap-2 flex-wrap">
                <button type="button"
                        class="btn btn-warning btn-sm btn-editar-nota"
                        data-id="${noteActualizada.id}">
                    Editar
                </button>

                <button type="button"
                        class="btn btn-danger btn-sm btn-eliminar-nota"
                        data-id="${noteActualizada.id}">
                    Eliminar
                </button>
            </div>
        `;
    }

    function ponerModoEdicion(nota) {
        const id = nota.dataset.id;
        const titulo = nota.dataset.titulo ?? '';
        const fecha = nota.dataset.fecha ?? '';
        const descripcion = nota.dataset.descripcion ?? '';

        nota.querySelector('.note-card').innerHTML = `
            <div class="mb-2">
                <label class="form-label">Título</label>
                <input type="text" class="form-control input-editar-titulo" value="${titulo}">
            </div>

            <div class="mb-2">
                <label class="form-label">Fecha</label>
                <input type="date" class="form-control input-editar-fecha" value="${fecha}">
            </div>

            <div class="mb-2">
                <label class="form-label">Descripción</label>
                <textarea class="form-control input-editar-descripcion" rows="4">${descripcion}</textarea>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <button type="button"
                        class="btn btn-success btn-sm btn-guardar-edicion"
                        data-id="${id}">
                    Guardar
                </button>

                <button type="button"
                        class="btn btn-secondary btn-sm btn-cancelar-edicion"
                        data-id="${id}">
                    Cancelar
                </button>
            </div>
        `;
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('/notes', {
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
            const sinNotas = document.getElementById('sin-notas');

            if (sinNotas) {
                sinNotas.remove();
            }

            listaNotas.insertAdjacentHTML('afterbegin', crearNotaHtml(data.note));
            form.reset();
            mostrarMensaje('success', 'Nota añadida correctamente.');
        })
        .catch(error => {
            let mensaje = 'Error al añadir la nota.';

            if (error.mensaje) {
                mensaje = error.mensaje;
            }

            mostrarMensaje('danger', mensaje);
        });
    });

    listaNotas.addEventListener('click', function (e) {
        const botonEliminar = e.target.closest('.btn-eliminar-nota');
        const botonEditar = e.target.closest('.btn-editar-nota');
        const botonGuardar = e.target.closest('.btn-guardar-edicion');
        const botonCancelar = e.target.closest('.btn-cancelar-edicion');

        if (botonEliminar) {
            const id = botonEliminar.dataset.id;

            fetch(`/notes/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(data => {
                const nota = botonEliminar.closest('.nota-item');

                if (nota) {
                    nota.remove();
                }

                if (listaNotas.querySelectorAll('.nota-item').length === 0) {
                    listaNotas.innerHTML = '<p id="sin-notas">No hay notas guardadas.</p>';
                }

                mostrarMensaje('success', 'Nota eliminada correctamente.');
            })
            .catch(error => {
                mostrarMensaje('danger', 'Error al eliminar la nota.');
            });

            return;
        }

        if (botonEditar) {
            const nota = botonEditar.closest('.nota-item');
            ponerModoEdicion(nota);
            return;
        }

        if (botonCancelar) {
            const nota = botonCancelar.closest('.nota-item');

            const noteOriginal = {
                id: nota.dataset.id,
                titulo: nota.dataset.titulo,
                fecha: nota.dataset.fecha,
                descripcion: nota.dataset.descripcion
            };

            ponerModoVista(nota, noteOriginal);
            return;
        }

        if (botonGuardar) {
            const nota = botonGuardar.closest('.nota-item');
            const id = botonGuardar.dataset.id;

            const titulo = nota.querySelector('.input-editar-titulo').value;
            const fecha = nota.querySelector('.input-editar-fecha').value;
            const descripcion = nota.querySelector('.input-editar-descripcion').value;

            fetch(`/notes/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    titulo: titulo,
                    fecha: fecha,
                    descripcion: descripcion
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
                ponerModoVista(nota, data.note);
                mostrarMensaje('success', 'Nota actualizada correctamente.');
            })
            .catch(error => {
                mostrarMensaje('danger', 'Error al actualizar la nota.');
            });
        }
    });
});