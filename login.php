<?php require_once "config.php"; ?>

<?php

$_myid = empty($_POST["myid"]) ? 0 : (int) $_POST["myid"];
$_myname = empty($_POST["myname"]) ? "" : $_POST["myname"];

echo "function_file_login_php(", $_myid, ", ", htmlspecialchars($_myname), ");<br>", PHP_EOL;

if (! $_myid || empty($_myname))
{
    require_once "tlogin.php";
    exit();
}

?><?php

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

$stmt = $mysqli->prepare("SELECT myid, myname FROM test");
if ($mysqli->errno)
    throw new RuntimeException("mysqli error: " . $mysqli->error);
$stmt->execute();
if ($stmt->errno)
    throw new RuntimeException("mysqli_stmt error: " . $stmt->error);
$result = $stmt->get_result();
if ($stmt->errno)
    throw new RuntimeException("mysqli_stmt error: " . $stmt->error);
/* Every prepared statement occupies server resources. Statements should be closed explicitly immediately after use */
$stmt->close();

/* Close the connection as soon as it's no longer needed */
$mysqli->close();

?><?php

/* Processing of the data retrieved from the database */
for ($row_no = 0; $row_no < $result->num_rows; $row_no++)
{
    $result->data_seek($row_no);
    $row = $result->fetch_assoc();

    if ($row["myid"] === $_myid && $row["myname"] === $_myname)
    {
        if (empty($_COOKIE["myid"]))
            setcookie("myid", (string) $_myid, time() + 3600);
        if (empty($_COOKIE["myname"]))
            setcookie("myname", $_myname, time() + 3600);
        /* Redirect browser */
        header("Location: index.php");

        $result->close();
        exit();
    }
}

$result->close();

echo "id or name not found<br>", PHP_EOL;

if (! empty($_COOKIE["myid"]))
    setcookie("myid", "", time() - 3600);
if (! empty($_COOKIE["myname"]))
    setcookie("myname", "", time() - 3600);

require_once "tlogin.php";

?>