-- --------------------------------------
--	USUARIOS
-- --------------------------------------



-- --------------------------------------
--	ESTUDIANTES
-- --------------------------------------



-- --------------------------------------
--	MATERIAS
-- --------------------------------------



-- --------------------------------------
--	CARRERAS
-- --------------------------------------



-- --------------------------------------
--	HORARIO
-- --------------------------------------


-- --------------------------------------
--	ASESORIAS
-- --------------------------------------


-- ------------- Obtener Asesores, Sus horarios y materias registradas
SELECT am.IDasesor_materia, e.IDestudiante, e.Nombre, e.Apellido, m.Materia as 'Materia' FROM asesor_materia am
INNER JOIN estudiante e ON am.Asesor = e.IDestudiante
INNER JOIN materia m ON am.Materia = m.IDmateria
ORDER BY e.IDestudiante ASC;


SELECT am.IDasesor_materia, e.IDestudiante, e.Nombre, e.Apellido, m.Materia as 'Materia' FROM asesor_materia am
INNER JOIN estudiante e ON am.Asesor = e.IDestudiante
INNER JOIN materia m ON am.Materia = m.IDmateria
ORDER BY e.IDestudiante ASC;


SELECT * FROM materia m
INNER JOIN carrera c ON  m.Carrera = c.IDcarrera;


SELECT * FROM materia m INNER JOIN carrera c ON m.Carrera = c.IDcarrera
WHERE c.IDcarrera = 1;


SELECT * FROM estudiante e INNER JOIN carrera c ON e.Carrera = c.IDcarrera

SELECT * FROM materia m INNER JOIN carrera c ON m.Carrera = c.IDcarrera 
WHERE m.IDmateria = 1;



SELECT * FROM estudiante e
INNER JOIN carrera c ON e.Carrera = c.IDcarrera







-- ---------------------------------------------
-- NUEVO QUERIES
-- ---------------------------------------------


-- Login
SELECT * FROM usuario u
WHERE (u.usu_correo = 'carlosrozuma@gmail.m'
OR u.usu_username = 'charly')
AND u.usu_password = md5('freedom');


-- Obtener ID y carrera de estudiante si lo es
SELECT e.PK_est_id, c.ca_nombre FROM estudiante e
INNER JOIN carrera c ON e.FK_carrera = c.PK_ca_id
WHERE e.FK_usuario = 2;




-- --------Obtener estudiantes
SELECT * FROM estudiante e
INNER JOIN carrera c ON e.FK_carrera = c.PK_ca_id;

-- --------Obtener estudiantes por ID
SELECT * FROM estudiante e
INNER JOIN carrera c ON e.FK_carrera = c.PK_ca_id
WHERE e.PK_est_id = 1;

-- --------Obtener estudiantes por carrera
SELECT * FROM estudiante e 
INNER JOIN carrera c ON e.FK_carrera = c.PK_ca_id
WHERE c.PK_ca_id = 2;


-- --------Comprobar si Estudiante tiene un horario
-- fecha actual
SELECT DATE(NOW());



-- ciclo actual
SELECT PK_ciclo_id, ciclo_inicio, ciclo_fin
FROM  ciclo
WHERE DATE(NOW()) BETWEEN ciclo_inicio AND ciclo_fin;
-- WHERE DATE(NOW()) BETWEEN '2017/01/17' AND '2017/05/17';



-- Horario de ciclo actual
SELECT h.PK_horario_id, c.ciclo_inicio, c.ciclo_fin FROM horario h
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo
WHERE DATE(NOW()) BETWEEN c.ciclo_inicio AND c.ciclo_fin;
-- WHERE (DATE(NOW()) >= c.ciclo_inicio AND DATE(NOW()) <= c.ciclo_fin);


-- --------Obtiene horas y dias
SELECT PK_dia_id as 'id', dia_nombre as 'dia' FROM dia order by id;
SELECT PK_hora_id as 'id', hora FROM hora order by PK_hora_id;


-- --------Obtener horario de Asesor y el ciclo
SELECT PK_est_id FROM estudiante e
WHERE e.FK_usuario = 2;



-- -----TODO: CREAR SUBCONSULTAS PARA OBTENER primero los horarios del ciclo actual
-- -----Despues del asesor
SELECT e.PK_est_id as 'ID Estudiante',
			CONCAT( e.est_nombre, ' ', e.est_apellido ) as Nombre,
			c.ciclo_inicio as 'Ciclo Inicio',
			c.ciclo_fin as 'Ciclo Fin',
			d.dia_nombre as 'Dia',
			hora.hora as 'Hora'
