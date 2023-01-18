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
    <title>Takenlijst / Toevoegen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <main>
        <h1>Nieuwe Taak</h1>

        <form action="../backend/takenController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="titel">Titel: </label>
                <input type="text" name="titel" id="titel" class="form-input">
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving: </label>
                <textarea type="textarea" name="beschrijving" id="beschrijving" class="form-input" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="type">Afdeling: </label>
                <select name="afdeling" id="afdeling">
                    <option value="">Kies een afdeling</option>
                    <option value="personeel">personeel</option>
                    <option value="horeca">horeca</option>
                    <option value="techniek">techniek</option>
                    <option value="">inkoop</option>
                    <option value="klantenservice">klantenservice</option>
                    <option value="groen">groen</option>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" value="To Do" name="status">
            </div>

            <div class="form-group">
                <input type="hidden" value="To Do" name="status">
            </div>

            <div class="form-group">
                <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user">
            </div>

             <label for="beschrijving">Deadline: </label>
                <input  type="date" required name="deadline"  class="form-input" />

            <input type="submit" value="Verstuur melding">

        </form>

    </main>


</body>

</html>