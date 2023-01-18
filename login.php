<!doctype html>
<html lang="nl">

<head>
	<?php require_once 'head.php'; ?>
</head>
<header>
	<?php require_once 'header.php'; ?>
</header>

<form action="backend/loginController.php" method="POST">
<main>
	<div class="form-group">
		<label for="username">Gebruikersnaam:</label>
		<input type="text" name="username" id="username">
	</div>

	<div class="form-group">
		<label for="password">Wachtwoord:</label>
		<input type="password" name="password" id="password">
	</div>
	<input type="submit"value="Login">
</main>
</form>