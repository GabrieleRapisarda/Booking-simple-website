<?php
 
    
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }
    

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        // Se username e password sono stati inviati
        // Connessione al DB
        $conn = mysqli_connect("localhost", "root","","theater") or die(mysqli_error($conn));
        // Preparazione 
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
     
        // Permette l'accesso tramite email o username in modo intercambiabile
        // ID e Username per sessione, password per controllo
        $query = "SELECT CF, username, password FROM USER WHERE username = '$username'";
        // Esecuzione
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;

        if (mysqli_num_rows($res) > 0) {
            // Ritorna una sola riga, il che ci basta perché l'utente autenticato è solo uno
               // Imposto una sessione dell'utente
               $entry = mysqli_fetch_assoc($res);
               if (password_verify($_POST['password'], $entry['password'])){
               $_SESSION['username'] = $entry['username'];
               $_SESSION['user_id'] = $entry['CF'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
               }
            }
        
        // Se l'utente non è stato trovato o la password non ha passato la verifica
        $error = "Username e/o password errati.";
        }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error = "Inserisci username e password.";
    }

?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='./style/login.css'>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>login - Accedi</title>
    </head>
    <body>
        <main class="login">
            <section>
                <div class='prima_riga'>
            <h1>Sign in</h1></div>
            <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<span class='error'>$error</span>";
                }
                
            ?>
            <form name='login' method='post'>
                <!-- Seleziono il valore di ogni campo sulla base dei valori inviati al server via POST -->
                <div class="username">
                    <div><input type='text' name='username' placeholder='Username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                </div>
                <div class="password">   
                    <div><input type='password' name='password' placeholder='Password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                </div>
                <div>
                <button type="submit"> Submit </button>
                </div>
            </form>
           <div class="signed">Non hai un account? <a href="signup.php">Iscriviti</a></div>
            </section>
        </main>
    </body>
</html>