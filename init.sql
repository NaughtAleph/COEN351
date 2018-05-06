CREATE DATABASE IF NOT EXISTS coen351;
USE coen351;

DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Books;
DROP TABLE IF EXISTS Accounts;

CREATE TABLE Books (
	id INT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	author VARCHAR(255) NOT NULL,
	price DECIMAL(6,2) NOT NULL,
	fiction BOOLEAN,
	nonfiction BOOLEAN,
	adventure BOOLEAN,
	mystery BOOLEAN,
	history BOOLEAN,
	biography BOOLEAN,
	fantasy BOOLEAN
);

INSERT INTO
	Books(title,author,price,fiction,nonfiction,adventure,mystery,history,biography,fantasy)
	VALUES('Gulliver\'s Travels','Jonathan Swift',12.95,true,false,true,false,false,false,true);

INSERT INTO
	Books(title,author,price,fiction,nonfiction,adventure,mystery,history,biography,fantasy)
	VALUES('Treasure Island','Robert Louis Stevenson',5.50,true,false,true,false,false,false,false);

INSERT INTO
	Books(title,author,price,fiction,nonfiction,adventure,mystery,history,biography,fantasy)
	VALUES('Gone Girl','Gillian Flynn',3.38,true,false,false,true,false,false,false);

INSERT INTO
	Books(title,author,price,fiction,nonfiction,adventure,mystery,history,biography,fantasy)
	VALUES('In Cold Blood','Truman Capote',6.20,false,true,false,true,false,false,false);

INSERT INTO
	Books(title,author,price,fiction,nonfiction,adventure,mystery,history,biography,fantasy)
	VALUES('Night','Elie Wiesel',4.00,false,true,false,false,true,true,false);

INSERT INTO
	Books(title,author,price,fiction,nonfiction,adventure,mystery,history,biography,fantasy)
	VALUES('The Hobbit','J.R.R. Tolkien',20.00,true,false,true,false,false,false,true);

INSERT INTO
	Books(title,author,price,fiction,nonfiction,adventure,mystery,history,biography,fantasy)
	VALUES('A Game Of Thrones (Complete Set)','George R.R. Martin',80.95,true,false,true,false,false,false,true);

CREATE TABLE Accounts (
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	firstname VARCHAR(255) NOT NULL,
	lastname VARCHAR(255) NOT NULL,
	contact VARCHAR(255),
	email VARCHAR(255),
	password VARCHAR(255) NOT NULL
);

INSERT INTO Accounts (username,firstname,lastname,contact,email,password)
			VALUES ('admin','admin','admin','1111111111','admin@admin.admin','$2y$10$fyQPTz5KKcpceOqltS9gmuAL8IltzLljNwPM5Z96N.2h4twpwYQ16');

INSERT INTO Accounts (username,firstname,lastname,contact,email,password)
			VALUES ('test','test','test','1234567890','test@test.test','$2y$10$oqUgiWIyGP86c6YJ6fj8juj7Gk2.VCE7UVylfPpMPJgbVnHrFy6kK');

INSERT INTO Accounts (username,firstname,lastname,contact,email,password)
			VALUES ('user1','user','name','1231231234','user@name.com','$2y$10$uHyv3YoPqSZ8UhxiYRPsRuHFfRYb9OaHBUQi0s8LYbDicT2ti3ejG');

CREATE TABLE Reviews(
	id INT PRIMARY KEY AUTO_INCREMENT,
	bookid INT,
	review TEXT,
	accountid INT,
	time INT UNSIGNED,
	FOREIGN KEY (bookid) REFERENCES Books(id),
	FOREIGN KEY (accountid) REFERENCES Accounts(id)
);

INSERT INTO Reviews (bookid,review,accountid,time)
			VALUES (1,'This is the first review',2,1525623099);

INSERT INTO Reviews (bookid,review,accountid,time)
			VALUES (3,'Good read',2,1525623285);

INSERT INTO Reviews (bookid,review,accountid,time)
			VALUES (7,'No spoilers please',2,1525623285);
