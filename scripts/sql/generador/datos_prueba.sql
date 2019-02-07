/********************
   TIPOS DE ANIMAL
********************/
insert into tipo_animal(tipo)
values
    ('Perros'),
    ('Gatos'),
    ('Hurones'),
    ('Conejos'),
    ('Aves'),
    ('Tortugas'),
    ('Roedores'),
    ('Otros');

/********************
      USUARIOS
********************/
insert into usuarios(mail, pass_cuenta, nombre, localidad, provincia, fecha_nacimiento, genero, info, foto_perfil, privacidad, activo)
values
    ('jclaver64@gmail.com', '1', 'Inazio Claver', 'Huesca', 'Huesca', '1992-05-28', 'HOMBRE', 'programandoapasitos.blogspot.com', 'usuarios/1/perfil.jpg', 1, 1),
    ('mirenaroa@hotmail.com', '1', 'Miren Aroa', 'Huesca', 'Huesca', '1992-05-27', 'MUJER', 'Esto no puedo ser real', 'usuarios/2/perfil.png', 0, 1),
    ('alumnodam1ignacioclaverpaules@gmail.com', '1', 'Chuse Inazio', 'Vigo', 'Pontevedra', '1987-3-27', 'HOMBRE', 'Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias. Hablamos de un país paraisomático en el que a uno le caen pedazos de frases asadas en la boca. Ni siquiera los todopoderosos signos de puntuación dominan a los textos simulados; una vida, se puede decir, poco ortográfica. Pero un buen día, una pequeña línea de texto simulado, llamada Lorem Ipsum, decidió aventurarse y salir al vasto mundo de la gramática. El gran Oxmox le desanconsejó hacerlo, ya que esas tierras estaban llenas de comas malvadas, signos de interrogación salvajes y puntos y coma traicioneros, pero el texto simulado no se dejó atemorizar. Empacó sus siete versales, enfundó su inicial en el cinturón y se puso en camino. Cuando ya había escalado las primeras colinas de las montañas cursivas, se dio media vuelta para dirigir su mirada por última vez, hacia su ciudad natal Letralandia, el encabezamiento del pueblo Alfabeto y el subtítulo de su', 'usuarios/3/perfil.png', 0, 1),
    ('yipicayei@gmail.com', '1', 'Bruce Springsteen', 'Madrid', 'Madrid', '1940-12-12', 'HOMBRE', 'Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro. Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca. Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no te cabe parte dellas.Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro. Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca. Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no', 'usuarios/4/perfil.png', 0, 1),
    ('ramaladingdong@gmail.com', '1', 'Emma Watson', 'Dos Hermanas', 'Sevilla', '1959-09-19', 'MUJER', 'En la consulta han participado 144.540 personas, por lo que se ha superado por segunda vez consecutiva los 100.000 votos. La votación ha estado abierta desde el martes 10 a las 11.00 horas hasta el miércoles', 'usuarios/5/perfil.png', 0, 1);

/********************
      ANIMALES
********************/

