<?php
require_once('models/memple');

$memple = Memple();

$idservi = isset($_REQUEST['idservi']) ? $_REQUEST['idservi']: NULL;
$idemple = isset($_REQUEST['idemple']) ? $_REQUEST['idemple']: NULL;
$nit = isset($_POST['nit']) ? $_POST['nit']: NULL;
$precio = isset($_POST['precio']) ? $_POST['precio']: NULL;
$tiposervi = isset($_POST['tiposervi']) ? $_POST['tiposervi']: NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;
?>