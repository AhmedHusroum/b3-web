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
            <a class="buttons" href="create.php">Nieuwe taak &gt;</a>
            <form action="" method="GET">
                <select name="status">
                    <option value="">- Kies de afdeling -</option>
                    <option value="Not Done">Doing & To Do</option>
                    <option value="Done">Done</option>
                </select>
                <input type="submit" value="filter">
            </form>  


        </div>
        <a class="buttons" href="afdeling.php">Afdeling&gt;</a>
        <a class="buttons"   href="my.php">Eigen Taken&gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
        require_once '../backend/conn.php';
        if(isset($_GET['status']) && $_GET['status'] == "Done")
        {
            $query = "SELECT * FROM taken WHERE status = :status ORDER BY deadline ASC";
            $statement = $conn->prepare($query);
            $statement->execute([":status" => 'Done']);
        }
        elseif(isset($_GET['status']) && $_GET['status'] == "Not Done")
        {
            $query = "SELECT * FROM taken WHERE status != :status ORDER BY deadline ASC";
            $statement = $conn->prepare($query);
            $statement->execute([":status" => 'Done']);
        }
        else
        {
            $query = "SELECT * FROM taken WHERE status = :status OR status = :status2 OR status = :status3 ORDER BY deadline ASC";
            $statement = $conn->prepare($query);
            $statement->execute([":status" => 'Done', ":status2" => 'To Do', ":status3" => 'Doing']);
        }
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
