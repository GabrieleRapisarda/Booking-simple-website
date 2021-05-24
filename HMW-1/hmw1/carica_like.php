<?php 

require_once 'auth.php';

$sessionString = '"'.$_SESSION['user_id'].'"';

$conn = mysqli_connect("localhost", "root","","theater") or die(mysqli_error($conn));

$query ="SELECT * FROM PREFERITI WHERE User = $sessionString";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

//riformatto array


if (mysqli_num_rows($res) > 0) {
    
    while($entry = mysqli_fetch_assoc($res)) {
        $like[] = array( "id_opera" => $entry["ID_opera"]);
    }
}
else 
 $like=null;

 mysqli_close($conn);
 echo json_encode($like);

?>