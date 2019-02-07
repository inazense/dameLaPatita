<?php

/**
 * Geocodifica una dirección
 * @param string $address
 * @return array con latitud, longitud y string con direccion, o FALSE si hubo algun error
 */
function geocode($address){

    // Convierte en URL la dirección
    $address = urlencode($address);

    // POST a la API de geolocalización de Google Maps
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";

    // Recogo la respuesta JSON
    $resp_json = file_get_contents($url);

    // Decodifico el JSON
    $resp = json_decode($resp_json, true);

    // El parámetro de Status de la respuesta debe ser OK para permitir la geoposición
    if ($resp['status'] == 'OK'){

        // Capturo los datos (solo los que me interesan)
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];

        // Verifico si los datos están completos
        if ($lati && $longi && $formatted_address){

            // Meto los datos en un array
            $data_arr = array();

            array_push(
                $data_arr,
                $lati,
                $longi,
                $formatted_address
            );

            return $data_arr;

        }
        else{
            return false;
        }
    }
    else{
      return false;
    }
} // Fin geocode
