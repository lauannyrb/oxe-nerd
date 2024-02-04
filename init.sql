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
    category VARCHAR(50) NOT NULL,
    quantidade INT
);

-- Inserir produtos na tabela products
INSERT INTO products (name, category, price, old_price, image_path, quantidade)
VALUES 
    ('Conjunto camisa namorados GAMER', 'Promoção', 45.50, 65.50, '../images/img-promo/camisa.png', 50),
    ('Camiseta Homem Aranha Venoms', 'Promoção', 36.99, 45.00, '../images/img-promo/camisa_homem_aranha.png', 30),
    ('Placa de Vídeo PNY GeForce RTX 4090 XLR8', 'Promoção', 5000.39, 7000.39, '../images/img-promo/placa_video.png', 10),
    ('Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico', 'Promoção', 288.81, 453.02, '../images/img-promo/gabinete.png', 20),
    ('Star Guardian Orianna Cosplay Traje League of Legends', 'Promoção', 215.50, 320.45, '../images/img-promo/vestido.png', 15),
    ('Capinha para celular GAME ZONE Merilin Cases', 'Promoção', 21.90, 39.90, '../images/img-promo/capa2.png', 40),
    ('Caneca de GAMER personalizada imperdível', 'Promoção', 15.19, 25.99, '../images/img-promo/Caneca.png', 100),
    ('Caneca PLAY GAME controle personalizada', 'Promoção', 21.99, 33.75, '../images/img-promo/Caneca-play-game.png', 80);

INSERT INTO products (name, price, old_price, image_path, category, quantidade)
VALUES 
    ('RAM RGB, 8GB x 2, 16GB, 32GB, 3200MHz, Memória DDR4 DIMM', 130.99, 210.99, '../images/img_eletro/RAM.png', 'Eletrônicos', 25),
    ('Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico', 279.99, 453.99, '../images/img_eletro/gabinete.png', 'Eletrônicos', 12),
    ('Gabinete Gamer Lion Rosa USB 3.0 c/ 1 Cooler ARGBMCA-LION/PK', 279.99, 453.99, '../images/img_eletro/rosa.png', 'Eletrônicos', 8),
    ('Gabinete Gamer RGB Neologic Branco - NL-C301W Unica', 279.99, 453.99, '../images/img_eletro/branco.png', 'Eletrônicos', 15),
    ('Monitor Extream 21,5", Full HD, Led, 75hz, HDMI/VGA, VESA, Flicker Free', 499.99, 999.99, '../images/img_eletro/monitor.png', 'Eletrônicos', 5),
    ('Monitor Led 19,5" 1080p Hdmi Vga Widescreen 16:9 19.5 polegadas Fox', 399.99, 999.99, '../images/img_eletro/monitor1.png', 'Eletrônicos', 8),
    ('Monitor Gamer 20" Full HD LED 75Hz HDMI HQ Moba 20GHQ75 Preto e vermelho', 499.99, 999.99, '../images/img_eletro/monitor2.png', 'Eletrônicos', 3),
    ('GPU NV RTX3060 12GB 1-CLICK OC GDDR6 192BITS Galax 36NOL7MD1VOC', 2279.99, 3199.99, '../images/img_eletro/rtx.png', 'Eletrônicos', 7),
    ('Processador AMD RYZEN Cooler Wraith Stealth RYZEN 5 5500 3.6GHz', 549.99, 1399.99, '../images/img_eletro/cpuryzen.png', 'Eletrônicos', 10),
    ('Combo Kit Teclado Mouse Gamer E Fone Headset Rosa Rgb Pink', 450.90, 630.00, '../images/img_eletro/teclado.png', 'Eletrônicos', 20),
    ('Kit teclado e mouse GAMER exbom USB LED colorido semi mecânino', 199.99, 449.99, '../images/img_eletro/teclado1.png', 'Eletrônicos', 15),
    ('SSD 240 GB Kingston A400, SATA, 500MB/s , 350MB/s - SA400S37/240G', 129.99, 349.99, '../images/img_eletro/SSD.png', 'Eletrônicos', 30);

