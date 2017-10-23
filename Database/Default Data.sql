-- ----------------------------
-- DATOS DEFAULT
-- ----------------------------

INSERT INTO rol(nombre) VALUES
('administrador'),
('estudiante');



-- ----------------------------
-- USUARIOS
-- ----------------------------

INSERT INTO usuario(nombre_usuario, password, correo, FK_rol) VALUES
('root', md5('root'), 'carlosrozuma@gmail.com', 1);




START TRANSACTION;
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '8:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '9:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '10:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '11:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '12:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '13:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '14:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '15:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '16:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '17:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '18:00:00', 'Lunes', 1);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '8:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '9:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '10:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '11:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '12:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '13:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '14:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '15:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '16:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '17:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '18:00:00', 'Martes', 2);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '8:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '9:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '10:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '11:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '12:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '13:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '14:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '15:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '16:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '17:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '18:00:00', 'Miercoles', 3);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '8:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '9:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '10:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '11:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '12:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '13:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '14:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '15:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '16:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '17:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '18:00:00', 'Jueves', 4);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '8:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '9:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '10:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '11:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '12:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '13:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '14:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '15:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '16:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '17:00:00', 'Viernes', 5);
INSERT INTO dia_hora (PK_id, hora, dia, dia_numero) VALUES (DEFAULT, '18:00:00', 'Viernes', 5);

COMMIT;




