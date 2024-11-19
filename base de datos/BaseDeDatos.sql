-- Eliminar la base de datos si existe
DROP DATABASE IF EXISTS registro_y_egreso_de_empleados;

-- Crear la base de datos
CREATE DATABASE registro_y_egreso_de_empleados;
USE registro_y_egreso_de_empleados;

-- Crear tabla sucursal
CREATE TABLE sucursal (
    id_sucursal INT AUTO_INCREMENT UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    locacion VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_sucursal)
);

-- Crear tabla empleados
CREATE TABLE empleados (
    id_empleados INT AUTO_INCREMENT UNIQUE NOT NULL,
    id_sucursal INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    area VARCHAR(50) NOT NULL,
    dni INT(25) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_empleados),
    FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal)
);

-- Crear tabla ingresar
CREATE TABLE ingresar (
    id_ingresar INT AUTO_INCREMENT NOT NULL,
    id_empleados INT NOT NULL,
    id_sucursal INT NOT NULL,
    ingreso_egreso BOOLEAN NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    PRIMARY KEY (id_ingresar),
    FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal),
    FOREIGN KEY (id_empleados) REFERENCES empleados(id_empleados)
);

-- Crear tabla horario
CREATE TABLE horario (
    id_horarios INT AUTO_INCREMENT NOT NULL,
    id_empleados INT NOT NULL,
    horario_ingreso TIME NOT NULL,
    dia_dl_semana VARCHAR(10) NOT NULL,  -- 'Lunes', 'Martes', etc.
    PRIMARY KEY(id_horarios),
    FOREIGN KEY (id_empleados) REFERENCES empleados(id_empleados)
);

-- Crear tabla usuarios
CREATE TABLE usuarios (
    id_empleados INT NOT NULL,
    id_usuario INT AUTO_INCREMENT NOT NULL,
    id_sucursal INT NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    rango int(25) NOT NULL,
    contrasena VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (id_empleados) REFERENCES empleados(id_empleados),
    FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal)
);

CREATE TABLE autentificacion (
    id_autentificacion INT AUTO_INCREMENT NOT NULL,
    clave INT(6),
	PRIMARY KEY(id_autentificacion)
);

INSERT INTO autentificacion (clave) VALUES (111111);

-- Insertar datos en sucursal
INSERT INTO sucursal (nombre, locacion) VALUES
('Sucursal Centro', 'Calle Principal 123'),
('Sucursal Norte', 'Avenida Norte 456'),
('Sucursal Sur', 'Calle Sur 789'),
('Sucursal Este', 'Avenida Este 101');

-- Insertar datos en empleados
INSERT INTO empleados (id_sucursal, nombre, apellido, area, dni, rol) VALUES
(1, 'Juan', 'Pérez', 'Ventas', 12345678, 'Gerente'),
(1, 'María', 'Gómez', 'Ventas', 23456789, 'Vendedora'),
(2, 'Carlos', 'Fernández', 'Administración', 34567890, 'Supervisor'),
(2, 'Lucía', 'Ramírez', 'Ventas', 45678901, 'Vendedora'),
(3, 'Pedro', 'Martínez', 'Logística', 56789012, 'Vendedor'),
(3, 'Ana', 'López', 'Atención al Cliente', 67890123, 'Vendedora'),
(4, 'Jorge', 'Sánchez', 'Recepción', 78901234, 'Recepcionista'),
(4, 'Clara', 'Hernández', 'Soporte', 89012345, 'Asistente'),
(1, 'Luis', 'García', 'Finanzas', 90123456, 'Contador'),
(2, 'Sofía', 'Torres', 'Cajas', 10234567, 'Cajera');

