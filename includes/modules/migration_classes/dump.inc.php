<?php

$TABLE = $_GET["dump"];

if ($_POST && !$error) {
    $cookie = "";
    foreach (["output", "format", "db_style", "routines", "events", "table_style", "auto_increment", "triggers", "data_style"] as $key) {
        $cookie .= "&$key=" . urlencode($_POST[$key]);
    }
    cookie("adminer_export", substr($cookie, 1));
    $tablesList = implode(',', $_POST['tables']);
    $tables = array_flip((array)$_POST["tables"]) + array_flip((array)$_POST["data"]);
    $ext    = dump_headers(
        (count($tables) == 1 ? key($tables) : DB),
        (DB == "" || count($tables) > 1)
    );
    $is_sql = preg_match('~sql~', $_POST["format"]);

    if ($is_sql) {
        echo "-- {$tablesList}\n\n";
        if ($jush == "sql") {
            echo "SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
" . ($_POST["data_style"] ? "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
" : "") . "
";
            $connection->query("SET time_zone = '+00:00';");
        }
    }

    $style     = $_POST["db_style"];
    $databases = [DB];
    if (DB == "") {
        $databases = $_POST["databases"];
        if (is_string($databases)) {
            $databases = explode("\n", rtrim(str_replace("\r", "", $databases), "\n"));
        }
    }

    foreach ((array)$databases as $db) {
        $adminer->dumpDatabase($db);
        if ($connection->select_db($db)) {
            if ($is_sql && preg_match('~CREATE~', $style) && ($create = $connection->result("SHOW CREATE DATABASE " . idf_escape($db), 1))) {
                set_utf8mb4($create);
                if ($style == "DROP+CREATE") {
                    echo "DROP DATABASE IF EXISTS " . idf_escape($db) . ";\n";
                }
                echo "$create;\n";
            }
            if ($is_sql) {
                if ($style) {
                    echo use_sql($db) . ";\n\n";
                }
                $out = "";

                if ($_POST["routines"]) {
                    foreach (["FUNCTION", "PROCEDURE"] as $routine) {
                        foreach (get_rows("SHOW $routine STATUS WHERE Db = " . q($db), null, "-- ") as $row) {
                            $create = remove_definer($connection->result("SHOW CREATE $routine " . idf_escape($row["Name"]), 2));
                            set_utf8mb4($create);
                            $out .= ($style != 'DROP+CREATE' ? "DROP $routine IF EXISTS " . idf_escape($row["Name"]) . ";;\n" : "") . "$create;;\n\n";
                        }
                    }
                }

                if ($_POST["events"]) {
                    foreach (get_rows("SHOW EVENTS", null, "-- ") as $row) {
                        $create = remove_definer($connection->result("SHOW CREATE EVENT " . idf_escape($row["Name"]), 3));
                        set_utf8mb4($create);
                        $out .= ($style != 'DROP+CREATE' ? "DROP EVENT IF EXISTS " . idf_escape($row["Name"]) . ";;\n" : "") . "$create;;\n\n";
                    }
                }

                if ($out) {
                    echo "DELIMITER ;;\n\n$out" . "DELIMITER ;\n\n";
                }
            }

            if ($_POST["table_style"] || $_POST["data_style"]) {
                $views = [];
                foreach (table_status('', true) as $name => $table_status) {
                    $table = (DB == "" || in_array($name, (array)$_POST["tables"]));
                    $data  = (DB == "" || in_array($name, (array)$_POST["data"]));
                    if ($table || $data) {
                        if ($ext == "tar") {
                            $tmp_file = new TmpFile();
                            ob_start([$tmp_file, 'write'], 1e5);
                        }

                        $adminer->dumpTable($name, ($table ? $_POST["table_style"] : ""), (is_view($table_status) ? 2 : 0));
                        if (is_view($table_status)) {
                            $views[] = $name;
                        } elseif ($data) {
                            $fields = fields($name);
                            $adminer->dumpData($name, $_POST["data_style"], "SELECT *" . convert_fields($fields, $fields) . " FROM " . table($name));
                        }
                        if ($is_sql && $_POST["triggers"] && $table && ($triggers = trigger_sql($name))) {
                            echo "\nDELIMITER ;;\n$triggers\nDELIMITER ;\n";
                        }

                        if ($ext == "tar") {
                            ob_end_flush();
                            tar_file((DB != "" ? "" : "$db/") . "$name.csv", $tmp_file);
                        } elseif ($is_sql) {
                            echo "\n";
                        }
                    }
                }

                foreach ($views as $view) {
                    $adminer->dumpTable($view, $_POST["table_style"], 1);
                }

                if ($ext == "tar") {
                    echo pack("x512");
                }
            }
        }
    }

    if ($is_sql) {
        echo "-- " . $connection->result("SELECT NOW()") . "\n";
    }
}
ob_get_contents();
ob_end_clean();
die(123);
