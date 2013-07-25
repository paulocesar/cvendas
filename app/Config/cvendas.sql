SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `cvendas` ;
CREATE SCHEMA IF NOT EXISTS `cvendas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `cvendas` ;

-- -----------------------------------------------------
-- Table `cvendas`.`years`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvendas`.`years` ;

CREATE  TABLE IF NOT EXISTS `cvendas`.`years` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `year` INT NOT NULL ,
  `observation` TEXT NULL ,
  `lock` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cvendas`.`providers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvendas`.`providers` ;

CREATE  TABLE IF NOT EXISTS `cvendas`.`providers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cvendas`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvendas`.`products` ;

CREATE  TABLE IF NOT EXISTS `cvendas`.`products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `code` VARCHAR(45) NULL ,
  `provider_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_products_providers1_idx` (`provider_id` ASC) ,
  CONSTRAINT `fk_products_providers1`
    FOREIGN KEY (`provider_id` )
    REFERENCES `cvendas`.`providers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cvendas`.`months`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvendas`.`months` ;

CREATE  TABLE IF NOT EXISTS `cvendas`.`months` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cvendas`.`sells`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvendas`.`sells` ;

CREATE  TABLE IF NOT EXISTS `cvendas`.`sells` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `year_id` INT UNSIGNED NOT NULL ,
  `month_id` INT UNSIGNED NOT NULL ,
  `product_id` INT UNSIGNED NOT NULL ,
  `quantity` INT NOT NULL DEFAULT 0 ,
  `observation` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sells_years_idx` (`year_id` ASC) ,
  INDEX `fk_sells_months1_idx` (`month_id` ASC) ,
  INDEX `fk_sells_products1_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_sells_years`
    FOREIGN KEY (`year_id` )
    REFERENCES `cvendas`.`years` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sells_months1`
    FOREIGN KEY (`month_id` )
    REFERENCES `cvendas`.`months` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sells_products1`
    FOREIGN KEY (`product_id` )
    REFERENCES `cvendas`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `cvendas`.`providers`
-- -----------------------------------------------------
START TRANSACTION;
USE `cvendas`;
INSERT INTO `cvendas`.`providers` (`id`, `name`) VALUES (1, 'Mecesa');
INSERT INTO `cvendas`.`providers` (`id`, `name`) VALUES (2, 'Novalata');

COMMIT;

-- -----------------------------------------------------
-- Data for table `cvendas`.`products`
-- -----------------------------------------------------
START TRANSACTION;
USE `cvendas`;
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (1, 'ECONOMICA LT', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (2, 'VINIL LT', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (3, 'LATEX LT', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (4, 'TEXTURA 16L LT', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (5, 'LIQUI-BRILHO GL (Balde)', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (6, 'ECONOMICO GL', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (7, 'VINIL GL', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (8, 'LATEX GL', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (9, 'MASSA ACRIL GL (Balde)', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (10, 'MASSA PVA GL (Balde)', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (11, 'ESMALTE GL', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (12, 'ESMALTE 900 ml (1/4)', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (13, 'ESMALTE 112,5 ml (1/32)', NULL, 1);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (14, 'NOVALATEX LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (15, 'TEXTURA 20 kg LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (16, 'PISO LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (17, 'SELADOR LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (18, 'NOBRE LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (19, 'PLUS LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (20, 'MASSA ACRIL LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (21, 'MASSA PVA LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (22, 'SEMI-BRILHO LT', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (23, 'PISO GL ', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (24, 'SELADOR GL', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (25, 'NOBRE GL', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (26, 'PLUS GL', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (27, 'SEMI-BRILHO GL', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (28, 'AGUARRAS 450 ml', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (29, 'AGUARRAS 900 ml', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (30, 'MASSA/TINTA CPL 900 ml', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (31, 'VERNIZ GL', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (32, 'VERNIZ 225 ml (1/16)', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (33, 'VERNIZ 900 ml (1/4)', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (34, 'ZARCAO GL', NULL, 2);
INSERT INTO `cvendas`.`products` (`id`, `name`, `code`, `provider_id`) VALUES (35, 'ZARCAO 900 ml (1/4)', NULL, 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `cvendas`.`months`
-- -----------------------------------------------------
START TRANSACTION;
USE `cvendas`;
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (1, 'JAN');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (2, 'FEV');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (3, 'MAR');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (4, 'ABR');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (5, 'MAI');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (6, 'JUN');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (7, 'JUL');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (8, 'AGO');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (9, 'SET');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (10, 'OUT');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (11, 'NOV');
INSERT INTO `cvendas`.`months` (`id`, `name`) VALUES (12, 'DEZ');

COMMIT;
