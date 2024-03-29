<aside class="sidebar">
    <div class="contenedor-sidebar">
        <h2 class="doit">Do-it</h2>

        <div class="cerrar-menu">
            <img id="cerrar-menu" src="build/img/cerrar.svg" alt="imagen cerrar menu">
        </div>
     
    </div>

        <nav class="sidebar-nav">
        <div class="<?php echo ($title === 'Projects') ? 'activo' : ''; ?>">
        <div class="icon">
        <a href="/dashboard">        
            <i class="fa fa-suitcase fa-lg" aria-hidden="true"></i>
            Projects</a>
        </div>
        </div>

        <div class="<?php echo ($title === 'Create Projects') ? 'activo' : ''; ?>">
        <div class="icon">
        <a href="/create-projects">
        <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
            Create Projects</a>
        </div>
        </div>

        <div class="<?php echo ($title === 'Profile') ? 'activo' : ''; ?>">
        <div class="icon">
        <a href="/profile">
        <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
            Profile</a>
        </div>
        </div>
    </nav>

    <div class="cerrar-sesion-mobile">
        <a href="/logout" class="cerrar-sesion">Log Out</a>
    </div>
</aside>