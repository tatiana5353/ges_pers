const express = require("express");
const jwt = require("jsonwebtoken");
const { connecter } = require("./bd/connect");
const routesUtilisateur = require("./route/utilisateur");
const app = express();

//

// const users = [
//   {
//     name: "john",
//     password: "1234",
//   },
// ];
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
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use("/api/v1", routesUtilisateur);
// app.get("/", (req, res) => {
//   console.log("salut ça marche");
// });

// app.post("/auth", (req, res) => {
//   const { name, password } = req.body;
//   const valid = users.some(
//     (user) => user.name === name && user.password === password
//   );
//   console.log("name :" + name);
//   console.log("password :" + password);
//   const token = jwt.sign({ name }, privatekey, { algorithm: "RS256" });
//   if (valid) {
//     res.send(token);
//   } else {
//     res.status(404).send("pas trouvé");
//   }
// });
// function jwtGuard(req, res, next) {
//   const idToken = req.headers.authorization;
//   jwt.verify(idToken, publickey, (err, decoded) => {
//     if (err) {
//       res.status(401).send("Unauthorized");
//     } else {
//       req.userToken = decoded;
//       next();
//     }
//   });
// }
// app.get("/", jwtGuard, (req, res) => {
//   res.send(req.userToken);
// });
connecter("mongodb://127.0.0.1:27017/", (erreur) => {
  if (erreur) {
    console.log("erreur lors de la connexion avec la premiere donnée");
    process.exit(-1);
  } else {
    console.log("connexion avec la base de donnée établie");
  }
});
app.listen(3000);
console.log("attente de port 3000");
