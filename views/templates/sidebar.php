<aside class="sidebar">
    <h2 class="doit">Do-it</h2>

    <nav class="sidebar-nav">
        <div class="<?php echo ($title === 'Projects') ? 'activo' : ''; ?>">
        <div class="icon">
        <i class="fa fa-suitcase" aria-hidden="true"></i>
        <a href="/dashboard">Projects</a>
        </div>
        </div>

        <div class="<?php echo ($title === 'Create Projects') ? 'activo' : ''; ?>">
        <div class="icon">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        <a href="/create-projects">Create Projects</a>
        </div>
        </div>

        <div class="<?php echo ($title === 'Profile') ? 'activo' : ''; ?>">
        <div class="icon">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        <a class="<?php ?>" href="/profile">Profile</a>
        </div>
        </div>
    </nav>
</aside>