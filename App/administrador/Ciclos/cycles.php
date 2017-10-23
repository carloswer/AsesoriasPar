
<?php

require_once "../../config.php";

use Control\ControlCiclos;

$conCycles = new ControlCiclos();

$cyclesArray = $conCycles->getCycles();

?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

<div class="container-fluid">
    <div id="page-content-wrapper">
        <div class="panel panel-default">

            <div class="row">

                <!-- Segunda columa -->
                <div class="col-md-6">
                    <center><h1>Agregar Ciclo Nuevo</h1></center>
                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <div class="col-sm-7 col-md-6">
                                <label for="start" >Inicio:</label>
                            </div>
                            <div class="hidden-xs col-sm-5 col-md-6">
                                <label for="end" >Fin:</label>
                            </div>
                            <div class="col-sm-7 col-md-4">
                                <input type="date" class="form-control input-materia" id="start" name="start">
                            </div>
                            <div class="col-sm-5 col-md-4 col-md-offset-2">
                                <input type="date" class="form-control input-materia" id="end" name="end">
                            </div>
                        </div>

                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-register-cycle" class="boton-agregar btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span>Registrar</button>
                            </div>
                            <span id="registerCycle-result"></span>
                        </div>

                    </form>
                </div>  <!-- SEGUNDA COLUMNA -->


<!--                ------------------------------ACTUALIZAR -->
                <!-- Segunda columa -->
                <div class="col-md-6">
                    <h1><center>Actualizar ciclo</center></h1>
                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <label for="ciclos" class="">Ciclo</label>
                            <select name="id_cycle" id="id_cycleU" class="form-control">
                                <?php foreach($cyclesArray as $ciclo): ?>
                                    <option value="<?= $ciclo->getId(); ?>"><?= $ciclo->getStart()." a ". $ciclo->getEnd(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-7 col-md-6">
                                <label for="start" >Inicio:</label>
                            </div>
                            <div class="hidden-xs col-sm-5 col-md-6">
                                <label for="end" >Fin:</label>
                            </div>
                            <div class="col-sm-7 col-md-4">
                                <input type="date" class="form-control input-materia" id="startU" name="startU">
                            </div>
                            <div class="col-sm-5 col-md-4 col-md-offset-2">
                                <input type="date" class="form-control input-materia" id="endU" name="endU">
                            </div>
                        </div>

                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-update-cycle" class="boton-agregar btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span>Actualizar</button>
                            </div>
                            <span id="updateCycle-result"></span>
                        </div>

                    </form>
                </div>


                <!--------------------------------ELIMINAR-->
                <!-- Segunda columa -->
                <div class="col-md-4">
                    <h1><center>Eliminar ciclo</center></h1>
                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <label for="ciclos" class="">Ciclo</label>
                            <select name="id_cycleD" id="id_cycleD" class="form-control">
                                <?php foreach($cyclesArray as $ciclo): ?>
                                    <option value="<?= $ciclo->getId(); ?>"><?= $ciclo->getStart()." a ". $ciclo->getEnd(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-5">
                                <button type="button" id="btn-delete-cycle" class="btn btn-danger form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span> Eliminar</button>
                            </div>
                            <span id="deleteCycle-result"></span>
                        </div>

                    </form>
                </div>
            </div> <!-- FILA PRINCIPAL -->


            </div> <!-- FILA PRINCIPAL -->


        </div> <!-- PANEL -->
    </div>
</div> <!-- Container -->

<?php include_once TEMPLATE_PATH."/footer.php"; ?>
