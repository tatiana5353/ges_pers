const jwt = require("jsonwebtoken");
const { Utilisateur } = require("../model/Utilisateur");
const client = require("../bd/connect");
const { ObjectId } = require("mongodb");
const privatekey = `-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAuATrTxH2G8mHAC7CZyTZ3Gy02NcyndulzjeRORHOsynUJ82V
8YRS77dv2FY0RMsIdJeNZ5tjJ/eTDem9hQCjHDVKEDSf21xnrqQ4wCbWBAJYtKrp
y72h8aPWqeEjd7+54tUDMSLCtlSaXHdgvMWhwldNgnkdv0mO5UzBbZPgQTmg2en0
q7F9eZMne2Vb02VblOhftfn0PKIEEf8rLVL3seLxvNdv0vuiuzEGU7OoADYJyXSr
A210uBa1s4U5hYQ4wIcGr7tvUD29Cui3vkokrnAy5ro91wnfnUUmYsTpcra2lZ6i
tY8n43gmZZ4GhapcnRSshUBRt2/kijwORbJlEwIDAQABAoIBAQCmvVZWDClbXkzk
HnpqKVr6vslTXhLwNJFVfMYq1vbbIsCo3EDMWaEosqc2eE3eM7ZSpuwrAAJluY/W
4H+oXz5sleCpNHXQtzb/aLA/dDEh6tpjwiYcRZTStikRPv37SI9veKHuyNdzjM9d
j5HpGo6K4L5LxeDtbgJ7xQPTfVWK4tnlVzzVKi4mYqiar2ebib9DVHyestu+SWNX
UsA7tiXfkuSe46A5ZQ05TdIudhMmHuMSKBC9/u7X9xUw45M6HPird/KQYfBJN3M3
4Nlahn/DlFcqEaztNuDwypg/ZEQOv0nQQ2xsrQFcExduoY/Q9QyS8L7gbEDJ19Zq
4s4+rcNRAoGBAOWn2LaSMsseXeu3NxIe1KM1D6b7cFbPp7VVHTefzY9FfRxpUlMU
cyHqE3CB7+gJrlzw9OiJIwzxOdK1Y0ksTHXCpPITON5q2N2U8OX9lELmGQ0pU4sd
Se2unHkL7v0HWlRqdMQDV83BFal55RHhGXmOv3yGCl+Gg/cT8xwgLLs5AoGBAM0g
5WUI5/hMvtCQMcdPke2bNK4BpB8R2NWS+8+HMxY9YPTsKI3+fXBBvGMrExHQqXoV
YN4UrFbJoGKuJtGDZmupdUvxDQPfwIgNzRVbMhs/ctM79JymQZxPAv8lDwMakj85
wD5A2Rm/zIKudXt2dvijCyfPQkmb7kjaIqRg3garAoGBAMw1QtOdDoNkvjkSUmrP
dV6mmQNvQ0Y+Ia9xPqiudVd3f7daw7RSU8oNXTnGoK/go+XK8Msw3jTs7vC5D88K
D/cKnCcRBplnwuzNOqQXptURy6bTX5Es+wbZJBPSk7D079JuUuPU4Sd5EK0BUbpj
QYbAcu7kNacZcpCqcZtJ1NypAoGARJSl/TSQEbTe6u36po9U06LbZv3HeFfILgeZ
RtYF336f5uL54BdgquJfcKxbEM65isaQ/07cG5wHklZ1RgDvgjlCrSQnXM83GIW8
tlIqG3AIHNVjv+fZ8b982f7y2O/OS3MscePOccxtPJfFUYTW2+Pu+91QZTnL3fGI
OXrlYEcCgYAs17YcoqWBR/CSn1PE7rgX+BoSwlmYkRu4ZYXlNntXlid97ERY4C6J
1xk0VsQXDpuPNfPMLnrM4Rl3bTZk8xPnhSCWGQ4T7vSuEVq5h+B3Nm0bAoZ0X6Wi
FAvYHdp3wtEarg92F3BLZdHGjsTZ0Jfih5HN7WN8u87WlDMhaHKOsw==
-----END RSA PRIVATE KEY-----`;
const publickey = `-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuATrTxH2G8mHAC7CZyTZ
3Gy02NcyndulzjeRORHOsynUJ82V8YRS77dv2FY0RMsIdJeNZ5tjJ/eTDem9hQCj
HDVKEDSf21xnrqQ4wCbWBAJYtKrpy72h8aPWqeEjd7+54tUDMSLCtlSaXHdgvMWh
wldNgnkdv0mO5UzBbZPgQTmg2en0q7F9eZMne2Vb02VblOhftfn0PKIEEf8rLVL3
seLxvNdv0vuiuzEGU7OoADYJyXSrA210uBa1s4U5hYQ4wIcGr7tvUD29Cui3vkok
rnAy5ro91wnfnUUmYsTpcra2lZ6itY8n43gmZZ4GhapcnRSshUBRt2/kijwORbJl
EwIDAQAB
-----END PUBLIC KEY-----`;

