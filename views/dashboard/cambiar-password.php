<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/profile" class="enlace">Back to Profile</a>


    <form class="formulario" method="POST" action="/cambiar-password">

        <div class="campo">
        <label for="nombre">Password Actual</label>
        <input
        type="password"
        name="password_actual"
        placeholder="Your actual password"
        />
        </div>  

        <div class="campo">
        <label for="nombre">New Password</label>
        <input
        type="password"
        name="password_nuevo"
        placeholder="Your new password"
        />
        </div>

        <input type="submit" value="Save Changes">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>