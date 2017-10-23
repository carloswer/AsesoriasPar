

// ---------------
// Login
// ----------------

function ajaxAuth(data){
    $.ajax({
        url: 'ajax/auth.php',
        type: 'post',
        cache: false,
        // Los datos se mandan como si fuera GET para poder obtenerlos por separado
        data: "user="+data.user+"&pass="+data.pass,
        dataType: 'json',

        //Metodo que se ejecuta antes de enviar el request
        beforeSend: function(){
            //Quita mensaje si es que esta
            $('.login-message').remove();
            //Cambia el icono del span
            $('#login-spin').show();
        }
    })
    .done(function(response){

        //Identificando tipo
        if( response.type === "auth" ){

            //Cuando salio correcto
            if( response.result === true ){
                $('#login-status').html('<p class="login-message msj-exito bg-success">'+response.message+' - Redireccionando</p>');
                //Si es administrador
                if( response.value === 'administrador' )
                    setTimeout(function(){ window.location = "administrador/"; },1000);
                //Si es estudiante
                else
                    setTimeout(function(){ window.location = "estudiante/"; },1000);
            }
            else if( response.result === 'null' )
                $('#login-status').html('<p class="login-message msj-error bg-warning">'+response.message+'</p>');
            else if( response.result === 'error' ){
                $('#login-status').html('<p class="login-message msj-fail bg-danger">'+response.message+'</p>');
            }

        }
        else
            alert("Response desconocido: " + response);



    })
    .fail(function(){
        $('#login-status').html('<p class="login-message msj-fail bg-danger">Ocurrio un error, intentelo más tarde</p>');
    })
    .always(function(response){

        // oculta spin
        $('#login-spin').hide();
        console.log( response );

        // Coultar mensaje
        setTimeout(function(){
            $('.login-message').hide();
        },3000);
    });
}


// ---------------
// REGISTRO
// ----------------


function signupAjax( dataJSON ){
    var dataJSONString = JSON.stringify( dataJSON );

    $.ajax({
        url: 'ajax/register.php',
        type: 'post',
        //Tipo de dato que regresa
        dataType: 'json',
        data: {user_register: dataJSONString},
        cache:false,
        beforeSend: function(){
            //$('#signup-spin').show();
            $('#singup-result').html( "cargando..." );
        }
    })
    .done(function(response){

        //Si es del tipo
        if( response.type === "signup" ){

            //Si no se registro por algo
            if( response.result === false ){
                //TODO: poner mensaje amarilllo
                $('#singup-result').html( response.message );
            }
            //Si ocurre un error
            else if( response.result === 'error' ){
                //TODO: poner mensaje rojo
                $('#singup-result').html( response.message );
            }
            else{
                //TODO: poner mensaje verde
                $('#singup-result').html( "Se registro con éxito" );
                window.location = "login.php";
            }

        }

    })
    .fail(function(){
        $('#singup-result').html( "Ocurrio un error" );
    })
    .always( function(response) {
        // $('#signup-spin').hide();
        console.log(  response );
    });
}


//---------------------------------------------------------------------
// ----------------- AJAX DE CICLOS
//---------------------------------------------------------------------

