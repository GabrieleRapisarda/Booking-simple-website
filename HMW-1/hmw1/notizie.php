<?php 
    require_once 'auth.php';

    header('Content-Type: application/json');

    function mediaStack(){

        $api_key='88795ecaa22ee4c00297ee2f6258007e';
        $url = "http://api.mediastack.com/v1/news?countries=it&languages=it&keywords=teatro&offset=50&limit=50&access_key=".$api_key;

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


        $newJson = array();
        #riformatto array
        for ($i = 0; $i < count($json['data']); $i++) {
            $newJson[] = array('image' => $json['data'][$i]['image'], 'title' => $json['data'][$i]['title'], 'author' => $json['data'][$i]['author'], 'description' => $json['data'][$i]['description']);
        }
        
        echo json_encode($newJson);
        

    }

    mediaStack();


?>