-- Inserir produtos de Personalizados
INSERT INTO products (name, price, old_price, image_path, category, quantidade) 
VALUES 
    ('Caneca GAMER personalizada', 15.99, 25.99, '../images/img_perso/Caneca.png', 'Personalizados', 50),
    ('Caneca PLAY GAME controle personalizada', 21.99, 34.99, '../images/img_perso/Caneca-play-game.png', 'Personalizados', 60),
    ('Caneca de GTA San Andreas personalizada', 32.99, 47.99, '../images/img_perso/CanecaGTA.png', 'Personalizados', 30),
    ('Caneca Estou Offline Chrome Dinossauro Café personalizada', 32.99, 47.99, '../images/img_perso/CanecaChrome.png', 'Personalizados', 25),
    ('Camiseta GAMER Super Mario World', 39.99, NULL, '../images/img_perso/MarioWorld.png', 'Personalizados', 20),
    ('Camiseta Homem Aranha Venom', 36.99, 44.99, '../images/img_perso/LogoAranha.png', 'Personalizados', 15),
    ('Camiseta feminina T-shirt Nasa Nerd', 54.99, NULL, '../images/img_perso/NASA.png', 'Personalizados', 10),
    ('Camiseta feminina Naruto Sasuke Chibi', 44.99, 55.99, '../images/img_perso/SASUKEE.png', 'Personalizados', 18),
    ('Capinha para celular Groot', 30.00, 35.00, '../images/img_capas/capa1.png', 'Personalizados', 25),
    ('Capinha para celular GAME ZONE', 21.90, 39.90, '../images/img_capas/capa2.png', 'Personalizados', 40),
    ('Capa para celular Gameboy', 99.99, 107.99, '../images/img_capas/capa3.png', 'Personalizados', 12),
    ('Capa para celular do Pikachu', 39.90, 53.99, '../images/img_capas/capa4.png', 'Personalizados', 30);

INSERT INTO `user` (`name`, `nickname`, `email`, `password`, `date`, `type_user`)
VALUES ('admin', 'adm', 'adm@oxenerd.com', 'adm', NOW(), 'adm');

INSERT INTO `user` (`name`, `nickname`, `email`, `password`, `date`, `type_user`)
VALUES
    ('Alice Johnson', 'alice_j', 'alice@example.com', '1234', NOW(), 'normal'),
    ('Bob Smith', 'bob_s', 'bob@example.com', '1234', NOW(), 'normal'),
    ('Charlie Brown', 'charlie_b', 'charlie@example.com', '1234', NOW(), 'normal'),
    ('David Miller', 'david_m', 'david@example.com', '1234', NOW(), 'normal'),
    ('Emily Davis', 'emily_d', 'emily@example.com', '1234', NOW(), 'normal'),
    ('Frank Robinson', 'frank_r', 'frank@example.com', '1234', NOW(), 'normal'),
    ('Grace White', 'grace_w', 'grace@example.com', '1234', NOW(), 'normal'),
    ('Henry Turner', 'henry_t', 'henry@example.com', '1234', NOW(), 'normal'),
    ('Isabel Lee', 'isabel_l', 'isabel@example.com', '1234', NOW(), 'normal'),
    ('Jack Evans', 'jack_e', 'jack@example.com', '1234', NOW(), 'normal'),
    ('Katherine Hall', 'katherine_h', 'katherine@example.com', '1234', NOW(), 'normal'),
    ('Liam Taylor', 'liam_t', 'liam@example.com', '1234', NOW(), 'normal'),
    ('Mia Clark', 'mia_c', 'mia@example.com', '1234', NOW(), 'normal'),
    ('Noah Adams', 'noah_a', 'noah@example.com', '1234', NOW(), 'normal'),
    ('Olivia Wright', 'olivia_w', 'olivia@example.com', '1234', NOW(), 'normal'),
    ('Patrick Harris', 'patrick_h', 'patrick@example.com', '1234', NOW(), 'normal'),
    ('Quinn Martinez', 'quinn_m', 'quinn@example.com', '1234', NOW(), 'normal'),
    ('Rachel King', 'rachel_k', 'rachel@example.com', '1234', NOW(), 'normal'),
    ('Samuel Turner', 'samuel_t', 'samuel@example.com', '1234', NOW(), 'normal'),
    ('Tara Roberts', 'tara_r', 'tara@example.com', '1234', NOW(), 'normal');
