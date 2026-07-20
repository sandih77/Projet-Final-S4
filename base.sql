sqlite3 writable/db/mobilemoney.db

CREATE TABLE prefixes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe TEXT UNIQUE NOT NULL
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
    code_secret TEXT,
    solde REAL,
);

CREATE TABLE operations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER,
    type_operation_id INTEGER,
    destinataire TEXT,
    montant REAL,
    frais REAL,
    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(client_id) REFERENCES clients(id),
    FOREIGN KEY(type_operation_id) REFERENCES types_operation(id)
);
