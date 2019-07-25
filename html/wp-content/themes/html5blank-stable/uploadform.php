<?
include_once("web/includes/classses/db_submit.php");
$submission = db_submission();

$result = $submission->processform();
?>
