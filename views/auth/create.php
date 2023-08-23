<div class="contenedor create">
<?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Create your Account in Do-it</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form class="formulario" method="POST" action="/create">
        <div class="campo">
                <label for="nombre">                
                <i class="fa fa-user" aria-hidden="true"></i>
                </label>
                <input
                    type="text"
                    id="nombre"
                    placeholder="Your name"
                    name="nombre"
                    value="<?php echo $usuario->nombre ?>"
                />
            </div>
            <div class="campo">
                <label for="email">                
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </label>
                <input
                    type="email"
                    id="email"
                    placeholder="Your email"
                    name="email"
                    value="<?php echo $usuario->email ?>"

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
            <div class="campo">
                <label for="password2">
                <i class="fa fa-lock" aria-hidden="true"></i>
                </label>
                <input
                    type="password"
                    id="password2"
                    placeholder="Repeat password"
                    name="password2"
                />
            </div>
            <input type="submit" class="boton" value="Create Account">
        </form>
        <div class="acciones">
            <a href="/">Already have an account? Sign in</a>
            <a href="/forget">Forgot your password?</a>
        </div>
    </div> <!---.contenedor-sm-->
</div>