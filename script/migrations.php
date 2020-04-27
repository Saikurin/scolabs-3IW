<?php

require "core/ConstantLoader.php";
require "core/DB.php";
require "core/Migrations.php";

new ConstantLoader();

/**
 * @param string $migration
 * @param string $to
 */
function executeMigration(string $migration, $to = "up")
{
    require "migrations/" . $migration . ".php";

    try {
        $tableMigration = DB_PREFIXE . "migrations";

        $class = new  $migration();

        /**
         * @var PDO $pdo
         * Documentation is only for autocompletion
         */
        $pdo = $class->getPdo();

        checkTableMigration($pdo, $tableMigration);

        if ($to === "up") {
            $query = $pdo->prepare("SELECT version FROM " . $tableMigration . " WHERE version = :version ");
            $query->execute([
                "version" => $migration
            ]);

            if (!$query->fetch(PDO::FETCH_COLUMN)) {
                $class->up();
                $query = $pdo->prepare("INSERT INTO " . $tableMigration . " (version) VALUE (:version)");
                $query->execute([
                    "version" => $migration
                ]);
            }
        } else {
            $class->down();
            $query = $pdo->prepare("DELETE FROM " . $tableMigration . "  WHERE version = :version");
            $query->execute([
                "version" => $migration
            ]);
        }

    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/**
 * @param PDO $pdo
 * @param string $tableMigration
 */
function checkTableMigration(PDO $pdo, string $tableMigration)
{
    /** @var array $tables */
    $tables = $pdo->query("SHOW TABLES;")->fetchAll(PDO::FETCH_ASSOC);

    // Check if table migration exist
    if (!in_array(DB_PREFIXE . "migrations", $tables)) {

        $pdo->query("
        create table " . $tableMigration . "
        (
            id_migration int auto_increment,
            version char(21) not null,
            constraint oft_migrations_pk
                primary key (id_migration)
        );
        
        create unique index " . $tableMigration . "_version_uindex
            on " . $tableMigration . " (version);
    ");
    }
}

$migration = getopt(null, ["migration:"])['migration'] ?? null;
$to = getopt(null, ["to:"])['to'] ?? "up";

if ($migration) {
    executeMigration($migration, $to);
} else {
    $files = glob("migrations/*.php");
    foreach ($files as $file) {
        $fileName = explode("/", $file)[1];
        $version = explode(".", $fileName)[0];
        executeMigration($version);
    }
}