<?php
// for each input add post
//echo('hi');
//var_dump($_POST);

$tablename = $_POST['tablename'];
$column = [];
foreach ($_POST as $key => $data){

    if ($key !== 'tablename'){
        $arrayNum = substr($key, -1);

        $column[$arrayNum][] = $data;
    }

}
// changer le fichier php avec les valeurs du tableau
echo('<pre>');
var_dump($column);
// get $nom replace all dans le fichier