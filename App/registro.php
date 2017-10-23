<?php

    require_once "config.php";
    use Control\Sesiones;
    use Control\ControlCarreras;

    $conCareers = new ControlCarreras();

    $careersArray = $conCareers->getCareers();

?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

<div class="container">

    <div id="singup-form" class="formulario col-xs-12">
        <form method="post">

            <div class="row">

                <!--Usuario-->
                <div class="usuario col-xs-12 col-sm-6">
                    <div class="text-center">
                        <h4>Datos de Acceso</h4>
                    </div>

                    <div class="form-group">
                        <label for="username" class="">Nombre de usuario</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="username" id="username" class="form-control" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass" class="">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Contraseña" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass2" class="">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Contraseña" required>
                        </div>
                    </div>
                </div>

                <!--Estudiante-->
                <div class="estudiante col-xs-12 col-sm-6">
                    <div class="text-center">
                        <h4>Datos del Estudiante</h4>
                    </div>

                    <div class="form-group">
                        <label for="first_name" class="">Nombre</label>
                        <div class="input-group col-xs-12">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" min="3" name="first_name" id="first_name" class="form-control" placeholder="Nombre" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="">Apellido</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" min="3" id="last_name" name="last_name" class="form-control" placeholder="Apellido" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="">ID ITSON</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span></span>
                            <input type="text" name="id_itson" id="id_itson" class="form-control" placeholder="00000...." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="career" class="">Carrera</label>
                        <select name="career" id="career" class="form-control">
                            <?php foreach($careersArray as $career): ?>
                                <option value="<?= $career->getId(); ?>"><?= $career->getShortName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!--Boton de registro-->
            <div class="row">
                <div class="control col-xs-12">
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-success">
                        <span id="signup-spin" class="none">
                            <i class="icon fa fa-spinner fa-spin"></i>
    				    </span>
                            Registrar
                        </button>
                    </div>
                    <br>
                    <span id="singup-result"></span>

                    <div class="iniciarSesion text-center">
                        <p id="pie" ><a href="login.php">Ya tengo una cuenta</a></p>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<?php include_once TEMPLATE_PATH."/footer.php"; ?>