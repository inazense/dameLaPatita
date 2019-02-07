/**
 * Author:  Inazio
 * Created: 29-abr-2016
 */

-- Creo la base de datos
drop database if exists proyecto_fin_dam;
create database proyecto_fin_dam;

-- Uso la base de datos
use proyecto_fin_dam;

-- Borro las tablas previas
-- (por si no eliminase la BD)

drop table if exists usuarios;
drop table if exists animales;
drop table if exists tipo_animal;
drop table if exists animales_foto;
drop table if exists ficha_veterinaria;
drop table if exists anunciantes;
drop table if exists anuncios;
drop table if exists denuncias;
-- Creo las tablas

create table tipo_animal(
    id int auto_increment primary key,
    tipo varchar(50)
);

create table usuarios(
    id int auto_increment primary key,
    mail varchar(255) unique,
    pass_cuenta varchar(255),
    nombre varchar(120),
    localidad varchar(50),
    provincia varchar(50),
    fecha_nacimiento date,
    genero varchar(6),
    info text,
    foto_perfil varchar(255),
    privacidad int, -- 0 = Publico // 1 = Ocultar mail // 2 = mail + fechaNacimiento // 3 = mail + fecha + genero // 4 = mail + fecha + genero + localidad + provincia
    activo int -- -1 = Banneado // 0 = Dado de baja // 1 = Login permitido
);

create table animales(
    id int auto_increment primary key,
    tipo int references tipo_animal(id),
    usuario int references usuarios(id),
    nombre varchar(30),
    sexo varchar(11),
    edad int,
    caracter varchar(255),
    informacion text,
    peso double,
    altura int,
    calle varchar(100),
    localidad varchar(50),
    provincia varchar(50),
    latitud double, -- Para google maps
    longitud double, -- Para google maps
    tlfn1 varchar(12),
    tlfn2 varchar(12),
    estado int -- 0 = solicitud de borrado // 1 = familia //2 = en adopcion // 3 = perdido // 4 = encontrado
);

create table fotos_animales(
    id int auto_increment primary key,
    animal int references animales(id),
    ruta_imagen varchar(255)
);

create table ficha_veterinaria(
    id_animal int references animales(id),
    fecha date,
    motivo text,
    diagnostico text,
    factura varchar(255),
    clinica varchar(50),
    primary key (id_animal, fecha)
);

create table denuncias(
	id int auto_increment primary key,
    animal int references animales(id),
    denunciante varchar(50),
    mail varchar(50),
    mensaje text
);

create table anunciantes(
    id int auto_increment primary key,
    nombre varchar(150),
    contacto varchar(255),
    mail varchar(255),
    tlfn1 varchar(12),
    tlfn2 varchar(12),
    fax varchar(20)
);

create table anuncios(
    id int auto_increment primary key,
    anunciante int references anunciantes(id),
    titulo varchar(100),
    imagen varchar(255),
	enlace text,
    provincia varchar(50),
    fecha_publicacion date,
    fecha_finalizacion date,
    estado int, -- 0 = Caducado // 1 = <= 10 dias para caducar // 2 = Anunciado
    precio double
);

-- USUARIOS
create user 'usuario_basico'@'%' identified by 'm0nster!!';

-- Permisos de seleccción
grant select on proyecto_fin_dam.* to 'usuario_basico'@'%';

-- Permisos de inserción
grant insert on proyecto_fin_dam.usuarios to 'usuario_basico'@'%';
grant insert on proyecto_fin_dam.animales to 'usuario_basico'@'%';
grant insert on proyecto_fin_dam.fotos_animales to 'usuario_basico'@'%';
grant insert on proyecto_fin_dam.ficha_veterinaria to 'usuario_basico'@'%';

-- Permisos de actualización
grant update on proyecto_fin_dam.usuarios to 'usuario_basico'@'%';
grant update on proyecto_fin_dam.animales to 'usuario_basico'@'%';
grant update on proyecto_fin_dam.fotos_animales to 'usuario_basico'@'%';
grant update on proyecto_fin_dam.ficha_veterinaria to 'usuario_basico'@'%';

-- Refresco los privilegios
flush privileges;
