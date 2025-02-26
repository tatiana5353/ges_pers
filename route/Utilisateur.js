const express = require("express");
const {
  ajouterUtilisateur,
  geTousUtilisateurs,
  getUtilisateurs,
  supprimerUtilisateur,
  modifierUtilisateur,
  jwtGuard,
} = require("../controller/utilisateur");
const router = express.Router();

router.route("/utilisateurs").post(ajouterUtilisateur);
router.route("/utilisateurs").get(jwtGuard, geTousUtilisateurs);
router.route("/utilisateurs/:id").get(jwtGuard, getUtilisateurs);
router.route("/utilisateurs/:id").put(jwtGuard, modifierUtilisateur);
router.route("/utilisateurs/:id").delete(jwtGuard, supprimerUtilisateur);

module.exports = router;