function cycleAjax( dataJSON ){
    var dataJSONString = JSON.stringify( dataJSON );

    //Obtiene el tipo
    var obj = $.parseJSON(dataJSONString);
    var type = obj['type'];


    switch(type){

        //---------------------------------------------------------------------
        // AJAX REGISTER
        //---------------------------------------------------------------------


        case "register":
            $.ajax({
                url: 'ajax/registerCycle.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {cycle_register: dataJSONString},
                cache:false,
                beforeSend: function(){
                    $('#registerCycle-result').html( "cargando..." );
                }
            })
                .done(function(response){

                    //Si es del tipo
                    if( response.type === "registerCycle" ){

                        //Si no se registro por algo
                        if( response.result === false ){
                            //TODO: poner mensaje amarilllo
                            $('#registerCycle-result').html( response.message );
                        }
                        //Si ocurre un error
                        else if( response.result === 'error' ){
                            //TODO: poner mensaje rojo
                            $('#registerCycle-result').html( response.message );
                        }
                        else{
                            //TODO: poner mensaje verde
                            $('#registerCycle-result').html( "Se registro con éxito" );
                        }

                    }

                })
                .fail(function(){
                    $('#registerCycle-result').html( "Ocurrio un error" );
                })
                .always( function(response) {
                    // $('#signup-spin').hide();
                    console.log(  response );
                });
            break;

        //---------------------------------------------------------------------
        // AJAX UPDATE
        //---------------------------------------------------------------------

        case "update":
            $.ajax({
                url: 'ajax/updateCycle.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {cycle_update: dataJSONString},
                cache:false,
                beforeSend: function(){
                    $('#updateCycle-result').html( "cargando..." );
                }
            })
                .done(function(response){

                    //Si es del tipo
                    if( response.type === "updateCycle" ){

                        //Si no se registro por algo
                        if( response.result === false ){
                            //TODO: poner mensaje amarilllo
                            $('#updateCycle-result').html( response.message );
                        }
                        //Si ocurre un error
                        else if( response.result === 'error' ){
                            //TODO: poner mensaje rojo
                            $('#updateCycle-result').html( response.message );
                        }
                        else{
                            //TODO: poner mensaje verde
                            $('#updateCycle-result').html( "Se actualizo con éxito" );
                        }

                    }

                })
                .fail(function(){
                    $('#updateCycle-result').html( "Ocurrio un error" );
                })
                .always( function(response) {
                    // $('#signup-spin').hide();
                    console.log(  response );
                });
            break;

        //---------------------------------------------------------------------
        // AJAX DELETE
        //---------------------------------------------------------------------

        case "delete":
            $.ajax({
                url: 'ajax/deleteCycle.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {cycle_delete: dataJSONString},
                cache:false,
                beforeSend: function(){
                    $('#deleteCycle-result').html( "cargando..." );
                }
            })
                .done(function(response){

                    //Si es del tipo
                    if( response.type === "deleteCycle" ){

                        //Si no se registro por algo
                        if( response.result === false ){
                            //TODO: poner mensaje amarilllo
                            $('#deleteCycle-result').html( response.message );
                        }
                        //Si ocurre un error
                        else if( response.result === 'error' ){
                            //TODO: poner mensaje rojo
                            $('#deleteCycle-result').html( response.message );
                        }
                        else{
                            //TODO: poner mensaje verde
                            $('#deleteCycle-result').html( "Se elimino con éxito" );
                        }
                    }
                })
                .fail(function(){
                    $('#deleteCycle-result').html( "Ocurrio un error" );
                })
                .always( function(response) {
                    // $('#signup-spin').hide();
                    console.log(  response );
                });
            break;
    }
}

//---------------------------------------------------------------------
// ----------------- AJAX DE CARRERAS
//---------------------------------------------------------------------

