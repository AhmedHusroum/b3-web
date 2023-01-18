<?php
$action = $_POST['action'];

if($action == 'create')
{

		$titel = $_POST['titel'];

		$beschrijving = $_POST['beschrijving'];

		$afdeling = $_POST['afdeling'];

		$status = $_POST['status'];

		$deadline = $_POST['deadline'];

		$user = $_POST['user'];
	


	require_once 'conn.php';



	$query = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline)
	VALUES(:titel, :beschrijving, :afdeling, :status, :deadline)";

	$query = "INSERT INTO taken (titel, beschrijving, afdeling, user, status, deadline)
	VALUES(:titel, :beschrijving, :afdeling, :user, :status, :deadline)";


	$statement = $conn->prepare($query);

	$statement->execute([
		":titel" => $titel,
		":beschrijving" => $beschrijving,
		":afdeling" => $afdeling,
		":user" => $user,
		":status" => $status,
		":deadline" => $deadline
	]);
	 header("Location: ".$base_url."/taken/index.php");

}
if($action == 'delete')
{
	$id = $_POST['id'];
	
	require_once 'conn.php';

	$query = "DELETE FROM taken WHERE id = :id";

	$statement = $conn->prepare($query);

	$statement->execute([
		":id" => $id
	]);
	header("Location: ../index.php?msg=Melding verwijderd!");
}

if ($action == 'update'){
	$titel = $_POST['titel'];
	$beschrijving = $_POST['beschrijving'];
	$id = $_POST['id'];
	$afdeling = $_POST['afdeling'];
	$user = $_POST['user'];
	$status = $_POST['status'];
	$deadline = $_POST['deadline'];

	require_once 'conn.php';
	$query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status, deadline = :deadline WHERE id = :id";

	$query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, user = :user, status = :status, deadline = :deadline WHERE id = :id";
	$statement = $conn->prepare($query);
	$statement->execute([
	":titel" => $titel,
	":beschrijving" => $beschrijving,
	":afdeling" => $afdeling,
	":user" => $user,
	":status" => $status,
	":deadline" => $deadline,
	":id" => $id
	]);

	header("Location:../taken/index.php?msg=Melding Aangepast!");

}