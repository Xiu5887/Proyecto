-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS portafolio_digital;
USE portafolio_digital;

-- Tabla de estudiantes
CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    carnet VARCHAR(20) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de materias
CREATE TABLE IF NOT EXISTS materias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    semestre INT NOT NULL,
    contenido_url VARCHAR(255) NULL
);

-- Tabla de inscripciones (relación estudiante-materia)
CREATE TABLE IF NOT EXISTS inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT NOT NULL,
    materia_id INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id),
    FOREIGN KEY (materia_id) REFERENCES materias(id)
);

-- Tabla de notas
CREATE TABLE IF NOT EXISTS notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inscripcion_id INT NOT NULL,
    nota DECIMAL(4,2) NOT NULL,
    tipo VARCHAR(50), -- Ejemplo: Parcial, Final, Tarea
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (inscripcion_id) REFERENCES inscripciones(id)
);

-- Tabla de eventos (calendario académico)
CREATE TABLE IF NOT EXISTS eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha_evento DATE NOT NULL,
    hora_evento TIME,
    estudiante_id INT,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id)
);

-- Tabla de biblioteca (recursos)
CREATE TABLE IF NOT EXISTS biblioteca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT,
    url_recurso VARCHAR(255),
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Poblar la tabla de materias con el pensum oficial (8 semestres)
INSERT INTO materias (nombre, codigo, semestre) VALUES
-- Semestre 1
('Educación Ambiental', 'ADG-25132', 1),
('Hombre, Sociedad, Ciencia y Tecnología', 'ADG-25123', 1),
('Inglés I', 'IDM-24113', 1),
('Dibujo', 'MAT-21212', 1),
('Matemática I', 'MAT-21215', 1),
('Geometría Analítica', 'MAT-21524', 1),
('Seminario I', 'ADG-25131', 1),
('Defensa Integral de la Nación I', 'DIN-21113', 1),
-- Semestre 2
('Inglés II', 'IDM-24123', 2),
('Química General', 'QUF-22014', 2),
('Física I', 'QUF-23015', 2),
('Matemática II', 'MAT-21225', 2),
('Álgebra Lineal', 'MAT-21114', 2),
('Seminario II', 'ADG-25141', 2),
('Defensa Integral de la Nación II', 'DIN-21123', 2),
-- Semestre 3
('Física II', 'QUF-23025', 3),
('Matemática III', 'MAT-21235', 3),
('Probabilidades y Estadística', 'MAT-21414', 3),
('Programación', 'SYC-22113', 3),
('Sistemas Administrativos', 'AGG-22313', 3),
('Defensa Integral de la Nación III', 'DFN-21133', 3),
-- Semestre 4
('Teoría de los Sistemas', 'SYC-32114', 4),
('Cálculo Numérico', 'MAT-31714', 4),
('Lógica Matemática', 'MAT-31214', 4),
('Lenguajes de Programación I', 'SYC-32225', 4),
('Procesamiento de Datos', 'SYC-32414', 4),
('Sistemas de Producción', 'AGL-30214', 4),
('Defensa Integral de la Nación IV', 'DIN-31143', 4),
-- Semestre 5
('Teoría de Grafos', 'MAT-31114', 5),
('Lenguajes de Programación II', 'SYC-32235', 5),
('Investigación de Operaciones', 'MAT-30925', 5),
('Circuitos Lógicos', 'ELN-30514', 5),
('Análisis de Sistemas', 'SYC-32514', 5),
('Bases de Datos', 'SYC-32614', 5),
('Defensa Integral de la Nación V', 'DIN-31153', 5),
-- Semestre 6
('Optimización No Lineal', 'MAT-30935', 6),
('Lenguajes de Programación III', 'SYC-32245', 6),
('Procesos Estocásticos', 'MAT-31414', 6),
('Arquitectura del Computador', 'SYC-30525', 6),
('Diseño de Sistemas', 'SYC-32524', 6),
('Sistemas Operativos', 'SYC-30834', 6),
('Defensa Integral de la Nación VI', 'DIN-31163', 6),
-- Semestre 7
('Implantación de Sistemas', 'SYC-32714', 7),
('Metodología de la Investigación', 'ADG-30214', 7),
('Simulación y Modelos', 'MAT-30945', 7),
('Redes', 'SYC-31644', 7),
('Gerencia de la Informática', 'ADG-30224', 7),
('Electiva Técnica', 'ELECTIVA-TEC-7', 7),
('Electiva No Técnica', 'ELECTIVA-NT-7', 7),
('Defensa Integral de la Nación VII', 'DIN-31173', 7),
-- Semestre 8
('Teoría de Decisiones', 'MAT-31314', 8),
('Auditoría de Sistemas', 'SYC-32814', 8),
('Marco Legal para el Ejercicio de la Ingeniería', 'CJU-37314', 8),
('Teleprocesos', 'TTC-31154', 8),
('Electiva Técnica', 'ELECTIVA-TEC-8', 8),
('Electiva No Técnica', 'ELECTIVA-NT-8', 8),
('Defensa Integral de la Nación VIII', 'DIN-31183', 8);
