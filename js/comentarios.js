"use strict";
document.addEventListener("DOMContentLoaded", iniciarPagina);
function iniciarPagina() {

    // let btn_pag_anterior = document.querySelector("#pag-anterior");
    // btn_pag_anterior.addEventListener('click', function (e) {
    //     e.preventDefault();
    //     anteriorPag();
    // });

    // let btn_pag_siguiente = document.querySelector("#pag-siguiente");
    // btn_pag_siguiente.addEventListener('click', function (e) {
    //     e.preventDefault();
    //     siguientePag();
    // });

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
    let botonVer = document.querySelector("#btn-ver-mas");
    if (botonVer) {
        botonVer.addEventListener('click', function (e) {
            e.preventDefault();
            verComentariosPorNoticia();
        });
    }

    let btn_ver_mas = document.querySelector('#btn-ver-mas');

    function verComentariosPorNoticia(ordenado = false) {
        let id_noticia = btn_ver_mas.dataset.id_noticia;
        let rol = btn_ver_mas.dataset.rol;
        let url = "";

        if (ordenado == false) {
            url = `api/comentario/${id_noticia}`;
        } else {
            url = `api/comentario/${id_noticia}/DESC`;
        }
        getAllComentariosByNoticia(url, rol);
    }

    async function agregarComentario(detalle, estrellas) {
        try {
            if (detalle != "" && estrellas != "") {
                let comentario = {
                    "descripcion": detalle,
                    "puntaje": estrellas,
                    "fecha_actual": getFechaActual(),
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

    //Obtengo la fecha actual para el comentario con formato dd/mm/yyyy hh:mm:ss
    function getFechaActual() {
        let hoy = new Date();
        let fecha = hoy.getFullYear() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getDate();
        let hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
        let fechaYHora = fecha + ' ' + hora;
        return fechaYHora;
    }

    //Obtengo todos los comentarios de una noticia 
    async function getAllComentariosByNoticia(url, rol) {
        try {
            let response = await fetch(`${url}`);
            if (response.ok) {
                let comentarios = await response.json();
                renderListCategorias(comentarios, rol);
            } else {
                console.log('Hubo un error');
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

    function ordenarPorPuntaje(puntaje) {
        let id_noticia = btn_ver_mas.dataset.id_noticia;
        let rol = btn_ver_mas.dataset.rol;
        let url = `api/comentario/${id_noticia}/PUNTAJE/${puntaje}`;
        getAllComentariosByNoticia(url, rol);
    }

    //Se renderiza la lista de comentarios.
    function renderListCategorias(comentarios, rol) {

        if (comentarios.length > 0) {
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

            // Creo las columnas del thead
            let columna_quien_lo_escribio = document.createElement('th');
            let columna_descripcion = document.createElement('th');
            let columna_puntaje = document.createElement('th');
            let columna_fecha = document.createElement('th');
            let columna_eliminar = document.createElement('th');

            //Se crea el boton ordenar descendente
            let btn_orden_desc = document.createElement('button');
            btn_orden_desc.innerHTML = '<ion-icon name="caret-down-outline"></ion-icon>';
            btn_orden_desc.id = `btn-ordenar-desc`;

            //Se crea el boton ordenar ascendente
            let btn_orden_asc = document.createElement('button');
            btn_orden_asc.innerHTML = '<ion-icon name="caret-up-outline"></ion-icon>';
            btn_orden_asc.id = `btn-ordenar-asc`;

            let divBtn = document.createElement('div');
            let divPuntaje = document.createElement('div');
            columna_quien_lo_escribio.innerHTML = "Quien lo escribio";
            columna_descripcion.innerHTML = "Mensaje";
            columna_puntaje.innerHTML = "Puntaje";

            divPuntaje.appendChild(cargarSelectTabla(5));
            columna_fecha.innerHTML = "Fecha creación";
            divBtn.appendChild(btn_orden_desc);
            divBtn.appendChild(btn_orden_asc);
            columna_fecha.appendChild(divBtn);
            columna_puntaje.appendChild(divPuntaje);
            columna_eliminar.innerHTML = "Eliminar";

            // Se agregan las columnas a la fila.
            fila_head.appendChild(columna_quien_lo_escribio);
            fila_head.appendChild(columna_descripcion);
            fila_head.appendChild(columna_puntaje);
            fila_head.appendChild(columna_fecha);

            // Si es admin se agrega la columna de eliminar.
            if (rol == 'admin') {
                fila_head.appendChild(columna_eliminar);
            }

            //Se agrega la fila al thead
            t_head.appendChild(fila_head);

            //Recorro el array de comentarios
            if (comentarios.length > 0) {
                for (const COMENTARIO of comentarios) {
                    let fila = document.createElement('tr');
                    //Se crean las celdas
                    let celda_email = document.createElement('td');
                    let celda_descripcion = document.createElement('td');
                    let celda_puntaje = document.createElement('td');
                    let celda_fecha = document.createElement('td');
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
                    celda_fecha.innerHTML = COMENTARIO.fecha_actual;
                    celda_btn_eliminar.appendChild(btn_eliminar);
                    celda_descripcion.appendChild(textArea_descripcion);

                    //Se agregan las celdas a la fila
                    fila.appendChild(celda_email);
                    fila.appendChild(celda_descripcion);
                    fila.appendChild(celda_puntaje);
                    fila.appendChild(celda_fecha);

                    // Si es admin se agrega la columna de eliminar.
                    if (rol == 'admin') {
                        fila.appendChild(celda_btn_eliminar);
                    }

                    //Se agrega la fila al tbody
                    t_body.appendChild(fila);
                }
            } else {
                t_body.innerText = "Aun no se han hecho comentarios.";
            }

            // Se agrega el evento click al boton borrar.
            let botonesBorrar = document.querySelectorAll(".btn-borrar-comentario");
            botonesBorrar.forEach(e => {
                e.addEventListener("click", btnBorrarClick);
            });
            // Se agrega el evento click al boton ordenar descendente.
            let btnOrdenarDesc = document.querySelector("#btn-ordenar-desc")
            btnOrdenarDesc.addEventListener('click', function (e) {
                let ordenado = true;
                verComentariosPorNoticia(ordenado);
            });
            // Se agrega el evento click al boton ordenar ascendente.
            let btnOrdenarASC = document.querySelector("#btn-ordenar-asc")
            btnOrdenarASC.addEventListener('click', function (e) {
                verComentariosPorNoticia();
            });
            // Se agrega el cambio de puntaje.
            let puntaje = document.querySelector("#orden_puntaje");
            puntaje.addEventListener("change", function () {
                let valorPuntaje = puntaje.value;
                if (valorPuntaje != "ninguno") {
                    ordenarPorPuntaje(valorPuntaje);
                } else {
                    verComentariosPorNoticia();
                }
            });
        } else {
            document.querySelector('#tbody').innerHTML = 'No hay comentarios.';
        }
    }

    //Cargar select
    function cargarSelectTabla(cantOpciones) {
        let select = document.createElement('select');
        select.id = 'orden_puntaje';
        let none = document.createElement('option');
        none.innerHTML = 'Ninguno';
        none.value = 'ninguno';
        select.appendChild(none);
        for (let index = 1; index <= cantOpciones; index++) {
            let option = document.createElement('option');
            option.value = index;
            option.innerHTML = index;
            select.appendChild(option);
        }
        return select;
    }

}

// let paginaActual = 1;
// Se incrementa en uno la variable global
// function siguientePag() {
//     incrementar(1);
// }

// Se decrementa en uno la variable global
// function anteriorPag() {
//     incrementar(-1);
// }

// Segun el numero de pagina y el limite son los registros que se van a mostrar
// function incrementar(pag) {
//     paginaActual += pag;
//     window.location.href = `paginado/${paginaActual}`;
// }



