<?php 
    require_once 'auth.php';

    $codiceFiscale = $_SESSION['user_id'];
      
        
    $conn = mysqli_connect("localhost", "root","","theater") or die(mysqli_error($conn));
    // Preparazione 
    $id = urlencode($_GET['opera']);
    $data = urlencode($_GET['data']);
    $ora = urlencode($_GET['ora']);
    $operazione = urlencode($_GET['operazione']);

    if($operazione == 2){
          
      $query1 = "DELETE from visione  where Data = '$data' and Opera = '$id' and Ora = '$ora'and User = '$codiceFiscale' ";
      mysqli_query($conn, $query1) or die(mysqli_error($conn));
            
    }
    if($operazione == 1){

      $query2 = "INSERT INTO VISIONE (User,  Opera, Data, Ora) VALUES ('$codiceFiscale','$id','$data','$ora')";
      mysqli_query($conn, $query2) or die(mysqli_error($conn));

    }
  
    $res='Operazione eseguita con successo';

    mysqli_close($conn);
    echo json_encode($res);
          
?>