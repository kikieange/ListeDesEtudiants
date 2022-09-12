
create table etudiants(
    idetudiants INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(30) NOT NULL,
    Prenom VARCHAR(30) NOT NULL,
    Adresse VARCHAR(70) NOT NUll,
    Ville VARCHAR(30) NOT NULL,
    Codepostal INT UNSIGNED NOT NULL,
    Pays VARCHAR(30) NOT NULL,
    Mail VARCHAR(50) NOT NULL,
    DateInscription TIMESTAMP,
    UNIQUE (Mail)
    );