import Helpers from "./Helpers.js";

const apiKey = 'e940d1c4dd331ee1646290e8b5d9f650';

const creerCase = resultat => {
    // Renvoyer tout le DOM d'une case
    const lien = document.createElement("div");
    lien.className = "container-fluid";
    lien.innerHTML = remplirLien(`album/${resultat.album.id}`, resultat.title, resultat.preview, resultat.id, resultat.type, `artiste/${resultat.artist.id}`, resultat.artist.name, resultat.album.title);
    return lien;
};

const remplirLien = (lien, content, preview, id, type, lienArtist, contentArtist, contentAlbum) => {
    return `<div class="d-flex flex-row justify-content-between list-group-item resultat-titre col-12 d-block">
        <a class="col-3" href="${lien}">${content}</a>
        <a class="col-3" href="${lienArtist}">${contentArtist}</a>
        <a class="col-3" href="${lien}">${contentAlbum}</a>
        <span class="d-flex flex-row col-3 justify-content-around">
            <button class="btn btn-primary d-block" onCLick="like('${id}', '${type}')"><img src='http://192.168.10.10/img/heart.png' style="width:20px"/></button>
            <button class="btn btn-primary d-block" onCLick="play('${id}','${preview}')"><img src='http://192.168.10.10/img/play.png' style="width:20px"/></button>
        </span>
    </div>`
};

const traiterResultats = data => {
    Helpers.id("resultats").innerHTML = "";
    // Boucle sur les résultats
    Helpers.id("resultats").innerHTML = `
    <div class="d-flex flex-row justify-content-between resultat-titre col-12 d-block">
        <p class="col-3" >Titre</p>
        <p class="col-3" >Artiste</p>
        <p class="col-6" >Album</p>
    </div>`;
    for (let i = 0; i < data.length; i++) {
        const resultat = data[i];
        Helpers.id("resultats").appendChild(creerCase(resultat));
    }
};

const rechercher = () => {
    const mots = Helpers.id("motsRecherches").value;
    console.log("Recherche de", mots);
    const url = `https://api.deezer.com/search?q=${mots}`;
    axios.get(`https://cors-anywhere.herokuapp.com/${url}`, {
        headers: {
            'Access-Control-Allow-Origin': '*'
        }
    }).then(response =>{ traiterResultats(response.data.data)})
    .catch(error => console.error(error));
};

export default rechercher;
