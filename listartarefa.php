<?php

include_once "conexao.php";
session_start();
$usuario_id=$_SESSION['id'];

$conexao = new conexao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">

    <style>
        body{
            background-image: none;
        }
    </style>
    <title>Tarefas</title>
</head>
<body>
<h1>Lista de tarefa</h2>
</br>
<div class="tab">
<a href="cadastro_tarefa.php"> Criar tarefa </a>
<div class="esqueceu">
<span>Trocar a senha?</span>
<a href="recuperars.php?acao=2">Trocar</a>
</div>
<div class="classificacao" id="classificacao">
<div class="classificar" id="classificar" onmouseover="classificarTarefa()">
    <p>Classificar tarefas</p>
</div><!--classificar-->
<div class="clicar" id="clicar" style="display: none;">
    <a href="listartarefa.php?ordem=criacao"><p>Data criação</p></a>
    <a href="listartarefa.php?ordem=conclusao"><p>Data conclusão</p></a>
</div><!--clicar-->
</div><!--classificacao-->

<table id="tabela-tarefas">

    <tr>
        <th>titulo</th>
        <th>descrição</th>
        <th>Data criação</th>
        <th>data conclusão</th>
        <th>ALTERAR</th>
        <th>EXCLUIR</th>
        <th>STATUS</th>
    </tr>
</div>
  <?php
  $ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'conclusao';
  $arrtarefa = $conexao->executar("select * from tarefas where usuario_id ='$usuario_id' order by data_$ordem asc");
   
   foreach ($arrtarefa as $tarefa){
     ?>

     <tr class="tarefa" id="tarefa-<?= $tarefa['id'] ?>">
        <td><?=$tarefa['titulo']?></td>
        <td><?php echo $tarefa['descricao']; ?></td>
        <td><?=$tarefa['data_criacao']?></td>
        <td><?=$tarefa['data_conclusao']?></td>
        <td>
            <a href="cadastro_tarefa.php?tarefa=<?=$tarefa['id']?>">Alterar</a>
        </td>
        <td>
        <a href="acao.php?tarefa=<?=$tarefa['id']?>&acao=5">Excluir</a>

        </td>
        <td class="pendencia">
        <p id="status">Pendente<span><p class="alterar" onclick="modificarPendencia()">Alterar</p></span></p>
        </td>
     </tr>
     <?php   
   }
  ?>
</table>
</div>
<script src="validar.js"></script>
</body>
</html>
<?php
if(isset($_GET['acao']) ){
?>
<div class="alert alert-success">
<?php
if($_GET['acao']==1 || $_GET['acao']==5 )
{
    echo "Salvo com sucesso!";
}else if($_GET['acao']==3){
    echo "Alterado com sucesso!";
}else if($_GET['acao']==4){
    echo "Excluido com sucesso!";
}
?>

</div>

<?php
}
?>