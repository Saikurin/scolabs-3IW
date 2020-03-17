<?php

class Version20200228151214 extends Migrations {
    public function up()
    {
        $this->executeSQL("
            CREATE TABLE `nfoz_classrooms` (
              `id_classroom` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(45) NOT NULL,
              `level` VARCHAR(45) NULL,
              PRIMARY KEY (`id_classroom`))
            ENGINE = InnoDB");
    }

    public function down()
    {
        $this->executeSQL("DROP TABLE nfoz_classrooms");
    }
}