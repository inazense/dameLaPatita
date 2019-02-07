<?php
    error_reporting(E_ALL- E_NOTICE - E_DEPRECATED);
    session_start();

    session_destroy();
    
    header('location: /damelapatita/paginas/finSesion.html');
?>