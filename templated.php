<?php

if ( RES_LANGUAGE == "中文" ) {
define("RES_TITLE", "基础 HTML 表格");
define("RES_MATCHED", "匹配");
define("RES_ID", "标识");
define("RES_LABEL", "标签");
define("RES_TEXT", "为了更好的理解例子，我们对表格添加了边框。");
} else {
define("RES_TITLE", "A basic HTML table");
define("RES_MATCHED", "matched");
define("RES_ID", "id");
define("RES_LABEL", "label");
define("RES_TEXT", "To understand the example better, we have added borders to the table.");
}

?>

<!DOCTYPE html>
<html>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
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
echo "    <th>", RES_LABEL, "</th>", PHP_EOL;
echo "  </tr>", PHP_EOL;

/* Processing of the data retrieved from the database */
for ($row_no = 0; $row_no < $result->num_rows; $row_no++) {
  $result->data_seek($row_no);
  $row = $result->fetch_assoc();
  echo "  <tr>", PHP_EOL;
  echo "    <td>", $row["id"] === $_id && $row["label"] === $_label ? "yes" : "no", "</td>", PHP_EOL;
  echo "    <td>", $row["id"], " ( ", gettype($row["id"]), " ) ", "</td>", PHP_EOL;
  echo "    <td>", $row["label"], " ( ", gettype($row["label"]), " ) ", "</td>", PHP_EOL;
  echo "  </tr>", PHP_EOL;
}

$result->close();

echo "</table>", PHP_EOL;

echo "<p>", RES_TEXT, "</p>", PHP_EOL;

?>

</body>
</html>