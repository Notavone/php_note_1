CREATE TABLE IF NOT EXISTS theme
(
    id    INT AUTO_INCREMENT,
    label VARCHAR(45),
    PRIMARY KEY PK_THEME (id)
);

CREATE TABLE IF NOT EXISTS inscription
(
    id    INT AUTO_INCREMENT,
    email VARCHAR(1024),
    PRIMARY KEY PK_INSCRIPTION (id)
);

CREATE TABLE IF NOT EXISTS admin
(
    username VARCHAR(128) UNIQUE,
    password VARCHAR(128),
    PRIMARY KEY PK_ADMIN (username)
);

CREATE TABLE IF NOT EXISTS theme_inscription
(
    theme_id       INT,
    inscription_id INT,
    PRIMARY KEY PK_THEME_INSCRIPTION (theme_id, inscription_id),
    FOREIGN KEY FK_THEME_INSCRIPTION_THEME (theme_id) REFERENCES theme (id),
    FOREIGN KEY FK_THEME_INSCRIPTION_INSCRIPTION (inscription_id) REFERENCES inscription (id)
);