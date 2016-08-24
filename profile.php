<?php
  acf_form_head();
  $context = Timber::get_context();
  $user = wp_get_current_user();
  if(!$user->ID) {
    wp_redirect('/');
  }
  $user->image = new TimberImage($user->image);
  $context['user'] = $user;

  $form_args = [
    'post_type' => 'user-form',
    'meta_key' => 'user',
    'meta_value' => $user->ID
  ];
  $forms = Timber::get_posts($form_args);
  $context['form'] = array_shift($forms);

  Timber::render('profile.twig', $context);
?>
