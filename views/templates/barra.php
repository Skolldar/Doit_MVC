<div class="barra-mobile">
    <h1>Do-it</h1>

    <div class="menu">
        <img id="mobile-menu" src="build/img/menu.svg" alt="imagen menu">
    </div>

</div>

<div class="barra">
    <p>Hola: <span><?php echo $_SESSION['nombre']; ?></span></p>

    <div  class="cerrar-sesion">
    <a href="/logout">
    <i class="fa fa-sign-out" aria-hidden="true"></i>
    </a>
    </div>
</div>