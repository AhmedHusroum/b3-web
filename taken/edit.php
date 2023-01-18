<?php 
session_start();
?>
<?php  
if(!isset($_SESSION['user_id']))
{ 
    $msg="Je moet eerst inloggen!";
    header("Location:../login.php?msg=$msg");
}
?> 
<!doctype html>
<html lang="nl">

<head>
    <title>TakenList / Taken / Aanpassen</title>
    <?php require_once '../head.php'; ?>
</head>
<body>

    <main>

        <h1>Taak aanpassen</h1>
        <?php
        $id = $_GET['id'];

        require_once'../backend/conn.php';

        $query = "SELECT * FROM taken WHERE id = :id";

        $statement = $conn->prepare($query);

        $statement->execute([
            ":id" => $id
        ]);


        $taak = $statement->fetch(PDO::FETCH_ASSOC);

        ?>

        <form action="../backend/takenController.php" method="POST">
            <input type="hidden" name="action" value="update">
             <input type="hidden" name="id" value="<?php echo 
             $taak ['id'];?>">

            <div class="form-group">
                <label for="titel">Titel: </label>
                <input type="text" name="titel" id="titel" value="<?php echo $taak['titel']; ?>" class="form-input">
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving: </label>
                <textarea type="textarea" name="beschrijving" id="beschrijving" class="form-input" rows="4"> <?php echo $taak['beschrijving']; ?> </textarea>
            </div>
            <div class="form-group">
                <label for="type">Afdeling: </label>
                <select name="afdeling"  id="afdeling" >
                    <option value="<?php echo $taak['afdeling'] ?>"><?php echo $taak['afdeling'] ?></option>
                    <option value="personeel">personeel</option>
                    <option value="horeca">horeca</option>
                    <option value="techniek">techniek</option>
                    <option value="">inkoop</option>
                    <option value="klantenservice">klantenservice</option>
                    <option value="groen">groen</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status: </label>
                <select name="status" id="status">
                    <option value="<?php echo $taak['status'] ?>"><?php echo $taak['status'] ?></option>
                    <option value="To do">To do</option>
                    <option value="Doing">Doing</option>
                    <option value="Done">Done</option>
                </select>
            </div>


            <div class="form-group">

            <label for="date">Deadline: </label>
                <input type="date" required name="deadline" value="<?php echo $id; ?>">
                </div>
                
            </div>

            <input type="submit" value="Aanpassen">
            <form action="../backend/takenController.php" method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
            </form>

            <form action="../backend/takenController.php" method="POST">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input action="delete" type="submit" value="Verwijderen">
            </form>

        </form>
    </main>
</body>