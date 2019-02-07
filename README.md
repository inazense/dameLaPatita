# Dame la patita
Plataforma web animalista centrada en promover mediante anuncios los siguientes puntos:
1. Adopción de animales
2. Búsqueda de animales perdidos
3. Publicar los animales domésticos encontrados en la calle
<p align="center"><img src="img/logoOriginal.png" /></p>

## Historia
Esta web se presentó como proyecto final para el ciclo de grado superior de DAM (Desarrollo de Aplicaciones Multiplataforma) en Junio de 2016.
La idea surgió como una plataforma para recopilar mediante un mapa interactivo los sitios donde han sido perdidos / encontrados diversos animales debido a la frustración de falta de plataformas y asociaciones que se dedicasen a ello en mi ciudad, Huesca.
Estaba pensada para, en un futuro, crearse como un proyecto real que englobase una solución única en todo el territorio nacional, pero por diversos motivos se ha ido dejando.
Pese a que tiene aún mucho que mejorar, he decidido liberar el código por si alguien desea tomar la idea y llevarla a cabo.

## Tecnología usada
El proyecto está sobre PHP usando Bootstrap para la creación de la web responsive y AngujarJS para la creación de tags que permitan la reutilización de código. La base de datos está montada sobre MySQL, y todo ello está soportado sobre un servidor Apache / MariaDB.

## Más información
La documentación entregada puede ser leída desde el siguiente enlace:
[Documentación Proyecto Final](/doc/Documentacion%20Proyecto%20Final.pdf)

## Scripts
En la carpeta de [scripts](/scripts) encontraréis todos los scripts necesarios para que funcione la solución con una conexión a base de datos.
Se divide en dos secciones:
- [backup](/scripts/backup) que se usará para realizar una copia periódica de la base de datos
- [sql](/scripts/sql) que contiene los scripts que deberán cargarse en la base de datos, además de unos casos de prueba para testear la solución

