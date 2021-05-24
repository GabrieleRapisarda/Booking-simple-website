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
    <link rel='stylesheet' href='./style/home.css'>
    <script src='./scripts/home.js' defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Home </title>
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

    <section>
      
      <div id="news">
        <div id="prima_news"></div>
        <div id="seconda_news"></div>
        <button id="ScorriNews"></button>
      </div>
      
      <div id="Titolo_Ricerca">
        <div id="titolo">Lista Spettacoli</div>
        <div id="BarraRicerca">Cerca
        <input type="text"></div>
      </div>

      <div id="Lista_Opere">  
      </div>


      

      <div class='prenotazioni_titolo'>Le mie prenotazioni</div>
      <div class='grid_prenotazioni'>
        
        <div class='table'>
          <div class='table_header'>
            <div class='header_item'>Opera</div>
            <div class='header_item'>Ora</div>
            <div class='header_item'>Data</div>
          </div>
          <div class='table_content'>
          </div>
        </div>
      
        
        <form  method='post' id='myForm'>
          <span class='error'></span>

          <div class="opera">
          Scegli opera
          <select name='op'>
            <option value ='Amleto'>Amleto</option>
            <option value ='Gli uccelli'>Gli uccelli</option>
            <option value ='Tartuffo'>Tartuffo</option>
            <option value ='Le beatrici'>Le beatrici</option>
            <option value ='Aspettando Godot'>Aspettando Godot</option>
          </select>
          </div>
          <div class="data">
            Scegli la data
            <select name='data'>
            <option value='10-10-2021'>10/10/2021</option>
            <option value='11-10-2021'>11/10/2021</option>
            <option value='11-11-2021'>11/11/2021</option>
            <option value='12-11-2021'>12/11/2021</option>
            <option value='23-01-2022'>23/01/2022</option>
            </select>
          </div>
          <div class="ora">
            Scegli orario
            <select name='ora'>
            <option value='13-00'>13:00 </option>
            <option value='15-00'>15:00 </option>
            <option value='18-00'>18:00 </option>
            <option value='21-00'>21:00 </option>
            
            </select>
          </div>
          <div class ="operazione">
            <input type='radio' name='operazione' value='1'>Aggiungi
            <input type='radio' name='operazione' value='2'>Rimuovi
          </div>
          <div class="tasto_invio">
            <button type='submit' >Invio </button>
          </div>
        </form>
      </div>

      
    </section>
    <footer><em>Homework 1</em></br>
      Gabriele Rapisarda O46002228</footer>
  </body>
 
</html>