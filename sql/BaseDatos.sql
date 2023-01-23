CREATE TABLE `bd_usuarios`.`usuarios` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `nombre` VARCHAR(64) NOT NULL , 
    `contrasena` VARCHAR(32) NOT NULL , 
    `email` VARCHAR(64) NOT NULL , 
    `created` DATETIME NOT NULL , 
    `updated` DATETIME NOT NULL , 
    `lastlogin` DATETIME NOT NULL , 
    PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;


CREATE TABLE `bd_usuarios`.`roles` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `nombre` VARCHAR(50) NOT NULL ,
    PRIMARY KEY (`id`)
    ) ENGINE = InnoDB; 

ALTER TABLE `usuarios` ADD `type` INT NOT NULL DEFAULT '2' AFTER `lastlogin`; 