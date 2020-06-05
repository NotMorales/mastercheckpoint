
-- -----------------------------------------------------
-- Schema uv_fca_admin
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `uv_fca_admin` DEFAULT CHARACTER SET utf8 ;
USE `uv_fca_admin` ;

-- -----------------------------------------------------
-- Table `uv_fca_admin`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`permiso` (
  `permisoId` INT NOT NULL AUTO_INCREMENT,
  `clave` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(50) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permisoId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`role` (
  `roleId` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(50) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`roleId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`permiso_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`permiso_role` (
  `permiso_roleId` INT NOT NULL AUTO_INCREMENT,
  `roleId` INT NOT NULL,
  `permisoId` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permiso_roleId`),
  INDEX `roleIdFkPermisoRole_idx` (`roleId` ASC),
  INDEX `permisoIdFkPermisoRole_idx` (`permisoId` ASC),
  UNIQUE INDEX `rolePermisoUnico` (`roleId` ASC, `permisoId` ASC),
  CONSTRAINT `roleIdFkPermisoRole`
    FOREIGN KEY (`roleId`)
    REFERENCES `uv_fca_admin`.`role` (`roleId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `permisoIdFkPermisoRole`
    FOREIGN KEY (`permisoId`)
    REFERENCES `uv_fca_admin`.`permiso` (`permisoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`persona` (
  `personaId` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(75) NOT NULL,
  `apellidoPaterno` VARCHAR(75) NOT NULL,
  `apellidoMaterno` VARCHAR(75) NOT NULL,
  `telefono` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`personaId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`Users` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `personaId` INT NOT NULL,
  `roleId` INT NOT NULL,
  `matricula` VARCHAR(75) NOT NULL,
  `email` VARCHAR(75) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) NULL,
  `remember_token` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`),
  INDEX `roleIdFkUser_idx` (`roleId` ASC),
  INDEX `personaFkUser_idx` (`personaId` ASC),
  UNIQUE INDEX `matricula_UNIQUE` (`matricula` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `personaFkUser`
    FOREIGN KEY (`personaId`)
    REFERENCES `uv_fca_admin`.`persona` (`personaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `roleIdFkUser`
    FOREIGN KEY (`roleId`)
    REFERENCES `uv_fca_admin`.`role` (`roleId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`experienciaEducativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`experienciaEducativa` (
  `experienciaEducativaId` INT NOT NULL AUTO_INCREMENT,
  `docenteId` INT NOT NULL,
  `nombreExperiencia` VARCHAR(75) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `color` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`experienciaEducativaId`),
  INDEX `docenteIdFkExperienciaEducativa_idx` (`docenteId` ASC),
  CONSTRAINT `docenteIdFkExperienciaEducativa`
    FOREIGN KEY (`docenteId`)
    REFERENCES `uv_fca_admin`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`listaAsistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`listaAsistencia` (
  `listaAsistenciaId` INT NOT NULL AUTO_INCREMENT,
  `experienciaEducativaId` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `horaInicio` TIME NULL,
  `horaFin` TIME NULL,
  `duracion` INT NOT NULL,
  `estado` TINYINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`listaAsistenciaId`),
  INDEX `experienciaEducativaIdFkListaAsistencia_idx` (`experienciaEducativaId` ASC),
  CONSTRAINT `experienciaEducativaIdFkListaAsistencia`
    FOREIGN KEY (`experienciaEducativaId`)
    REFERENCES `uv_fca_admin`.`experienciaEducativa` (`experienciaEducativaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`experienciaEstudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`experienciaEstudiante` (
  `experienciaEstudianteId` INT NOT NULL AUTO_INCREMENT,
  `experienciaEducativaId` INT NOT NULL,
  `userId` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`experienciaEstudianteId`),
  INDEX `experienciaEducativaIdFkExperienciaEstudiante_idx` (`experienciaEducativaId` ASC),
  UNIQUE INDEX `experienciaEstudianteunico` (`experienciaEducativaId` ASC, `userId` ASC),
  INDEX `userIdFkExperienciaEstudiante_idx` (`userId` ASC),
  CONSTRAINT `experienciaEducativaIdFkExperienciaEstudiante`
    FOREIGN KEY (`experienciaEducativaId`)
    REFERENCES `uv_fca_admin`.`experienciaEducativa` (`experienciaEducativaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userIdFkExperienciaEstudiante`
    FOREIGN KEY (`userId`)
    REFERENCES `uv_fca_admin`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`listaAsistenciaEstudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`listaAsistenciaEstudiante` (
  `listaAsistenciaEstudianteId` INT NOT NULL AUTO_INCREMENT,
  `listaAsistenciaId` INT NOT NULL,
  `userId` INT NOT NULL,
  `registro` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `direccion` VARCHAR(255) NULL,
  `tipo` TINYINT NOT NULL DEFAULT 1,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`listaAsistenciaEstudianteId`),
  INDEX `listaAsistenciaIdFkListaAsistenciaEstudiante_idx` (`listaAsistenciaId` ASC),
  INDEX `userIdFkListaAsistenciaEstudiante_idx` (`userId` ASC),
  CONSTRAINT `listaAsistenciaIdFkListaAsistenciaEstudiante`
    FOREIGN KEY (`listaAsistenciaId`)
    REFERENCES `uv_fca_admin`.`listaAsistencia` (`listaAsistenciaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userIdFkListaAsistenciaEstudiante`
    FOREIGN KEY (`userId`)
    REFERENCES `uv_fca_admin`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`tema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`tema` (
  `temaId` INT NOT NULL AUTO_INCREMENT,
  `experienciaEducativaId` INT NOT NULL,
  `nombreTema` VARCHAR(255) NOT NULL,
  `fechaInicio` DATE NOT NULL,
  `fechaFin` DATE NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`temaId`),
  INDEX `experienciaEducativaIdFkTema_idx` (`experienciaEducativaId` ASC),
  CONSTRAINT `experienciaEducativaIdFkTema`
    FOREIGN KEY (`experienciaEducativaId`)
    REFERENCES `uv_fca_admin`.`experienciaEducativa` (`experienciaEducativaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`participacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`participacion` (
  `participacionId` INT NOT NULL AUTO_INCREMENT,
  `experienciaEstudianteId` INT NOT NULL,
  `temaId` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `numeroParticipaciones` INT NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`participacionId`),
  INDEX `temaIdFkParticipaicon_idx` (`temaId` ASC),
  INDEX `experienciaEstudianteIdFkParticipacion_idx` (`experienciaEstudianteId` ASC),
  CONSTRAINT `temaIdFkParticipaicon`
    FOREIGN KEY (`temaId`)
    REFERENCES `uv_fca_admin`.`tema` (`temaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `experienciaEstudianteIdFkParticipacion`
    FOREIGN KEY (`experienciaEstudianteId`)
    REFERENCES `uv_fca_admin`.`experienciaEstudiante` (`experienciaEstudianteId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`colaParticipacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`colaParticipacion` (
  `colaParticipacionId` INT NOT NULL AUTO_INCREMENT,
  `experienciaEstudianteId` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `participaciones` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`colaParticipacionId`),
  INDEX `experienciaEstudianteIdFkColaParticipacion_idx` (`experienciaEstudianteId` ASC),
  CONSTRAINT `experienciaEstudianteIdFkColaParticipacion`
    FOREIGN KEY (`experienciaEstudianteId`)
    REFERENCES `uv_fca_admin`.`experienciaEstudiante` (`experienciaEstudianteId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`notificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`notificacion` (
  `notificacionId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `userIdRemitente` INT NOT NULL,
  `notificacion` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `fecha` DATE NULL,
  `estado` TINYINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notificacionId`),
  INDEX `userIdFkNotificacion_idx` (`userId` ASC),
  INDEX `userIdRemitenteFkNotificacion_idx` (`userIdRemitente` ASC),
  CONSTRAINT `userIdFkNotificacion`
    FOREIGN KEY (`userId`)
    REFERENCES `uv_fca_admin`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userIdRemitenteFkNotificacion`
    FOREIGN KEY (`userIdRemitente`)
    REFERENCES `uv_fca_admin`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uv_fca_admin`.`mensaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uv_fca_admin`.`mensaje` (
  `mensajeId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `userIdRemitente` INT NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `mensaje` VARCHAR(255) NOT NULL,
  `fecha` DATE NOT NULL,
  `estado` TINYINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mensajeId`),
  INDEX `userIdFkNotificacion_idx` (`userId` ASC),
  INDEX `userIdRemitenteFkNotificacion_idx` (`userIdRemitente` ASC),
  CONSTRAINT `userIdFkNotificacion0`
    FOREIGN KEY (`userId`)
    REFERENCES `uv_fca_admin`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userIdRemitenteFkNotificacion0`
    FOREIGN KEY (`userIdRemitente`)
    REFERENCES `uv_fca_admin`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `role` (`roleId`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, '2020-03-11 21:32:46', NULL),
(2, 'maestro', NULL, '2020-03-11 21:32:53', NULL),
(3, 'estudiante', NULL, '2020-03-11 21:32:57', NULL);