-- Adopción
insert into animales(tipo, usuario, nombre, sexo, edad, caracter, informacion, peso, altura, localidad, provincia, tlfn1, tlfn2, estado)
values
    (1, 1, 'Caissa', 'Hembra', 15, 'Miedosa, mimosa', 'Buscamos adopción para esta perrita recien rescatada de peleas callejeras. Tiene miedo de los humanos, y requiere paciencia', 13.300, 23, 'Huesca', 'Huesca', '974000000', '600000000', 2),
    (1, 2, 'Canela', 'Hembra', 24, 'Activa, muy movida', 'Buscamos adopción para esta perrita. Acostumbrada a vivir con gatos, tremendamente cariñosa, aunque algo nerviosa con los cambios. Muy bien educada en su anterior casa, es imposible no quererla', 7.500, 15, 'Huesca', 'Huesca', '974111111', '611111111', 2),
    (1, 2, 'Indi', 'Macho', 37, 'Extrovertido, amigable', 'Es un perro acostumbrado a vivir con cualquier tipo de animal, gatos, perros, tortugas... Se acostumbra facilmente a todo y es muy sociable. Buscamos adopción por haber tenido que huir al extranjero', 32.000, 40, 'Sesa', 'Huesca', '974222222', '622222222', 2),
    (1, 2, 'Rex', 'Macho', 120, 'Tranquilo y pacifico', 'Usado por la policía durante casi toda su vida, estamos buscando un hogar para este héroe ya jubilado. Muy bien adiestrado, se busca un hogar que le aporte tranquilidad y felicidad', 28.250, 35, 'Benasque', 'Huesca', '974333333', '633333333', 2),
    (1, 1, 'Ron', 'Macho', 79, 'Hiperactivo, curioso', 'Encontrado en la calle una noche fría, sin chip, lo adopté hace dos años pero ahora tengo que buscarle un hogar mejor. Gran perseguidor de ardillas, es muy curioso y le gusta lamer.', 35.000, 52, 'Huesca', 'Huesca', '974444444', '644444444', 2),
    (2, 3, 'Tara', 'Hembra', 41, 'Mimosa, territorial con otros animales', 'Rescatada por una chica de otra ciudad, la ha cuidado tremendamente bien. Es poseedora de sida gatuno, por lo que no puede convivir con otros felinos. Tuvo una cadera fracturada, pero se ha recuperado tremendamente bien gracias a los cuidados necesarios y ahora lleva una vida completamente normal. Y tiene ojazos, por cierto', 35.000, 52, 'Huesca', 'Huesca', '986000000', '655555555', 2),
    (3, 3, 'Limon', 'Macho', 1, 'Recien nacido', 'Es un hurón recien nacido que espera adopción, ya que no puedo mantenerlo en mi casa por mucho más tiempo. Se agradecería mandar fotos conforme vaya creciendo', 35.000, 52, 'Barcelona', 'Barcelona', '918456542', '654897235', 2),
    (3, 4, 'Antan', 'Macho', 1, 'Recien nacido', 'Es un hurón recien nacido que espera adopción, ya que no puedo mantenerlo en mi casa por mucho más tiempo. Se agradecería mandar fotos conforme vaya creciendo', 35.000, 52, 'Barcelona', 'Barcelona', '915468970', '654122203', 2),
    (6, 5, 'Lim', 'Macho', 15, 'Tranquila', 'Tortuga de mar con poquita vida, le gusta relajarse en su arenero mientras recibe los rayos del sol. Preferiblemente adopción para familia sin gatos, por si acaso...', 0.700, 5, 'Barcelona', 'Barcelona', '916855441', '711411411', 2),
    (6, 4, 'Cartona', 'Macho', 27, 'Le gusta marcar territorio', 'Criada en cautividad, se sienta agraviada si tiene que convivir con otras tortugas, pero tolera muy bien a los perros', 5.250, 20, 'Huesca', 'Huesca', '974010102', '654321987', 2),
    (6, 5, 'Kiwi', 'Hembra', 91, 'Compañia para ancianos', 'Es un kiwi que ha sido adiestrado para poder convivir y hacer compañia a ancianos que se sientan solos. Despues de un tiempo he decidido que el mejor modo de ayudar es dejar que lo adopte alguien que lo vaya a querer tanto como yo y pueda acompañarle a lo largo de su vida', 1.100, 10, 'Boltaña', 'Huesca', '974010102', '654111000', 2),
    (2, 1, 'Churrasquito', 'Macho', 16, 'Independiente y glotón', 'Se busca hogar para este gato recien castrado. Necesario un jardin donde pueda moverse con libertad, pues está acostumbrado a moverse por un pueblo a sus anchas. Le gusta mucho robar comida dulce, hay que estar atento a eso', 5.300, 16, 'Huesca', 'Huesca', '974010102', '698777456', 2),
    (2, 3, 'Cantilla', 'Hembra', 160, 'Mimosa', 'Le encanta ser acariciada, cuidada y estar en lugares cálidos. Se busca alguien que quiera cuidarla y se responsabilice para castrarla en cuanto la reciba en adopción. Puede convivr sin problemas con cualquier animal', 35.000, 52, 'Sabiñanigo', 'Huesca', '974010102', '658932111', 2),
    (4, 2, 'Polin', 'Hembra', 29, 'Timido', 'Busco adopción para mi conejo, ya que en mi piso no puede seguir... Es timido con la gente y otros animales, pero a base de alimentos es factible ganarselo', 3.450, 12, 'Boltaña', 'Huesca', '974010102', '654784203', 2),
    (8, 3, 'Mandrain', 'Macho', 43, 'Jugueton', 'Le gusta perderse por la casa, es muy cotilla y sirve para hacer compañia a cualquiera que lo necesite. Muy cariñoso, le encanta jugar con niños y otros animales', 2.500, 13, 'Huesca', 'Huesca', '974010102', '715986321', 2);

