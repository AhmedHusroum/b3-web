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
                <select name="afdeling">
                    <option value="">- Kies status om te filteren -</option>
                    <option value="personeel">Personeel</option>
                    <option value="horeca">Horeca</option>
                    <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</option>
                </select>
                <input type="submit" value="filter">
            </form>  


        </div>
        <a class="buttons" href="index.php">Taken&gt;</a>
        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
        require_once '../backend/conn.php';
        if(isset($_GET['afdeling']) && $_GET['afdeling'] == "personeel")
        {
            $query = "SELECT * FROM taken WHERE afdeling = 'personeel' ORDER BY deadline ASC";
        }
        else if(isset($_GET['afdeling']) && $_GET['afdeling'] == "horeca")
        {
            $query = "SELECT * FROM taken WHERE afdeling = 'horeca' ORDER BY deadline ASC";
        }
        else if(isset($_GET['afdeling']) && $_GET['afdeling'] == "techniek")
        {
            $query = "SELECT * FROM taken WHERE afdeling = 'techniek' ORDER BY deadline ASC";
        }
        else if(isset($_GET['afdeling']) && $_GET['afdeling'] == "inkoop")
        {
            $query = "SELECT * FROM taken WHERE afdeling = 'inkoop' ORDER BY deadline ASC";
        }
        else if(isset($_GET['afdeling']) && $_GET['afdeling'] == "klantenservice")
        {
            $query = "SELECT * FROM taken WHERE afdeling = 'klantenservice' ORDER BY deadline ASC";
        }
        else if(isset($_GET['afdeling']) && $_GET['afdeling'] == "groen")
        {
            $query = "SELECT * FROM taken WHERE afdeling = 'groen' ORDER BY deadline ASC";
        }
        else
        {
            $query = "SELECT * FROM taken ORDER BY deadline ASC";
        }
        $statement = $conn->prepare($query);
        $statement->execute();
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