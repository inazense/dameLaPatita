<?php

/**
* Convierte meses a años
* @param int $meses int > 11
* @return int
*/
function monthToYear($meses){

   return round($meses/12);
} // Fin monthToYear

/**
* Devuelve una cadena de texto
* indicando X meses o X años
* @param int $meses
* @return string
*/
function cadenaEdad($meses){

   if ($meses > 11){
       return monthToYear($meses) . " años";
   }
   else{
       return $meses . " meses";
   }
} // Fin cadenaEdad

/**
 * Sustituye una cadena por otra en caso de que la pasada sea nulo
 * @param string $original
 * @param string $siNulo
 * @return string
 */
function cambiarCadenasNulas($original, $siNulo){
    if ($original == NULL) {
        return $siNulo;
    } else {
        return $original;
    }
}

/**
 * Formatea el peso del animal en cadena de texto
 * @param double $peso
 * @return string
 */
function indicarPeso($peso){
    if ($peso == NULL){
        return "Peso desconocido";
    }
    else{
        return $peso . " kg.";
    }
}

/**
 * Formatea la altura del animal en cadena de texto
 * @param int $altura
 * @return string
 */
function indicarAltura($altura){
    if ($altura == NULL){
        return "Altura desconocida";
    }
    else{
        return $altura. " cm.";
    }
}

/**
 * Devuelve la URL completa para mostrar una imagen en el servidor
 * @param string $imagen
 * @return type
 */
function crearRutaImagen($imagen){
    return 'http://127.0.0.1/img/' . $imagen;
}

/**
 * Genera una cadena aleatoria de seis dígitos.
 * Fuente: https://josemmsimo.wordpress.com/2013/01/18/obteniendo-una-cadena-alfanumerica-usando-php/
 * @return string
 */
function getRandomCode(){
    $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-)(.:,;";
    $su = strlen($an) - 1;
    return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
}
