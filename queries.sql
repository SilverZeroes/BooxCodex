


-- CREATE TABLE IF NOT EXISTS books(id INT PRIMARY KEY AUTO_INCREMENT, cover VARCHAR(20), title VARCHAR(20), author VARCHAR(20), year VARCHAR(4));

CREATE TABLE IF NOT EXISTS genres(id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(20) UNIQUE);

CREATE TABLE IF NOT EXISTS book_genres (book_id INT, genre_id INT, PRIMARY KEY(book_id, genre_id), FOREIGN KEY (book_id) REFERENCES books(id), FOREIGN KEY (genre_id) REFERENCES genres(id));

-- ALTER TABLE books MODIFY title VARCHAR(40);

/*
INSERT INTO books (cover, title, author, year) VALUES
('book0.jpg', "The Brothers Karamazov", "Fyodor Dostoevsky", "1880"),
('book1.jpg', "Notes from Underground", "Fyodor Dostoevsky", "1864"),
('book2.jpg', "Crime and Punishment", "Fyodor Dostoevsky", "1866"),
('book3.jpg', "The Stranger", "Albert Camus", "1942"),
('book4.jpg', "The Trial", "Franz Kafka", "1925"),
('book5.jpg', "The Road", "Cormac McCarthy", "2006"),
('book6.jpg', "The Lord of the Rings", "J.R.R Tolkien", "1955"),
('book7.jpg', "The Hobbit", "J.R.R Tolkien", "1937"),
('book8.jpg', "Meditation", "Marcus Aureilius", "----"),
('book9.jpg', "The Book of the New Sun", "Gene Wolfe", "1983"),
('book10.jpg', "Les Miserables", "Victor Hugo", "1862"),
('book11.jpg', "1984", "George Orwell", "1949"),
('book12.jpg', "Lord of the Flies", "William Golding", "1954"),
('book13.jpg', "The Grapes of Wrath", "John Steinbeck", "1939"),
('book14.jpg', "Twenty Thousand Leagues Under the Sea", "J.R.R Tolkien", "1937"),
('book15.jpg', "Our Mutual Friend", "Charles Dickens", "1865");
*/

-- ALTER TABLE books ADD description TEXT;

-- SELECT * FROM books;

/*
INSERT INTO genres (name) VALUES
('Novel'),
('Philosophical Fiction'),
('Theological'),
('Fiction'),
('Crime'),
('Psychological'),
('Absurdist'),
('Horror'),
('Western'),
('Post-Apocalyptic'),
('Tragedy'),
('Adventure'),
('Fantasy'),
('Epic'),
('Children\'s Literature'),
('Philosophy'),
('Historical'),
('Science Fiction'),
('Dystopian'),
('Historical Fiction'),
('Political Fiction'),
('Social Science Fiction'),
('Allegorical Fiction');


	Genres:
    	1 - Novel
        2 - Philosophical
        3 - Theological
        4 - Fiction
        5 - Crime
        6 - Psychological
        7 - Absurdist
        8 - Horror
        9 - Western
        10 - Post-Apocalyptic
        11 - Tragedy
        12 - Adventure
        13 - Fantasy
        14 - Epic
        15 - Children's Literature
        16 - Philosophy
        17 - Historical
        18 - Science Fiction
        19 - Dystopian
        20 - Historical Fiction
        21 - Political Fiction
        22 - Social Science Fiction
        23 - Allegorical Fiction
*/
-- UPDATE genres set name = "Philosophical" WHERE id=2;

-- INSERT INTO genres (book_id, genre_id) VALUES
-- (1, 1),
-- (1, 2),
-- (1, 3),
-- (1, 4),
-- (2, 1),
-- (2, 2),
-- (2, 3),
-- (3, 1),
-- (3, 2),
-- (3, 5),
-- (3, 


