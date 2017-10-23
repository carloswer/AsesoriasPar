-- OBTIENE LOS ASESORES DE UNA MATERIA EN ESPECIFICO DIFERENTE AL USUARIO CONECTADO
-- Se utilizara al momento de seleccionar una materia para que aparezcan los asesores correspondientes a esa materia 


-- RECIBE: id_materia = id de la materia que estas buscando
--         id_usuario = id del usuario conectado

-- SE LLAMA: CALL SP_ObAsesoresMateria(3,3);

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ObAsesoresMateria`(
	IN `id_materia` INT,
	IN `id_usuario` INT
)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN

SELECT 
	e.PK_est_id as 'id estudiante',
	CONCAT(e.est_nombre, ' ', e.est_apellido) as Asesor,
	e.est_avatar
FROM estudiante e
INNER JOIN horario h ON h.FK_asesor = e.PK_est_id
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo
INNER JOIN horario_materia hm ON hm.FK_horario = h.PK_horario_id
INNER JOIN materia m ON m.PK_mat_id = hm.FK_materia
WHERE m.PK_mat_id = id_materia AND e.PK_est_id NOT LIKE id_usuario;

END



----------------------------------------------------------------------------------

-- Verifica si esta en el ciclo actual 
-- Se usa siempre para comprobar que las acciones de realizan en el ciclo actual

-- RECIBE: la fecha 
-- SE LLAMA: CALL SP_EstaEnElCiclo(fecha);


CREATE DEFINER=`root`@`localhost` PROCEDURE `estaCiclo`(
	IN `fecha` DATE

)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN


SELECT c.PK_ciclo_id, (fecha BETWEEN DATE(c.ciclo_inicio) AND (c.ciclo_fin)) AS respuesta
FROM ciclo c;

END

-------------------------------------------------------------------------


-- MODIFICA EL PERFIL DEL USUARIO


-- RECIBE: id, nombre, apellido, telefono, facebook, avatar

-- SE LLAMA: CALL SP_EditarPerfil('00000126079','Carlos', 'Noriega', '6442306790', 'JASON BOURNE','batinew');


CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EditarPerfil`(
	IN `id` VARCHAR(50),
	IN `nombre` VARCHAR(50),
	IN `apellido` VARCHAR(50),
	IN `telefono` VARCHAR(50),
	IN `facebook` VARCHAR(50),
	IN `avatar` VARCHAR(50)

)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN

UPDATE estudiante e 

SET	e.est_nombre = nombre,
		e.est_apellido = apellido,
		e.est_telefono = telefono,
		e.est_facebook = facebook,
		e.est_avatar = avatar
		
WHERE e.est_idItson = id; 

END


--------------------------------------------------------------------------------



-- LOGIN
-- recibe email, usarname, contrase;a, 
-- SE LLAMA : CALL SP_Login('carlosrozuma@gmail.m', 'charly', 'freedom');


CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Login`(
	IN `email` VARCHAR(50),
	IN `username` VARCHAR(50),
	IN `contra` VARCHAR(50)

)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN

SELECT * FROM usuario u
WHERE u.usu_correo = email
OR u.usu_username = username 
AND u.usu_password = md5(contra);

END

--------------------------------------------------------------------------

-- OBTIENE MATERIAS DE UNA CARRERA EN ESPECIFICO
-- RECIBE: idcarrera
-- SE LLAMA: CALL SP_ObtMateriasCarrera(1);

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ObtMateriasCarrera`(
	IN `id_carrera` INT
)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN

SELECT *
FROM materia m
INNER JOIN carrera c ON m.FK_mat_carrera = c.PK_ca_id
WHERE c.PK_ca_id = id_carrera;

END



