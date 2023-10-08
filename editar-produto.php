<?php 
require "banco.php";
require "src/repository/RepositorioProdutos.php";
require "src/models/Produto.php";

$repositorio_produtos = new RepositorioProdutos($pdo);

if (isset($_POST['editar'])) {
  $novoProduto = new Produto(
    $_GET['id'],
    $_POST['tipo'] ?? $produto->getTipo(),
    $_POST['nome'] ?? $produto->getNome(),
    $_POST['descricao'] ?? $produto->getDescricao(),
    $_POST['preco'] ?? $produto->getPreco(),
  );

  if (isset($_FILES['imagem'])) {
    $novoProduto->setImagem(uniqid() . $_FILES['imagem']['name']);
    move_uploaded_file($_FILES['imagem']['tmp_name'], $novoProduto->getImagemDiretorio());
  }

  $repositorio_produtos->editar_produto($novoProduto);
  header('Location: admin.php');
  die();
} else {
  $produto = $repositorio_produtos->buscar_produto($_GET['id']);
}

?>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Editar Produto</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <a href="admin.php"><img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto"></a>
    <h1>Editar Produto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <section class="container-form">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $produto->getId()?>">


      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" value="<?= $produto->getNome() ?>" required>

      <div class="container-radio">
        <div>
            <label for="cafe">Café</label>
            <input type="radio" id="cafe" name="tipo" value="Café" <?= $produto->getTipo() == 'Café' ? "checked" : "" ?>>
        </div>
        <div>
            <label for="almoco">Almoço</label>
            <input type="radio" id="almoco" name="tipo" value="Almoço" <?= $produto->getTipo() == 'Almoço' ? "checked" : "" ?>>
        </div>
    </div>

      <label for="descricao">Descrição</label>
      <input type="text" id="descricao" name="descricao" value="<?= $produto->getDescricao() ?>" required>

      <label for="preco">Preço</label>
      <input type="text" id="preco" name="preco" value="<?= $produto->getPrecoFormatado() ?>" required>

      <label for="imagem">Envie uma imagem do produto</label>
      <input type="file" name="imagem" accept="image/*" id="imagem" value="<?= $produto->getImagem() ?>">

      <input type="submit" name="editar" class="botao-cadastrar"  value="Editar produto"/>
    </form>

  </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>