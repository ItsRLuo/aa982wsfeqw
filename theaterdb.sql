SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`movie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`movie` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`movie` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`theater`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`theater` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`theater` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `address` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`showtime`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`showtime` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`showtime` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `movie_id` INT NOT NULL ,
  `theater_id` INT NOT NULL ,
  `date` DATE NOT NULL ,
  `time` TIME NOT NULL ,
  `available` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_showtime_play` (`movie_id` ASC) ,
  INDEX `fk_showtime_theater1` (`theater_id` ASC) ,
  CONSTRAINT `fk_showtime_play`
    FOREIGN KEY (`movie_id` )
    REFERENCES `mydb`.`movie` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_showtime_theater1`
    FOREIGN KEY (`theater_id` )
    REFERENCES `mydb`.`theater` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ticket` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`ticket` (
  `ticket` INT NOT NULL AUTO_INCREMENT ,
  `first` VARCHAR(45) NOT NULL ,
  `last` VARCHAR(45) NOT NULL ,
  `creditcardnumber` VARCHAR(16) NOT NULL ,
  `creditcardexpiration` VARCHAR(4) NOT NULL ,
  `showtime_id` INT NOT NULL ,
  `seat` INT NOT NULL ,
  PRIMARY KEY (`ticket`) ,
  UNIQUE INDEX `ticket_UNIQUE` (`ticket` ASC) ,
  INDEX `fk_table1_showtime1` (`showtime_id` ASC) ,
  CONSTRAINT `fk_table1_showtime1`
    FOREIGN KEY (`showtime_id` )
    REFERENCES `mydb`.`showtime` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
