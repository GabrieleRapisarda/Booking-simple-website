

function onResponse(response){
    return response.json();
}

function getResponse(json){


    console.log(json);

    if(json.length==null)
        console.log('nessun risultato');
    else{
        

        for(let i=0;i<json.length;i++){
        const string=document.createElement("p");
        string.textContent=json[i].citta + " -- " + json[i].indirizzo + " -- " + json[i].titolo + " -- " + json[i].incasso_totale;

        document.getElementById('results').appendChild(string);
        }
    }

}

function search(event){

    event.preventDefault();
    const form_data = new FormData(document.querySelector("#ricerca form"));
    document.getElementById('results').innerHTML='';
    

    var q=parseFloat(form_data.get('search'));
    //console.log(q);
    //validation , devo vedere se utente ha inserito un numero
    if(isNaN(q)){
        console.log("Non hai inserito un numero");
        errore.classList.remove('hidden');
        return;
    }
    else{
    errore.classList.add('hidden');
    fetch("cerca_indirizzi.php?q="+ q).then(onResponse).then(getResponse);
    }
        
}


const cerca = document.querySelector("form");
const errore = document.getElementById("errore");

cerca.addEventListener("submit",search);