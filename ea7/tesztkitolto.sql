SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `tesztkitolto` ;
CREATE SCHEMA IF NOT EXISTS `tesztkitolto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `tesztkitolto` ;

-- -----------------------------------------------------
-- Table `tesztkitolto`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tesztkitolto`.`users` (
  `uid` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `passmd5` VARCHAR(255) NULL,
  `nev` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 0,
  `guid` VARCHAR(255) NULL,
  PRIMARY KEY (`uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tesztkitolto`.`tesztek`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tesztkitolto`.`tesztek` (
  `tid` INT NOT NULL AUTO_INCREMENT,
  `cim` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`tid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tesztkitolto`.`tesztkerdesek`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tesztkitolto`.`tesztkerdesek` (
  `tkid` INT NOT NULL AUTO_INCREMENT,
  `kerdestxt` MEDIUMTEXT NULL,
  `kerdeshtml` MEDIUMTEXT NULL,
  `kerdesbin` MEDIUMBLOB NULL,
  `tipus` VARCHAR(45) NULL,
  `kategoria` VARCHAR(45) NULL,
  `nehezseg` DECIMAL(10,2) NULL,
  PRIMARY KEY (`tkid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tesztkitolto`.`teszt_tesztkerdes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tesztkitolto`.`teszt_tesztkerdes` (
  `ttid` INT NOT NULL AUTO_INCREMENT,
  `tid` INT NOT NULL,
  `tkid` INT NOT NULL,
  `sorszam` INT NOT NULL,
  `helyespontszam` INT NOT NULL DEFAULT 1,
  `hibaspontszam` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`ttid`),
  INDEX `fk_teszt_tesztkerdes_tesztek1_idx` (`tid` ASC),
  INDEX `fk_teszt_tesztkerdes_tesztkerdesek1_idx` (`tkid` ASC),
  CONSTRAINT `fk_teszt_tesztkerdes_tesztek1`
    FOREIGN KEY (`tid`)
    REFERENCES `tesztkitolto`.`tesztek` (`tid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teszt_tesztkerdes_tesztkerdesek1`
    FOREIGN KEY (`tkid`)
    REFERENCES `tesztkitolto`.`tesztkerdesek` (`tkid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tesztkitolto`.`kitoltesek`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tesztkitolto`.`kitoltesek` (
  `kid` INT NOT NULL AUTO_INCREMENT,
  `tid` INT NOT NULL,
  `uid` INT NOT NULL,
  `startdatum` DATETIME NOT NULL,
  `enddatum` DATETIME NULL,
  `osszpont` INT NULL,
  PRIMARY KEY (`kid`),
  INDEX `fk_kitoltesek_users_idx` (`uid` ASC),
  INDEX `fk_kitoltesek_tesztek1_idx` (`tid` ASC),
  CONSTRAINT `fk_kitoltesek_users`
    FOREIGN KEY (`uid`)
    REFERENCES `tesztkitolto`.`users` (`uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kitoltesek_tesztek1`
    FOREIGN KEY (`tid`)
    REFERENCES `tesztkitolto`.`tesztek` (`tid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tesztkitolto`.`tesztvalaszok`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tesztkitolto`.`tesztvalaszok` (
  `tvid` INT NOT NULL AUTO_INCREMENT,
  `tkid` INT NOT NULL,
  `sorszam` INT NOT NULL,
  `valasztxt` MEDIUMTEXT NULL,
  `valaszhtml` MEDIUMTEXT NULL,
  `valaszbin` MEDIUMBLOB NULL,
  `helyese` TINYINT(1) NULL,
  PRIMARY KEY (`tvid`),
  INDEX `fk_tesztvalaszok_tesztkerdesek1_idx` (`tkid` ASC),
  CONSTRAINT `fk_tesztvalaszok_tesztkerdesek1`
    FOREIGN KEY (`tkid`)
    REFERENCES `tesztkitolto`.`tesztkerdesek` (`tkid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tesztkitolto`.`kitoltesvalaszok`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tesztkitolto`.`kitoltesvalaszok` (
  `kvid` INT NOT NULL AUTO_INCREMENT,
  `kid` INT NOT NULL,
  `tkid` INT NOT NULL,
  `tvid` INT NOT NULL,
  PRIMARY KEY (`kvid`),
  INDEX `fk_kitoltesvalaszok_tesztvalaszok1_idx` (`tvid` ASC),
  INDEX `fk_kitoltesvalaszok_tesztkerdesek1_idx` (`tkid` ASC),
  INDEX `fk_kitoltesvalaszok_kitoltesek1_idx` (`kid` ASC),
  CONSTRAINT `fk_kitoltesvalaszok_tesztvalaszok1`
    FOREIGN KEY (`tvid`)
    REFERENCES `tesztkitolto`.`tesztvalaszok` (`tvid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kitoltesvalaszok_tesztkerdesek1`
    FOREIGN KEY (`tkid`)
    REFERENCES `tesztkitolto`.`tesztkerdesek` (`tkid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kitoltesvalaszok_kitoltesek1`
    FOREIGN KEY (`kid`)
    REFERENCES `tesztkitolto`.`kitoltesek` (`kid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS; 