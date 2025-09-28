<?php require_once "config.php"; ?>

<?php

$_id = empty($_POST["id"]) ? 0 : (int) $_POST["id"];
$_label = empty($_POST["label"]) ? "" : $_POST["label"];

echo "function_file_index_php(", $_id, ", ", htmlspecialchars($_label), ");<br>", PHP_EOL;

if (! $_id || ! $_label)
{
    require_once "templates.php";
    exit();
}

?><?php

/* If the query contains any variable input then parameterized prepared statements should be used */

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
    throw new RuntimeException("mysqli connection error: " . $mysqli->connect_error);
}
echo "Success... ", $mysqli->host_info, "<br>", PHP_EOL;
/* Set the desired charset after establishing a connection */
echo "Initial character set: ", $mysqli->character_set_name(), "<br>", PHP_EOL;
$mysqli->set_charset('utf8mb4');
if ($mysqli->errno) {
    throw new RuntimeException("mysqli error: " . $mysqli->error);
}
echo "Current character set: ", $mysqli->character_set_name(), "<br>", PHP_EOL;

$stmt = $mysqli->prepare("SELECT id, label FROM test");
if ($mysqli->errno) {
    throw new RuntimeException("mysqli error: " . $mysqli->error);
}
$stmt->execute();
if ($stmt->errno) {
    throw new RuntimeException("mysqli_stmt error: " . $stmt->error);
}
$result = $stmt->get_result();
if ($stmt->errno) {
    throw new RuntimeException("mysqli_stmt error: " . $stmt->error);
}
/* Every prepared statement occupies server resources. Statements should be closed explicitly immediately after use */
$stmt->close();

/* Close the connection as soon as it's no longer needed */
$mysqli->close();

?>

<?php require_once "templated.php"; ?>