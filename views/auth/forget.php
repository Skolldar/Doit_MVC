<div class="contenedor forget">

    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
    <p class="descripcion-pagina">Recover your access Do-it</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form class="formulario" method="POST" action="/forget" novalidate>
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
            <input type="submit" class="boton" value="Send">
        </form>
        <div class="acciones">
        <a href="/">Already have an account? Sign in</a>
        <a href="/create">Don't have an account yet? Create one</a>
        </div>
    </div> <!---.contenedor-sm-->
</div>