<?php

require "banco.php";
require "src/repository/RepositorioProdutos.php";

$repositorio_produtos = new RepositorioProdutos($pdo);
$repositorio_produtos->remover_produto($_POST['id']);

header('Location: admin.php');
die();