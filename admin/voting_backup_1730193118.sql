

CREATE TABLE `candidate` (
  `candidate_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `year_level` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO candidate VALUES("1","President","Harry","Den","4th Year","Male","upload/male3.jpg");
INSERT INTO candidate VALUES("2","Secretary","James","Corden","3rd Year","Male","upload/male3.jpg");


CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO user VALUES("1","admin","admin","Harry","Den");


CREATE TABLE `voters` (
  `voters_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `year_level` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `account` varchar(100) NOT NULL,
  PRIMARY KEY (`voters_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO voters VALUES("1","21241523","8CCADFqy","Christine","Grey","3rd Year","Unvoted","Active");
INSERT INTO voters VALUES("2","6666","vTSNuAQt","Harry","Den","4th Year","Voted","Active");
INSERT INTO voters VALUES("3","220022","7wVWbNOA","Nikki","Panto","1st Year","Unvoted","");


CREATE TABLE `votes` (
  `vote_id` int(255) NOT NULL AUTO_INCREMENT,
  `candidate_id` varchar(255) NOT NULL,
  `voters_id` varchar(255) NOT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO votes VALUES("1","1","2");
INSERT INTO votes VALUES("2","","2");
INSERT INTO votes VALUES("3","","2");
INSERT INTO votes VALUES("4","2","2");
INSERT INTO votes VALUES("5","","2");
INSERT INTO votes VALUES("6","","2");
INSERT INTO votes VALUES("7","","2");
INSERT INTO votes VALUES("8","","2");
INSERT INTO votes VALUES("9","","2");
INSERT INTO votes VALUES("10","","2");
INSERT INTO votes VALUES("11","","2");

