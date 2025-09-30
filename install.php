<?php require_once "lib.php"; ?>

<?php

$mysqli = start_sql();
create_table($mysqli);

$data =
[
    [1, "PHP"],
    [2, "Java"],
    [3, "C++"]
];

$myid = 0;
$myname = "";

insert_into_table($mysqli, $data, $myid, $myname);
stop_sql($mysqli);

echo "Database is ready", "<br>", PHP_EOL;

?>