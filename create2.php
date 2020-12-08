<?php
$main_name = $_POST{"main_name"};

if (isset($_POST["review"])==true)
{
  header("location: template_test2.php?main_name=".$main_name);
  exit();
}
?>
