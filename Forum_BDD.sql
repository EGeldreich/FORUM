CREATE TABLE CATEGORY(
   id_category INT,
   categoryName VARCHAR(100),
   PRIMARY KEY(id_category)
);

CREATE TABLE USER(
   id_user INT,
   pseudo VARCHAR(100),
   password VARCHAR(255),
   registrationDate DATE,
   mail VARCHAR(100),
   role VARCHAR(50),
   PRIMARY KEY(id_user)
);

CREATE TABLE TOPIC(
   id_topic INT,
   title VARCHAR(100),
   topicDate DATETIME,
   locked TINYINT,
   user_id INT NOT NULL,
   category_id INT NOT NULL,
   PRIMARY KEY(id_topic),
   FOREIGN KEY(user_id) REFERENCES FORUM_USER(id_user),
   FOREIGN KEY(category_id) REFERENCES TOPIC_CATEGORY(id_category)
);

CREATE TABLE POST(
   id_post INT,
   postDate DATETIME,
   content TEXT,
   topic_id INT NOT NULL, 
   user_id INT NOT NULL,
   PRIMARY KEY(id_post),
   FOREIGN KEY(topic_id) REFERENCES TOPIC(id_topic),
   FOREIGN KEY(user_id) REFERENCES FORUM_USER(id_user)
);