function jwtGuard(req, res, next) {
  const idToken = req.headers.authorization;
  jwt.verify(idToken, publickey, (err, decoded) => {
    if (err) {
      res.status(401).send("Unauthorized");
    } else {
      req.userToken = decoded;
      next();
    }
  });
}

const ajouterUtilisateur = async (req, res) => {
  try {
    let utilisateur = new Utilisateur(
      req.body.noms,
      req.body.adresse,
      req.body.telephone,
      req.body.motDePasse
    );
    const token = jwt.sign({ noms: utilisateur.noms }, privatekey, {
      algorithm: "RS256",
    });
    let result = await client
      .bd()
      .collection("utilisateurs")
      .insertOne(utilisateur);
    res.status(200).json({ result, token });
  } catch (error) {
    console.log(error);
    res.status(500).json(error);
  }
};

const geTousUtilisateurs = async (req, res) => {
  try {
    let cursor = client.bd().collection("utilisateurs").find();
    let result = await cursor.toArray();
    if (result.length > 0) {
      res.status(200).json(result);
    } else {
      res.status(204).json({ msg: "Aucun utilisateur trouvé" });
    }
  } catch (error) {
    console.log(error);
    res.status(500).json(error);
  }
};

const getUtilisateurs = async (req, res) => {
  try {
    let id = new ObjectId(req.params.id);
    let cursor = client.bd().collection("utilisateurs").find({ _id: id });
    let result = await cursor.toArray();
    if (result.length > 0) {
      res.status(200).json(result[0]);
    } else {
      res.status(404).json({ msg: "Cet utilisateur n'existe pas" });
    }
  } catch (error) {
    console.log(error);
    res.status(500).json(error);
  }
};

const modifierUtilisateur = async (req, res) => {
  try {
    let id = new ObjectId(req.params.id);
    let nNoms = req.body.noms;
    let nAdresse = req.body.adresse;
    let nTelephone = req.body.telephone;
    let nMotDepasse = req.body.motDePasse;
    let result = await client
      .bd()
      .collection("utilisateurs")
      .updateOne(
        { _id: id },
        {
          $set: {
            noms: nNoms,
            adresse: nAdresse,
            telephone: nTelephone,
            motDePasse: nMotDepasse,
          },
        }
      );
    if (result.modifiedCount == 1) {
      res.status(200).json({ msf: "Modification réussie", result });
    } else {
      res.status(404).json({ msf: "Cet utiisateur n'existe pas" });
    }
  } catch (error) {
    console.log(error);
    res.status(500).json(error);
  }
};
const supprimerUtilisateur = async (req, res) => {
  try {
    let id = new ObjectId(req.params.id);
    let result = await client
      .bd()
      .collection("utilisateurs")
      .deleteOne({ _id: id });
    if (result.deletedCount == 1) {
      res.status(200).json({ msg: "suppression réussie" });
    } else {
      res.status(404).json({ msg: "Cet utilisateur n'existe pas" });
    }
  } catch (error) {
    console.log(error);
    res.status(500).json(error);
  }
};

module.exports = {
  ajouterUtilisateur,
  geTousUtilisateurs,
  getUtilisateurs,
  modifierUtilisateur,
  supprimerUtilisateur,
  jwtGuard,
};
