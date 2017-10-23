<?php

    //TODO: checar cada vez que se realice algo que el usuario aun existe
    //TODO: checar que los registros a utilizar aun existan (validar)
    require_once "config.php";
    use Control\Sesiones;
    
    // Comprobar que haya una session activa
    if( Sesiones::isSessionON() ){
        if( Sesiones::isAdmin() )
            header("Location: administrador/");
        else
            header("Location: estudiante/");
    }

?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

    <div class="container">
    	<div class="login-container col-md-6 col-md-offset-3 text-center">
    		<h1>Iniciar Sesion</h1>
            <div id="login-status" class="status"></div>
    		
    		<form id="login-form">
    			<div class="form-group">
    				<label for="" class="sr-only label-control">Usuario</label>
    				<input type="text" class="form-control" id="txtUser" placeholder="Usuario" name="user" required="true">
    			</div>

    			<div class="form-group">
    				<label for="" class="sr-only label-control">Contraseña</label>
    				<input type="password" class="form-control" id="txtPass" placeholder="Contraseña" name="pass" required="true">
    			</div>

    			<button id="btn-auth" class="form-control btn btn-primary" type="submit">
    				<span id="login-spin" class="none">
                        <i class="icon fa fa-spinner fa-spin"></i>
    				</span>
    				Iniciar
    			</button>
    		</form>
            <span class="text-center">
                <a href="registro.php">Registrarse</a>
            </span>

    	</div>
    </div>



<?php include_once TEMPLATE_PATH."/footer.php"; ?>
