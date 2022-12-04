-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema programming-languagues-schema
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema programming-languagues-schema
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `programming-languagues-schema` DEFAULT CHARACTER SET utf8 ;
USE `programming-languagues-schema` ;

-- -----------------------------------------------------
-- Table `programming-languagues-schema`.`credentials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming-languagues-schema`.`credentials` (
  `credentials_id` INT NOT NULL,
  `email` VARCHAR(245) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`credentials_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming-languagues-schema`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming-languagues-schema`.`categories` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming-languagues-schema`.`experts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming-languagues-schema`.`experts` (
  `expert_id` INT NOT NULL AUTO_INCREMENT,
  `credentials_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `pic` BLOB NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `openning_time` VARCHAR(45) NOT NULL,
  `rating` DOUBLE(2,1) NULL,
  PRIMARY KEY (`expert_id`),
  INDEX `fk_experts_credentials_idx` (`credentials_id` ASC) VISIBLE,
  INDEX `fk_experts_categories1_idx` (`category_id` ASC) VISIBLE,
  CONSTRAINT `fk_experts_credentials`
    FOREIGN KEY (`credentials_id`)
    REFERENCES `programming-languagues-schema`.`credentials` (`credentials_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experts_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `programming-languagues-schema`.`categories` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming-languagues-schema`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming-languagues-schema`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `credentials_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_users_credentials1_idx` (`credentials_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_credentials1`
    FOREIGN KEY (`credentials_id`)
    REFERENCES `programming-languagues-schema`.`credentials` (`credentials_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming-languagues-schema`.`consultants`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming-languagues-schema`.`consultants` (
  `consultant_id` INT NOT NULL AUTO_INCREMENT,
  `expert_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `time` DATETIME NOT NULL,
  `price` DECIMAL(9,2) NOT NULL,
  INDEX `fk_experts_has_users_users1_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_experts_has_users_experts1_idx` (`expert_id` ASC) VISIBLE,
  PRIMARY KEY (`consultant_id`),
  CONSTRAINT `fk_experts_has_users_experts1`
    FOREIGN KEY (`expert_id`)
    REFERENCES `programming-languagues-schema`.`experts` (`expert_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experts_has_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `programming-languagues-schema`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming-languagues-schema`.`experiences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming-languagues-schema`.`experiences` (
  `experience_id` INT NOT NULL AUTO_INCREMENT,
  `expert_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `details` VARCHAR(245) NOT NULL,
  PRIMARY KEY (`experience_id`),
  INDEX `fk_experiences_experts1_idx` (`expert_id` ASC) VISIBLE,
  CONSTRAINT `fk_experiences_experts1`
    FOREIGN KEY (`expert_id`)
    REFERENCES `programming-languagues-schema`.`experts` (`expert_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
