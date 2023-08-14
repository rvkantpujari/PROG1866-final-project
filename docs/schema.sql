-- Create DATABASE
CREATE DATABASE IF NOT EXISTS readwise;


-- Create users table - It stores users' personal as well as login data
CREATE TABLE IF NOT EXISTS readwise.users (
    user_email VARCHAR(100) PRIMARY KEY,
	user_fname VARCHAR(50) NOT NULL,
    user_lname VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    password VARCHAR(100) NOT NULL
);


-- Create authors table - It stores authors' personal data
CREATE TABLE IF NOT EXISTS readwise.authors (
	author_email VARCHAR(100) PRIMARY KEY,
	author_fname VARCHAR(50) NOT NULL,
    author_lname VARCHAR(50) NOT NULL
);


-- Create publishers table - It stores publishers' personal data
CREATE TABLE IF NOT EXISTS readwise.publishers (
	publisher_email VARCHAR(100) PRIMARY KEY,
	publisher_name VARCHAR(200) NOT NULL
);


-- Create books table - It stores Books' data such as ISBN, Title, Description, Edition etc.
CREATE TABLE IF NOT EXISTS readwise.books (
	book_isbn INT(13) PRIMARY KEY,
    book_title VARCHAR(100) NOT NULL,
    book_desc TEXT,
    book_edition VARCHAR(50),
    book_published_year YEAR(4),
    book_author VARCHAR(100) NOT NULL,
    book_publisher VARCHAR(100) NOT NULL,
    FOREIGN KEY (book_author) REFERENCES readwise.authors (author_email) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (book_publisher) REFERENCES readwise.publishers (publisher_email) ON UPDATE CASCADE ON DELETE RESTRICT
);


-- Create read table - It stores when a user started reading book from given list of books
CREATE TABLE IF NOT EXISTS readwise.read(
	book_isbn INT(13) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    read_on DATE NOT NULL DEFAULT NOW(),
    FOREIGN KEY (book_isbn) REFERENCES readwise.books (book_isbn) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (user_email) REFERENCES readwise.users (user_email) ON UPDATE CASCADE ON DELETE RESTRICT
);