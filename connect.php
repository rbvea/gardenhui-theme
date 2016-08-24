<?php
  use Qaribou\Collection\ImmArray;

  if(isset($_ENV['PANTHEON_ENVIRONMENT']) && $_ENV['PANTHEON_ENVIRONMENT'] == 'live' ) {
    wp_redirect('/');
  }
  $context = Timber::get_context();
  $users = ImmArray::fromArray(get_users(['fields' => 'all_with_meta']));
  $context['users'] = $users;
  Timber::render('connect.twig', $context);
?>
