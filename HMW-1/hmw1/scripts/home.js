var listaTitoli;
var lista_mipiace=[];

function createImage(src){
    const image = document.createElement('img');
    image.src= src;
    return image;
  }


/***************************************************/
/*         Caricamento dati dal db                 */
/***************************************************/

function caricaLike(json){

  //controllo se ci sono like o no

  if(json == null){
  console.log("Non ci sono like da caricare");
  return;}
  else{
    for(let i=0;i<json.length;i++)
      lista_mipiace.push(json[i].id_opera);
    console.log("Like caricati correttamente");
  }

}

function cercalike(id){

  var flag=false;
  
  for(let i=0;i<lista_mipiace.length;i++)
    if(lista_mipiace[i] == id) {//ci sta il mi piace
      flag=true;
      break;}

  
  return flag;

}

function onJson(json){ 

    //console.log(json);

    for (let i = 0; i < json.length; i++)
    {

        const box=document.createElement("div"); 
        box.id=i;   

        const flag = cercalike(i);
          
        if(flag==true){  
          const like_button=createImage('./img/like2.png');
          like_button.classList='like_button';
          like_button.addEventListener('click',unlike_it);
          box.appendChild(like_button);

        }
        else{
          const like_button=createImage('./img/like1.png');
          like_button.classList='like_button';
          like_button.addEventListener('click',like_it);
          box.appendChild(like_button);

        }
      
        
        const img=createImage(json[i].Copertina);  
        img.id='immagine';
        box.appendChild(img);

        const titolo=document.createElement("h1");
        titolo.textContent = json[i].Titolo;
        box.appendChild(titolo);

        const autore=document.createElement("em");
        autore.textContent=json[i].Autore;
        box.appendChild(autore);


        const biglietto = document.createElement("h3");
        biglietto.textContent="Costo biglietto : "+json[i].Costo+" €";
        box.appendChild(biglietto);

        const dettagli_button=document.createElement("h2");
        dettagli_button.textContent = 'Dettagli';
        dettagli_button.addEventListener('click',piuDettagli);
        box.appendChild(dettagli_button);

        const descr=document.createElement("p");
        descr.textContent=json[i].Descrizione;
        descr.className='hidden';
        box.appendChild(descr);  


        
        document.getElementById("Lista_Opere").appendChild(box);
        
         
    }
    
    //console.log(document.querySelector('#Lista_Opere'));
    listaTitoli=document.querySelectorAll("#Lista_Opere div h1");
}


function onResponse(response){
  return response.json();
}

fetch("http://localhost/hmw1/carica_like.php").then(onResponse).then(caricaLike);   //cerco se ci sono like e in tal caso riempio array lista_mipiace  
fetch("http://localhost/hmw1/opere.php").then(onResponse).then(onJson);   //fecth a opere.php che prende i dati dal db


/*******          Gestione dei like           ********/ 


function mettiLike(json){

  console.log("operazione sul db effettuata con successo");

}

function unlike_it(event){

  const button = event.currentTarget;
  id_opera=button.parentElement.id;

  button.src='./img/like1.png';
  button.removeEventListener('click',unlike_it);
  button.addEventListener('click',like_it);


  //lo tolgo dal db
  fetch("http://localhost/hmw1/like.php?operazione=rimuovi&id_opera="+id_opera).then(onResponse).then(mettiLike);
}


function like_it(event){
  
  const button = event.currentTarget;
  id_opera=button.parentElement.id;

  button.src = './img/like2.png';
  button.removeEventListener('click',like_it);
  button.addEventListener('click',unlike_it);

  //lo aggiungo al db
  fetch("http://localhost/hmw1/like.php?operazione=aggiungi&id_opera="+id_opera).then(onResponse).then(mettiLike);
  
    
}

/******     Dettagli Button      *******/

function menoDettagli(event){

    const mdettagli=event.currentTarget;
    mdettagli.parentElement.querySelector('h2').classList.remove('hidden');
    mdettagli.classList.add('hidden');
  }
  
  function piuDettagli(event){
    
    const pdettagli = event.currentTarget;
    const descr=pdettagli.parentElement.querySelector('p');
  
    pdettagli.classList.add('hidden');
    descr.classList.remove('hidden');
    descr.addEventListener('click',menoDettagli);
  }

/**********************       Barra di ricerca     ***********************/

