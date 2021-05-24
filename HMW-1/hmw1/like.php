<?php 
    require_once 'auth.php';

    $sessionString = '"'.$_SESSION['user_id'].'"';

    $conn = mysqli_connect("localhost", "root","","theater") or die(mysqli_error($conn));
    
    // Preparazione 
    $id_opera = urlencode($_GET['id_opera']);
    $operazione = urlencode($_GET['operazione']);

    if($operazione=='aggiungi')
    $query = "INSERT INTO PREFERITI VALUES ($sessionString,$id_opera)";
    else if($operazione=='rimuovi')
    $query = "DELETE FROM PREFERITI  where ID_opera = '$id_opera' and User = $sessionString ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);

    echo json_encode('Operazione completata---php');

?>