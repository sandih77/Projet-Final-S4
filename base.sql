sqlite3 writable/db/mobileMoney.db

CREATE TABLE operateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT UNIQUE NOT NULL,
    commission REAL NOT NULL
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
    operateur_id INTEGER,
    FOREIGN KEY(type_operation_id) REFERENCES types_operation(id),
    FOREIGN KEY(operateur_id) REFERENCES operateur(id)
);

CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT,
    telephone TEXT UNIQUE,
    code_secret INTEGER
);

CREATE TABLE operations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER,
    type_operation_id INTEGER,
    client_destinataire INTEGER,
    montant REAL,
    frais REAL,
    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,
    operateur_id INTEGER,
    FOREIGN KEY(client_id) REFERENCES clients(id),
    FOREIGN KEY(type_operation_id) REFERENCES types_operation(id),
    FOREIGN KEY(client_destinataire) REFERENCES clients(id),
    FOREIGN KEY(operateur_id) REFERENCES operateur(id)
);

-- Données de test
INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Sandih', '0388784291', 1234);
INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Test', '0343434434', 1234);

INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Orange', '0322222222', 1234);

INSERT INTO types_operation (nom)
VALUES
    ('depot'),
    ('retrait'),
    ('transfert');

INSERT INTO operateur (nom, commission)
VALUES
    ('yas', 0),
    ('orange', 5),
    ('airtel', 7);

INSERT INTO prefixes (prefixe, operateur_id)
VALUES
    ('034', 1),
    ('038', 1),
    ('033', 3),
    ('037', 2),
    ('032', 2);

INSERT INTO baremes (type_operation_id, montant_min, montant_max, frais, operateur_id)
VALUES
    (1, 0, 1000, 10, 1),
    (1, 1000, 2000, 20, 1),
    (1, 2000, 3000, 30, 1),
    (2, 0, 1000, 5, 1),
    (2, 1000, 2000, 10, 1),
    (2, 2000, 3000, 15, 1),
    (3, 0, 1000, 15, 1),
    (3, 1000, 2000, 20, 1),
    (3, 2000, 3000, 25, 1);