-- Perdidos
insert into animales(tipo, usuario, nombre, sexo, edad, caracter, informacion, peso, altura, calle, localidad, provincia, latitud, longitud, tlfn1, tlfn2, estado)
values
    (1, 1, 'Caissa', 'Hembra', 15, 'Miedosa, mimosa', 'Se perdió en la calle Lanuza cuando rompió la correa sin querer y un coche la asustó. Es muy miedosa, responde al nombre de Caissa. Cualquier noticia sería de agradecer', 13.000, 23, 'Calle Lanuza', 'Huesca', 'Huesca', 42.138295 , -0.403131,'974000000', '600000000', 3),
    (1, 2, 'Canela', 'Hembra', 24, 'Nerviosa, juguetona', 'Se perdió hace una hora y media. Necesita medicación crónica. Contactad urgente si la veis, por favor', 7.500, 15, 'Calle los olivos', 'Huesca', 'Huesca', 42.130192, -0.406068, '974111111', '611111111', 3),
    (1, 2, 'Indi', 'Macho', 37, 'Extrovertido, amigable', 'Responde al nombre de Indi. Es muy jugueton, pero no esquiva los coche, corre hacía ellos. Por favor, intentad cogedlo o llamad a cualquiera de los números en caso de verlo', 32.000, 40, 'Calle Padre Ferrer', 'Sesa', 'Huesca', 41.995523, -0.245260, '974222222', '622222222', 3),
    (1, 2, 'Rex', 'Macho', 120, 'Tranquilo y pacifico', 'Huido de la finca, la última vez fue viso en Camino Campale yendo hacía el Ara. Es mayor y puede estar muy desorientado, pero es manso y no muerde, de verás', 28.250, 35, 'Camino Campale', 'Benasque', 'Huesca', 42.603782, 0.518530, '974333333', '633333333', 3),
    (1, 1, 'Ron', 'Macho', 79, 'Hiperactivo, curioso', 'Se fue mientras jugabamos en el parque y no pude cogerlo a tiempo. Si alguien lo ve llame a este número +34 658 77 99 20', 35.000, 52, 'Avenida Doctor Artero', 'Huesca', 'Huesca', 42.146196, -0.419673, '974444444', '644444444', 3),
    (2, 3, 'Tara', 'Hembra', 41, 'Mimosa, territorial con otros animales', 'Escapó cuando mi hija lo pisó sin querer. La última vez fue visto entrando en un aula de la ong Reciclaje Tecnológico y reparando tres ordenadores', 35.000, 52, 'Calle Padre Huesca', 'Huesca', 'Huesca', 42.135992, -0.406694, '986000000', '655555555', 3),
    (3, 3, 'Limon', 'Macho', 1, 'Recien nacido', 'Es recién nacido, la caja se rompió y la lluvia lo arrastro por la calle. No pude llegar a tiempo, y ahora está perdido él y su hermano', 35.000, 52, 'Carrer de Roger', 'Barcelona', 'Barcelona', 41.377163, 2.127411, '918456542', '654897235', 3),
    (3, 4, 'Antan', 'Macho', 1, 'Recien nacido', 'Es recién nacido, la caja se rompió y la lluvia lo arrastro por la calle. No pude llegar a tiempo, y ahora está perdido él y su hermano', 35.000, 52, 'Carrer de Viriat', 'Barcelona', 'Barcelona', 41.380164, 2.139274, '915468970', '654122203', 3),
    (6, 5, 'Lim', 'Macho', 15, 'Tranquila', 'Se busca a lo largo de la calle. No ha podido correr mucho pero no la encontramos después de tres horas', 0.700, 5, 'Carrer de Londres', 'Barcelona', 'Barcelona', 41.390932, 2.147081, '916855441', '711411411', 3),
    (6, 4, 'Cartona', 'Macho', 27, 'Una tortuga, es normal', 'Se busca por los alrededores. Mi sobrino es muy fan de las tortugas ninjas y pensó que era buena idea meterla por una alcantarilla. Sabemos que salió montada en una rata pero la ultima vez no la pudimos coger', 5.250, 20, 'Calle Ramon J Sender', 'Huesca', 'Huesca', 42.134684, -0.403115, '974010102', '654321987', 3),
    (6, 5, 'Kiwi', 'Hembra', 91, 'Curiosa', 'Se fugo deslizandose por un balcón del octavo piso. Necesita colirio para no quedarse ciega. Por favor, vuelve. No gastaré más chistes sobre frutas', 1.100, 10, 'Calle San Pablo', 'Boltaña', 'Huesca', 42.445299, 0.067981, '974010102', '654111000', 3),
    (2, 1, 'Churrasquito', 'Macho', 16, 'Independiente y glotón', 'Se fue como todas las noches a cazar pero lleva tres días sin volver a casa. Lo hemos buscado por todos los sitios pero no lo encontramos...', 5.300, 16, 'Calle Ricardo del Arco', 'Huesca', 'Huesca', 42.138184, -0.417134, '974010102', '698777456', 3),
    (2, 3, 'Cantilla', 'Hembra', 160, 'Mimosa', 'Se escapó mientras dormía, pensabamo sque volvería al sentir hambre pero de eso hace dia y medio. Urge su búsqueda', 35.000, 52, 'Calle de Lepanto', 'Sabiñanigo', 'Huesca', 42.519415, -0.366647, '974010102', '658932111', 3),
    (4, 2, 'Polin', 'Hembra', 29, 'Timido', 'Estamos muy preocupados. Es un conejo negro, ojos saltones y con una mancha en forma de Harry Potter en el lomo. Lo queremos mucho, si lo veis avisad por favor, el arroz se nos está enfriando', 3.450, 12, 'Plaza España', 'Boltaña', 'Huesca', 42.446266, 0.067407, '974010102', '654784203', 3),
    (8, 3, 'Mandrain', 'Macho', 43, 'Jugueton', 'Es un buitre amaestrado para el control de plagas en la sede política. Se escapó por accidente y tememos que le haya pasado algo. Es el simbolo del partido y sin el estamos aún más perdidos', 2.500, 13, 'Calle Niágara', 'Huesca', 'Huesca', 42.140688, -0.395025, '974010102', '715986321', 3);

