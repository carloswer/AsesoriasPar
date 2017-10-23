<?php

    require_once '../../config.php';
    include_once '../sesion.php';

    use Control\Funciones;
    use Control\Sesiones;
    use Control\ControlHorarios;
    use Control\ControlMaterias;
    use Control\ControlEstudiantes;
    use Objetos\Materia;


//Si se es alumno
    if( !Sesiones::isAsesor() )
        header("Location: ../index.php");


    $conHorarios = new ControlHorarios();
    $conMaterias = new ControlMaterias();
    $conEstudiantes = new ControlEstudiantes();


    //Si hay un ciclo actual
    $cicloActual = $conHorarios->getCurrentCycle();
    if( $cicloActual == null )
        header("Location: index.php");


    //Se verifica si ya tiene horario
    $schedule = $conHorarios->haveStudentCurrSchedule( Sesiones::getStudentId() );
    //Si ya tiene, se redirecciona
    if( $schedule === true )
        header("Location: index.php");

    //----Si no tiene horario
    //Obtiene dias y horas
    $hoursArray = $conHorarios->getHoursAndDays();
    //----Obtiene materias
    $subjectsArray = $conMaterias->getSubject_ByCarrerId( Sesiones::getStudentCarrer()->getId() );


?>


    <?php include_once TEMPLATE_PATH."/header.php"; ?>
    <div class="container">
        <?php include_once TEMPLATE_PATH."/estudiante-menu.php"; ?>
        <h1>Crear Horario</h1>


        <?php if( $subjectsArray == null ): ?>
            <h4>No hay materias disponibles</h4>
        <?php else: ?>

            <?php if( $hoursArray == null ): ?>
                <h4>No hay dias/horas disponibles para registro. Contacte Administrador</h4>
            <?php else: ?>

            <!-- TABLA DE HORARIO -->
<!--                <div class="horario multi-select">-->
                    <div class="schedule-table schedule-single-select" id="schedule-table">
                        <?= Funciones::makeScheduleTable( $hoursArray, $schedule );  ?>
                    </div>

                    <!-- Seccion de materias -->
                    <div class="materias">
                        <h4>Seleccione materias</h4>
                        <div class="controles form-inline" style="margin-bottom: 20px;">

                            <div class="form-group">
                                <label for="buscar-materia">Buscar:</label>
                                <input type="text" id="buscar-materia" class="form-control" placeholder="buscar">
                            </div>

                            <div class="form-group">
                                <label for="">Carrera:</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">ISW</option>
                                    <option value="2">IMT</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Plan:</label>
                                <select name="" id="" class="form-control">
                                    <option value="2009">2009</option>
                                    <option value="2016">2016</option>
                                </select>
                            </div>

                        </div>


                        <?php foreach($subjectsArray as $sub ): /**@var $sub Materia*/?>
                            <span href="javascript:void(0)" class="materia-item" data-id="<?= $sub->getId(); ?>"><?php echo $sub->getName(); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <br>
                    <div id="opciones">
                        <button id="btn-registrar-horario" class="btn btn-success">Registrar horario</button>
                        <button id="btn-reset-horario" class="btn btn-default">Reset</button>
                        <a href="index.php" class="btn btn-danger">Cancelar</a>

                        <span id="horario__registro-status"></span>
                    </div>
                </div>


                <br><br><br>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php include_once TEMPLATE_PATH."/footer.php"; ?>