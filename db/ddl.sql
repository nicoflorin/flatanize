-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema flatanize
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema flatanize
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `flatanize` DEFAULT CHARACTER SET latin1 ;
USE `flatanize` ;

-- -----------------------------------------------------
-- Table `flatanize`.`flats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize`.`flats` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `code` CHAR(5) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flat_id` INT UNSIGNED NULL,
  `username` VARCHAR(50) NOT NULL,
  `display_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `salt` CHAR(64) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_flats`
    FOREIGN KEY (`flat_id`)
    REFERENCES `flatanize`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize`.`shopping_lists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize`.`shopping_lists` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flats_id` INT UNSIGNED NOT NULL,
  `product` VARCHAR(255) NOT NULL,
  `amount` INT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_shopping_lists_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize`.`finances`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize`.`finances` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flats_id` INT UNSIGNED NOT NULL,
  `product` VARCHAR(255) NOT NULL,
  `price` DECIMAL(9,2) NOT NULL,
  `date` DATE NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_finances_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize`.`frequencies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize`.`frequencies` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize`.`wdays`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize`.`wdays` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `day` ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize`.`cleanings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize`.`cleanings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flats_id` INT UNSIGNED NOT NULL,
  `frequency_id` INT UNSIGNED NOT NULL,
  `wdays_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `frequency` VARCHAR(255) NOT NULL,
  `weekday` CHAR(2) NOT NULL,
  `start` DATE NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cleanings_frequencies_idx` (`frequency_id` ASC),
  INDEX `fk_cleanings_wdays_idx` (`wdays_id` ASC),
  CONSTRAINT `fk_cleanings_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cleanings_frequencies`
    FOREIGN KEY (`frequency_id`)
    REFERENCES `flatanize`.`frequencies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cleanings_wdays`
    FOREIGN KEY (`wdays_id`)
    REFERENCES `flatanize`.`wdays` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
