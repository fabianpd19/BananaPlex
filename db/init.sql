-- Creación de tablas
CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL UNIQUE CHECK (nombre IN ('cliente', 'admin'))
);

CREATE TABLE provincias (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(255) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    rol_id INT NOT NULL REFERENCES roles(id) ON DELETE RESTRICT
);

CREATE TABLE productos (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

CREATE TABLE empleados (
    id SERIAL PRIMARY KEY,
    usuario_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
    nombre1 VARCHAR(100) NOT NULL,
    nombre2 VARCHAR(100),
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100) NOT NULL,
    cedula VARCHAR(20), -- Nuevo campo para número de cédula
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    direccion VARCHAR(200) NOT NULL,
    provincia_id INT REFERENCES provincias(id) ON DELETE SET NULL
);


CREATE TABLE empresas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(255) UNIQUE
);

CREATE TABLE clientes (
    id SERIAL PRIMARY KEY,
    nombre1 VARCHAR(100) NOT NULL,
    nombre2 VARCHAR(100),
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    cedula VARCHAR(20), -- Nuevo campo para número de cédula
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    empresa_id INT REFERENCES empresas(id) ON DELETE SET NULL,
    provincia_id INT REFERENCES provincias(id) ON DELETE SET NULL
);


CREATE TABLE inventario (
    id SERIAL PRIMARY KEY,
    producto_id INT NOT NULL REFERENCES productos(id) ON DELETE CASCADE,
    cantidad INT NOT NULL CHECK (cantidad >= 0)
);

CREATE TABLE transacciones (
    id SERIAL PRIMARY KEY,
    cliente_id INT NOT NULL REFERENCES clientes(id) ON DELETE CASCADE,
    usuario_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
    producto_id INT NOT NULL REFERENCES productos(id) ON DELETE CASCADE,
    cantidad INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('compra', 'venta'))
);

CREATE TABLE solicitudes (
    id SERIAL PRIMARY KEY,
    cliente_id INT NOT NULL REFERENCES clientes(id) ON DELETE CASCADE,
    producto_id INT NOT NULL REFERENCES productos(id) ON DELETE CASCADE,
    cantidad INT NOT NULL,
    precio_ofrecido DECIMAL(10, 2) NOT NULL,
    estado VARCHAR(20) NOT NULL DEFAULT 'pendiente' CHECK (estado IN ('pendiente', 'aprobado', 'rechazado')),
    tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('compra', 'venta')),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    empleado_id INT REFERENCES empleados(id) ON DELETE SET NULL
);

-- Inserción de datos iniciales
INSERT INTO roles (nombre) VALUES ('cliente'), ('admin');

-- Insertar algunas provincias iniciales
INSERT INTO provincias (nombre) VALUES
    ('Azuay'),
    ('Bolívar'),
    ('Cañar'),
    ('Carchi'),
    ('Chimborazo'),
    ('Cotopaxi'),
    ('El Oro'),
    ('Esmeraldas'),
    ('Galápagos'),
    ('Guayas'),
    ('Imbabura'),
    ('Loja'),
    ('Los Ríos'),
    ('Manabí'),
    ('Morona Santiago'),
    ('Napo'),
    ('Orellana'),
    ('Pastaza'),
    ('Pichincha'),
    ('Santa Elena'),
    ('Santo Domingo de los Tsáchilas'),
    ('Sucumbíos'),
    ('Tungurahua'),
    ('Zamora Chinchipe');

-- Insertar datos iniciales en la tabla de productos
-- Insertar datos nuevos en la tabla de productos
INSERT INTO productos (nombre, descripcion, precio) VALUES
('PLÁTANO VERDE', 'Plátano en estado verde, ideal para exportación.', 1.50),
('PLÁTANO MADURO', 'Plátano en estado maduro listo para consumo.', 2.00),
('PLÁTANO ORGÁNICO', 'Plátano cultivado orgánicamente, sin pesticidas ni químicos.', 2.50),
('PLÁTANO BABY', 'Plátano pequeño, ideal para mercados específicos.', 1.00),
('PLÁTANO FRITO', 'Plátano maduro frito, típico en muchos países.', 3.00);

-- Insertar datos nuevos en la tabla de usuarios
INSERT INTO usuarios (nombre, correo, contraseña, rol_id) VALUES
('ADMIN PRINCIPAL', 'admin@example.com', 'adminpass', 2),
('JUAN PEREZ', 'juan.perez@example.com', 'pass123', 1),
('ANA GOMEZ', 'ana.gomez@example.com', 'pass123', 2),
('CARLOS RUIZ', 'carlos.ruiz@example.com', 'pass123', 1),
('MARIA SANCHEZ', 'maria.sanchez@example.com', 'pass123', 2);

-- Insertar datos nuevos en la tabla de empleados
INSERT INTO empleados (usuario_id, nombre1, nombre2, apellido1, apellido2, cedula, direccion, provincia_id)
VALUES
(3, 'ANA', 'MARIA', 'GOMEZ', 'GARCIA', '0102030405', 'Av. Siempre Viva 123', 1),
(5, 'MARIA', 'LUISA', 'SANCHEZ', 'RAMIREZ', '0607080910', 'Calle Falsa 456', 2);

-- Insertar datos nuevos en la tabla de empresas
INSERT INTO empresas (nombre, direccion, telefono, email) VALUES
('EMPRESA A', 'Av. Tecnología 789', '022345678', 'contacto@empresaA.com'),
('EMPRESA B', 'Calle Innovación 321', '042345678', 'contacto@empresaB.com');

-- Insertar datos nuevos en la tabla de clientes
INSERT INTO clientes (nombre1, nombre2, apellido1, apellido2, direccion, telefono, cedula, empresa_id, provincia_id)
VALUES
('LUIS', 'MARTIN', 'PEREZ', 'GOMEZ', 'Calle Principal 123', '0991234567', '1111111111', 1, 1),
('CARLA', 'VERONICA', 'RAMIREZ', 'LOPEZ', 'Av. Central 456', '0997654321', '2222222222', 2, 2);

-- Consulta para verificar datos insertados en la tabla de clientes
SELECT * FROM clientes;

-- Consulta para verificar datos insertados en la tabla de empleados
SELECT * FROM empleados;