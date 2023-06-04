CREATE TABLE assertion (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    result enum('passed', 'failed'),
    CONSTRAINT UQ_assertion_name UNIQUE KEY (name)
) ENGINE=InnoDB;

INSERT INTO assertion (id, name, result) VALUES
(1, 'assertArrayHasKey', 'passed'),
(2, 'assertArrayKey', 'failed');
