CREATE TABLE CUSTOMERS (
id INT(10) AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
address VARCHAR(50),
city VARCHAR(50),
state VARCHAR(40)

);

INSERT INTO CUSTOMERS VALUES (null,'Oscar ', 'Martinez',
 'Felipe 530 A', 'Ags', 'MA');
 
 select * from CUSTOMERS;