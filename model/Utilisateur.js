class Utilisateur {
  constructor(noms, adresse, telephone, motDePasse) {
    this.noms = noms;
    this.adresse = adresse;
    this.telephone = telephone;
    this.motDePasse = motDePasse;
  }
}

module.exports = { Utilisateur };
