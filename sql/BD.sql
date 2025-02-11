-- Crear base de datos
CREATE DATABASE tienda_medica;

-- Usar base de datos
USE tienda_medica;

-- Crear tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    admin TINYINT(1) NOT NULL DEFAULT 0
);

-- Crear tabla productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

-- Crear tabla carrito
CREATE TABLE carrito (
    id_carrito INT AUTO_INCREMENT PRIMARY KEY, 
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

-- Insertar productos por defecto
INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES
('Tensiómetro Digital', 'Mide la presión arterial con gran precisión y facilidad de uso.', 45.50, 'img/tensiometro_digital.png'),
('Oxímetro Digital', 'Dispositivo que mide el nivel de oxígeno en sangre y la frecuencia cardíaca.', 25.00, 'img/oximetro_digital.png'),
('Nebulizador Portátil', 'Aparato compacto para administrar medicación inhalada, ideal para uso en casa o en movimiento.', 60.00, 'img/nebulizador_portatil.png'),
('Oxígeno Portátil', 'Cilindro de oxígeno ligero y fácil de transportar, útil en situaciones de emergencia o tratamientos a domicilio.', 100.00, 'img/oxigeno_portatil.png');
