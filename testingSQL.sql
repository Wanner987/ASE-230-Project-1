-- database name is testingdb

-- create tables
CREATE TABLE artist (
    Name VARCHAR(32),
    Artist_ID int PRIMARY KEY
);

CREATE TABLE songs (
    Song_ID INT PRIMARY KEY,
    Artist_ID INT REFERENCES artist(Artist_ID),
    Name VARCHAR(32),
    Length_in_sec INT
);

CREATE TABLE users (
    User_ID INT PRIMARY KEY,
    Username VARCHAR(32),
    Password VARCHAR(32)
);

CREATE TABLE playlist (
    Playlist_ID INT PRIMARY KEY,
    User_ID INT REFERENCES users(User_ID)
);

CREATE TABLE playlist_songs (
    Playlist_ID INT REFERENCES playlist(Playlist_ID),
    Song_ID INT REFERENCES songs(Song_ID),
    PRIMARY KEY (Playlist_ID, Song_ID)
);

-- Fill tables
INSERT INTO artist (Name, Artist_ID) VALUES
('The Echoes', 1),
('Silent Waves', 2);

INSERT INTO songs (Song_ID, Artist_ID, Name, Length_in_sec) VALUES
(101, 1, 'Echo Chamber', 215),
(102, 2, 'Wave Rider', 198);

INSERT INTO users (User_ID, Username, Password) VALUES
(1001, 'music_lover', 'pass1234'),
(1002, 'beat_fan', 'beat2025');

INSERT INTO playlist (Playlist_ID, User_ID) VALUES
(501, 1001),
(502, 1002);

INSERT INTO playlist_songs (Playlist_ID, Song_ID) VALUES
(501, 101),
(501, 102),
(502, 102);
