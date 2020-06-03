<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Hallo: Gnoo</h2>
    <?php
    if(isset($_GET['muh'])) :
        ?>
        <h3><?php echo $_GET['muh']; ?></h3>
        <?php
    endif;
    ?>
</body>
</html>