function careerAjax( dataJSON ){
    var dataJSONString = JSON.stringify( dataJSON );

    //Obtiene el tipo
    var obj = $.parseJSON(dataJSONString);
    var type = obj['type'];

    switch(type) {

        //---------------------------------------------------------------------
        // AJAX REGISTER
        //---------------------------------------------------------------------

        case "register":
            $.ajax({
                url: 'ajax/registerCareer.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {career_register: dataJSONString},
                cache: false,
                beforeSend: function () {
                    $('#registerCareer-result').html("cargando...");
                }
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "registerCareer") {

                        //Si no se registro por algo
                        if (response.result === false) {
                            //TODO: poner mensaje amarilllo
                            $('#registerCareer-result').html(response.message);
                        }
                        //Si ocurre un error
                        else if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#registerCareer-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#registerCareer-result').html("Se registro con éxito");
                        }

                    }

                })
                .fail(function () {
                    $('#id_care').html("Ocurrio un error");
                })
                .always(function (response) {
                    // $('#signup-spin').hide();
                    console.log(response);
                });
            break;

        //---------------------------------------------------------------------
        // AJAX UPDATE
        //---------------------------------------------------------------------

        case "update":
            $.ajax({
                url: 'ajax/updateCareer.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {career_update: dataJSONString},
                cache: false,
                beforeSend: function () {
                    $('#updateCareer-result').html("cargando...");
                }
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "updateCareer") {

                        //Si no se registro por algo
                        if (response.result === false) {
                            //TODO: poner mensaje amarilllo
                            $('#updateCareer-result').html(response.message);
                        }
                        //Si ocurre un error
                        else if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#updateCareer-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#updateCareer-result').html("Se actualizo con éxito");
                        }
                    }
                })
                .fail(function () {
                    $('#updateCareer-result').html("Ocurrio un error");
                })
                .always(function (response) {
                    // $('#signup-spin').hide();
                    console.log(response);
                });
            break;

        //---------------------------------------------------------------------
        // AJAX DELETE
        //---------------------------------------------------------------------

        case "delete":
            $.ajax({
                url: 'ajax/deleteCareer.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {career_delete: dataJSONString},
                cache: false,
                beforeSend: function () {
                    $('#deleteCareer-result').html("cargando...");
                }
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "deleteCareer") {

                        //Si no se registro por algo
                        if (response.result === false) {
                            //TODO: poner mensaje amarilllo
                            $('#deleteCareer-result').html(response.message);
                        }
                        //Si ocurre un error
                        else if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#deleteCareer-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#deleteCareer-result').html("Se elimino con éxito");
                        }
                    }
                })
                .fail(function () {
                    $('#deleteCareer-result').html("Ocurrio un error");
                })
                .always(function (response) {
                    // $('#signup-spin').hide();
                    console.log(response);
                });
            break;


        //---------------------------------------------------------------------
        // AJAX SEARCH
        //---------------------------------------------------------------------

        case "search":

            $.ajax({
                url: 'ajax/searchCareer.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {career_search: dataJSONString},
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "searchCareer") {

                        if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#searchCareer-result').html(response.message);
                        }
                        if (response.result === 'true') {
                            //TODO: poner mensaje rojo
                            $('#searchCareer-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#searchCareer-result').html(response.message);
                        }
                    }
                })
                .fail(function(){
                    $('#searchCareer').html( "Ocurrio un error" );
                })
                .always( function(response) {
                    // $('#signup-spin').hide();
                    console.log(  response );
                });
            break;


    }
}


//------------------------- MATERIAS ------------------------------------

