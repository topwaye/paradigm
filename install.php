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

insert_into_table($mysqli, $data, 0, "");
stop_sql($mysqli);

echo "Database is ready", "<br>", PHP_EOL;

?>