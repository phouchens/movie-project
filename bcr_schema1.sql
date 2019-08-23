-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bcr
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `bcr` ;

-- -----------------------------------------------------
-- Schema bcr
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bcr` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
USE `bcr` ;

-- -----------------------------------------------------
-- Table `bcr`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bcr`.`roles` (
  `roleId` INT(11) NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`roleId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE INDEX `roleId` ON `bcr`.`roles` (`roleId` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bcr`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bcr`.`customer` (
  `customerId` INT(11) NOT NULL AUTO_INCREMENT,
  `role` INT(11) NOT NULL,
  `firstName` VARCHAR(45) NULL DEFAULT NULL,
  `lastName` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(45) NULL DEFAULT NULL,
  `lateFeeFlag` TINYINT(4) NOT NULL DEFAULT '0',
  `createdDate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`customerId`),
  CONSTRAINT `role`
    FOREIGN KEY (`role`)
    REFERENCES `bcr`.`roles` (`roleId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE INDEX `roleId_idx` ON `bcr`.`customer` (`role` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bcr`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bcr`.`employee` (
  `employeeId` INT(11) NOT NULL AUTO_INCREMENT,
  `role` INT(11) NOT NULL,
  `firstName` VARCHAR(45) NULL DEFAULT NULL,
  `lastName` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `createTime` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`employeeId`),
  CONSTRAINT `roleId`
    FOREIGN KEY (`role`)
    REFERENCES `bcr`.`roles` (`roleId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE UNIQUE INDEX `employeeId_UNIQUE` ON `bcr`.`employee` (`employeeId` ASC) VISIBLE;

CREATE INDEX `roleName_idx` ON `bcr`.`employee` (`role` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bcr`.`movie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bcr`.`movie` (
  `movieId` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL DEFAULT NULL,
  `genre` VARCHAR(45) NULL DEFAULT NULL,
  `year` VARCHAR(45) NULL DEFAULT NULL,
  `language` VARCHAR(45) NULL DEFAULT NULL,
  `moviecol` VARCHAR(45) NULL DEFAULT NULL,
  `actors` VARCHAR(45) NULL DEFAULT NULL,
  `directors` VARCHAR(45) NULL DEFAULT NULL,
  `rating` VARCHAR(45) NULL DEFAULT NULL,
  `dateCreated` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `rented` TINYINT(4) NOT NULL DEFAULT '0',
  `returnDate` TIMESTAMP NULL DEFAULT NULL,
  `price` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`movieId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE INDEX `movieId` ON `bcr`.`movie` (`movieId` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bcr`.`rental_transaction`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bcr`.`rental_transaction` (
  `transactionId` INT(11) NOT NULL AUTO_INCREMENT,
  `customerId` INT(11) NOT NULL,
  `employeeId` INT(11) NOT NULL,
  `rentalDate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `rentalItem` INT(11) NOT NULL,
  PRIMARY KEY (`transactionId`),
  CONSTRAINT `customer`
    FOREIGN KEY (`customerId`)
    REFERENCES `bcr`.`customer` (`customerId`),
  CONSTRAINT `employeee`
    FOREIGN KEY (`employeeId`)
    REFERENCES `bcr`.`employee` (`employeeId`),
  CONSTRAINT `item`
    FOREIGN KEY (`rentalItem`)
    REFERENCES `bcr`.`rental_item` (`rentalItemId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE INDEX `Primary_idx` ON `bcr`.`rental_transaction` (`customerId` ASC) VISIBLE;

CREATE INDEX `secondary_idx` ON `bcr`.`rental_transaction` (`employeeId` ASC) VISIBLE;

CREATE INDEX `tertiary_idx` ON `bcr`.`rental_transaction` (`rentalItem` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `bcr`.`rental_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bcr`.`rental_item` (
  `rentalItemId` INT(11) NOT NULL AUTO_INCREMENT,
  `movieId` INT(11) NOT NULL,
  `transactionId` INT(11) NOT NULL,
  PRIMARY KEY (`rentalItemId`),
  CONSTRAINT `primary`
    FOREIGN KEY (`movieId`)
    REFERENCES `bcr`.`movie` (`movieId`),
  CONSTRAINT `transaction`
    FOREIGN KEY (`transactionId`)
    REFERENCES `bcr`.`rental_transaction` (`transactionId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE INDEX `primary_idx` ON `bcr`.`rental_item` (`movieId` ASC) VISIBLE;

CREATE INDEX `transaction_idx` ON `bcr`.`rental_item` (`transactionId` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
