import Helpers from './Helpers.js'
import rechercher from './Recherche.js'
import chargerMusique from './media.js';

const showPage = pageId => {
    const pages = document.getElementsByClassName("racine");
    for (let i = 0; i < pages.length; i++) {
      const page = pages[i];
      page.style.display = page.id === pageId ? "" : "none";
    }
  };

const selectPage = () => {
    const hash = document.location.hash.replace("#", "");
    const path = hash.split("/");
    const page = path[0];

    console.log(path)
    switch (page) {
      case "titre":
        document.getElementsByClassName("lecteurMusique").src = "test.mp3"
        // document.location.href = hash
        break;
    }
};

const init = () => {
    selectPage();
    Helpers.id("boutonRecherche").addEventListener("click", rechercher);
};

window.addEventListener("load", init);
window.addEventListener("hashchange", selectPage);
