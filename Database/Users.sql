-- ----------------
-- USUARIO BASE DE DATOS
-- ----------------

-- http://dev.mysql.com/doc/refman/5.0/en/user-account-management.html

DROP USER asesoriaspar_itson;

GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP 
ON asesoriaspar.* TO 'asesoriaspar_itson'@'localhost' IDENTIFIED BY 'asesorias_pass';
FLUSH PRIVILEGES;

SHOW GRANTS FOR 'asesoriaspar_itson'@'localhost';


-- -----------Actualizar privilegios
REVOKE ALL PRIVILEGES ON asesoriaspar.* FROM 'asesoriaspar_itson'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON asesoriaspar.* TO 'asesoriaspar_itson'@'localhost';
FLUSH PRIVILEGES;



-- GRANT SELECT,INSERT,UPDATE,DELETE
-- ON asesoriaspar.* TO 'asesoriaspar_itson'@'%' IDENTIFIED BY 'asesorias_pass';
-- FLUSH PRIVILEGES;