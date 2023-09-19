<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST">

        <div class="campo">
        <label for="nombre">Name</label>
        <input
        type="text"
        value="<?php echo $usuario->nombre; ?>"
        name="nombre"
        placeholder="Your name"
        />
        </div>  

        <div class="campo">
        <label for="email">Email</label>
        <input
        type="email"
        value="<?php echo $usuario->email; ?>"
        name="email"
        placeholder="Your email"
        />
        </div>

        <input type="submit" value="Save Changes">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>