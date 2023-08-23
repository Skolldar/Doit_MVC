    <?php include_once __DIR__ . '/header-dashboard.php'; ?>

    <?php if(count($proyectos) === 0) { ?>
        <p class="no-proyectos">There's not yet Project. <a href="/create-projects">       
        <i class="fa fa-pencil" aria-hidden="true"></i>
        </a></p>
    <?php } else { ?>
            <ul class="listado-proyectos">
                <?php foreach($proyectos as $proyecto) { ?>
                    <li class="proyecto">
                        <a href="/project?id=<?php echo $proyecto->url; ?>">
                            <?php echo $proyecto->proyecto; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>

    <?php include_once __DIR__ . '/footer-dashboard.php'; ?>