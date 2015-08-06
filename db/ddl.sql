-- -----------------------------------------------------
-- Schema flatanize_com
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `flatanize_com` ;

-- -----------------------------------------------------
-- Schema flatanize_com
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `flatanize_com` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `flatanize_com` ;

-- -----------------------------------------------------
-- Table `flatanize_com`.`flats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`flats` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `code` CHAR(5) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flats_id` INT UNSIGNED NULL,
  `username` VARCHAR(50) NOT NULL,
  `display_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `salt` CHAR(64) NOT NULL,
  `token` VARCHAR(255) NULL,
  `img` VARCHAR(255) NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize_com`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`shopping_lists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`shopping_lists` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flats_id` INT UNSIGNED NOT NULL,
  `added_by` INT UNSIGNED NOT NULL,
  `product` VARCHAR(255) NOT NULL,
  `amount` INT NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_shopping_users_idx` (`added_by` ASC),
  CONSTRAINT `fk_shopping_lists_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize_com`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_shopping_lists_users`
    FOREIGN KEY (`added_by`)
    REFERENCES `flatanize_com`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`finances`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`finances` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flats_id` INT UNSIGNED NOT NULL,
  `added_by` INT UNSIGNED NOT NULL,
  `product` VARCHAR(255) NOT NULL,
  `price` DECIMAL(9,2) NOT NULL,
  `date` DATE NOT NULL,
  `cleared` TINYINT(1) NOT NULL DEFAULT 0,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_finances_users_idx` (`added_by` ASC),
  CONSTRAINT `fk_finances_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize_com`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_finances_users`
    FOREIGN KEY (`added_by`)
    REFERENCES `flatanize_com`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`frequencies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`frequencies` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`tasks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flats_id` INT UNSIGNED NOT NULL,
  `frequencies_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `next_date` DATE NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tasks_frequencies_idx` (`frequencies_id` ASC),
  CONSTRAINT `fk_tasks_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize_com`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tasks_frequencies`
    FOREIGN KEY (`frequencies_id`)
    REFERENCES `flatanize_com`.`frequencies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`tasks_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`tasks_users` (
  `tasks_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  `user_order` INT UNSIGNED NOT NULL,
  `count` INT UNSIGNED NOT NULL DEFAULT 0,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`tasks_id`, `users_id`),
  INDEX `fk_tasks_users_us_idx` (`users_id` ASC),
  CONSTRAINT `fk_tasks_users_tasks`
    FOREIGN KEY (`tasks_id`)
    REFERENCES `flatanize_com`.`tasks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tasks_users_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `flatanize_com`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`finances_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`finances_users` (
  `finances_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  `pricePP` FLOAT NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`finances_id`, `users_id`),
  INDEX `fk_fin_users_users_id_idx` (`users_id` ASC),
  CONSTRAINT `fk_fin_users_finances`
    FOREIGN KEY (`finances_id`)
    REFERENCES `flatanize_com`.`finances` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fin_users_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `flatanize_com`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flatanize_com`.`whiteboards`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `flatanize_com`.`whiteboards` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` INT UNSIGNED NOT NULL,
  `flats_id` INT UNSIGNED NOT NULL,
  `text` VARCHAR(255) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_whiteboard_users_idx` (`users_id` ASC),
  INDEX `fk_whiteboard_flats_idx` (`flats_id` ASC),
  CONSTRAINT `fk_whiteboards_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `flatanize_com`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_whiteboards_flats`
    FOREIGN KEY (`flats_id`)
    REFERENCES `flatanize_com`.`flats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Data for table `flatanize_com`.`frequencies`
-- -----------------------------------------------------
START TRANSACTION;
USE `flatanize_com`;
INSERT INTO `flatanize_com`.`frequencies` (`id`, `description`) VALUES (DEFAULT, 'once');
INSERT INTO `flatanize_com`.`frequencies` (`id`, `description`) VALUES (DEFAULT, 'daily');
INSERT INTO `flatanize_com`.`frequencies` (`id`, `description`) VALUES (DEFAULT, 'weekly');
INSERT INTO `flatanize_com`.`frequencies` (`id`, `description`) VALUES (DEFAULT, 'every month');

COMMIT;