function ricerca(event){

    const barraRicerca = event.currentTarget;
    var x;
  
    console.log('Stai cercando :'+ barraRicerca.value);
    
   
    for(let i=0;i< listaTitoli.length ; i++)
    {
      if(listaTitoli[i].textContent.search(barraRicerca.value) !== -1){
        x = listaTitoli[i].parentElement; 
        x.classList.remove("hidden");}
      else{ 
        x = listaTitoli[i].parentElement;
        x.classList.add("hidden");
      }
      //console.log(x);
    }
    
  }

//const preferiti = document.querySelector('#preferiti');
//const listaOperePreferite = document.querySelector('#Lista_Opere_Preferite');
const barraRicerca = document.querySelector('input[type="text"]');
barraRicerca.addEventListener('keyup',ricerca);


/********************           Lista Prenotazioni         *********************/

var id_prenotazione = 0;

function caricaPrenotazioni(json){

  if(json==null)
  console.log("Non ci sono prenotazioni");
  else{ //controllo se ci sono prenotazioni
  
  id_prenotazione = json.length;
  for(let i=0;i<json.length;i++)
  {
    const prenotazione = document.createElement('div');
    prenotazione.id=i;
    prenotazione.classList='table_row';

    const titolo = document.createElement("div");
    titolo.id='titolo';
    titolo.classList='table_data';
    titolo.textContent = json[i].Titolo ;
    
    const ora = document.createElement("div");
    ora.id='ora';
    ora.classList='table_data';
    ora.textContent = json[i].Ora;

    const data = document.createElement("div")
    data.id='data';
    data.classList='table_data'; 
    data.textContent = json[i].Data;

    prenotazione.appendChild(titolo);
    prenotazione.appendChild(ora);
    prenotazione.appendChild(data);
    document.querySelector("div.table_content").appendChild(prenotazione);
  }

  
}
}

fetch("http://localhost/hmw1/prenotazioni.php").then(onResponse).then(caricaPrenotazioni); 



/***************      form prenotazioni          *************/

function prenota(json){

  console.log(json);

}


function rimuovi_prenotazione(lista,id) {

  lista[id].remove();
  
}

function aggiungi_prenotazione(id,titolo,data,ora){

  
  const prenotazione = document.createElement('div');
  prenotazione.classList='table_row'
  prenotazione.id=id;

  const new_titolo = document.createElement("div");
  new_titolo.id='titolo';
  new_titolo.classList='table_data';
  new_titolo.textContent = titolo ;
    
  const new_data = document.createElement("div");
  new_data.id='data';
  new_data.classList='table_data';
  new_data.textContent= data;

  const new_ora=document.createElement("div");
  new_ora.id='ora';
  new_ora.classList='table_data';
  new_ora.textContent= ora;

  prenotazione.appendChild(new_titolo);
  prenotazione.appendChild(new_ora);
  prenotazione.appendChild(new_data);
  document.querySelector("div.table_content").appendChild(prenotazione);
  
    
}

