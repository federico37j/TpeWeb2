"use strict";
document.addEventListener("DOMContentLoaded", iniciarPagina);
function iniciarPagina() {

    let form_comentarios = document.querySelector('#comentarios');

    if (form_comentarios) {
        form_comentarios.addEventListener('submit', e => {
            e.preventDefault();
            let formData = new FormData(form_comentarios);
            let detalle = formData.get('detalle');
            let estrellas = formData.get('estrellas');
            agregarComentario(detalle, estrellas);
        });
    }

    //Se le asigna los eventos a los botones
    let botonesVer = document.querySelector("#btn-ver-mas");
    if (botonesVer) {
        botonesVer.addEventListener('click', function (e) {
            e.preventDefault();
            verComentariosPorNoticia();
        });
    }

    function verComentariosPorNoticia() {
        let btn_ver_mas = document.querySelector('#btn-ver-mas');
        getAllComentariosByNoticia(btn_ver_mas.dataset.id_noticia, btn_ver_mas.dataset.rol);
    }

    async function agregarComentario(detalle, estrellas) {
        try {
            if (detalle != "" && estrellas != "") {
                let comentario = {
                    "descripcion": detalle,
                    "puntaje": estrellas,
                    "id_noticia": form_comentarios.getAttribute('data-idNoticia'),
                    "id_usuario": form_comentarios.getAttribute('data-idUsuario')
                }
                let respuesta = await fetch('api/comentario', {
                    'method': 'POST',
                    'headers': {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(comentario)
                });
                if (respuesta.ok) {
                    verComentariosPorNoticia();
                } else {
                    console.log('Hubo un error');
                }

            } else {
                console.log('Faltan cargar datos.');
            }
        } catch (error) {
            console.log("Error: " + error);
        }
    }

    async function getAllComentariosByNoticia(id_noticia, rol) {
        try {
            let response = await fetch(`api/comentario/${id_noticia}`);
            if (response.ok) {
                let comentarios = await response.json();
                renderListCategorias(comentarios, rol);
            } else {
                console.log("Error - Failed URL!");
            }
        } catch (error) {
            console.log("Connection error");
        }
    }

    //Se borra un comentario.
    async function btnBorrarClick() {
        let id = this.getAttribute("data-id-borrar");
        try {
            let response = await fetch(`api/comentario/${id}`, {
                'method': "DELETE",
            });

            if (response.ok) {
                console.log(`Elemento borrado ${id}`);
                verComentariosPorNoticia();
            } else {
                console.log("No se pudo borrar");
            }
        } catch (error) {
            console.log("Error: " + error);
        }

    }
    //Se renderiza la lista de comentarios.
    function renderListCategorias(comentarios, rol) {
        //Se trae la etiqueta tbody
        let t_body = document.querySelector('#tbody');
        //Se trae la etiqueta thead
        let t_head = document.querySelector('#thead');
        //Vacio el HTML
        t_body.innerHTML = "";
        t_head.innerHTML = "";

        //Se crea el thead
        let fila_head = document.createElement('tr');
        fila_head.classList.add('encabezado');
        fila_head.classList.add('text-center');

        let columna_quien_lo_escribio = document.createElement('th');
        let columna_descripcion = document.createElement('th');
        let columna_puntaje = document.createElement('th');
        let columna_eliminar = document.createElement('th');

        columna_quien_lo_escribio.innerHTML = "Quien lo escribio";
        columna_descripcion.innerHTML = "Mensaje";
        columna_puntaje.innerHTML = "Puntaje";
        columna_eliminar.innerHTML = "Eliminar";

        fila_head.appendChild(columna_quien_lo_escribio);
        fila_head.appendChild(columna_descripcion);
        fila_head.appendChild(columna_puntaje);
        if (rol == 'admin') {
            fila_head.appendChild(columna_eliminar);
        }
        t_head.appendChild(fila_head);

        //Recorro el array de comentarios
        if (comentarios.length > 0) {
            for (const COMENTARIO of comentarios) {
                let fila = document.createElement('tr');
                //Se crean las celdas
                let celda_email = document.createElement('td');
                let celda_descripcion = document.createElement('td');
                let celda_puntaje = document.createElement('td');
                let celda_btn_eliminar = document.createElement('td');

                //Boton borrar
                let btn_eliminar = document.createElement('button');
                btn_eliminar.innerHTML = `<ion-icon name="close-circle-outline"></ion-icon>`;
                btn_eliminar.setAttribute('data-id-borrar', COMENTARIO.id_comentario);
                btn_eliminar.classList.add('btn-borrar-comentario');

                //Se crean los text area
                let textArea_descripcion = document.createElement('textarea');

                //Se agregan los datos a las celdas
                celda_email.innerHTML = COMENTARIO.email;
                textArea_descripcion.value = COMENTARIO.descripcion;
                celda_puntaje.innerHTML = COMENTARIO.puntaje;
                celda_btn_eliminar.appendChild(btn_eliminar);
                celda_descripcion.appendChild(textArea_descripcion);

                fila.appendChild(celda_email);
                fila.appendChild(celda_descripcion);
                fila.appendChild(celda_puntaje);
                if (rol == 'admin') {
                    fila.appendChild(celda_btn_eliminar);
                }
                t_body.appendChild(fila);
            }
        } else {
            t_body.innerText = "Aun no se han hecho comentarios.";
        }

        //Se le asigna los eventos a los botones
        let botonesBorrar = document.querySelectorAll(".btn-borrar-comentario");
        botonesBorrar.forEach(e => {
            e.addEventListener("click", btnBorrarClick);
        });
    }
}