-- Encontrados
insert into animales(tipo, usuario, informacion, calle, localidad, provincia, latitud, longitud, tlfn1, tlfn2, estado)
values
    (1, 1, 'Encontrado perro merodeando por enfrente de la entrada del parque. Marron, tamaño medio y con un collar con el nombre de "Chimo". Está muy limpio y bien alimentado, pero si chipar', 'Calle Rioja', 'Huesca', 'Huesca', 42.136333 , -0.410804,'974000000', '600000000', 4),
    (1, 2, 'Se ha visto a un perro bastante grande y parece que adulto por Henao Kalea, arriba y abajo, como buscando a sus dueños. Lleva ahí dos horas pero no quiere acercarse a ningún humano. Es de alguien?', 'Henao Kalea', 'Bilbao', 'Vizcaya', 43.264950, -2.932628, '974111111', '611111111', 4),
    (1, 2, 'Perro blanco, husky siberiano, ha aparecido en el portal de mi casa, en Callo Fuero. No tiene chip, ni collar, pero está muy bien cuidado. Tiene un ojo marron y otro azul, y es tremendamente mimoso. Sobre unos cinco años debe tener. Lo mantendré unos días hasta que salga el dueño. Difundid por favor', 'Calle Fuero', 'León', 'León', 42.596164, -5.574238, '974222222', '622222222', 4),
    (2, 4, 'Hay un gato que me ha seguido hasta mi portal esta mañana. Marron, con ojos negros y la cola pintada de blanco. Se acerca sin problemas a los humanos, y tiene un collar que pone "Con cariño para Ma". Está en mi piso de momento. Contactad a los números publicados', 'Calle de Almagro', 'Madrid', 'Madrid', 40.429904, -3.693492, '974010102', '654321987', 4),
    (8, 5, 'Mini cerdito ha aparecido en la entrada de mi restaurante. Es completamente negro, y debe pesar unos dos kilos así a ojo. A ver, que servimos ibéricos, pero lo voy a cuidar hasta que salga su dueño', 'Calle Cáceres', 'Alcorcón', 'Madrid', 40.346339, -3.833347, '974010102', '654111000', 4),
    (2, 1, 'Gata embarazada, blanca con motas marrones en el lomo, con collar, está dando a luz en mi portal. Favor de su dueño pasar a recogerla, ya hay cinco cachorros y sigue...', 'Calle Sancho Miranda', 'Málaga', 'Málaga', 36.748368, -4.418914, '974010102', '698777456', 4),
    (2, 3, 'Gato negro, con cola marron ha entrado en mi piso. Tiene una chapa con el nombre de Lobezno, y un número de teléfono pero solo puedo leer las dos últimas cifras, 45. Si alguien lo conoce poneros en contacto', 'Calle Goya', 'Málaga', 'Málaga', 36.705741, -4.437154, '974010102', '658932111', 4),
    (4, 2, 'Han aparecido tres conejos en la huerta de mi casa. Yo diría que son mascotas de alguien por los lazos que llevan, si alguien los conoce los estoy alimentando de momento y guardando de la lluvia. Saludos', 'Plaza Vela', 'Almeria', 'Almería', 36.850153, -2.358487, '974010102', '654784203', 4),
    (8, 3, 'Se ha encontrado un pato amarillo con una cinta en la pata con el nombre de "Para Miriam". Parece bastante desorientado. Entiendo que es de alguien, si lo anda buscando lo tengo en mi casa. Llámame', 'Calle Niágara', 'Huesca', 'Huesca', 42.140688, -0.395025, '974010102', '715986321', 4);

