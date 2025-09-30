<?php require_once "config.php"; ?>

<?php

/* If the query contains any variable input then parameterized prepared statements should be used */

function free_result($result)
{
    $result->close();
}

function stop_sql($mysqli)
{
    /* Close the connection as soon as it's no longer needed */
    $mysqli->close();
}

function start_sql()
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    echo "Success... ", $mysqli->host_info, "<br>", PHP_EOL;
    /* Set the desired charset after establishing a connection */
    echo "Initial character set: ", $mysqli->character_set_name(), "<br>", PHP_EOL;
    $mysqli->set_charset('utf8mb4');
    echo "Current character set: ", $mysqli->character_set_name(), "<br>", PHP_EOL;
    return $mysqli;
}

function create_table($mysqli)
{
    /* Non-prepared statement */
    $mysqli->query("DROP TABLE IF EXISTS test");
    $mysqli->query("CREATE TABLE test(myid INT, myname TEXT)");
}

function insert_into_table($mysqli, $arg0, $arg1, ...$args)
{
    /* Prepared statement, stage 1: prepare */
    $stmt = $mysqli->prepare("INSERT INTO test(myid, myname) VALUES (?, ?)");
    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("is", $arg1, ...$args); /* "is" means that $id is bound as an integer and $label as a string */

    foreach ($arg0 as $row)
    {
        $i = 0;
        $arg1 = $row[$i++];
        foreach ($args as &$arg)
            $arg = $row[$i++];

        $stmt->execute();
    }
    /* Every prepared statement occupies server resources. Statements should be closed explicitly immediately after use */
    $stmt->close();
}

function select_from_table($mysqli)
{
    $stmt = $mysqli->prepare("SELECT myid, myname FROM test");
    $stmt->execute();
    $result = $stmt->get_result();
    /* Every prepared statement occupies server resources. Statements should be closed explicitly immediately after use */
    $stmt->close();
    return $result;
}

?>