function subjectAjax( dataJSON ){
    var dataJSONString = JSON.stringify( dataJSON );

    //Obtiene el tipo
    var obj = $.parseJSON(dataJSONString);
    var type = obj['type'];

    switch(type) {

        //---------------------------------------------------------------------
        // AJAX REGISTER
        //---------------------------------------------------------------------

        case "register":
            $.ajax({
                url: 'ajax/registerSubject.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {subject_register: dataJSONString},
                cache: false,
                beforeSend: function () {
                    $('#registerSubject-result').html("cargando...");
                }
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "registerSubject") {

                        //Si no se registro por algo
                        if (response.result === false) {
                            //TODO: poner mensaje amarilllo
                            $('#registerSubject-result').html(response.message);
                        }
                        //Si ocurre un error
                        else if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#registerSubject-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#registerSubject-result').html("Se registro con éxito");
                        }

                    }

                })
                .fail(function () {
                    $('#id_care').html("Ocurrio un error");
                })
                .always(function (response) {
                    // $('#signup-spin').hide();
                    console.log(response);
                });
            break;

        //---------------------------------------------------------------------
        // AJAX UPDATE
        //---------------------------------------------------------------------

        case "update":
            $.ajax({
                url: 'ajax/updateSubject.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {subject_update: dataJSONString},
                cache: false,
                beforeSend: function () {
                    $('#updateSubject-result').html("cargando...");
                }
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "updateSubject") {

                        //Si no se registro por algo
                        if (response.result === false) {
                            //TODO: poner mensaje amarilllo
                            $('#updateSubject-result').html(response.message);
                        }
                        //Si ocurre un error
                        else if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#updateSubject-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#updateSubject-result').html("Se actualizo con éxito");
                        }
                    }
                })
                .fail(function () {
                    $('#updateSubject-result').html("Ocurrio un error");
                })
                .always(function (response) {
                    // $('#signup-spin').hide();
                    console.log(response);
                });
            break;

        //---------------------------------------------------------------------
        // AJAX DELETE
        //---------------------------------------------------------------------

        case "delete":
            $.ajax({
                url: 'ajax/deleteSubject.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {subject_delete: dataJSONString},
                cache: false,
                beforeSend: function () {
                    $('#deleteSubject-result').html("cargando...");
                }
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "deleteSubject") {

                        //Si no se registro por algo
                        if (response.result === false) {
                            //TODO: poner mensaje amarilllo
                            $('#deleteSubject-result').html(response.message);
                        }
                        //Si ocurre un error
                        else if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#deleteSubject-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#deleteSubject-result').html("Se elimino con éxito");
                        }
                    }
                })
                .fail(function () {
                    $('#deleteSubject-result').html("Ocurrio un error");
                })
                .always(function (response) {
                    // $('#signup-spin').hide();
                    console.log(response);
                });
            break;

        //---------------------------------------------------------------------
        // AJAX SEARCH
        //---------------------------------------------------------------------

        case "search":

            $.ajax({
                url: 'ajax/searchSubject.php',
                type: 'post',
                //Tipo de dato que regresa
                dataType: 'json',
                data: {subject_search: dataJSONString},
            })
                .done(function (response) {

                    //Si es del tipo
                    if (response.type === "searchSubject") {

                        if (response.result === 'error') {
                            //TODO: poner mensaje rojo
                            $('#searchSubject-result').html(response.message);
                        }
                        if (response.result === 'true') {
                            //TODO: poner mensaje rojo
                            $('#searchSubject-result').html(response.message);
                        }
                        else {
                            //TODO: poner mensaje verde
                            $('#searchSubject-result').html(response.message);
                        }
                    }
                })
                .fail(function(){
                    $('#searchSubject-result').html( "Ocurrio un errorzdfa" );
                })
                .always( function(response) {
                    // $('#signup-spin').hide();
                    console.log(  response );
                });
            break;
    }
}









// ---------------
// Horario
// ----------------

function ajaxRegisterSchedule(student, schedule, subjects){

    //JSON para enviar
    var JSONschedule =
        {
            "student": student,
            "schedule": schedule,
            "subjects": subjects
        };

    //Transforma a String
    var scheduleJSON = JSON.stringify( JSONschedule );
    //console.log( scheduleJSON );


    $.ajax({
        url: 'ajax/register.php',
        type: 'post',
        //Tipo de dato que regresa
        dataType: 'json',
        data: {json_schedule: scheduleJSON},
        cache:false,
        beforeSend: function(){
            $('#horario__registro-status').html("Cargando...");
        }
    })
    .done(function(response){

        if( response.type === "schedule_register" ){
            $('#horario__registro-status').html(response.message);
            if( response.result === true )
                window.location = "index.php";
        }
        else
            alert("respuesta desconocida");


    })
    .fail(function(){
        //TODO: crear un alert especial (tipo twitter)
        alert("ocurrio un error en la conexion");
        $('#horario__registro-status').html("Error de conexion, intente de nuevo");
    })
    .always( function(response) {
        console.log(  response );
    });
}



// ---------------
// ASESORIAS
// ----------------

/**
 * @param subjectId String|int
 * @param studentId String|int
 */
function updateAvailableDates( subjectId, studentId ){
    $.ajax({
        url: "ajax/solicitar.ajax.php",
        type: 'post',
        //Tipo de dato que regresa
        dataType: 'json',
        data: {type: "schedule", value: subjectId, student: studentId},
        cache:false,
        beforeSend: function(){
            $('#loader-fechas').show();
        }
    })
    .done(function(response){

        if( response.type === "asesoria_schedule" ){
            // $('#loader-fechas').hide();
            console.log( "ocultando");

            if( response.result === true ){
                //Se agrega tabla con datos
                $('#table-dates').html( response.extra );
            }

        }

    })
    .fail(function(){
        //TODO: crear un alert especial (tipo twitter)
        $('#table-dates').html( "ocurrio un error en la conexion" );
    })
    .always( function(response) {
        $('#loader-fechas').hide();
        console.log(  response );
    });

}