"use strict";

let btn_salir = document.querySelector('#btn-salir');
let contenedor_ver_detalle = document.querySelector('.contenedor-ver-detalle');

// Se cierra el detalle
if (btn_salir && contenedor_ver_detalle) {

    btn_salir.addEventListener('click', function () {
        contenedor_ver_detalle.classList.toggle('activo');
    });
  
}
