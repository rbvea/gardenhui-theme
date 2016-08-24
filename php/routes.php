<?php
	Routes::map('/register', function($params) {
		Routes::load("register.php");
	});

	Routes::map('/signup', function($params) {
		Routes::load("signup.php");
	});

	Routes::map('/profile', function($params) {
		Routes::load("profile.php");
	});

	Routes::map('/connect', function($params) {
		Routes::load("connect.php");
	});

	Routes::map('/form/:id/', function($params) {
		Routes::load("form.php", $params);
	});

	Routes::map('/update-profile/', function() {
		Routes::load('controllers/update-profile.php');
	});

	Routes::map('/ajax/image-upload/', function() {
		Routes::load('controllers/process-image.php');
	});

?>
