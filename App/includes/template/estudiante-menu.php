<?php
    use Control\Sesiones;
?>


<h1>Bienvenido usuario: <?= Sesiones::getStudentName() ?></h1>
<h4>Has iniciado como: <?= Sesiones::getStudentType(); ?></h4>

<!--Logout-->
<a href="<?= ROOT_REF."/logout.php"; ?>">cerrar sesion</a>

<!--MENU DEL USUARIO-->
<ul>
    <li><a href="<?= EST_REF."/"; ?>">Inicio</a></li>
    <li><a href="<?= EST_REF."/asesorias/"; ?>">Asesorias</a></li>
    <li><a href="<?= EST_REF."/acceso.php"; ?>">Cambiar Tipo</a></li>

    <?php if( Sesiones::isAsesor() ): ?>
        <li><a href="<?= EST_REF."/horario/"; ?>">Horario</a></li>
    <?php endif; ?>

    <li><a href="#">Perfil</a></li>
</ul>

<!-- Elementos con datos para utilizar con AJAX -->
 <input type="hidden" id="student-data" data-id="<?= Sesiones::getStudentId() ?>">