<?php

class Version20200101102020 extends Migrations
{

    public function up()
    {
        $this->executeSQL("CREATE TABLE user(id int not null)");
    }

    public function down()
    {
        $this->executeSQL("DROP TABLE user");
    }

}