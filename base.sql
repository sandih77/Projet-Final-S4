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
    code_secret INTEGER,
    epargne INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE operations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER,
    type_operation_id INTEGER,
    client_destinataire INTEGER,
    montant REAL,
    frais REAL,
    commission REAL NOT NULL DEFAULT 0,
    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,
    operateur_id INTEGER,
    FOREIGN KEY(client_id) REFERENCES clients(id),
    FOREIGN KEY(type_operation_id) REFERENCES types_operation(id),
    FOREIGN KEY(client_destinataire) REFERENCES clients(id),
    FOREIGN KEY(operateur_id) REFERENCES operateur(id)
);


CREATE TABLE epargne (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER,
    montant REAL NOT NULL DEFAULT 0,
    FOREIGN KEY (client_id) REFERENCES clients(id)
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
    ('Test2', '0341111111', 1234);

INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Orange', '0322222222', 1234);

INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Orange1', '0321111111', 1234);

INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Orange2', '0323333333', 1234);

INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Airtel', '0333333333', 1234);

INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Airtel1', '0331111111', 1234);

INSERT INTO clients (nom, telephone, code_secret)
VALUES
    ('Airtel2', '0332222222', 1234);

INSERT INTO types_operation (nom)
VALUES
    ('depot'),
    ('retrait'),
    ('transfert');

INSERT INTO operateur (nom, commission)
VALUES
    ('yas', 0),
    ('orange', 10),
    ('airtel', 15);

INSERT INTO prefixes (prefixe, operateur_id)
VALUES
    ('034', 1),
    ('038', 1),
    ('033', 3),
    ('037', 2),
    ('032', 2);

INSERT INTO baremes (type_operation_id, montant_min, montant_max, frais, operateur_id)
VALUES
-- ==========================
-- TRANSFERT MVOLA
-- ==========================
(3,       100,      1000,      70, 1),
(3,      1001,      5000,      70, 1),
(3,      5001,     10000,     150, 1),
(3,     10001,     25000,     250, 1),
(3,     25001,     50000,     500, 1),
(3,     50001,    100000,    1000, 1),
(3,    100001,    250000,    1900, 1),
(3,    250001,    500000,    1900, 1),
(3,    500001,   1000000,    3200, 1),
(3,   1000001,   2000000,    3800, 1),
(3,   2000001,   3000000,    5000, 1),
(3,   3000001,   4000000,    6300, 1),
(3,   4000001,   5000000,    7500, 1),
(3,   5000001,   6000000,    9400, 1),
(3,   6000001,   7000000,   10700, 1),
(3,   7000001,   8000000,   12500, 1),
(3,   8000001,   9000000,   14400, 1),
(3,   9000001,  10000000,   15700, 1),
(3,  10000001,  15000000,   23500, 1),
(3,  15000001,  20000000,   31400, 1);

INSERT INTO baremes (type_operation_id, montant_min, montant_max, frais, operateur_id)
VALUES
-- ==========================
-- RETRAIT MVOLA
-- ==========================
(2,       100,      1000,     100, 1),
(2,      1001,      5000,     150, 1),
(2,      5001,     10000,     275, 1),
(2,     10001,     20000,     550, 1),
(2,     20001,     25000,     650, 1),
(2,     25001,     50000,    1300, 1),
(2,     50001,    100000,    1900, 1),
(2,    100001,    250000,    3400, 1),
(2,    250001,    500000,    4700, 1),
(2,    500001,   1000000,    8800, 1),
(2,   1000001,   2000000,   14700, 1),
(2,   2000001,   3000000,   19600, 1),
(2,   3000001,   4000000,   24500, 1),
(2,   4000001,   5000000,   29400, 1),
(2,   5000001,   6000000,   34300, 1),
(2,   6000001,   7000000,   39200, 1),
(2,   7000001,   8000000,   44100, 1),
(2,   8000001,   9000000,   49000, 1),
(2,   9000001,  10000000,   53900, 1),
(2,  10000001,  15000000,   78400, 1),
(2,  15000001,  20000000,  102900, 1);

INSERT INTO baremes (type_operation_id, montant_min, montant_max, frais, operateur_id)
VALUES
-- ==========================
-- DEPOT MVOLA
-- Le dépôt est gratuit pour le client.
-- ==========================
(1,       100,  20000000, 0, 1);
