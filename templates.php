<?php

if ( RES_LANGUAGE == "中文" ) {
define("RES_TITLE", "HTML 表单");
define("RES_ID", "标识");
define("RES_LABEL", "标签");
define("RES_TEXT", "如果你点击提交按钮，表单数据将被发送到 index.php 页面。");
} else {
define("RES_TITLE", "HTML Forms");
define("RES_ID", "id");
define("RES_LABEL", "label");
define("RES_TEXT", "If you click the \"Submit\" button, the form-data will be sent to a page called \"index.php\".");
}

?>

<!DOCTYPE html>
<html>
<body>

<?php

echo "<h2>", RES_TITLE, "</h2>", PHP_EOL;

echo "<form method=\"post\" action=\"index.php\">", PHP_EOL;
echo "  <label for=\"id\">", RES_ID, "</label><br>", PHP_EOL;
echo "  <input type=\"text\" id=\"id\" name=\"id\" value=\"1\"><br>", PHP_EOL;
echo "  <label for=\"label\">", RES_LABEL, "</label><br>", PHP_EOL;
echo "  <input type=\"text\" id=\"label\" name=\"label\" value=\"PHP\"><br><br>", PHP_EOL;
echo "  <input type=\"submit\" value=\"Submit\">", PHP_EOL;
echo "</form>", PHP_EOL;

echo "<p>", RES_TEXT, "</p>", PHP_EOL;

?>

</body>
</html>