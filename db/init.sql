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
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
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
INSERT INTO productos (nombre, descripcion, precio, stock) VALUES
('Producto A', 'Descripción del Producto A', 10.00, 100),
('Producto B', 'Descripción del Producto B', 20.00, 50),
('Producto C', 'Descripción del Producto C', 30.00, 30);

-- Insertar datos iniciales en la tabla de usuarios
INSERT INTO usuarios (nombre, correo, contraseña, rol_id) VALUES
('test', 'test@test.com', '123', 2),
('Juan Pérez', 'juan.perez@example.com', 'password123', 1),
('Ana Gómez', 'ana.gomez@example.com', 'password123', 2),
('Carlos Ruiz', 'carlos.ruiz@example.com', 'password123', 1),
('Maria Sanchez', 'maria.sanchez@example.com', 'password123', 2);

INSERT INTO empleados (usuario_id, nombre1, nombre2, apellido1, apellido2, cedula, direccion, provincia_id)
VALUES
(2, 'Ana', 'Gómez', 'García', 'López', '3333333333', 'Dirección de Ana Gómez', 1),
(4, 'Maria', 'Sanchez', 'Perez', 'Ramirez', '4444444444', 'Dirección de Maria Sanchez', 2);

-- Insertar datos iniciales en la tabla de empresas
INSERT INTO empresas (nombre, direccion, telefono, email) VALUES
('Empresa X', 'Dirección de Empresa X', '123456789', 'contacto@empresaX.com'),
('Empresa Y', 'Dirección de Empresa Y', '987654321', 'contacto@empresaY.com');

-- Insertar datos iniciales en la tabla de clientes
INSERT INTO clientes (nombre1, nombre2, apellido1, apellido2, direccion, telefono, cedula, empresa_id, provincia_id)
VALUES
('Cliente', '1', 'Apellido1', 'Apellido2', 'Dirección de Cliente 1', '123123123', '1111111111', 1, 1),
('Cliente', '2', 'Apellido1', 'Apellido2', 'Dirección de Cliente 2', '321321321', '2222222222', 2, 2);

INSERT INTO productos (nombre, descripcion, precio, stock)
VALUES
    ('Plátano Verde', 'Plátano en estado verde, ideal para exportación.', 1.50, 100),
    ('Plátano Maduro', 'Plátano en estado maduro listo para consumo.', 2.00, 150),
    ('Plátano Orgánico', 'Plátano cultivado orgánicamente, sin pesticidas ni químicos.', 2.50, 80),
    ('Plátano Baby', 'Plátano pequeño, ideal para mercados específicos.', 1.00, 200),
    ('Plátano Frito', 'Plátano maduro frito, típico en muchos países.', 3.00, 120);

