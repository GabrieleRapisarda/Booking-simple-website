const container = document.getElementById('results');

function search(event){

    const form_data = new FormData(document.querySelector("#ricerca form"));
    console.log(form_data.get('search'));
    
    //fetch a file php
    fetch("cerca_photo.php?q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(searchJson);

    //visualizzo i contenuti
    container.innerHTML = '';

    event.preventDefault();
}

function searchResponse(response)
{
    //console.log(response);
    return response.json();
}

function searchJson(json)
{
    //console.log(json);
    errore.classList.add('hidden');
    //controllo se ho trovato le foto

    
    if(json.length == 0)
        errore.classList.remove('hidden');  
    else
    //creo img e appendo 

    for(let item in json)
    {
        const div= document.createElement('div')
        div.classList='image';

        const img= document.createElement("img");
        img.src=json[item].preview;
    
        div.appendChild(img);

        container.appendChild(div);
        //modale al click
        img.addEventListener('click', apriModale);
    }
    

}


function apriModale(event) {
    const modale = document.getElementById('modale');
	
	const image = document.createElement('img');
	
	image.id = 'immagine_post';
	
	image.src = event.currentTarget.src;
	
	modale.appendChild(image);
	
	modale.classList.remove('hidden');
    modale.addEventListener('click',chiudiModale);
	
	document.body.classList.add('no-scroll');
}


function chiudiModale() {
	
		//aggiungo la classe hidden 
		modale.classList.add('hidden');
		//prendo il riferimento dell'immagine dentro la modale
		img = modale.querySelector('img');
		//e la rimuovo 
		img.remove();
		//riabilito lo scroll
		document.body.classList.remove('no-scroll');
	
}


const cerca = document.querySelector("form");
const errore = document.getElementById("errore");

cerca.addEventListener("submit",search);


