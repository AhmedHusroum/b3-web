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
    <title></title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <?php require_once '../header.php'; ?>
    
    <main>
        <h1>Taken</h1>
        <div class="filter">
            <a class="buttons2" href="create.php">Nieuwe taak &gt;</a>


        </div>
        <a class="buttons" href="index.php">Taken&gt;</a>
        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM taken WHERE user = :user_id ORDER BY deadline ASC";
        $statement = $conn->prepare($query);
        $statement->execute([":user_id" => $_SESSION['user_id']]);
        $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>


        <table>
            <tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Afdeling</th>
                <th>Status</th>
                <th>Gebruiker</th>
                <th>Deadline</th>
                <th>Aanpassen</th>
            </tr>


        <?php foreach ($taken as $taak):?>

            <tr>
                <td><?php echo $taak['titel']; ?></td>
                <td><?php echo $taak['beschrijving']; ?></td>
                <td><?php echo $taak['afdeling']; ?></td>
                <td><?php echo $taak['status']; ?></td>
                <td><?php echo $taak['user'] ?></td>
                <td><?php echo $taak['deadline']; ?></td>
                <td><a href="edit.php?id=<?php echo $taak['id']; ?>">Aanpassen</a></td>
            </tr>

        <?php endforeach; ?>
        </table>
      
    </main>

</body>

</html>