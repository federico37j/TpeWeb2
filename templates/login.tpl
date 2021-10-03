{include file='templates/header.tpl'}

<div class="acceder">
    <div class="contenedor-registrarse acceder-formulario">
        <form method="POST" action="registrar">
            <h2>Registro</h2>
            <p class="text-center mensaje mensaje-exito">{$exito}</p>
            <label>E-mail:</label>
            <input type="email" name="email" placeholder="Ingresa tu email" required/>
            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Ingresa su contraseña" required/>
            <a href="login" class="" target="_blank">¿Aún no tienes una cuenta?</a>
            <div>
                <button class="btn-cargar" type="submit">Crear usuario</button>
            </div>
        </form>
    </div>
    <div class="acceder-formulario contenedor-acceder">
        <form method="POST" action="acceder">
            <h2>Bienvenido/a</h2>
            <p class="text-center mensaje mensaje-error">{$error}</p>
            <label>E-mail:</label>
            <input type="email" name="email"placeholder="Ingresa tu email" required>
            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Ingresa su contraseña" required>
            <a href="login" class="olvidado-password" target="_blank">¿Has olvidado tu contraseña?</a>
            <div>
                <button class="btn-iniciar" type="submit">Iniciar sesión</button>
            </div>
        </form>
    </div>
</div>

{include file='templates/footer.tpl'}