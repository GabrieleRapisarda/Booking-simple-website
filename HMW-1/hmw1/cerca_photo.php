<?php
    //ritorna risultati api unsplash

    require_once 'auth.php';

    header('Content-Type: application/json');

    function unsplash(){

        $api_key='_nk9icmHJ-m6fxNDcPRNg8oEY3T5lzlkOYyyEKQDqd8';
        $query = urlencode($_GET["q"]);
        $url = 'https://api.unsplash.com/search/photos?per_page=30&client_id='.$api_key.'&query='.$query;

        # Creo il CURL handle per l'URL selezionato
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        # Setto che voglio ritornato il valore, anziché un boolean (default)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Eseguo la richiesta all'URL
        $res = curl_exec($ch);
        
               
        # Impacchetto tutto in un JSON
        $json = json_decode($res, true);
        
        # Libero le risorse
        curl_close($ch);
        //se non trovo niente faccio la verifica

        $newJson = array();
        #riformatto array
        for ($i = 0; $i < count($json['results']); $i++) {
            $newJson[] = array('id' => $json['results'][$i]['id'], 'preview' => $json['results'][$i]['urls']['small'], 'height' => $json['results'][$i]['height'], 'width' => $json['results'][$i]['width']);
        }
        
        echo json_encode($newJson);
        
    }

    unsplash();

?>
