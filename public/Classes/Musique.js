import Helpers from "../js/Helpers.js";

export default class Musique {
    constructor(data) {
      this.data = data;
    }
  
    remplir() {
      Helpers.remplirChamp("titre", this.data.title)
    }
    
  }