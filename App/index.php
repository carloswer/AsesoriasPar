<?php

    require_once "config.php";
    $tituloPagina = "Inicio";

?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

    <div class="encabezado">
        <div class="container">
            <h1>Bienvenido a la plataforma de Asesorias Par</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Amet consequuntur, explicabo. Beatae dolorum exercitationem
                expedita harum ipsum iure odio, tempore. Eum facilis id itaque
                nobis non officia tempore veniam veritatis.
            </p>
            <div class="buttons">
                <a href="login.php" class="btn btn-default" >Iniciar Sesion</a>
                <a href="registro.php" class="btn btn-primary" >Registrarse</a>
            </div>
        </div>
    </div>
    <!--fin encabezado-->



<?php include_once TEMPLATE_PATH."/footer.php"; ?>
