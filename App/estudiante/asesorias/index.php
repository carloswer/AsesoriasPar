<?php

    require_once '../../config.php';
    include_once '../sesion.php';

    use Control\ControlAsesorias;
    use Control\ControlHorarios;
    use Control\Sesiones;

    $conAsesorias = new ControlAsesorias();
    $conSchedule = new ControlHorarios();

    $cycle = $conSchedule->getCurrentCycle();

    $arrayAsesorias = null;

    if( $cycle != null ){
        //Si es alumno
        if( Sesiones::isAlumno() )
            $conAsesorias->getCurrentAsesoriasLikeAlumno_ByStudent( Sesiones::getStudentId() );
        else
            $conAsesorias->getCurrentAsesoriasLikeAsesor_ByStudent( Sesiones::getStudentId() );
    }


?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

<!--MENU-->
<div class="container">
    <?php include_once TEMPLATE_PATH."/estudiante-menu.php"; ?>
    <h2>Asesorias</h2>

    <?php if( $cycle == null ): ?>
        <h3>No hay un ciclo actual disponible</h3>

    <?php else: ?>
        <?php if( Sesiones::isAlumno() ): ?>
            <div class="opciones">
                <h3>
                    <a href="solicitar.php" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> Solicitar Asesoria
                    </a>
                </h3>
            </div>
        <?php endif; ?>

        <?php if( $arrayAsesorias == null ): ?>
            <?php if( Sesiones::isAlumno() ): ?>
                <h3>No cuenta con asesorias registradas</h3
            <?php else: ?>
                <h3>No cuenta con solicitudes de asesorias</h3
            <?php endif; ?>

        <?php else: ?>


<!--                <div class="filtro-asesorias">-->
<!--                    <!-- Filtro -->-->
<!--                    <label for="filtro-asesorias">Filtrar por:</label>-->
<!--                    <select name="" id="filtro-asesorias">-->
<!--                        <option value="0">Todas</option>-->
<!--                        <option value="1">Proximas</option>-->
<!--                        <option value="2">Sin validar</option>-->
<!--                        <option value="3">Validadas</option>-->
<!--                    </select>-->
<!---->
<!--                    <label for="">Buscar:</label>-->
<!--                    <input type="text" placeholder="nombre..">-->
<!---->
<!--                    <label for="">Fecha desde:</label>-->
<!--                    <input type="date">-->
<!---->
<!--                    <label for="">Hasa:</label>-->
<!--                    <input type="date">-->
<!--                </div>-->

                <div class="table-responsive">
                    <!-- Registros -->
                    <table class="table table-striped">
                        <thead class="thead-inverse">
                            <tr>
<!--                                <th>Id</th>-->
                                <th><?= ( Sesiones::isAlumno() ) ? "Asesor" : "Alumno" ?></th>
                                <th>Fecha Solicitud</th>
                                <th>Fecha Asesoria</th>
                                <th>Hora</th>
                                <th>Materia</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-asesorias">
                            <?php foreach($arrayAsesorias as $asesoria ): ?>
                                <tr class="warning">
                                    <!--<td><?php //$asesoria->getId(); ?></td>-->
                                    <th><?= ( Sesiones::isAlumno() ) ? $asesoria->getAsesor()['nombre'] : $asesoria->getAlumno()['nombre'] ?></th>
                                    <td><?= $asesoria->getFechaSolicitud(); ?></td>
                                    <td><?= $asesoria->getFechaAsesoria(); ?></td>
                                    <td><?= $asesoria->getHora(); ?></td>
                                    <td><?= $asesoria->getMateria()['nombre']; ?></td>
                                    <td><?= $asesoria->getDescripcion(); ?></td>
                                    <td>
                                        <?= $conAsesorias->verificarEstado( $asesoria->getEstado(), $asesoria->getFechaAsesoria() ); ?>
                                    </td>
                                    <td>
                                        <?= $conAsesorias->obtenerOpcion( $asesoria->getEstado() ); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

        <?php endif; ?>
    <?php endif; ?>


</div>

<?php include_once TEMPLATE_PATH."/footer.php"; ?>


