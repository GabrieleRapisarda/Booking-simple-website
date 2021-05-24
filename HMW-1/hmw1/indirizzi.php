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
    <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='./style/indirizzi.css'>
    <script src='./scripts/indirizzi.js' defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Indirizzi </title>
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

    <header>
        <h1>
          <strong>Teatro ed Opere</strong>  
          </br>
          Informazione, cultura e spettacolo
        </h1>
    <div class="overlay"></div>   
    </header>

    
    <section id="ricerca">
        <form name='search_address'>
            <h1>Cerca Indirizzi con incasso maggiore di : </h1>
            <input type="text" name="search" id="searchbox" placeholder="Es. 50">
        </form>
    </section>

    <section id='errore' class='hidden'>
        <p> Non hai inserito un numero </p>
    </section>


    <section class="container">
        <div id="results">
        </div>
    </section>

    <footer><em>Homework 1</em></br>
      Gabriele Rapisarda O46002228</footer>

    </body>
</html>