<?php
session_start();
ini_set('display_errors','on');
error_reporting(E_ALL);
include ('configuration.php');
include('./model/class.database.php');

function __autoload($class_name) {
    include './model/class.'. $class_name . '.php';
}

include_once('controllers/controller1.php');
include ('view/vues1.php');
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Framework MVC</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<h1>Nouveau Model</h1>
<?php include ('view/v_newmodel.php');?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="script.js"></script>
</html>
<script>
</script>


