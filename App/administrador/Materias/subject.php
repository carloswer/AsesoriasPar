
<?php

require_once "../../config.php";

use Control\ControlMaterias;
use Control\ControlCarreras;

$conSubject = new ControlMaterias();
$conCareers = new ControlCarreras();

$subjectArray = $conSubject->getSubjects();
$careersArray = $conCareers->getCareers();

?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

<div class="container-fluid">
    <div id="page-content-wrapper">
        <div class="panel panel-default">

            <div class="row">

                <!---------------AGREGAR UNA CARRERA------------------------>
                <div class="col-md-6">
                    <center><h1>Agregar Materia</h1></center>
                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <div class="input-group inputMateria col-xs-12">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" min="3" name="name" id="name" class="form-control" placeholder="Nombre" required>
                            </div>

                            <div class="input-group inputMateria ">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" min="3" id="short_name" name="short_name" class="form-control" placeholder="abreviatura" required>
                            </div>
                            <div class="input-group inputMateria ">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" min="3" id="description" name="description" class="form-control" placeholder="descripcion" required>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6 inputMateria ">
                                    <select class="form-control" class="combo" id="career" name="career">
                                        <?php foreach($careersArray as $career): ?>
                                            <option value="<?= $career->getId(); ?>"><?= $career->getName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-6 inputMateria ">
                                    <select class="form-control" class="combo" id="plan" name="plan">
                                        <option value="2009" >2009</option>
                                        <option value="2017">2017</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 inputMateria">
                                <label for="semester">Semestre</label>
                                <select class="form-control" class="combo" id="semester" name="semester">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>

                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-register-subject" class="boton-agregar btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span>Agregar</button>
                            </div>
                            <span id="registerSubject-result"></span>
                        </div>
                    </form>
                </div>


                <!---------------ACTUALIZAR UNA CARRERA------------------------>
                <div class="col-md-6">
                    <center><h1>Actualizar Materia</h1></center>
                    <form id="formulario-Perfil">

                        <div class="col-xs-12 col-md-6" style="margin-bottom: 10px; ">
                            <select class="form-control" class="combo" id="subjectU" name="subjectU">
                                <?php foreach($subjectArray as $subject): ?>
                                    <option value="<?= $subject->getId(); ?>"><?= $subject->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="input-group inputMateria col-xs-12">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" min="3" name="nameU" id="nameU" class="form-control" placeholder="Nombre" required>
                            </div>

                            <div class="input-group inputMateria ">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" min="3" id="short_nameU" name="short_nameU" class="form-control" placeholder="abreviatura" required>
                            </div>
                            <div class="input-group inputMateria ">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" min="3" id="descriptionU" name="descriptionU" class="form-control" placeholder="descripcion" required>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 inputMateria ">
                                    <select class="form-control" class="combo" id="careerU" name="careerU">
                                        <?php foreach($careersArray as $career): ?>
                                            <option value="<?= $career->getId(); ?>"><?= $career->getName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-6 inputMateria ">
                                    <select class="form-control" class="combo" id="planU" name="planU">
                                        <option value="2009" >2009</option>
                                        <option value="2017">2017</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 inputMateria">
                                    <label for="semester">Semestre</label>
                                    <select class="form-control" class="combo" id="semesterU" name="semesterU">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-update-subject" class="boton-agregar btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span> Actualizar </button>
                            </div>
                            <span id="updateSubject-result"></span>
                        </div>
                    </form>
                </div>


                <!---------------AGREGAR UNA CARRERA------------------------>
                <div class="col-md-6">
                    <center><h1>Eliminar Materia</h1></center>
                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <label for="carreras" class="">Materia</label>
                            <select class="form-control" class="combo" id="subjectD" name="subjectD">
                                <?php foreach($subjectArray as $subject): ?>
                                    <option value="<?= $subject->getId(); ?>"><?= $subject->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="container-fluid">
                            <div class="col-sm-6 col-md-4 col-sm-offset-2">
                                <button type="button" id="btn-delete-subject" class="boton-agregar btn btn-danger form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-floppy-disk"></span> Eliminar</button>
                            </div>
                            <span id="deleteSubject-result"></span>
                        </div>
                    </form>
                </div>

                <!-----------------BUSCAR UNA MATERIA----------------------->

                <div class="col-md-6">
                    <center><h1>Buscar materia</h1></center>

                    <form id="formulario-Perfil">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="subjectS" class="">Buscar por:</label>
                                    <select name="subjectS" id="subjectS" class="form-control">
                                        <option value="id">ID</option>
                                        <option value="name">Nombre</option>
                                        <option value="shortName">Abreviatura</option>
                                        <option value="career">Carrera</option>
                                        <option value="plan">Plan educativo</option>
                                        <option value="semester">Semestre</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 ">
                                    <label for="search" class="">Valor:</label>
                                    <input type="text" class="form-control input-materia" id="search" name="search">
                                </div>
                                <div class="col-sm-12">
                                    <label for="searchSubject" class="">Resultado:</label>
                                </div>
                                <div class="col-sm-12">
                                    <span id="searchSubject-result"></span>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid row ">
                            <div class="col-sm-6 col-md-4">
                                <button type="button" id="btn-search-subject" class="boton-primary btn btn-success form-control btn-md" style="margin-top: 30px;"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                            </div>
                        </div>

                    </form>
                </div>




            </div> <!-- FILA PRINCIPAL -->

        </div> <!-- PANEL -->
    </div>
</div> <!-- Container -->

<?php include_once TEMPLATE_PATH."/footer.php"; ?>