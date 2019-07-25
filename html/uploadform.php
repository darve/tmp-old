<?

echo "asdasdasd";
include_once("includes/classes/db_submit.php");

$submit = new db_submit();

$result = $submit->processform();

$submit->getSingle();

$sent = $submit->sendconfirm();

echo $sent;
?>
