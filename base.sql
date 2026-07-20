sqlite3 writable/db/mobileMoney.db

CREATE TABLE operateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT UNIQUE NOT NULL
);

CREATE TABLE prefixes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe TEXT UNIQUE NOT NULL,
    operateur_id INTEGER,
    FOREIGN KEY(operateur_id) REFERENCES operateur(id)
);

CREATE TABLE types_operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL
);

CREATE TABLE baremes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type_operation_id INTEGER,
    montant_min REAL,
    montant_max REAL,
    frais REAL,
    FOREIGN KEY(type_operation_id) REFERENCES types_operation(id)
);

CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT,
    telephone TEXT UNIQUE,
    code_secret INTEGER,
    solde REAL
);

CREATE TABLE operations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER,
    type_operation_id INTEGER,
    client_destinataire INTEGER,
    montant REAL,
    frais REAL,
    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(client_id) REFERENCES clients(id),
    FOREIGN KEY(type_operation_id) REFERENCES types_operation(id),
    FOREIGN KEY(client_destinataire) REFERENCES clients(id)
);

-- Données de test
INSERT INTO clients (nom, telephone, code_secret, solde)
VALUES
    ('Sandih', '0388784291', 1234, 1000);
