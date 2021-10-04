"use strict";

let update_noticia_formulario = document.querySelector('#form-modificar');
let update_seccion_formulario = document.querySelector('#form-modificar-seccion');


if (update_noticia_formulario) {
	update_noticia_formulario.addEventListener('click', (evento) => {
		if (evento.target.id === 'form-modificar') {
			update_noticia_formulario.classList.remove('activo');
		}
	});

}

if (update_seccion_formulario) {
	update_seccion_formulario.addEventListener('click', (evento) => {
		if (evento.target.id === 'form-modificar-seccion') {
			console.log(evento.target.id);
			update_seccion_formulario.classList.remove('mostrar');
		}
	});

}
