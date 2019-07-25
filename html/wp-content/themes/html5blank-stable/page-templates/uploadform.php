<?php
session_start();
/**
 * Template Name: Upload form
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

include(TEMPLATEPATH . "/web/includes/classses/db_submit.php");
$submission = db_submission();

$result = $submission->processform();
?>
