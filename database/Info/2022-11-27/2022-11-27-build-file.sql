-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema programming_languageus_moduels_1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema programming_languageus_moduels_1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `programming_languageus_moduels_1` DEFAULT CHARACTER SET utf8 ;
USE `programming_languageus_moduels_1` ;

-- -----------------------------------------------------
-- Table `programming_languageus_moduels_1`.`account_infos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming_languageus_moduels_1`.`account_infos` (
  `account_infos_id` INT NOT NULL,
  `email` VARCHAR(245) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`account_infos_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming_languageus_moduels_1`.`experts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming_languageus_moduels_1`.`experts` (
  `expert_id` INT NOT NULL AUTO_INCREMENT,
  `account_infos_id` INT NOT NULL,
  `namel` VARCHAR(45) NOT NULL,
  `pic` BLOB NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `opening_time` VARCHAR(45) NOT NULL,
  `rating` DOUBLE(2,1) UNSIGNED NULL,
  PRIMARY KEY (`expert_id`),
  INDEX `fk_experts_account_infos1_idx` (`account_infos_id` ASC) VISIBLE,
  CONSTRAINT `fk_experts_account_infos1`
    FOREIGN KEY (`account_infos_id`)
    REFERENCES `programming_languageus_moduels_1`.`account_infos` (`account_infos_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming_languageus_moduels_1`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming_languageus_moduels_1`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `account_infos_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_users_account_infos1_idx` (`account_infos_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_account_infos1`
    FOREIGN KEY (`account_infos_id`)
    REFERENCES `programming_languageus_moduels_1`.`account_infos` (`account_infos_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming_languageus_moduels_1`.`consults`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming_languageus_moduels_1`.`consults` (
  `consult_id` INT NOT NULL AUTO_INCREMENT,
  `expert_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `time` DATETIME NOT NULL,
  `price` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`consult_id`),
  INDEX `fk_experts_has_users_users1_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_experts_has_users_experts_idx` (`expert_id` ASC) VISIBLE,
  CONSTRAINT `fk_experts_has_users_experts`
    FOREIGN KEY (`expert_id`)
    REFERENCES `programming_languageus_moduels_1`.`experts` (`expert_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experts_has_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `programming_languageus_moduels_1`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming_languageus_moduels_1`.`experiences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming_languageus_moduels_1`.`experiences` (
  `experience_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`experience_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programming_languageus_moduels_1`.`levels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programming_languageus_moduels_1`.`levels` (
  `level_id` INT NOT NULL AUTO_INCREMENT,
  `expert_id` INT NOT NULL,
  `experience_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  INDEX `fk_experts_has_experiences_experiences1_idx` (`experience_id` ASC) VISIBLE,
  INDEX `fk_experts_has_experiences_experts1_idx` (`expert_id` ASC) VISIBLE,
  PRIMARY KEY (`level_id`),
  CONSTRAINT `fk_experts_has_experiences_experts1`
    FOREIGN KEY (`expert_id`)
    REFERENCES `programming_languageus_moduels_1`.`experts` (`expert_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experts_has_experiences_experiences1`
    FOREIGN KEY (`experience_id`)
    REFERENCES `programming_languageus_moduels_1`.`experiences` (`experience_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
