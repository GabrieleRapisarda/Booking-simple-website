<?php
 
    
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }
    

    if (!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["username"]) && !empty($_POST["codiceFiscale"]) && !empty($_POST["password"]) )
    {
        $error = array();
        $conn = mysqli_connect("localhost", "root", "", "theater") or die(mysqli_error($conn));
        
        #validation specifica per ogni parametro inserito

        #username già utilizzato?
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT username FROM User WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        #codice fiscale valido?
        $codice_fiscale= mysqli_real_escape_string($conn, $_POST['codiceFiscale']);
        $query1 = "SELECT CF FROM User WHERE CF='$codice_fiscale'";
        $res1 = mysqli_query($conn,$query1);
            if(mysqli_num_rows($res1) > 0){
                $error[] = "Codice fiscale già registrato";
            }
        mysqli_free_result($res);
        mysqli_free_result($res1);
    
        #password con almeno 8 caratteri
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti (Inserire almeno 8 caratteri)";
        } 
        #conferma password coincide con password?
        if (strcmp($_POST["password"], $_POST["conferma_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        #se non ci sono stati errori posso registrare nel db
        if (count($error) == 0) {

            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO User (CF,  Nome, Cognome, Username, Password) VALUES('$codice_fiscale', '$nome', '$cognome','$username','$password')";
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["user_id"] = $_POST["CF"];
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
    }else if(isset($_POST["nome"]) || isset($_POST["cognome"]) || isset($_POST["username"]) || isset($_POST["codiceFiscale"]) || isset($_POST["password"]) )
    $error="Compila tutti i campi per procedere";

        
?>


<html>
    <head>
    <meta charset="UTF-8">
        <link rel='stylesheet' href='./style/login.css'>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registrati</title>
    </head>
    <body>
        <main class="signup">
        <section class="main">
            <div class='prima_riga'>
            <img src='./img/pencil.svg'>
            <h1>Registrati</h1>
            </div>
            <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    
                    echo "<span class='error'>";
                    foreach($error as $item){
                        echo $item."</br>";
                    }
                    echo "</span>";
                }
                
            ?>
            <form name='signup' method='post'>
                <!-- Seleziono il valore di ogni campo sulla base dei valori inviati al server via POST -->
               
                    <input type='text' name='nome' placeholder='Nome'<?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>
                
                    
                    <input type='text' name='cognome' placeholder='Cognome'<?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>>
            
                   
                    <input type='text' name='codiceFiscale' placeholder='Codice Fiscale' <?php if(isset($_POST["codiceFiscale"])){echo "value=".$_POST["codiceFiscale"];} ?>>
              
               
                    
                    <input type='text' name='username' placeholder='Username'<?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
              
               
                    
                    <input type='password' name='password' placeholder='Password'<?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
               
               
                    
                    <input type='password' name='conferma_password' placeholder='Conferma Password'<?php if(isset($_POST["conferma_password"])){echo "value=".$_POST["conferma_password"];} ?>>
              
               
                    <button type='submit'>Registrati</button>
               
            </form>
           <div class="signed">Hai già un account? <a href="login.php">Fai il login</a></div>
        </section>
        </main>
    </body>
</html>