-- Insertar datos en horario con horarios previstos por día
INSERT INTO horario (id_empleados, horario_ingreso, dia_dl_semana) VALUES
(1, '09:00:00', 'Lunes'),
(1, '09:00:00', 'Martes'),
(1, '09:00:00', 'Miércoles'),
(1, '09:00:00', 'Jueves'),
(1, '09:00:00', 'Viernes'),
(2, '09:00:00', 'Lunes'),
(2, '09:00:00', 'Martes'),
(2, '09:00:00', 'Miércoles'),
(2, '09:00:00', 'Jueves'),
(2, '09:00:00', 'Viernes'),
(3, '08:30:00', 'Lunes'),
(3, '08:30:00', 'Martes'),
(3, '08:30:00', 'Miércoles'),
(3, '08:30:00', 'Jueves'),
(3, '08:30:00', 'Viernes'),
(4, '09:00:00', 'Lunes'),
(4, '09:00:00', 'Martes'),
(4, '09:00:00', 'Miércoles'),
(4, '09:00:00', 'Jueves'),
(4, '09:00:00', 'Viernes'),
(5, '08:45:00', 'Lunes'),
(5, '08:45:00', 'Martes'),
(5, '08:45:00', 'Miércoles'),
(5, '08:45:00', 'Jueves'),
(5, '08:45:00', 'Viernes'),
(6, '09:00:00', 'Lunes'),
(6, '09:00:00', 'Martes'),
(6, '09:00:00', 'Miércoles'),
(6, '09:00:00', 'Jueves'),
(6, '09:00:00', 'Viernes');

-- Insertar datos en ingresar con variaciones
INSERT INTO ingresar (id_empleados, id_sucursal, ingreso_egreso, fecha, hora) VALUES
(1, 1, true, CURDATE(), '09:05:00'),  -- Juan llegó tarde
(2, 1, true, CURDATE(), '09:00:00'),  -- María llegó a tiempo
(3, 2, true, CURDATE(), '08:30:00'),  -- Carlos llegó a tiempo
(4, 2, true, CURDATE(), '09:10:00'),  -- Lucía llegó tarde
(5, 3, true, CURDATE(), '08:45:00'),  -- Pedro llegó a tiempo
(6, 3, false, CURDATE(), '00:00:00'),  -- Ana está ausente
(7, 4, true, CURDATE(), '09:00:00'),  -- Jorge llegó a tiempo
(8, 4, true, CURDATE(), '09:20:00'),  -- Clara llegó tarde
(9, 1, false, CURDATE(), '00:00:00'),  -- Luis está ausente
(10, 2, true, CURDATE(), '09:00:00');  -- Sofía llegó a tiempo

-- Insertar datos en usuarios
INSERT INTO usuarios (id_empleados, id_sucursal, nombre, email, rango, contrasena) VALUES
(1, 1, 'Juan Pérez', 'juan.perez@example.com', 'Admin', 'contrasena123'),
(2, 1, 'María Gómez', 'maria.gomez@example.com', 'Vendedora', 'contrasena123'),
(3, 2, 'Carlos Fernández', 'carlos.fernandez@example.com', 'Supervisor', 'contrasena123'),
(4, 2, 'Lucía Ramírez', 'lucia.ramirez@example.com', 'Vendedora', 'contrasena123'),
(5, 3, 'Pedro Martínez', 'pedro.martinez@example.com', 'Vendedor', 'contrasena123'),
(6, 3, 'Ana López', 'ana.lopez@example.com', 'Atención al Cliente', 'contrasena123'),
(7, 4, 'Jorge Sánchez', 'jorge.sanchez@example.com', 'Recepcionista', 'contrasena123'),
(8, 4, 'Clara Hernández', 'clara.hernandez@example.com', 'Asistente', 'contrasena123'),
(9, 1, 'Luis García', 'luis.garcia@example.com', 'Contador', 'contrasena123'),
(10, 2, 'Sofía Torres', 'sofia.torres@example.com', 'Cajera', 'contrasena123');


