create database asistencia;
use asistencia;
-- Crear la tabla de usuarios
CREATE TABLE profesores (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    apellido VARCHAR(255),
    cedula VARCHAR(255),
    email VARCHAR(255),
    nombre VARCHAR(255),
    password VARCHAR(255)
);

-- Crear la tabla de cursos
CREATE TABLE cursos (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(255),
    descripcion VARCHAR(255),
    nombre VARCHAR(255),
    profesor_id BIGINT,
    FOREIGN KEY (profesor_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Crear la tabla de estudiantes
CREATE TABLE estudiantes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    apellido VARCHAR(255),
    cedula VARCHAR(255),
    email VARCHAR(255),
    nombre VARCHAR(255),
    telefono VARCHAR(255)
);

-- Crear la tabla de clases
CREATE TABLE clases (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora DATETIME(6),
    curso_id BIGINT,
    FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE
);

-- Crear la tabla de curso_estudiante (relación muchos a muchos)
CREATE TABLE curso_estudiante (
    curso_id BIGINT,
    estudiante_id BIGINT,
    PRIMARY KEY (curso_id, estudiante_id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id) ON DELETE CASCADE
);

-- Crear la tabla de asistencias
CREATE TABLE asistencias (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    estado ENUM('PRESENTE', 'AUSENTE', 'TARDE'), -- Enum para definir los estados
    clase_id BIGINT,
    estudiante_id BIGINT,
    FOREIGN KEY (clase_id) REFERENCES clases(id) ON DELETE CASCADE,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id) ON DELETE CASCADE
);

CREATE TABLE reportes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    clase_id BIGINT,
    estudiante_id BIGINT, 
    estado ENUM('PRESENTE', 'AUSENTE', 'TARDE'), 
    fecha DATETIME, 
    FOREIGN KEY (clase_id) REFERENCES clases(id) ON DELETE CASCADE,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id) ON DELETE CASCADE
);
