
<?php

require_once "../../config.php";

use Control\ControlCarreras;

$conCareers = new ControlCarreras();
$careersArray = $conCareers->getCareers();

?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

<div class="container-fluid">
    <div id="page-content-wrapper">
        <div class="panel panel-default">

            <div class="row">

            <!---------------AGREGAR UNA CARRERA------------------------>
                <div class="col-md-6">
                    <center><h1>Agregar carrera</h1></center>
                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <div class="col-sm-7 col-md-6">
                                <label for="name" >Nombre:</label>
                            </div>
                            <div class="hidden-xs col-sm-5 col-md-6">
                                <label for="short-name" >Abreviatura:</label>
                            </div>
                            <div class="col-sm-7 col-md-4">
                                <input type="text" class="form-control input-materia" id="name" name="name">
                            </div>
                            <div class="col-sm-5 col-md-4 col-md-offset-2">
                                <input type="text" class="form-control input-materia" id="short_name" name="short_name">
                            </div>
                        </div>

                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-register-career" class="boton-agregar btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span>Agregar</button>
                            </div>
                            <span id="registerCareer-result"></span>
                        </div>

                    </form>
                </div>

                <!---------------ACTUALIZAR UNA CARRERA------------------------>

                <div class="col-md-6">
                    <center><h1>Actualizar carrera</h1></center>

                    <form id="formulario-Perfil">
                        <div class="form-group">
                            <label for="carreras" class="">Carrera</label>
                            <select name="id_careerU" id="id_careerU" class="form-control">
                                <?php foreach($careersArray as $career): ?>
                                    <option value="<?= $career->getId(); ?>"><?= $career->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-7 col-md-6">
                                <label for="name" >Nombre:</label>
                            </div>
                            <div class="hidden-xs col-sm-5 col-md-6">
                                <label for="short-name" >Abreviatura:</label>
                            </div>
                            <div class="col-sm-7 col-md-4">
                                <input type="text" class="form-control input-materia" id="nameU" name="nameU">
                            </div>
                            <div class="col-sm-5 col-md-4 col-md-offset-2">
                                <input type="text" class="form-control input-materia" id="short_nameU" name="short_nameU">
                            </div>
                        </div>

                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-update-career" class="boton-agregar btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span> Actualizar</button>
                            </div>
                            <span id="updateCareer-result"></span>
                        </div>

                    </form>
                </div>

                <!---------------ELIMINAR UNA CARRERA------------------------>

                <div class="col-md-6">
                    <center><h1>Eliminar Carrera</h1></center>

                    <form id="formulario-Perfil">
                        <div class="form-group">
                            <label for="carreras" class="">Carrera</label>
                            <select name="id_careerD" id="id_careerD" class="form-control">
                                <?php foreach($careersArray as $career): ?>
                                    <option value="<?= $career->getId(); ?>"><?= $career->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-delete-career" class="btn btn-danger form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span> Eliminar</button>
                            </div>
                            <span id="deleteCareer-result"></span>
                        </div>

                    </form>
                </div>


                <!---------------BUSCAR UNA CARRERA------------------------>

                <div class="col-md-6">
                    <center><h1>Buscar carrera</h1></center>

                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="id_careerS" class="">Buscar por:</label>
                                    <select name="id_careerS" id="id_careerS" class="form-control">
                                        <option value="id">ID</option>
                                        <option value="name">Nombre</option>
                                        <option value="shortName">Abreviatura</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 ">
                                    <label for="search" class="">Valor:</label>
                                    <input type="text" class="form-control input-materia" id="search" name="search">
                                </div>
                                <div class="col-sm-12">
                                    <label for="searchCareer" class="">Resultado:</label>
                                </div>
                                <div class="col-sm-12">
                                    <span id="searchCareer-result"></span>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-search-career" class="boton-primary btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div> <!-- FILA PRINCIPAL -->

        </div> <!-- PANEL -->
    </div>
</div> <!-- Container -->

<?php include_once TEMPLATE_PATH."/footer.php"; ?>
