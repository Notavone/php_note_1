INSERT INTO admin (username, password)
VALUES ('leoh', '11102002');

INSERT INTO inscription (id, email)
VALUES (1, 'leo.hugonnot@gmail.com'),
       (2, 'leo.hugonnot@edu.univ-fcomte.fr'),
       (3, 'leo.hugonnot@kalico-informatique.fr');

INSERT INTO theme (id, label)
VALUES (1, 'Informatique'),
       (2, 'Mathématique'),
       (3, 'Écologie'),
       (4, 'Films');

INSERT INTO theme_inscription (inscription_id, theme_id)
VALUES (1, 1),
       (1, 2),
       (2, 1),
       (2, 3),
       (2, 4);