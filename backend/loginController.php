<?php 
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

require_once'conn.php';
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([":username" => $username]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($statement->rowCount() < 1)
{	
	$msg = "Account niet gevonden!";
    header("Location:../login.php?msg=$msg");
}

if(!password_verify($password,$user['password']))
{
		$msg = "Onjuist Wachtwoord";
        header("Location:../login.php?msg=$msg");
}

$_SESSION['user_id'] = $user['id'];

header("Location: ../index.php?msg=Succesvol Ingelogd!");
?>