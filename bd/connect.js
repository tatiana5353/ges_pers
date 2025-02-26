const { MongoClient, Db } = require("mongodb");

var client = null;

function connecter(url, callback) {
  if (client == null) {
    client = new MongoClient(url);
    client.connect((erreur) => {
      if (erreur) {
        client = null;
        callback(erreur);
      } else {
        callback();
      }
    });
  } else {
    callback();
  }
}

function bd() {
  return new Db(client, "dbok");
}

function fermerConnection(params) {
  if (client) {
    client.close();
    client = null;
  }
}

module.exports = { connecter, bd, fermerConnection };
