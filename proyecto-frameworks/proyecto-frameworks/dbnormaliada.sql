CREATE DATABASE IF NOT EXISTS gastos_personales_normalizada;

USE gastos_personales_normalizada;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  email_verified_at DATETIME, 
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100),
  created_at DATETIME,
  updated_at DATETIME
);

CREATE TABLE password_reset_tokens (
  email VARCHAR(255) NOT NULL,
  token VARCHAR(255) NOT NULL,
  created_at DATETIME,
  
  PRIMARY KEY (email),
  FOREIGN KEY (email) REFERENCES users(email)
);

CREATE TABLE personal_access_tokens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tokenable_type VARCHAR(255) NOT NULL,
  tokenable_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  token VARCHAR(64) NOT NULL,
  abilities TEXT,
  last_used_at DATETIME,
  created_at DATETIME,
  updated_at DATETIME,

  FOREIGN KEY (tokenable_id) REFERENCES users(id)
);

CREATE TABLE categoria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50)
);

CREATE TABLE gasto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  categoria_id INT,
  cantidad DECIMAL(10,2),
  tipo VARCHAR(50),
  fecha DATE,
  
  FOREIGN KEY(categoria_id) REFERENCES categoria(id)
);

CREATE INDEX idx_gasto_categoria ON gasto(categoria_id);

CREATE TABLE ingreso (
  id INT AUTO_INCREMENT PRIMARY KEY, 
  categoria_id INT,
  cantidad DECIMAL(10,2),
  tipo VARCHAR(50),
  fecha DATE,
  
  FOREIGN KEY(categoria_id) REFERENCES categoria(id)
);

CREATE INDEX idx_ingreso_categoria ON ingreso(categoria_id);

INSERT INTO categoria (nombre) VALUES
  ('Alimentación'),
  ('Salud'),
  ('Alquiler Casa'),
  ('Carro');  

INSERT INTO gasto (categoria_id, cantidad, tipo, fecha) VALUES
  (1, 50.00, 'Gasto', '2023-11-01'),
  (1, 20.00, 'Gasto', '2023-11-03'),
  (2, 100.00, 'Gasto', '2023-10-27');
  
INSERT INTO ingreso (categoria_id, cantidad, tipo, fecha) VALUES
  (3, 75.00, 'Ingreso', '2023-11-02');