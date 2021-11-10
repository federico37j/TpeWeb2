{include file='templates/header.tpl'}
<div class="container">
    {if $rol === 'admin'}
        <a href="admin" class="panel-administrador">Panel administrador</a>
    {/if}
</div>
<section class="contenedor-principal container">
    <div class="secciones-filtrado">
        <h2>Secciones</h2>
        <a href="home">Quitar Filtro</a>
        {foreach from=$secciones item=$seccion}
            <a href="verNoticiasBySeccion/{$seccion->id_seccion}">{$seccion->nombre}</a>
        {/foreach}
    </div>

    <div class="contenedor-tabla-noticias">
        <table>
            <thead>
                <tr class="encabezado text-center">
                    <th>Titulo</th>
                    <th>Sección</th>
                    <th>Detalle</th>
                    <th>Fecha de subida</th>
                    <th>ver</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$noticias item=$noticia}
                    <tr>
                        <td>{$noticia->titulo}</td>
                        <td>{$noticia->nombre}</td>
                        <td>{$noticia->detalle}</td>
                        <td>{$noticia->fecha_subida}</td>
                        <td>
                            <a href="verNoticia/{$noticia->id_noticia}" data-idNoticia="{$noticia->id_noticia}"
                                class="btn-ver-noticia">
                                <ion-icon name="eye-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
    <div class="contenedor-ver-detalle {$active}">
        <div class="contenido-principal">
            <div class="contenedor-btn-salir">
                <h3>{$noticia->titulo}</h3>
                <button class="btn-salir" id="btn-salir">
                    <div class="icon-btn-salir">
                        <ion-icon name="close-outline" role="img" class="md hydrated" aria-label="close outline">
                        </ion-icon>
                    </div>
                </button>
            </div>
            <div class="contenedor-noticia">
                <div>
                    <p>{$noticia->detalle}</p>
                    <div class="seccion">
                        <label>Sección:</label>
                        <p>{$noticia->nombre}</p>
                    </div>
                </div>
            </div>
            {if $rol === 'usuarioComun' || $rol === 'admin'}
                <form class="comentarios" data-idNoticia="{$noticia->id_noticia}" data-rol="{$rol}" data-idUsuario="{$usuario}" id="comentarios">
                    <h4>Agregar comentario:</h4>
                    <div>
                        <textarea rows="2" name="detalle" placeholder="Ingresa su comentario"></textarea>
                    </div>
                    <div class="stars">
                        {if $rol === 'usuarioComun' || $rol === 'admin'}
                            <p class="clasificacion">
                                <input id="radio1" type="radio" name="estrellas" value="5">
                                <label for="radio1">★</label>
                                <input id="radio2" type="radio" name="estrellas" value="4">
                                <label for="radio2">★</label>
                                <input id="radio3" type="radio" name="estrellas" value="3">
                                <label for="radio3">★</label>
                                <input id="radio4" type="radio" name="estrellas" value="2">
                                <label for="radio4">★</label>
                                <input id="radio5" type="radio" name="estrellas" value="1">
                                <label for="radio5">★</label>
                            </p>
                        {/if}
                    </div>
                    <button type="submit" class="btn-comentar">COMENTAR</button>
                </form>

                <a href="#" id="btn-ver-mas">Ver comentarios</a>
                <table>
                    <thead id="thead"></thead>
                    <tbody id="tbody"></tbody>
                </table>
            {/if}
        </div>
    </div>
</section>

<section class="suscripciones">
    <article class="plan_basico">
        <h2>Plan Básico</h2>
        <p class="precio">$1600 / por mes</p>
        <p class="beneficios">Beneficios</p>
        <ul>
            <li>Bienestar integral</li>
            <li>Club el eco</li>
            <li>Peluquería</li>
            <li>Moda</li>
        </ul>
        <button class="btn-basico">Suscribirse</button>
    </article>
    <article class="plan_premium">
        <h2>Plan Premium</h2>
        <p class="precio">$2200 / por mes</p>
        <p class="beneficios">Beneficios</p>
        <ul>
            <li>Cuidado personal</li>
            <li>Gastronomía</li>
            <li>Home & Deco</li>
            <li>Mas</li>
        </ul>
        <button class="btn-premium">Suscribirse</button>
    </article>
</section>



<script type="text/javascript" src="js/comentarios.js"></script>
{include file='templates/footer.tpl'}