function checkForm(event){
  
  event.preventDefault();
  
  
  var lista_prenotazioni = document.querySelectorAll("div.table_content div.table_row");
  //console.log(lista_prenotazioni);
  const error = document.querySelector(".error");
  error.innerHTML='';

  const formData = new FormData(document.querySelector("#myForm"));

  //validation  
  if(formData.get('operazione') == null) {//devo selezionare operazione
    error.textContent="Seleziona il tipo di operazione";
    return;
  }
  if(formData.get('operazione')==2 && lista_prenotazioni.length > 0){ //devo eliminare prenotazione
    //controllo che ci sia
    
    var id_da_eliminare=-1;

    for(let i=0 ; i<lista_prenotazioni.length;i++){ 
      if(lista_prenotazioni[i].children.titolo.textContent == formData.get('op') && lista_prenotazioni[i].children.data.textContent == formData.get('data') && lista_prenotazioni[i].children.ora.textContent == formData.get('ora')){
        //se sono qua dentro vuol dire che ho trovato la prenotazione che voglio rimuovere
        var id_da_eliminare=i; //conservo index per rimuovere la prenotazione sotto
        break;
      }
    }

    //sono uscito da questo for perchè?
    if(id_da_eliminare==-1)
    {
      error.textContent='Non puoi rimuovere una prenotazione che non hai ancora registrato';
      return;
    }
    

  }
  if(formData.get('operazione')==2 && lista_prenotazioni.length == 0){//lista vuota -- non posso rimuovere niente
    error.textContent='Non hai ancora inserito nessuna prenotazione';
    return;
  }
  if(formData.get('operazione')==1 && lista_prenotazioni.length==0){ //lista vuota -- aggiungo direttamente
      //do nothing;
  }
  if(formData.get('operazione')==1 && lista_prenotazioni.length > 0){

    for(let i=0 ; i<lista_prenotazioni.length;i++){
      if(lista_prenotazioni[i].children.titolo.textContent == formData.get('op') && lista_prenotazioni[i].children.data.textContent == formData.get('data') && lista_prenotazioni[i].children.ora.textContent == formData.get('ora')){
        
        //se sono qui dentro vuol dire che ho trovato una prenotazione uguale
        error.textContent="Prenotazione già effettuata";
        return;
      }
    }

    //perchè sono uscito dal for? non ho trovato una prenotazione uguale quindi posso aggiungere la prenotazione

  }
  
  //HAI PASSATO LA VALIDATION , PUOI EFFETTUARE OPERAZIONE

  if(formData.get('operazione')==1){
    console.log("Registrazione in corso....");
    id_prenotazione++;
    aggiungi_prenotazione(id_prenotazione,formData.get('op'),formData.get('data'),formData.get('ora'));
  }
  else if(formData.get('operazione')==2){
    console.log("Rimozione in corso....");
    id_prenotazione--;
    rimuovi_prenotazione(lista_prenotazioni,id_da_eliminare);
  }


  //fetch

  var id;
  switch (formData.get('op')){
    case 'Amleto': id=0;
                  break;
    case 'Gli uccelli':id=1;
                  break;
    case 'Tartuffo':id=2;
                  break;  
    case 'Le beatrici':id=3;
                  break;
    case 'Aspettando Godot':id=4;
                  break;
  
  }

fetch("http://localhost/hmw1/prenota.php?opera="+id+"&data="+formData.get('data')+"&ora="+formData.get('ora')+"&operazione="+formData.get('operazione')).then(onResponse).then(prenota);

}

const myform = document.querySelector('#myForm');
myform.addEventListener('submit',checkForm);

/*****************          CaricaNotizie        *************/
var newsInPrimoPiano=0;

function createNews(Object){

  const contenitore = document.createElement("div");

  if(newsInPrimoPiano < 2)
      contenitore.className="primo_piano";
  else
      contenitore.className="secondo_piano";

  const img = document.createElement("img");
  img.src=Object.image;

  const title = document.createElement("h1");
  title.textContent=Object.title;

  const author = document.createElement("h2");
  author.textContent="Author : "+Object.author;

  const description= document.createElement("p");
  description.textContent=Object.description;
  description.className="hidden";

  contenitore.appendChild(img);
  contenitore.appendChild(title);
  contenitore.appendChild(author);
  contenitore.appendChild(description);
  
  switch (newsInPrimoPiano){

      case 0: document.getElementById("prima_news").appendChild(contenitore);
              break;
      case 1: document.getElementById("seconda_news").appendChild(contenitore);
              break;
      default : document.querySelector("#news").appendChild(contenitore);
              break;
  }
}

function notizie(json){
  
  //console.log(json);
  for(let i=0;i < json.length;i++)
    if(json[i].image !== null){ //visualizzo solo news con immagini
        createNews(json[i]);
        newsInPrimoPiano++;
    }

}


fetch("http://localhost/hmw1/notizie.php").then(onResponse).then(notizie);

/***************** Shifta Notizie ****************/

function shiftNews(){
 
  //la prima notizia la metto in coda
 
  var prima = document.querySelector("#prima_news .primo_piano");
  const clone_prima = prima.cloneNode(true);
  clone_prima.className="secondo_piano";
  document.querySelector("#news").appendChild(clone_prima);
  prima.remove();
 
 
  //la 2 diventa la prima
 
  var seconda = document.querySelector("#seconda_news .primo_piano");
  const clone_seconda = seconda.cloneNode(true);
  document.getElementById("prima_news").appendChild(clone_seconda);
  seconda.remove();
  
  //la notizia in coda diventa la 2
 
  var notiziaInCoda = document.querySelector(".secondo_piano");
  const clone_notiziaInCoda=notiziaInCoda.cloneNode(true);
  clone_notiziaInCoda.className="primo_piano";
  document.getElementById("seconda_news").appendChild(clone_notiziaInCoda);
  notiziaInCoda.remove();
 
  //console.log(document.querySelector("#news"));
 }
 
 const ScorriNews = document.getElementById("ScorriNews");
 ScorriNews.addEventListener("click",shiftNews);