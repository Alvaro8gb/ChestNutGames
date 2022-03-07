CREATE USER 'chesnut'@'%' IDENTIFIED BY 'chesnut';
GRANT ALL PRIVILEGES ON `chesnutgames`.* TO 'chesnut'@'%';

CREATE USER 'chesnut'@'localhost' IDENTIFIED BY 'chesnut';
GRANT ALL PRIVILEGES ON `chesnutgames`.* TO 'chesnut'@'localhost';