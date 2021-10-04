{include file='templates/header.tpl'}

<section class="contenedor-principal container">
    <div class="cargar-noticia-formulario">
        <form class="formulario-cargar-noticia" action="createNoticia" method="POST">
            <h1>CARGAR NOTICIA</h1>
            <label>Título:</label>
            <input type="text" name="titulo" placeholder="Ingresa el título de la noticia">
            <label>Detalle:</label>
            <input type="text" name="detalle" placeholder="Ingresa el detalle de la noticia">
            <label>Sección:</label>
            <select name="secciones" class="seccion-noticia">
                <option value="0">--- Ninguno ---</option>
                {foreach from=$secciones item=$seccion}
                    <option value={$seccion->id_seccion}>{$seccion->nombre_seccion}</option>
                {/foreach}
            </select>
            <label>Fecha:</label>
            <input type="datetime-local" name="fecha">
            <p class="text-center"></p>
            <div class="contenedor-btn-cargar">
                <input type="submit" class="btn-cargar" value="CARGAR">
            </div>
        </form>
    </div>

    <div class="contenedor-tabla-noticias">
        <table>
            <thead>
                <tr class="encabezado text-center">
                    <th>Titulo</th>
                    <th>Sección</th>
                    <th>Detalle</th>
                    <th>Fecha de subida</th>
                    {if true}
                        <th>Eliminar</th>
                        <th>Editar</th>
                    {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$noticias item=$noticia}
                    <tr>
                        <td>{$noticia->titulo}</td>
                        <td>{$noticia->nombre_seccion}</td>
                        <td>{$noticia->detalle}</td>
                        <td>{$noticia->fecha_subida}</td>
                        {if true}
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
                        {/if}
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>

    <div class="update-noticia-formulario {$activo}" id="form-modificar">
        <div class="contenido-principal">
            <form class="formulario-modificar-noticia" action="updateNoticia/{$noticia->id_noticia}" method="POST">
                <h1>MODIFICAR NOTICIA</h1>
                <label>Título:</label>
                <input type="text" name="titulo" placeholder="Ingresa el título de la noticia"
                    value="{$noticia->titulo}">
                <label>Detalle:</label>
                <input type="text" name="detalle" placeholder="Ingresa el detalle de la noticia"
                    value="{$noticia->detalle}">
                <label>Sección:</label>
                <select name="secciones" class="seccion-noticia">
                    <option value="0">--- Ninguno ---</option>
                    {foreach from=$secciones item=$seccion}
                        {if $seccion->id_seccion == $noticia->id_seccion}
                            <option value={$seccion->id_seccion} selected>{$seccion->nombre_seccion}</option>
                        {else}
                            <option value={$seccion->id_seccion}>{$seccion->nombre_seccion}</option>
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


    
 </section>
<section class="contenedor-principal container">
    <div class="cargar-noticia-formulario">
        <form class="formulario-cargar-noticia" action="createSeccion" method="POST">
            <h1>CARGAR SECCIÓN</h1>
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Ingresa el título de la noticia">
            {* <label>Detalle:</label>
            <input type="text" name="detalle" placeholder="Ingresa el detalle de la noticia">
            <label>Sección:</label>
            <select name="secciones" class="seccion-noticia">
                <option value="0">--- Ninguno ---</option>
                {foreach from=$secciones item=$seccion}
                    <option value={$seccion->id_seccion}>{$seccion->nombre_seccion}</option>
                {/foreach}
            </select>
            <label>Fecha:</label>
            <input type="datetime-local" name="fecha"> *}
            <p class="text-center"></p>
            <div class="contenedor-btn-cargar">
                <input type="submit" class="btn-cargar" value="CARGAR">
            </div>
        </form>
    </div>

    <div class="contenedor-tabla-noticias">
        <table>
            <thead>
                <tr class="encabezado text-center">
                    <th>Nombre</th>
                    {* <th>Sección</th>
                    <th>Detalle</th>
                    <th>Fecha de subida</th> *}
                    {if true}
                        <th>Eliminar</th>
                        <th>Editar</th>
                    {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$secciones item=$seccion}
                    <tr>
                        <td>{$seccion->nombre_seccion}</td>
                        {* <td>{$noticia->nombre_seccion}</td>
                        <td>{$noticia->detalle}</td>
                        <td>{$noticia->fecha_subida}</td> *}
                        {if true}
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
                        {/if}
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>

    <div id="form-modificar">
        <div class="contenido-principal">
            <form class="formulario-modificar-seccion" action="updateSeccion/{$seccion->id_seccion}" method="POST">
                <h1>MODIFICAR SECCIÓN</h1>
                <label>Nombre:</label>
                <input type="text" name="nombre" placeholder="Ingresa el nombre de la seccion"
                    value="{$seccion->nombre_seccion}">
                <p class="text-center"></p>
                <div class="contenedor-btn-cargar">
                    <input type="submit" class="btn-cargar" value="MODIFICAR">
                </div>
            </form>
        </div>
    </div>


    
</section>
{include file='templates/footer.tpl'}