CREATE USER 'chestnut'@'%' IDENTIFIED BY 'chestnut';
GRANT ALL PRIVILEGES ON `chestnutgames`.* TO 'chestnut'@'%';

CREATE USER 'chestnut'@'localhost' IDENTIFIED BY 'chestnut';
GRANT ALL PRIVILEGES ON `chestnutgames`.* TO 'chestnut'@'localhost';