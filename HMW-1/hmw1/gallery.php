<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }



?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='./style/gallery.css'>
        <script src='./scripts/gallery.js' defer></script>
        <title> Gallery </title>
    </head>

    <body>

        <nav>
            <div class="dropdown">
                <a class ='profile_button'><?php  echo $_SESSION['username']; ?></a> 
                <div class="dropdown-content">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
      
            <a href="home.php" class='links'>Home</a>
            <a href="gallery.php" class='links'>Gallery</a> 
            <a href="indirizzi.php" class='links'>Indirizzi</a> 

            
        </nav>

        <section id="ricerca">
            <form name='gallery'>
                <h1>Cosa vuoi cercare?</h1>
                <input type="text" name="search" id="searchbox" placeholder="Es.Theater">
                <div class="unsplash">Powered by unsplash<img src='./img/unsplash.svg'></div>
            </form>
        </section>

        <section id='errore' class='hidden'>
            <p> Nessun risultato </p>
        </section>


        <section class="container">
            <div id="results">
            </div>
        </section>

        <section id="modale" class="hidden" >
                
        </section>

    </body>
</html>