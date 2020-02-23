<?php
    // include ("toolBox.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="js/javascript0.js"></script>
    <link rel="shortcut icon" type="image/png" href="./images/logo.png"/>
    <!--link polices-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto|Ubuntu&display=swap" rel="stylesheet">
    <!--link icones-->
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/70c8e4b57f.js" crossorigin="anonymous"></script>
    <!--link bootsrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--link jquery-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>ZALZALI Ahmad</title>
    <meta name="description" content="Curriculum Vitae de ZALZALI Ahmad Technicien développeur en formation" />
</head>

<body onload="typeWriter() ; monTips()" >
<div class="container">
<div class="row">

        <div id="header" class="col-12 sticky-top">
            <?php include ("menu.php"); ?>
        </div>

        <div id="middle" class="col-12">
            <?php include ("contenu.php"); ?>
        </div>

        <div id="footer" class="fixed-bottom">
            <?php include ("footer.php"); ?>
        </div>

</div>
</div>
    <script src="js/javascript0.js"></script>

</body>
</html>