/********************
   FOTOS ANIMALES
********************/
insert into fotos_animales(animal, ruta_imagen)
values
	-- En adopcion
    (1, 'animales/1/img/a0.jpg'),
    (1, 'animales/1/img/a1.jpg'),
    (1, 'animales/1/img/a2.jpg'),
    (2, 'animales/2/img/a0.jpg'),
    (2, 'animales/2/img/a1.jpg'),
    (3, 'animales/3/img/a0.jpg'),
    (3, 'animales/3/img/a1.jpg'),
    (3, 'animales/3/img/a2.jpg'),
    (4, 'animales/4/img/a0.jpg'),
    (5, 'animales/5/img/a0.jpg'),
    (6, 'animales/6/img/a0.jpg'),
    (6, 'animales/6/img/a1.jpg'),
    (7, 'animales/7/img/a0.jpg'),
    (7, 'animales/7/img/a1.jpg'),
    (8, 'animales/8/img/a0.jpg'),
    (9, 'animales/9/img/a0.jpg'),
    (10, 'animales/10/img/a0.jpg'),
    (11, 'animales/11/img/a0.jpg'),
    (12, 'animales/12/img/a0.jpg'),
    (12, 'animales/12/img/a1.jpg'),
    (12, 'animales/12/img/a2.jpg'),
    (12, 'animales/12/img/a3.jpg'),
    (13, 'animales/13/img/a0.jpg'),
    (14, 'animales/14/img/a0.jpg'),
    (15, 'animales/15/img/a0.jpg'),

    -- Perdidos
    (16, 'animales/16/img/a0.jpg'),
    (16, 'animales/16/img/a1.jpg'),
    (16, 'animales/16/img/a2.jpg'),
    (17, 'animales/17/img/a0.jpg'),
    (17, 'animales/17/img/a1.jpg'),
    (18, 'animales/18/img/a0.jpg'),
    (19, 'animales/19/img/a0.jpg'),
    (20, 'animales/20/img/a0.jpg'),
    (21, 'animales/21/img/a0.jpg'),
    (22, 'animales/22/img/a0.jpg'),
    (23, 'animales/23/img/a0.jpg'),
    (24, 'animales/24/img/a0.jpg'),
    (25, 'animales/25/img/a0.jpg'),
    (26, 'animales/26/img/a0.jpg'),
    (27, 'animales/27/img/a0.jpg'),
    (28, 'animales/28/img/a0.jpg'),
    (29, 'animales/29/img/a0.jpg'),
    (30, 'animales/30/img/a0.jpg'),

    -- Encontrados
    (31, 'animales/31/img/a0.jpg'),
    (32, 'animales/32/img/a0.jpg'),
    (33, 'animales/33/img/a0.jpg'),
    (35, 'animales/35/img/a0.jpg'),
    (38, 'animales/38/img/a0.jpg'),
    (39, 'animales/39/img/a0.jpg');

