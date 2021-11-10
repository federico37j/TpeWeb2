{include file='templates/header.tpl'}

{if true}
    {* {if $mostrar === "usuarios"} *}
        <section class="contenedor-principal container">    

        <div class="contenedor-tabla-seccion">
            <table>
                <thead>
                    <tr class="encabezado text-center">
                        <th>Email</th>
                        <th>Asignar/Quitar Admin</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$usuarios item=$usuario}
                        <tr>
                            <td>{$usuario->email}</td>
                            <td>
                                {if $usuario->id_rol != 1}<a href="modificarRol/{$usuario->id_usuario}" class="btn-editar-noticia">
                                        <ion-icon name="person-add-outline"></ion-icon>
                                </a>{/if}
                                {if $usuario->id_rol eq 1}<a href="modificarRol/{$usuario->id_usuario}" class="btn-borrar-noticia">
                                        <ion-icon name="person-remove-outline"></ion-icon>
                                </a>{/if}
                            </td>
                            <td>
                                <a href="deleteUser/{$usuario->id_usuario}" class="btn-borrar-noticia">
                                    <ion-icon name="close-circle-outline"></ion-icon>
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        </section>
    {/if}

    {include file='templates/footer.tpl'}