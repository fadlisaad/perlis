<?php
require ('conn.php');

$config_filename = 'config.json';
if (!file_exists($config_filename)) {
    throw new Exception("Can't find ".$config_filename);
}
$config = json_decode(file_get_contents($config_filename), true);

if($config['fpx']['environment'] == 'Staging'){
	$stm = $pdo->query("SELECT * FROM agencies WHERE code LIKE '%STG'");
} else {
	$stm = $pdo->query("SELECT * FROM agencies");
}

$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

$list = NULL;
foreach ($rows as $value) {
	$list .= '<option value="'.$value['code'].'" data-id="'.$value['id'].'" data-email="'.$value['email'].'">'.$value['name'].'</option>';
}

echo $list;