/********************
 FICHAS VETERINARIAS
********************/
insert into ficha_veterinaria(id_animal, fecha, motivo, diagnotico, factura, clinica)
values
    (1, '2015-12-03', 'Castración', 'Se ha castrado al animal. Limpia de cicatriz y medicación otorgada', 'animales/1/facturas/a0.pdf'),
    (1, '2016-01-09', 'Revisión de la intervención', 'Herida cicatrizada correctamente, no presenta ningún signo de infección', 'animales/1/facturas/a1.pdf'),
    (2, '2014-11-23', 'Castración', 'Se castra a primera hora de la mañana. Por la tarde presenta ligera infección y se trata con antibioticos. Volver en una semana para revisión', 'animales/2/facturas/a0.pdf'),
    (2, '2014-12-01', 'Revisión post-intervención', 'La incisión parece completamente limpia, y cicatriza correctamente. Limpia de herida y recibe el alta', null),
    (2, '2015-09-03', 'Presenta herida en el hocico', 'Se retira una chordiga de la parte interna del hocico que estaba obstruyendo el sistema respiratorio. Limpieza y colocación de campana para evitar infección posterior', 'animales/2/facturas/a1.pdf'),
    (5, '2011-1-16', 'Nacimiento', 'Parto con insuficiencia respiratoria. Se reanima y finaliza con normalidad', 'null'),
(5, '2011-1-16', 'Vacunas', 'Antirrabica y contra la lamprea', 'null'),
    (5, '2012-03-29', 'No para de vomitar', 'Se le detecta reacción alérgica a las primeras vacunas. Tropamina en pastillas durante quince días', 'animales/5/facturas/a0.pdf'),
    (5, '2013-02-14', 'Castración', 'Se ha castrado al animal. Limpia de cicatriz y medicación otorgada', 'animales/5/facturas/a1.pdf'),
(5, '2013-07-16', 'Chipado', 'Registrado el animal a nombre de Emma Watson.', 'animales/5/facturas/a1.pdf');

