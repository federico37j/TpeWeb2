{include file='templates/header.tpl'}

<section class="contenedor-principal container">
    <div class="cargar-noticia-formulario">
        <form class="formulario-cargar-noticia" action="createNoticia" method="POST" enctype="multipart/form-data">
            <h1>CARGAR NOTICIA</h1>
            <label>Título:</label>
            <input type="text" name="titulo" placeholder="Ingresa el título de la noticia">
            <label>Detalle:</label>
            <input type="text" name="detalle" placeholder="Ingresa el detalle de la noticia">
            <label>Sección:</label>
            <select name="secciones" class="seccion-noticia">
                <option value="0">--- Ninguno ---</option>
                {foreach from=$secciones item=$seccion}
                    <option value={$seccion->id_seccion}>{$seccion->nombre}</option>
                {/foreach}
            </select>
            <label>Fecha:</label>
            <input type="datetime-local" name="fecha">
            <input type="file" class="form-control" id="image" name="image" multiple>
            <p class="text-center"></p>
            <div class="contenedor-btn-cargar">
                <input type="submit" class="btn-cargar" value="CARGAR">
            </div>
        </form>
    </div>
    <div class="contenedor-tabla-noticias">
        <div class="usuarios">
            <a href="user">
                <ion-icon name="people-outline"></ion-icon>
            </a>
        </div>
        <table>
            <thead>
                <tr class="encabezado text-center">
                    <th>Titulo</th>
                    <th>Sección</th>
                    <th>Detalle</th>
                    <th>Fecha de subida</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
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
                            <a href="deleteNoticia/{$noticia->id_noticia}" class="btn-borrar-noticia">
                                <ion-icon name="close-circle-outline"></ion-icon>
                            </a>
                        </td>
                        <td>
                            <a href="editNoticia/{$noticia->id_noticia}" class="btn-editar-noticia">
                                <ion-icon name="sync-circle-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
    {if $mostrar === "editarNoticia"}
        <div class="update-noticia-formulario" id="form-modificar-noticia">
            <div class="contenido-principal">
                <form class="formulario-modificar-noticia" action="updateNoticia/{$noticia->id_noticia}" method="POST">
                    <h1>MODIFICAR NOTICIA</h1>
                    <label>Título:</label>
                    <input type="text" name="titulo" placeholder="Ingresa el título de la noticia"
                        value="{$noticia->titulo}">
                    <label>Detalle:</label>
                    <textarea rows="2" name="detalle"
                        placeholder="Ingresa el detalle de la noticia">{$noticia->detalle}</textarea>
                    <label>Sección:</label>
                    <select name="secciones" class="seccion-noticia">
                        <option value="0">--- Ninguno ---</option>
                        {foreach from=$secciones item=$seccion}
                            {if $seccion->id_seccion == $noticia->id_seccion}
                                <option value={$seccion->id_seccion} selected>{$seccion->nombre}</option>
                            {else}
                                <option value={$seccion->id_seccion}>{$seccion->nombre}</option>
                            {/if}
                        {/foreach}
                    </select>
                    <p class="text-center"></p>
                    <div class="contenedor-btn-cargar">
                        <input type="submit" class="btn-cargar" value="MODIFICAR">
                    </div>
                </form>
            </div>
        </div>
    {/if}

</section>
<section class="contenedor-principal container">
    <div class="cargar-seccion-formulario">
        <form class="formulario-cargar-seccion" action="createSeccion" method="POST">
            <h1>CARGAR SECCIÓN</h1>
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingresa el nombre de la sección">
            <p class="text-center"></p>
            <div class="contenedor-btn-cargar">
                <input type="submit" class="btn-cargar" value="CARGAR">
            </div>
        </form>
    </div>
    <div class="contenedor-tabla-seccion">
        <table>
            <thead>
                <tr class="encabezado text-center">
                    <th>Nombre</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                    {if $respuesta > 0}
                        <div class="alerta-delete">
                            <div class="contenido-principal">
                                <div class="contenedor-btn-salir">
                                    <h3>INFORMACIÓN</h3>
                                    <button class="btn-salir" id="btn-salir-alerta">
                                        <ion-icon name="close-outline" role="img" class="md hydrated"
                                            aria-label="close outline"></ion-icon>
                                    </button>
                                </div>
                                <p>Si elimina esta sección se borrarán las noticias relacionadas. ¿Desea eliminarla?</p>
                                <a href="deleteNoticiaPorSeccion/{$respuesta}" class="btn-borrar-noticia"
                                    id="btn-eliminar-noticia">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                            </div>
                        </div>
                    {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$secciones item=$seccion}
                    <tr>
                        <td>{$seccion->nombre}</td>
                        <td>
                            <a href="deleteSeccion/{$seccion->id_seccion}" class="btn-borrar-noticia">
                                <ion-icon name="close-circle-outline"></ion-icon>
                            </a>
                        </td>
                        <td>
                            <a href="editSeccion/{$seccion->id_seccion}" class="btn-editar-noticia">
                                <ion-icon name="sync-circle-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
    {if $mostrar === "editarSeccion"}
        <div id="form-modificar-seccion" class="update-seccion-formulario">
            <div class="contenido-principal">
                <form class="formulario-modificar-seccion" action="updateSeccion/{$seccion->id_seccion}" method="POST">
                    <h1>MODIFICAR SECCIÓN</h1>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" placeholder="Ingresa el nombre de la seccion"
                        value="{$seccion->nombre}">
                    <p class="text-center"></p>
                    <div class="contenedor-btn-cargar">
                        <input type="submit" class="btn-cargar" value="MODIFICAR">
                    </div>
                </form>
            </div>
        </div>
    {/if}

</section>

{include file='templates/footer.tpl'}