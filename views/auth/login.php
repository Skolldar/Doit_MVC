<div class="contenedor login">

    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Sign in</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>


        <form class="formulario" method="POST" action="/" novalidate>
            <div class="campo">
                <label for="email">                
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </label>
                <input
                    type="email"
                    id="email"
                    placeholder="Your email"
                    name="email"
                />
            </div>
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
            <input type="submit" class="boton" value="Log in">
        </form>
        <div class="acciones">
            <a href="/create">Don't have an account yet? Create one</a>
            <a href="/forget">Forgot your password?</a>
        </div>
    </div> <!---.contenedor-sm-->
</div>