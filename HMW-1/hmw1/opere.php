<?php

$conn = mysqli_connect("localhost","root","","theater") or die(mysqli_error($conn));


$query = "SELECT Titolo,Autore,Descrizione,Copertina,Costo_biglietto FROM opera" ;

// Esecuzione
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (mysqli_num_rows($res) > 0) {
    
    while($entry = mysqli_fetch_assoc($res)) {
        $opere[] = array( "Titolo" => $entry["Titolo"], "Autore" => $entry["Autore"], 
                          "Descrizione" => $entry["Descrizione"], "Copertina" => $entry["Copertina"],
                          "Costo" => $entry["Costo_biglietto"]);
    }
}
mysqli_close($conn);
echo json_encode($opere);
?>