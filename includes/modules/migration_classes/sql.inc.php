<?php

if (!$error && $_POST) {
    $fp = false;
    if (!isset($_GET["import"])) {
        $query = $_POST["query"];
    } elseif ($_POST["webfile"]) {
        $sql_file_path = isset($_POST['filepath']) ? $_POST['filepath'] : $adminer->importServerPath();
        $fp = @fopen((file_exists($sql_file_path)
            ? $sql_file_path
            : "compress.zlib://$sql_file_path.gz"
        ), "rb");
        $query = ($fp ? fread($fp, 1e6) : false);
    } else {
        $query = get_file("sql_file", true);
    }

    if (is_string($query)) { // get_file() returns error as number, fread() as false
        if (function_exists('memory_get_usage')) {
            @ini_set("memory_limit", max(ini_bytes("memory_limit"), 2 * strlen($query) + memory_get_usage() + 8e6)); // @ - may be disabled, 2 - substr and trim, 8e6 - other variables
        }

        if ($query != "" && strlen($query) < 1e6) { // don't add big queries
            $q = $query . (preg_match("~;[ \t\r\n]*\$~", $query) ? "" : ";"); //! doesn't work with DELIMITER |
            if (!$history || reset(end($history)) != $q) { // no repeated queries
                restart_session();
                $history[] = array($q, time()); //! add elapsed time
                set_session("queries", $history_all); // required because reference is unlinked by stop_session()
                stop_session();
            }
        }

        $space = "(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";
        $delimiter = ";";
        $offset = 0;
        $empty = true;
        $connection2 = connect(); // connection for exploring indexes and EXPLAIN (to not replace FOUND_ROWS()) //! PDO - silent error
        if (is_object($connection2) && DB != "") {
            $connection2->select_db(DB);
            if ($_GET["ns"] != "") {
                set_schema($_GET["ns"], $connection2);
            }
        }
        $commands = 0;
        $errors = array();
        $parse = '[\'"' . ($jush == "sql" ? '`#' : ($jush == "sqlite" ? '`[' : ($jush == "mssql" ? '[' : ''))) . ']|/\*|-- |$' . ($jush == "pgsql" ? '|\$[^$]*\$' : '');
        $total_start = microtime(true);
        parse_str($_COOKIE["adminer_export"], $adminer_export);
        $dump_format = $adminer->dumpFormat();
        unset($dump_format["sql"]);

        while ($query != "") {
            if (!$offset && preg_match("~^$space*+DELIMITER\\s+(\\S+)~i", $query, $match)) {
                $delimiter = $match[1];
                $query = substr($query, strlen($match[0]));
            } else {
                preg_match('(' . preg_quote($delimiter) . "\\s*|$parse)", $query, $match, PREG_OFFSET_CAPTURE, $offset); // should always match
                list($found, $pos) = $match[0];
                if (!$found && $fp && !feof($fp)) {
                    $query .= fread($fp, 1e5);
                } else {
                    if (!$found && rtrim($query) == "") {
                        break;
                    }
                    $offset = $pos + strlen($found);

                    if ($found && rtrim($found) != $delimiter) { // find matching quote or comment end
                        while (preg_match('(' . ($found == '/*' ? '\*/' : ($found == '[' ? ']' : (preg_match('~^-- |^#~', $found) ? "\n" : preg_quote($found) . "|\\\\."))) . '|$)s', $query, $match, PREG_OFFSET_CAPTURE, $offset)) { //! respect sql_mode NO_BACKSLASH_ESCAPES
                            $s = $match[0][0];
                            if (!$s && $fp && !feof($fp)) {
                                $query .= fread($fp, 1e5);
                            } else {
                                $offset = $match[0][1] + strlen($s);
                                if ($s[0] != "\\") {
                                    break;
                                }
                            }
                        }
                    } else { // end of a query
                        $empty = false;
                        $q = substr($query, 0, $pos);
                        $commands++;
                        $print = "<pre id='sql-$commands'><code class='jush-$jush'>" . $adminer->sqlCommandQuery($q) . "</code></pre>\n";
                        if ($jush == "sqlite" && preg_match("~^$space*+ATTACH\\b~i", $q, $match)) {
                            // PHP doesn't support setting SQLITE_LIMIT_ATTACHED
                            echo $print;
                            echo "<p class='error'>" . lang('ATTACH queries are not supported.') . "\n";
                            $errors[] = " <a href='#sql-$commands'>$commands</a>";
                            if ($_POST["error_stops"]) {
                                break;
                            }
                        } else {
                            if (!$_POST["only_errors"]) {
                                echo $print;
                                ob_flush();
                                flush(); // can take a long time - show the running query
                            }
                            $start = microtime(true);
                            //! don't allow changing of character_set_results, convert encoding of displayed query
                            if ($connection->multi_query($q) && is_object($connection2) && preg_match("~^$space*+USE\\b~i", $q)) {
                                $connection2->query($q);
                            }

                            do {
                                $result = $connection->store_result();

                                if ($connection->error) {
                                    echo ($_POST["only_errors"] ? $print : "");
                                    echo "<p class='error'>" . lang('Error in query') . ($connection->errno ? " ($connection->errno)" : "") . ": " . error() . "\n";
                                    $errors[] = " <a href='#sql-$commands'>$commands</a>";
                                    if ($_POST["error_stops"]) {
                                        break 2;
                                    }
                                } else {
                                    $import_msg = " <span class='time'>(" . format_time($start) . ")</span>"// 1000 - maximum length of encoded URL in IE is 2083 characters
                                    ;
                                    $affected = $connection->affected_rows; // getting warnigns overwrites this
                                    $warnings = ($_POST["only_errors"] ? "" : $driver->warnings());
                                    $warnings_id = "warnings-$commands";
                                    if ($warnings) {
                                        $time .= ", <a href='#$warnings_id'>" . lang('Warnings') . "</a>" . script("qsl('a').onclick = partial(toggle, '$warnings_id');", "");
                                    }
                                    $explain = null;
                                    $explain_id = "explain-$commands";
                                    if (is_object($result)) {
                                        $limit = $_POST["limit"];
                                        $orgtables = select($result, $connection2, array(), $limit);
                                        if (!$_POST["only_errors"]) {
                                            echo "<form action='' method='post'>\n";
                                            $num_rows = $result->num_rows;
                                            echo "<p>" . ($num_rows ? ($limit && $num_rows > $limit ? lang('%d / ', $limit) : "") . lang('%d row(s)', $num_rows) : "");
                                            echo $time;
                                            if ($connection2 && preg_match("~^($space|\\()*+SELECT\\b~i", $q) && ($explain = explain($connection2, $q))) {
                                                echo ", <a href='#$explain_id'>Explain</a>" . script("qsl('a').onclick = partial(toggle, '$explain_id');", "");
                                            }
                                            $id = "export-$commands";
                                            echo ", <a href='#$id'>" . lang('Export') . "</a>" . script("qsl('a').onclick = partial(toggle, '$id');", "") . "<span id='$id' class='hidden'>: "
                                                . html_select("output", $adminer->dumpOutput(), $adminer_export["output"]) . " "
                                                . html_select("format", $dump_format, $adminer_export["format"])
                                                . "<input type='hidden' name='query' value='" . h($q) . "'>"
                                                . " <input type='submit' name='export' value='" . lang('Export') . "'><input type='hidden' name='token' value='$token'></span>\n"
                                                . "</form>\n"
                                            ;
                                        }
                                    } else {
                                        if (preg_match("~^$space*+(CREATE|DROP|ALTER)$space++(DATABASE|SCHEMA)\\b~i", $q)) {
                                            restart_session();
                                            set_session("dbs", null); // clear cache
                                            stop_session();
                                        }
                                        if (!$_POST["only_errors"]) {
                                            echo "<p class='message' title='" . h($connection->info) . "'>" . lang('Query executed OK, %d row(s) affected.', $affected) . "$time\n";
                                        }
                                    }
                                    echo ($warnings ? "<div id='$warnings_id' class='hidden'>\n$warnings</div>\n" : "");
                                    if ($explain) {
                                        echo "<div id='$explain_id' class='hidden'>\n";
                                        select($explain, $connection2, $orgtables);
                                        echo "</div>\n";
                                    }
                                }

                                $start = microtime(true);
                            } while ($connection->more_results() && $connection->next_result());
                        }

                        $query = substr($query, $offset);
                        $offset = 0;
                    }
                }
            }
        }
    }
}
