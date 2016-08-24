<?php
  global $params;
  acf_form_head();
  $context = Timber::get_context();
  $context['params'] = $params;

  Timber::render('form.twig', $context);
?>
