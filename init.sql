CREATE TABLE `user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `nickname` VARCHAR(50) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `date` DATE NOT NULL,
    `type_user` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image LONGBLOB
);

INSERT INTO `user` (`name`, `nickname`, `email`, `password`, `date`, `type_user`)
VALUES ('admin', 'adm', 'adm@oxenerd.com', '$2y$10$BN2ZcQEotyIa93399D6zNOw7dtmUKxpnD2oTFuSMuJX.hoSaPUPb2', NOW(), 'adm');



