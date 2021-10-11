"use strict";

let update_noticia_formulario = document.querySelector('#form-modificar-noticia');
let update_seccion_formulario = document.querySelector('#form-modificar-seccion');
let btn_borrar_noticia = document.querySelectorAll('.btn-borrar-noticia');
let btn_salir_alerta = document.querySelector('#btn-salir-alerta');

// Se cierra el detalle
if (btn_salir_alerta) {

    btn_salir_alerta.addEventListener('click', function () {
        document.querySelector('.alerta-delete').classList.toggle('ocultar');
    });
  
}

if (update_noticia_formulario) {
	update_noticia_formulario.addEventListener('click', (evento) => {
		if (evento.target.id === 'form-modificar-noticia') {
			update_noticia_formulario.classList.add('ocultar');
		}
	});

}

if (update_seccion_formulario) {
	update_seccion_formulario.addEventListener('click', (evento) => {
		if (evento.target.id === 'form-modificar-seccion') {
			update_seccion_formulario.classList.add('ocultar');
		}
	});

}