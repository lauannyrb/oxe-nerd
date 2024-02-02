CREATE TABLE `user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `nickname` VARCHAR(50) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `date` DATETIME NOT NULL,
    `type_user` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    old_price DECIMAL(10, 2),
    image_path VARCHAR(255),
    category VARCHAR(50) NOT NULL
);

CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_name VARCHAR(255),
    price DECIMAL(10,2),
    quantity INT
);

-- Inserir produtos na tabela products
INSERT INTO products (name, category, price, old_price, image_path)
VALUES ('Conjunto camisa namorados GAMER', 'Promoção', 45.50, 65.50, '../images/img-promo/camisa.png'),
       ('Camiseta Homem Aranha Venoms', 'Promoção', 36.99, 45.00, '../images/img-promo/camisa_homem_aranha.png'),
       ('Placa de Vídeo PNY GeForce RTX 4090 XLR8', 'Promoção', 5000.39, 7000.39, '../images/img-promo/placa_video.png'),
       ('Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico', 'Promoção', 288.81, 453.02, '../images/img-promo/gabinete.png'),
       ('Star Guardian Orianna Cosplay Traje League of Legends', 'Promoção', 215.50, 320.45, '../images/img-promo/vestido.png'),
       ('Capinha para celular GAME ZONE Merilin Cases', 'Promoção', 21.90, 39.90, '../images/img-promo/capa2.png'),
       ('Caneca de GAMER personalizada imperdível', 'Promoção', 15.19, 25.99, '../images/img-promo/Caneca.png'),
       ('Caneca PLAY GAME controle personalizada', 'Promoção', 21.99, 33.75, '../images/img-promo/Caneca-play-game.png');


INSERT INTO products (name, price, old_price, image_path, category)
VALUES ('RAM RGB, 8GB x 2, 16GB, 32GB, 3200MHz, Memória DDR4 DIMM', 130.99, 210.99, '../images/img_eletro/RAM.png', 'Eletrônicos'),
       ('Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico', 279.99, 453.99, '../images/img_eletro/gabinete.png', 'Eletrônicos'),
       ('Gabinete Gamer Lion Rosa USB 3.0 c/ 1 Cooler ARGBMCA-LION/PK', 279.99, 453.99, '../images/img_eletro/rosa.png', 'Eletrônicos'),
       ('Gabinete Gamer RGB Neologic Branco - NL-C301W Unica', 279.99, 453.99, '../images/img_eletro/branco.png', 'Eletrônicos'),
       ('Monitor Extream 21,5", Full HD, Led, 75hz, HDMI/VGA, VESA, Flicker Free', 499.99, 999.99, '../images/img_eletro/monitor.png', 'Eletrônicos'),
       ('Monitor Led 19,5" 1080p Hdmi Vga Widescreen 16:9 19.5 polegadas Fox', 399.99, 999.99, '../images/img_eletro/monitor1.png', 'Eletrônicos'),
       ('Monitor Gamer 20" Full HD LED 75Hz HDMI HQ Moba 20GHQ75 Preto e vermelho', 499.99, 999.99, '../images/img_eletro/monitor2.png', 'Eletrônicos'),
       ('GPU NV RTX3060 12GB 1-CLICK OC GDDR6 192BITS Galax 36NOL7MD1VOC', 2279.99, 3199.99, '../images/img_eletro/rtx.png', 'Eletrônicos'),
       ('Processador AMD RYZEN Cooler Wraith Stealth RYZEN 5 5500 3.6GHz', 549.99, 1399.99, '../images/img_eletro/cpuryzen.png', 'Eletrônicos'),
       ('Combo Kit Teclado Mouse Gamer E Fone Headset Rosa Rgb Pink', 450.90, 630.00, '../images/img_eletro/teclado.png', 'Eletrônicos'),
       ('Kit teclado e mouse GAMER exbom USB LED colorido semi mecânino', 199.99, 449.99, '../images/img_eletro/teclado1.png', 'Eletrônicos'),
       ('SSD 240 GB Kingston A400, SATA, 500MB/s , 350MB/s - SA400S37/240G', 129.99, 349.99, '../images/img_eletro/SSD.png', 'Eletrônicos');


-- Inserir produtos de Personalizados
INSERT INTO products (name, price, old_price, image_path, category) 
VALUES 
('Caneca GAMER personalizada', 15.99, 25.99, '../images/img_perso/Caneca.png', 'Personalizados'),
('Caneca PLAY GAME controle personalizada', 21.99, 34.99, '../images/img_perso/Caneca-play-game.png', 'Personalizados'),
('Caneca de GTA San Andreas personalizada', 32.99, 47.99, '../images/img_perso/CanecaGTA.png', 'Personalizados'),
('Caneca Estou Offline Chrome Dinossauro Café personalizada', 32.99, 47.99, '../images/img_perso/CanecaChrome.png', 'Personalizados'),
('Camiseta GAMER Super Mario World', 39.99, NULL, '../images/img_perso/MarioWorld.png', 'Personalizados'),
('Camiseta Homem Aranha Venom', 36.99, 44.99, '../images/img_perso/LogoAranha.png', 'Personalizados'),
('Camiseta feminina T-shirt Nasa Nerd', 54.99, NULL, '../images/img_perso/NASA.png', 'Personalizados'),
('Camiseta feminina Naruto Sasuke Chibi', 44.99, 55.99, '../images/img_perso/SASUKEE.png', 'Personalizados'),
('Capinha para celular Groot', 30.00, 35.00, '../images/img_capas/capa1.png', 'Personalizados'),
('Capinha para celular GAME ZONE', 21.90, 39.90, '../images/img_capas/capa2.png', 'Personalizados'),
('Capa para celular Gameboy', 99.99, 107.99, '../images/img_capas/capa3.png', 'Personalizados'),
('Capa para celular do Pikachu', 39.90, 53.99, '../images/img_capas/capa4.png', 'Personalizados');

INSERT INTO `user` (`name`, `nickname`, `email`, `password`, `date`, `type_user`)
VALUES ('admin', 'adm', 'adm@oxenerd.com', '$2y$10$BN2ZcQEotyIa93399D6zNOw7dtmUKxpnD2oTFuSMuJX.hoSaPUPb2', NOW(), 'adm');