FROM horario h
INNER JOIN estudiante e ON e.PK_est_id = h.FK_asesor
INNER JOIN dia_hora dh ON dh.FK_horario = h.PK_horario_id
INNER JOIN dia d ON d.PK_dia_id = dh.FK_dia
INNER JOIN hora ON hora.PK_hora_id = dh.PK_dia_hora
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo
WHERE (DATE(NOW()) BETWEEN c.ciclo_inicio AND c.ciclo_fin) 
	AND e.PK_est_id = 1;



SELECT 
	e.PK_est_id as 'id estudiante',
	CONCAT(e.est_nombre, ' ', e.est_apellido) as 'Nombre',
	h.PK_horario_id as 'IDHorario',
	c.PK_ciclo_id as 'ciclo id',
	c.ciclo_inicio as 'Inicio',
	c.ciclo_fin as 'fin',
	dh.PK_dia_hora as 'dia_hora ID',
	d.dia_nombre as 'dia',
	t.hora as 'hora'
FROM estudiante e
INNER JOIN horario h ON h.FK_asesor = e.PK_est_id
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo
INNER JOIN dia_hora dh ON dh.FK_horario = h.PK_horario_id
INNER JOIN hora t ON t.PK_hora_id = dh.FK_hora
INNER JOIN dia d ON d.PK_dia_id = dh.FK_dia
--  WHERE e.PK_est_id = 2;

-- Materias registradas
SELECT 
	e.PK_est_id as 'id estudiante',
	CONCAT(e.est_nombre, ' ', e.est_apellido) as 'Asesor',
	h.PK_horario_id as 'IDHorario',
	c.PK_ciclo_id as 'ciclo id',
	c.ciclo_inicio as 'Inicio',
	c.ciclo_fin as 'fin',
	m.PK_mat_id as 'materia id',
	m.mat_nombre as 'materia'
FROM estudiante e
INNER JOIN horario h ON h.FK_asesor = e.PK_est_id
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo
INNER JOIN horario_materia hm ON hm.FK_horario = h.PK_horario_id
INNER JOIN materia m ON m.PK_mat_id = hm.FK_materia



SELECT dh.FK_hora as 'hora', dh.FK_dia as 'dia'
FROM dia_hora dh
INNER JOIN horario h ON h.PK_horario_id = dh.FK_horario
WHERE h.FK_asesor = 2 AND h.FK_ciclo = 2;
 
 




-- ASESORIAS DEL CICLO ACTUAL
SELECT * FROM asesoria
-- Asesor
-- Alumno
-- Hora
-- Dia
-- Fecha
-- Estado



-- --------------------- Materias con asesores dentro del ciclo actual
-- Obtener materias con asesores de la carrera del que inisio sesion y sin contarlo a el.
-- en caso de que sea asesor de dicha materia
SELECT m.PK_mat_id as 'materiaID', 
		mat_nombre as 'nombre'
FROM materia m 
INNER JOIN horario_materia hm ON hm.FK_materia = m.PK_mat_id 
INNER JOIN horario h ON h.PK_horario_id = hm.FK_horario 
WHERE (h.FK_ciclo = 2 AND h.FK_asesor != 1) AND (m.FK_carrera = 1)
GROUP BY nombre
ORDER BY materiaID


-- --------------------- Asesores de una materia sin contar al actual
SELECT 
	e.PK_est_id as 'id_estudiante',
	CONCAT(e.est_nombre, ' ', e.est_apellido) as 'nombre_asesor'
FROM estudiante e
INNER JOIN horario h ON h.FK_asesor = e.PK_est_id
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo
INNER JOIN horario_materia hm ON hm.FK_horario = h.PK_horario_id
INNER JOIN materia m ON m.PK_mat_id = hm.FK_materia
-- WHERE h.FK_ciclo = 2 AND e.PK_est_id <> 1
GROUP BY nombre_asesor
ORDER BY nombre_asesor



SELECT e.PK_est_id as 'id_estudiante',
	CONCAT(e.est_nombre, ' ', e.est_apellido) as 'nombre_asesor'
FROM estudiante e
INNER JOIN horario h ON h.FK_asesor = e.PK_est_id
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo
INNER JOIN horario_materia hm ON hm.FK_horario = h.PK_horario_id
INNER JOIN materia m ON m.PK_mat_id = hm.FK_materia
WHERE (h.FK_ciclo = 2 AND e.PK_est_id <> 1)
AND ( m.PK_mat_id = 5 )
GROUP BY nombre_asesor
ORDER BY nombre_asesor


SELECT e.PK_est_id as 'id_estudiante', 
	CONCAT(e.est_nombre, ' ', e.est_apellido) as 'nombre_asesor' 
