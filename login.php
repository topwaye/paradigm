<?php require_once "lib.php"; ?>

<?php

$_myid = empty($_POST["myid"]) ? 0 : (int) $_POST["myid"];
$_myname = empty($_POST["myname"]) ? "" : $_POST["myname"];

echo "function_file_login_php(", $_myid, ", ", htmlspecialchars($_myname), ");<br>", PHP_EOL;

if (! $_myid || empty($_myname))
{
    require_once "tlogin.php";
    exit();
}

$mysqli = start_sql();
$result = select_from_table($mysqli);
stop_sql($mysqli);

/* Processing of the data retrieved from the database */
for ($row_no = 0; $row_no < $result->num_rows; $row_no++)
{
    $result->data_seek($row_no);
    $row = $result->fetch_assoc();

    if ($row["myid"] === $_myid && $row["myname"] === $_myname)
    {
        /* Patch: Do NOT do if(empty($_COOKIE["myid"])) */

        /* expire in 1 hour */
        setcookie("myid", (string) $_myid, time() + 3600);
        setcookie("myname", $_myname, time() + 3600);
        /* Redirect browser */
        header("Location: index.php");

        free_result($result);
        exit();
    }
}

free_result($result);

echo "id or name not found<br>", PHP_EOL;

/* set the expiration date to one hour ago to delete cookies */
if (! empty($_COOKIE["myid"]))
    setcookie("myid", "", time() - 3600);
if (! empty($_COOKIE["myname"]))
    setcookie("myname", "", time() - 3600);

require_once "tlogin.php";

?>