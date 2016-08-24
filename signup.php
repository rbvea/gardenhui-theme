<?php

  /**
   *  Registers user
   */
  if(!isset($_POST['first_name']) ||
    !isset($_POST['last_name']) ||
    !isset($_POST['email'])
  ) {
    wp_redirect('/register');
  }

  $first_name = strtolower($_POST['first_name']);
  $last_name = strtolower($_POST['last_name']);
  $args = [
    'user_login' => "{$first_name}.{$last_name}",
    'user_email' => $_POST['email'],
    'user_pass' => $_POST['password']
  ];
  $user_id = wp_insert_user($args);

  if($_POST['image']) {
    update_user_meta($user_id, 'image', $_POST['image']);
  }

  if(! is_wp_error($user_id)) {
    foreach($_POST['acf'] as $key => $val) {
      $field = acf_get_field($key);
      $name = $field['name'];
      update_user_meta($user_id, $name, $val);
      update_user_meta($user_id, "_{$name}", $key);
    }

    // create new form
    $form_args = [
      'post_type' => 'user-form',
      'post_title' => "{$first_name} {$last_name}",
      'post_status' => 'publish'
    ];
    $id = wp_insert_post($form_args);

    update_user_meta($id, "_user", "field_57a686587198d");
    update_user_meta($id, "user", $user_id);

    update_user_meta($id, "_completed", 'field_57a686797198e');
    update_user_meta($id, "completed", 0);

    wp_redirect('/signup-success');
  } else {
    wp_redirect('/register');
  }




?>
