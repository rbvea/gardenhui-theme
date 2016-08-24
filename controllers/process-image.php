<?php
  $file = array_shift($_FILES);
  $file_return = wp_handle_upload($file, ['test_form' => FALSE]);
  die(json_encode($file_return));
?>
