{include file='templates/header.tpl'}
<div class="container">
    {if $rol === 'true'}
        <a href="admin" class="panel-administrador">Panel administrador</a>
    {/if}
</div>
<section class="contenedor-principal container">
    <div class="secciones-filtrado">
        <h2>Secciones</h2>
        <a href="home">Quitar Filtro</a>
        {foreach from=$secciones item=$seccion}
            <a href="verNoticiasBySeccion/{$seccion->id_seccion}">{$seccion->nombre_seccion}</a>
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
                        <td>{$noticia->nombre_seccion}</td>
                        <td>{$noticia->detalle}</td>
                        <td>{$noticia->fecha_subida}</td>
                        <td>
                            <a href="verNoticia/{$noticia->id_noticia}" class="btn-ver-noticia">
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
                    <ion-icon name="close-outline" role="img" class="md hydrated" aria-label="close outline"></ion-icon>
                </button>
            </div>
            <div class="contenedor-noticia">
                <div>
                    <p>{$noticia->detalle}</p>
                    <div class="seccion">
                        <label>Sección:</label>
                        <p>{$noticia->nombre_seccion}</p>
                    </div>
                </div>
            </div>
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



{include file='templates/footer.tpl'}