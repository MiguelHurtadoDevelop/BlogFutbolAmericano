CREATE DATABASE blogFA;
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS blogFA;
USE blogFA;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    apellidos       varchar(255),
    email           varchar(255) not null,
    password        varchar(255) not null,
    fecha           date not null,
    rol             varchar(20) not null,
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS registros;
CREATE TABLE IF NOT EXISTS registros(
    id              int(255) auto_increment not null,
    categoria_id    int(255) not null,
    usuario_id      int(255) not null,
    titulo          varchar(100) not null,
    descripcion     text,
    fecha           date not null,
    CONSTRAINT pk_registros PRIMARY KEY(id),
    CONSTRAINT fk_registro_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id),
    CONSTRAINT fk_registro_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

