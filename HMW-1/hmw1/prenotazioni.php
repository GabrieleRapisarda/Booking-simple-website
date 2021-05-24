<?php

require_once 'auth.php'; //ho bisogno delle variabili di sessione

$conn = mysqli_connect("localhost","root","","theater") or die(mysqli_error($conn));


$query = "SELECT o.Titolo , v.Data , v.Ora
From  visione v join Opera o on o.ID=v.Opera 
where User = ".'"'.$_SESSION['user_id'].'"';


// Esecuzione
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (mysqli_num_rows($res) > 0) {
    
    while($entry = mysqli_fetch_assoc($res)) {
        $prenotazioni[] = array( "Titolo" => $entry["Titolo"], "Data" => $entry["Data"], "Ora"=> $entry["Ora"]);
    }
}
mysqli_close($conn);

if(isset($prenotazioni))
echo json_encode($prenotazioni);
else
echo json_encode(null);


?>

