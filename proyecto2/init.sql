CREATE DATABASE IF NOT EXISTS libreria;
USE libreria;

-- Tabla de libros
CREATE TABLE IF NOT EXISTS libro (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    isbn VARCHAR(13) NOT NULL UNIQUE,
    titulo VARCHAR(100) NOT NULL,
    genero VARCHAR(100),
    editorial VARCHAR(100),
    autor VARCHAR(100) NOT NULL,
    fecha_lanzamiento DATE NOT NULL,
    num_copias INT NOT NULL
);

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla de administradores
CREATE TABLE IF NOT EXISTS administrador (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    `contraseña` VARCHAR(255) NOT NULL
);

-- Tabla de préstamos
CREATE TABLE IF NOT EXISTS ticketprestamo (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_libro INT NOT NULL,
    id_usuario INT NOT NULL,
    id_administrador INT NOT NULL,
    fecha_prestamo DATE,
    FOREIGN KEY (id_libro) REFERENCES libro(id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id)
);

-- Inserción de administradores
INSERT INTO administrador (nombre, `contraseña`) VALUES
('Admin1', 'password1'),
('Admin2', 'password2');

-- Inserción de libros reales
INSERT INTO libro (isbn, titulo, genero, editorial, autor, fecha_lanzamiento, num_copias) VALUES
('9780140449266', 'Crimen y castigo', 'Novela', 'Penguin Classics', 'Fyodor Dostoevsky', '1866-01-01', 3),
('9780061120084', 'Matar a un ruiseñor', 'Ficción', 'Harper Perennial', 'Harper Lee', '1960-07-11', 5),
('9780307277671', 'El hombre en busca de sentido', 'Psicología', 'Beacon Press', 'Viktor Frankl', '1946-01-01', 4),
('9780439023481', 'Los juegos del hambre', 'Ciencia ficción', 'Scholastic', 'Suzanne Collins', '2008-09-14', 6),
('9780141439600', 'Orgullo y prejuicio', 'Romance', 'Penguin Classics', 'Jane Austen', '1813-01-28', 4),
('9781400032716', '1984', 'Distopía', 'Plume', 'George Orwell', '1949-06-08', 5),
('9780385490818', 'El alquimista', 'Ficción', 'HarperOne', 'Paulo Coelho', '1988-01-01', 7),
('9780743273565', 'El gran Gatsby', 'Novela', 'Scribner', 'F. Scott Fitzgerald', '1925-04-10', 5),
('9780553213119', 'Drácula', 'Horror', 'Bantam Classics', 'Bram Stoker', '1897-05-26', 3),
('9780060850524', 'El arte de la guerra', 'Historia', 'Harper Collins', 'Sun Tzu', '0500-01-01', 8);