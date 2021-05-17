CREATE TABLE IF NOT EXISTS role (
  id INTEGER NOT NULL,
  label VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS member (
  id INTEGER AUTO_INCREMENT,
  pseudo VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  creation_date DATETIME NOT NULL,
  role_id INTEGER NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  CONSTRAINT fk_member_role_id FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE IF NOT EXISTS article(
  id INTEGER AUTO_INCREMENT,
  creation_date DATETIME NOT NULL,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  summary TEXT NOT NULL,
  author_id INTEGER NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_article_author_id FOREIGN KEY (author_id) REFERENCES member(id)
);

CREATE TABLE IF NOT EXISTS comment (
  id INTEGER AUTO_INCREMENT,
  creation_date DATETIME NOT NULL,
  content TEXT NOT NULL,
  article_id INTEGER NOT NULL,
  author_id INTEGER NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_article_id FOREIGN KEY (article_id) REFERENCES article(id) ON DELETE CASCADE,
  CONSTRAINT fk_comment_author_id FOREIGN KEY (author_id) REFERENCES member(id)
);

INSERT INTO role VALUES
(0, 'member'),
(1, 'admin');