FROM estudiante e 
INNER JOIN horario h ON h.FK_asesor = e.PK_est_id 
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo 
INNER JOIN horario_materia hm ON hm.FK_horario = h.PK_horario_id 
INNER JOIN materia m ON m.PK_mat_id = hm.FK_materia 
WHERE (h.FK_ciclo = 2 AND e.PK_est_id <> 1) AND ( m.PK_mat_id = 5 ) 
GROUP BY nombre_asesor ORDER BY nombre_asesor


SELECT e.PK_est_id as 'id_estudiante', 
		CONCAT(e.est_nombre, ' ', e.est_apellido) as 'nombre_asesor' 
FROM estudiante e INNER JOIN horario h ON h.FK_asesor = e.PK_est_id 
INNER JOIN ciclo c ON c.PK_ciclo_id = h.FK_ciclo 
INNER JOIN horario_materia hm ON hm.FK_horario = h.PK_horario_id 
INNER JOIN materia m ON m.PK_mat_id = hm.FK_materia 
WHERE (h.FK_ciclo = 2 AND e.PK_est_id <> 1) AND ( m.PK_mat_id = 4 ) GROUP BY nombre_asesor ORDER BY nombre_asesor



DELETE FROM dia_hora;
DELETE FROM horario_materia;
DELETE FROM dia_hora;



-- ---------------------------Asesorias registradas
SELECT  
	a.PK_asesoria_id as 'id_asesoria',
	CONCAT(e.est_nombre,' ',e.est_apellido) as 'alumno',
	CONCAT(eh.est_nombre,' ',eh.est_apellido) as 'asesor',
	m.mat_nombre as 'materia',
	a.asesoria_desc as 'descripcion',
	d.dia_nombre as 'dia',
	ho.hora as 'hora',
	a.asesoria_fecha as 'fecha',
	a.asesoria_registro as 'registro_asesoria'
FROM asesoria a
--  Alumno
INNER JOIN estudiante e ON e.PK_est_id = a.FK_alumno
INNER JOIN materia m ON m.PK_mat_id = a.FK_materia
-- Asesor
INNER JOIN dia_hora dh ON dh.PK_dia_hora = a.FK_dia_hora
INNER JOIN hora ho ON ho.PK_hora_id = dh.FK_hora
INNER JOIN dia d ON d.PK_dia_id = dh.FK_dia
INNER JOIN horario h ON h.PK_horario_id = dh.FK_horario
INNER JOIN estudiante eh ON eh.PK_est_id = h.FK_asesor
LEFT JOIN estado_asesoria ea ON ea.FK_asesoria = a.PK_asesoria_id
-- WHERE ea.FK_asesoria IS NULL;
WHERE (ea.FK_asesoria IS NULL) AND (e.PK_est_id = 1 OR eh.PK_est_id = 1)
-- WHERE h.FK_ciclo = 2 -- AND e.PK_est_id = 4


-- Asesorias canceladas
SELECT  
	a.PK_asesoria_id as 'id_asesoria',
	CONCAT(e.est_nombre,' ',e.est_apellido) as 'alumno',
	CONCAT(eh.est_nombre,' ',eh.est_apellido) as 'asesor',
	m.mat_nombre as 'materia',
	a.asesoria_desc as 'descripcion',
	d.dia_nombre as 'dia',
	ho.hora as 'hora',
	a.asesoria_fecha as 'fecha',
	a.asesoria_registro as 'registro_asesoria',
	ea.val_comentario as 'razon'
FROM asesoria a
--  Alumno
INNER JOIN estudiante e ON e.PK_est_id = a.FK_alumno
INNER JOIN materia m ON m.PK_mat_id = a.FK_materia
-- Asesor
INNER JOIN dia_hora dh ON dh.PK_dia_hora = a.FK_dia_hora
INNER JOIN hora ho ON ho.PK_hora_id = dh.FK_hora
INNER JOIN dia d ON d.PK_dia_id = dh.FK_dia
INNER JOIN horario h ON h.PK_horario_id = dh.FK_horario
INNER JOIN estudiante eh ON eh.PK_est_id = h.FK_asesor
INNER JOIN estado_asesoria ea ON ea.FK_asesoria = a.PK_asesoria_id
WHERE ea.val_tipo = 2 -- Cancelado



SELECT 
	a.asesoria_fecha as 'fecha', 
	dh.FK_hora as 'hora',
	dh.FK_dia as 'dia'
 FROM asesoria a
INNER JOIN dia_hora dh ON dh.PK_dia_hora = a.FK_dia_hora


SELECT * FROM asesoria;
SELECT * FROM estado_asesoria


DELETE FROM estado_asesoria;
DELETE FROM asesoria;
