<?php require_once "config.php"; ?>

<?php

$_myid = empty($_COOKIE["myid"]) ? 0 : (int) $_COOKIE["myid"];
$_myname = empty($_COOKIE["myname"]) ? "" : $_COOKIE["myname"];

echo "function_file_index_php(", $_myid, ", ", htmlspecialchars($_myname), ");<br>", PHP_EOL;

if (! $_myid || ! $_myname)
{
    header("Location: login.php");
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

if ( RES_LANGUAGE == "中文" )
{
  define("RES_TITLE", "基础 HTML 表格");
  define("RES_MATCHED", "匹配");
  define("RES_ID", "标识");
  define("RES_NAME", "名字");
  define("RES_TEXT", "为了更好的理解例子，我们对表格添加了边框。");
}
else
{
  define("RES_TITLE", "A basic HTML table");
  define("RES_MATCHED", "matched");
  define("RES_ID", "id");
  define("RES_NAME", "name");
  define("RES_TEXT", "To understand the example better, we have added borders to the table.");
}

?>

<!DOCTYPE html>
<html>
<style>
table
{
  border-collapse: collapse;
  width: 100%;
}
th, td
{
  text-align: left;
  padding: 8px;
}
tr:nth-child(even)
{
  background-color: #D6EEEE;
}
</style>
<body>

<?php 

echo "<h2>", RES_TITLE, "</h2>", PHP_EOL;

echo "<table>", PHP_EOL;
echo "  <tr>", PHP_EOL;
echo "    <th>", RES_MATCHED, "</th>", PHP_EOL;
echo "    <th>", RES_ID, "</th>", PHP_EOL;
echo "    <th>", RES_NAME, "</th>", PHP_EOL;
echo "  </tr>", PHP_EOL;

/* Processing of the data retrieved from the database */
for ($row_no = 0; $row_no < $result->num_rows; $row_no++)
{
  $result->data_seek($row_no);
  $row = $result->fetch_assoc();
  echo "  <tr>", PHP_EOL;
  echo "    <td>", $row["myid"] === $_myid && $row["myname"] === $_myname ? "yes" : "no", "</td>", PHP_EOL;
  echo "    <td>", $row["myid"], " ( ", gettype($row["myid"]), " ) ", "</td>", PHP_EOL;
  echo "    <td>", $row["myname"], " ( ", gettype($row["myname"]), " ) ", "</td>", PHP_EOL;
  echo "  </tr>", PHP_EOL;
}

$result->close();

echo "</table>", PHP_EOL;

echo "<p>", RES_TEXT, "</p>", PHP_EOL;

?>

</body>
</html>