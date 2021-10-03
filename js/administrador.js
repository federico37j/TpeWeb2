"use strict";

let update_noticia_formulario = document.querySelector('#form-modificar');


if(update_noticia_formulario){
	update_noticia_formulario.addEventListener('click', (evento) => {
		evento.target.id === 'form-modificar' ? update_noticia_formulario.classList.remove('activo') : '';
	});

}
