<?php require_once "lib.php"; ?>

<?php

$_myid = empty($_COOKIE["myid"]) ? 0 : (int) $_COOKIE["myid"];
$_myname = empty($_COOKIE["myname"]) ? "" : $_COOKIE["myname"];

echo "function_file_index_php(", $_myid, ", ", htmlspecialchars($_myname), ");<br>", PHP_EOL;

if (! $_myid || empty($_myname))
{
    /* Redirect browser */
    header("Location: login.php");
    exit();
}

$mysqli = start_sql();
$result = select_from_table($mysqli);
stop_sql($mysqli);

require_once "tindex.php";

?>