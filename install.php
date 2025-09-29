<?php require_once "config.php"; ?>

<?php

/* If the query contains any variable input then parameterized prepared statements should be used */

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno)
    throw new RuntimeException("mysqli connection error: " . $mysqli->connect_error);
echo "Success... ", $mysqli->host_info, "<br>", PHP_EOL;
/* Set the desired charset after establishing a connection */
echo "Initial character set: ", $mysqli->character_set_name(), "<br>", PHP_EOL;
$mysqli->set_charset('utf8mb4');
if ($mysqli->errno)
    throw new RuntimeException("mysqli error: " . $mysqli->error);
echo "Current character set: ", $mysqli->character_set_name(), "<br>", PHP_EOL;

/* Non-prepared statement */
$mysqli->query("DROP TABLE IF EXISTS test");
if ($mysqli->errno)
    throw new RuntimeException("mysqli error: " . $mysqli->error);
$mysqli->query("CREATE TABLE test(myid INT, myname TEXT)");
if ($mysqli->errno)
    throw new RuntimeException("mysqli error: " . $mysqli->error);
/* Prepared statement, stage 1: prepare */
$stmt = $mysqli->prepare("INSERT INTO test(myid, myname) VALUES (?, ?)");
if ($mysqli->errno)
    throw new RuntimeException("mysqli error: " . $mysqli->error);
/* Prepared statement, stage 2: bind and execute */
$stmt->bind_param("is", $myid, $myname); /* "is" means that $id is bound as an integer and $label as a string */
if ($stmt->errno)
    throw new RuntimeException("mysqli_stmt error: " . $stmt->error);
$data =
[
    [1, "PHP"],
    [2, "Java"],
    [3, "C++"]
];
foreach ($data as $row)
{
    [$myid, $myname] = $row;
    $stmt->execute();
    if ($stmt->errno)
        throw new RuntimeException("mysqli_stmt error: " . $stmt->error);
}
/* Every prepared statement occupies server resources. Statements should be closed explicitly immediately after use */
$stmt->close();

/* Close the connection as soon as it's no longer needed */
$mysqli->close();

echo "Database is ready", "<br>", PHP_EOL;

?>