-- Insertar registros de ingresos para octubre de 2024
INSERT INTO ingresar (id_empleados, id_sucursal, ingreso_egreso, fecha, hora) VALUES
-- Lunes 1 de octubre
(1, 1, true, '2024-10-01', '09:05:00'),  -- Juan
(2, 1, true, '2024-10-01', '09:00:00'),  -- María
(3, 2, true, '2024-10-01', '08:30:00'),  -- Carlos
(4, 2, true, '2024-10-01', '09:10:00'),  -- Lucía
(5, 3, true, '2024-10-01', '08:45:00'),  -- Pedro
(6, 3, false, '2024-10-01', '00:00:00'),  -- Ana (ausente)
(7, 4, true, '2024-10-01', '09:00:00'),  -- Jorge
(8, 4, true, '2024-10-01', '09:20:00'),  -- Clara
(9, 1, false, '2024-10-01', '00:00:00'),  -- Luis (ausente)
(10, 2, true, '2024-10-01', '09:00:00'),  -- Sofía
-- Martes 2 de octubre
(1, 1, true, '2024-10-02', '09:10:00'),
(2, 1, true, '2024-10-02', '09:05:00'),
(3, 2, true, '2024-10-02', '08:35:00'),
(4, 2, true, '2024-10-02', '09:15:00'),
(5, 3, true, '2024-10-02', '08:50:00'),
(6, 3, false, '2024-10-02', '00:00:00'),
(7, 4, true, '2024-10-02', '09:00:00'),
(8, 4, true, '2024-10-02', '09:25:00'),
(9, 1, false, '2024-10-02', '00:00:00'),
(10, 2, true, '2024-10-02', '09:00:00'),
-- Miércoles 3 de octubre
(1, 1, true, '2024-10-03', '09:00:00'),
(2, 1, true, '2024-10-03', '09:00:00'),
(3, 2, true, '2024-10-03', '08:30:00'),
(4, 2, true, '2024-10-03', '09:05:00'),
(5, 3, true, '2024-10-03', '08:45:00'),
(6, 3, false, '2024-10-03', '00:00:00'),
(7, 4, true, '2024-10-03', '09:00:00'),
(8, 4, true, '2024-10-03', '09:20:00'),
(9, 1, true, '2024-10-03', '09:00:00'),
(10, 2, true, '2024-10-03', '09:00:00'),
-- Jueves 4 de octubre
(1, 1, true, '2024-10-04', '09:05:00'),
(2, 1, true, '2024-10-04', '09:00:00'),
(3, 2, true, '2024-10-04', '08:30:00'),
(4, 2, true, '2024-10-04', '09:10:00'),
(5, 3, true, '2024-10-04', '08:45:00'),
(6, 3, false, '2024-10-04', '00:00:00'),
(7, 4, true, '2024-10-04', '09:00:00'),
(8, 4, true, '2024-10-04', '09:20:00'),
(9, 1, true, '2024-10-04', '09:00:00'),
(10, 2, true, '2024-10-04', '09:00:00'),
-- Viernes 5 de octubre
(1, 1, true, '2024-10-05', '09:15:00'),
(2, 1, true, '2024-10-05', '09:00:00'),
(3, 2, true, '2024-10-05', '08:35:00'),
(4, 2, true, '2024-10-05', '09:15:00'),
(5, 3, true, '2024-10-05', '08:50:00'),
(6, 3, false, '2024-10-05', '00:00:00'),
(7, 4, true, '2024-10-05', '09:00:00'),
(8, 4, true, '2024-10-05', '09:25:00'),
(9, 1, false, '2024-10-05', '00:00:00'),
(10, 2, true, '2024-10-05', '09:00:00');

-- Insertar horarios para los últimos 4 empleados
INSERT INTO horario (id_empleados, horario_ingreso, dia_dl_semana) VALUES
-- Horarios para Jorge
(7, '09:00:00', 'lunes'),  -- Lunes
(7, '09:00:00', 'martes'),  -- Martes
(7, '09:00:00', 'miércoles'),  -- Miércoles
(7, '09:00:00', 'jueves'),  -- Jueves
(7, '09:00:00', 'viernes'),  -- Viernes
-- Horarios para Clara
(8, '09:15:00', 'lunes'),
(8, '09:15:00', 'martes'),
(8, '09:15:00', 'miércoles'),
(8, '09:15:00', 'jueves'),
(8, '09:15:00', 'viernes'),
-- Horarios para Luis
(9, '09:30:00', 'lunes'),
(9, '09:30:00', 'martes'),
(9, '09:30:00', 'miércoles'),
(9, '09:30:00', 'jueves'),
(9, '09:30:00', 'viernes'),
-- Horarios para Sofía
(10, '09:00:00', 'lunes'),
(10, '09:00:00', 'martes'),
(10, '09:00:00', 'miércoles'),
(10, '09:00:00', 'jueves'),
(10, '09:00:00', 'viernes');
