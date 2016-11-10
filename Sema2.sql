-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema TFS
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `TFS` ;

-- -----------------------------------------------------
-- Schema TFS
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TFS` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci ;
USE `TFS` ;

-- -----------------------------------------------------
-- Table `TFS`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `TFS`.`User` ;

CREATE TABLE IF NOT EXISTS `TFS`.`User` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(45) NOT NULL,
  `birthdate` DATE NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TFS`.`References`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `TFS`.`References` ;

CREATE TABLE IF NOT EXISTS `TFS`.`References` (
  `ref_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NULL,
  `text` VARCHAR(5000) NULL,
  `User_Id` INT NOT NULL,
  PRIMARY KEY (`ref_id`),
  INDEX `fk_References_User_idx` (`User_Id` ASC),
  CONSTRAINT `fk_References_User`
    FOREIGN KEY (`User_Id`)
    REFERENCES `TFS`.`User` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TFS`.`Pictures`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `TFS`.`Pictures` ;

CREATE TABLE IF NOT EXISTS `TFS`.`Pictures` (
  `pic_id` INT NOT NULL AUTO_INCREMENT,
  `pic_name` VARCHAR(45) NOT NULL,
  `References_ref_id` INT NOT NULL,
  PRIMARY KEY (`pic_id`),
  INDEX `fk_Pictures_References1_idx` (`References_ref_id` ASC),
  CONSTRAINT `fk_Pictures_References1`
    FOREIGN KEY (`References_ref_id`)
    REFERENCES `TFS`.`References` (`ref_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
