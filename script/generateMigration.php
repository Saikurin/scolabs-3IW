<?php

$nameOfFile = "Version" . date('YmdHis');

$content = '
<?php 

class ' . $nameOfFile . ' extends Migrations {

    public function up()
    {
        $this->executeSQL("SELECT 1 + 1");
    }

    public function down()
    {
        $this->executeSQL("SELECT 1 - 1");
    }
}
';

file_put_contents("migrations/" . $nameOfFile . ".php", trim($content));

echo "Migration " . date('YmdHis'). " generate in migrations folder\n";