/********************
    ANUNCIANTES
********************/
insert into anunciantes(nombre, contacto, mail, tlfn1, tlfn2, fax)
values
    ('Edugamer92', 'Eduardo Cantero', 'edugamer92@gmail.com', '974551120', '687451020', null),
    ('Indiana Photography', 'Regina Falangi', 'indifoto@gmail.com', '974444554', '687451020', null),
    ('Zoo', 'Anne Rice', 'veterinariazoo@gmail.com', '976877945', '665544001', '976877946'),
    ('WWF', 'Manuel Escudeiro', 'nolodelpressingcatch@wwf.com', '910000000', '631547778', '910000000'),
    ('Green Peace', 'Matilde Asensi', 'matilde@asensipeace.com', '923154699', '600111356', '923154699');
    ('San Adoptin', 'Richard Castle', 'admin@sanadoptin.com', '944532155', '715468993', '944532155');

 /********************
      ANUNCIOS
********************/
insert into anuncios(anunciante, titulo, imagen, enlace, provincia, fecha_publicacion, fecha_finalizacion, estado, precio)
values
    -- España
    (1, 'Edugamer92, tu canal de videojuegos', 'anuncios/1/imagen.jpg', 'https://www.youtube.com/user/EduGamer92', 'España', '2016-04-25', '2017-04-25', 24.99),
    (2, 'Animal book al 50%', 'anuncios/2/imagen.jpg', 'http://regalosregalicos.wix.com/regalomamen', 'España', '2016-04-25', '2017-04-25', 24.99),
    (3, 'Descuento en revisiones', 'anuncios/3/imagen.jpg', 'http://www.clinicaveterinariazoo.com/', 'España', '2016-03-25', '2016-06-25', 14.99),
    (4, 'Be partner today', 'anuncios/4/imagen.jpg', 'www.wwf.org', 'España', '2016-04-25', '2016-04-25', 24.99),
    (5, 'Luchemos contra el fracking', 'anuncios/5/imagen.jpg', 'www.greenpeace.org', 'España', '2016-04-25', '2017-04-25', 24.99),
    (6, 'Ayudanos, nuestra perrera te necesita', 'anuncios/6/imagen.jpg', 'http://www.sanadoptin.org/', 'España', '2016-05-16', '2016-05-30', 3.99),
    (1, 'Ultimas novedades sobre manga', 'anuncios/7/imagen.jpg', 'https://www.youtube.com/user/EduGamer92', 'España', '2016-04-25', '2016-06-25', 0.00),
    (2, 'Arte natural. Encarga tu trabajo ahora', 'anuncios/8/imagen.jpg', 'http://regalosregalicos.wix.com/regalomamen', 'España', '2016-04-25', '2016-06-25', 0.00),
    (4, 'No al exterminio del lince ibérico', 'anuncios/9/imagen.jpg', 'www.wwf.org', 'España', '2016-04-25', '2016-06-25', 0.00),
    (5, 'Contra el fracking en Vizcaya', 'anuncios/10/imagen.jpg', 'www.greenpeace.org', 'España', '2016-04-25', '2016-06-25', 0.00),

    -- Huesca
    (1, 'SkypeEvent el 19 de Junio. ¡Únete!', 'anuncios/11/imagen.jpg', 'https://www.youtube.com/user/EduGamer92', 'Huesca', '2016-06-01', '2016-06-19', 4.50),
    (2, 'Concurso "Indiana Photography"', 'anuncios/12/imagen.jpg', 'http://regalosregalicos.wix.com/regalomamen', 'Huesca', '2016-05-18', '2016-06-18', 5.99),
    (3, 'Campaña de esterilización 2016', 'anuncios/13/imagen.jpg', 'http://www.clinicaveterinariazoo.com/', 'Huesca', '2016-05-01', '2017-05-01', 24.99),
    (4, 'El verano del mini cerdito', 'anuncios/14/imagen.jpg', 'www.wwf.org', 'Huesca', '2016-05-01', '2016-08-19', 14.99),
    (5, 'Cuida tu Pirineos', 'anuncios/15/imagen.jpg', 'www.greenpeace.org', 'Huesca', '2016-05-01', '2017-06-19', 24.99);
