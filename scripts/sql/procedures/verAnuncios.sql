delimiter $$
drop procedure verAnuncios $$
create procedure verAnuncios()
begin
	declare id1 int;
    declare id2 int;
    declare id3 int;
    declare id4 int;
    declare id5 int;
    declare id6 int;
    declare id7 int;
    declare id8 int;
    declare id9 int;
    declare id10 int;
    declare inicio int;
    declare fin int;
    
    select min(id) 
    into inicio
    from anuncios
    where estado > 0;
    
    select max(id)
    into fin
    from anuncios
    where estado > 0;
    
    set id1 = floor(rand() * fin) + inicio;
    set id2 = floor(rand() * fin) + inicio;
    set id3 = floor(rand() * fin) + inicio;
    set id4 = floor(rand() * fin) + inicio;
    set id5 = floor(rand() * fin) + inicio;
    set id6 = floor(rand() * fin) + inicio;
    set id7 = floor(rand() * fin) + inicio;
    set id8 = floor(rand() * fin) + inicio;
    set id9 = floor(rand() * fin) + inicio;
    set id10 = floor(rand() * fin) + inicio;
    
    select titulo, imagen, enlace
    from anuncios
    where estado > 0
    and provincia like 'España'
	and (id = id1 or id = id2 or id = id3 or id = id4 or id = id5 or id = id6 or id = id7 or id = id8 or id = id9 or id = id10);
end $$
delimiter ;