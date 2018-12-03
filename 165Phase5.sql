SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `book_id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `summary` varchar(500) NOT NULL,
  `avg_rating` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for 'User'
--

CREATE TABLE `User` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `points` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for Club
--

CREATE TABLE `Club` (
  `club_id` int(5) NOT NULL AUTO_INCREMENT,
  `club_name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`club_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `HAS_READ`
--

CREATE TABLE `HAS_READ` (
  `userID` int(5) NOT NULL,
  `bookID` int(10) NOT NULL,
  `dateFINISHED` date NOT NULL,
  PRIMARY KEY (userID, bookID, dateFINISHED),

  FOREIGN KEY (userID) REFERENCES User(user_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE,

  FOREIGN KEY (bookID) REFERENCES Book(book_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `MEETING`
--

CREATE TABLE `MEETING` (
  `club_id` int(5) NOT NULL,
  `book_id` int(10) NOT NULL,
  `dateTOMEET` date NOT NULL,
  `timeToMEET` time NOT NULL,
  `location` varchar(50) NOT NULL,
  `mTitle` varchar(50) DEFAULT NULL,
  `mDescription` varchar(50) DEFAULT NULL,

  PRIMARY KEY(club_id, book_id, dateTOMEET),

  FOREIGN KEY (club_id) REFERENCES Club(club_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE,

  FOREIGN KEY (book_id) REFERENCES Book(book_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `MEMBER_OF`
--

CREATE TABLE `MEMBER_OF` (
  `club_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date_joined` date DEFAULT NULL,
  PRIMARY KEY (club_id, user_id),

  FOREIGN KEY (club_id) REFERENCES Club(club_id)
  ON UPDATE CASCADE 
  ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES User(user_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `user_id` int(5) NOT NULL,
  `book_id` int(5) NOT NULL,
  `title` varchar(50) DEFAULT 'Unkown',
  `body` varchar(500) DEFAULT '',
  `rating` decimal(3,1) DEFAULT '0.0',
  `time_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`user_id`,`book_id`),

	FOREIGN KEY (user_id) REFERENCES User(user_id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,

	FOREIGN KEY (book_id) REFERENCES Book(book_id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Book`(`title`, `genre`, `summary`, `avg_rating`) VALUES
('Kafka On The Shore', 'Magical Realism', 'Comprising two distinct but interrelated plots, 
	the narrative runs back and forth between both plots, taking up each plotline in alternating chapters.', 0),
('The Little Prince', 'Fantasy', 'he simple tale tells the story of a child, the little prince, who travels the universe gaining wisdom.', 0),
("Harry Potter and The Sorcerers Stone", 'Fantasy', 'The first novel in the Harry Potter series and Rowling\'s debut novel, it follows Harry Potter, 
	a young wizard who discovers his magical heritage on his eleventh birthday, when he receives a letter of acceptance to Hogwarts School of Witchcraft and Wizardry', 0),
('The Year Of Magical Thinking', 'Non Fiction', 'The book recounts Didion\'s experiences of grief after Dunne\'s 2003 death.', 0),
('Crazy Rich Asians', 'Romance-Comedy', 'Rachel Chu is happy to accompany her longtime boyfriend, Nick, to his best friend\'s wedding in Singapore.
 She\'s also surprised to learn that Nick\'s family is extremely wealthy and he\'s considered one of the country\'s most eligible bachelors. 
 Thrust into the spotlight, Rachel must now contend with jealous socialites, quirky relatives and something far, far worse -- Nick\'s disapproving mother.', 0),
('Frankenstein', 'Science Fiction', 'When the brilliant but unorthodox scientist Dr. Victor Frankenstein rejects the artificial man that he has created, the Creature escapes and later swears revenge.', 0),
('The Divine Comedy', 'Poem', 'Virgil guides Dante through Hell in Inferno, where sinners hopelessly endure contrapasso as 
	eternal punishment of their sins. Purgatorio depicts sinners who undergo punishment as a way to cleanse their souls.', 0),
('Charlie and the Chocolate Factory', 'Fantasy', 'The story features the adventures of young Charlie Bucket inside the chocolate factory of eccentric chocolatier Willy Wonka.', 0),
('Pride and Prejudice', 'Romance', 'Pride and Prejudice is a humorous story of love and life among English gentility during the Georgian era.', 0),
("To All the Boys Ive Loved Before", 'Romance', 'A teenage girl\'s love letters are exposed and wreak havoc on her life.', 0),
('The Shining', 'Horror', 'Jack Torrance becomes winter caretaker at the isolated Overlook Hotel in Colorado, hoping to cure his writer\'s block. He settles in along with his wife, 
	Wendy, and his son, Danny , who is plagued by psychic premonitions. As Jack\'s writing goes nowhere and Danny\'s 
	visions become more disturbing, Jack discovers the hotel\'s dark secrets and begins to unravel into a homicidal maniac hell-bent on terrorizing his family', 0),
("Dekada 70", 'Drama', 'Dekada \'70 is the story of a family caught in the middle of the tumultuous decade of the 1970s. It details how a middle-class 
	family struggled with and faced the changes that empowered Filipinos to rise against the Marcos government.', 0),
('GAPO', 'Drama', 'The conflict of living life as Filipino-American', 0),
('Lord of The Flies', 'Allegorical','The book focuses on a group of British boys stranded on an uninhabited island and their disastrous attempt to govern themselves.', 0),
('Lord of The Rings', 'High Fantasy', 'The future of civilization rests in the fate of the One Ring, which has been lost for centuries. Powerful forces are unrelenting in their search for it.
 But fate has placed it in the hands of a young Hobbit named Frodo Baggins, who inherits the Ring and steps into legend.', 0),
('To Kill A Mokingbird', 'Southern Gothic', 'Maycomb is suffering through the Great Depression, but Atticus is a prominent lawyer and the Finch family is reasonably well off in comparison to the rest of society. 
	One summer, Jem and Scout befriend a boy named Dill, who has come to live in their neighborhood for the summer, and the trio acts out stories together.', 0),
('The Call of Cthullu', 'Horror', 'French novelist Michel Houellebecq, in his book H. P. Lovecraft: Against the World, Against Life, describes "The Call of Cthulhu" as the first of Lovecraft\'s "great texts." 
	The "Cthulhu Mythos" a story-cycle takes its name from the titular creature of the story.', 0),
('The Woman Who Had Two Navels', 'Historical', 'It tells the story of a Filipino elite woman who is hallucinating, and is preoccupied with the notion that she has two navels or belly buttons in order to be treated as an extraordinary person.', 0),
('Cave And Shadows', 'Metaphysical Thriller', 'A whodunit thriller set in Martial Law Era Philippines', 0),
('The Immortal Life of Henrietta Lacks', 'Non Fiction', 'The book is about Henrietta Lacks and the immortal cell line, known as HeLa, that came from Lacks\'s cervical cancer cells in 1951.', 0);


INSERT INTO `User`(`name`, `email_address`, `password`, `nationality`, `points`) VALUES
('Cardo Dalisay', 'cardodalisay@gmail.com', '$2y$10$xI82LJ02J5Z79YwKNwNEiONQV8OWZqgnzW.yqg4WRxfFDlHTe/hwG', 'Filipino', 0),
('Anonymous User', 'test8@gmail.com', '$2y$10$0LazASvaKDUVee8ylnN2aOGsArPNkrrt6RFUhAXg5ckNFR4TSQV9O', 'Filipino', 0),
('Kyle Bonifacio', 'steffibonifacio@gmail.com', '$2y$10$arnI8NNX9AjiN1y.BabGluTHUb2.uCvj7ZKFW2aecWhkafbGgxmhC', 'Filipino', 0);


INSERT INTO `Club` (`club_name`, `description`, `date_created`) VALUES
('Happy Tree Friends', 'expect the unexpected', now()),
('Magical Bookworms', 'avada kedavra', now()),
('Happy Joyful Fun', 'only happy endings!', now());

INSERT INTO `MEMBER_OF` (`club_id`, `user_id`, `date_joined`) VALUES
(1, 1, now()),
(1, 3, now()),
(2, 3, now());

COMMIT;