<?php

class Version20200331220014 extends Migrations {
    public function up()
    {
        $this->executeSQL("
        CREATE TABLE `nfoz_students`(
        `id_student` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `lastname` VARCHAR(45) NOT NULL, 
        `firstname` VARCHAR(45) NOT NULL, 
        `email` VARCHAR(255) NOT NULL,
        `address` VARCHAR(255) NOT NULL,
        `phoneNumber` CHAR(10) NOT NULL, 
        `parent1` INT UNSIGNED, 
        `parent2` INT UNSIGNED,
        PRIMARY KEY (`id_student`))
        ENGINE = InnoDB");

        $this->executeSQL("
        CREATE TABLE `nfoz_absences`(
        `id_absence` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `id_student` INT UNSIGNED NOT NULL,
        `date` DATETIME, 
        PRIMARY KEY (`id_absence`),
        FOREIGN KEY (`id_student`) REFERENCES nfoz_students(`id_student`))
        ENGINE = InnoDB");

        $this->executeSQL("
        CREATE TABLE `nfoz_teachers`(
        `id_teacher` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
        `firstname` VARCHAR(255), 
        `lastname` VARCHAR(50),
        PRIMARY KEY (`id_teacher`))
        ENGINE = InnoDB");

        $this->executeSQL("
        CREATE TABLE `nfoz_subject`(
        `id_subject` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
        `name` VARCHAR(255),
        PRIMARY KEY (`id_subject`))
        ENGINE = InnoDB");

        $this->executeSQL("
        CREATE TABLE `nfoz_grades`(
        `id_grade` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
        `id_student` INT UNSIGNED NOT NULL, 
        `id_subject` INT UNSIGNED NOT NULL, 
        `id_teacher` INT UNSIGNED NOT NULL,
        `grade` FLOAT(2,2) NOT NULL,
        PRIMARY KEY (`id_grade`),
        FOREIGN KEY (`id_student`) REFERENCES nfoz_students(`id_student`),
        FOREIGN KEY (`id_subject`) REFERENCES nfoz_subject(`id_subject`),
        FOREIGN KEY (`id_teacher`) REFERENCES nfoz_teacher(`id_teacher`)) 
        ENGINE = InnoDB");
    }

    public function down()
    {
        $this->executeSQL("DROP TABLE nfoz_students");
        $this->executeSQL("DROP TABLE nfoz_absences");
        $this->executeSQL("DROP TABLE nfoz_grades");
        $this->executeSQL("DROP TABLE nfoz_subject");
        $this->executeSQL("DROP TABLE nfoz_teacher");
    }
}