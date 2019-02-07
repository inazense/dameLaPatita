delimiter $$

create procedure actualizar_estado()
begin
    declare v_id int;
    declare v_comienzo date;
    declare v_final date;
    declare v_ultima_fila int default 0;
    declare v_estado int;
    declare c_anuncios cursor for
	select id, fecha_publicacion, fecha_finalizacion
        from anuncios;
    declare continue handler for not found set v_ultima_fila = 1;
    open c_anuncios;
            anuncios_cursor : loop
        
            fetch c_anuncios into v_id, v_comienzo, v_final;
            if v_ultima_fila = 1 then
		leave anuncios_cursor;
            end if;
            
            if datediff(v_final, v_comienzo) <= 0 then
		set v_estado = 0;
            elseif datediff(v_final, v_comienzo) <= 10 and datediff(v_final, v_comienzo) > 0 then
		set v_estado = 1;
            else
		set v_estado = 2;
            end if;
            
            update anuncios set estado = v_estado where id = v_id;
        end loop anuncios_cursor;
    close c_anuncios;
end $$
delimiter ;