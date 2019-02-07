set global event_scheduler = on;

create event e_ActualizarEstado
on schedule every 1 day starts '2016-05-22 03:00:00'
do call actualizar_estado()
