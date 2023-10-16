CREATE TABLE users(
    id_user SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL
);

CREATE TABLE genre(
    id_genre SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    color VARCHAR(255) NOT NULL
);


CREATE TABLE artist(
    id_artist SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL
);

CREATE TABLE album(
    id_album SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    id_artist INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,

    CONSTRAINT fk_id_artist FOREIGN KEY (id_artist) REFERENCES artist(id_artist) ON DELETE CASCADE
);


CREATE TABLE music(
    id_music SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    id_genre INT NOT NULL,
    audio_url VARCHAR(255) NOT NULL,
    id_album INT NOT NULL,
    release_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_id_genre FOREIGN KEY (id_genre) REFERENCES genre(id_genre) ON DELETE CASCADE,
    CONSTRAINT fk_id_album FOREIGN KEY (id_album) REFERENCES album(id_album) ON DELETE CASCADE
);

CREATE TABLE likes(
    id_user INT NOT NULL,
    id_music INT NOT NULL,
    CONSTRAINT fk_id_user FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_id_music FOREIGN KEY (id_music) REFERENCES music(id_music) ON DELETE CASCADE
);




