<?php
    

    require_once 'auth.php';

    $conn = mysqli_connect("localhost", "root","","theater") or die(mysqli_error($conn));
    // Preparazione 
    $q = $_GET['q'];

    $query = "CALL p1($q)";
    

    $res=mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($res) > 0) {
    
        while($entry = mysqli_fetch_assoc($res)) {

            $indirizzi[] = array( "citta"=>$entry["citta"], "indirizzo" => $entry["indirizzo"],"titolo"=>$entry["titolo"],"incasso_totale"=>$entry["Incasso_totale"]);
        }
    }

    echo json_encode($indirizzi);

?>
