<?php
  use Qaribou\Collection\ImmArray;

  foreach($_POST['acf'] as $key => $val) {
    $field = acf_get_field($key);
    $name = $field['name'];
    $current_user = wp_get_current_user();
    if(!$current_user->ID) {
      return;
    }
    update_user_meta($current_user->ID, $name, $val);
    update_user_meta($current_user->ID, "_{$name}", $key);
  }

  if(isset($_POST['image'])) {
    update_user_meta($current_user->ID, 'image', $_POST['image']);
  }
  
  wp_redirect('/profile');


?>
