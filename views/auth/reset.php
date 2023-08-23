<div class="contenedor reset">

    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Enter your new password</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if($mostrar) { ?> 

        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">
                <i class="fa fa-lock" aria-hidden="true"></i>
                </label>
                <input
                    type="password"
                    id="password"
                    placeholder="Your password"
                    name="password"
                />
            </div>
            <input type="submit" class="boton" value="Save Password">
        </form>

        <?php } ?>

        <div class="acciones">
            <a href="/create">Don't have an account yet? Create one</a>
            <a href="/forget">Forgot your password?</a>
        </div>
    </div> <!---.contenedor-sm-->
</div>