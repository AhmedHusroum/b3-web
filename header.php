<?php require_once 'backend/config.php'; ?>


<div class="header">
     <img src="<?php echo $base_url;  ?>/img/background.png" alt="background" class="background-image">

  <div class="header-right">
    <a class="active" href="<?php echo $base_url; ?>/index.php">Home</a>
    <a href="<?php echo $base_url; ?>/taken/index.php">Taken</a>
    <?php  
    if(!isset($_SESSION['user_id']))
    { ?>
        <a href="<?php echo $base_url; ?>/login.php">Inloggen</a>
        <?php  
    }
    else
    { ?>
        <a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a>
        <?php  
    }
    ?> 
  </div>

</div>

