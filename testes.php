<?php 	
	require_once 'C:\xampp\htdocs\CRUD_POO\classes\class_usuarios.php';	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>CRUD-POO</title>
</head>
<body>
	<?php $usuario = new Usuarios(); ?>

	<?php 
		//condição: se tiver realmente o post cadastrar, ele cadastra o nome e e-mail, se não ele retorna um erro.
		if(isset($_POST['cadastrar'])):
			$nome = $_POST['nome'];
			$email = $_POST['email'];

			$usuario->setNome($nome);
			$usuario->setEmail($email);

			#inserindo dados
			if($nome == "" or $email == ""){			
				echo "Favor preencher campo nome e e-mail!";					
				return false;
			}
			else{
				$usuario->insert();
				echo "<script>alert('Cadastro efetuado com sucesso!')</script>";				
			}
		endif;
	?>


	<!--Fazendo o upload dos dados editados-->
	<?php 
		if(isset($_POST['atualizar'])):
			$id = $_POST['id'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];

			$usuario->setNome($nome);
			$usuario->setEmail($email);

			if ($usuario->update($id)) {
				echo "<script>alert('Dados atualizados com sucesso!')</script>";
			}
		endif;
	?>
	<!--Deletando dados selecionado pelo usuário.-->	
	<?php 
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
			$id = (int)$_GET['id'];
			if($usuario->delete($id)){
				echo "<script>alert('Dados deletados com sucesso!')</script>";
			}
		endif;
	 ?>

	 <h3>Buscando dados pelo nome</h3>
	<form action="" method="post">
		<input type="text" name="pesquisa" placeholder="Buscar pelo nome" />
		<input type="submit" value="Buscar" name="buscar" />
	</form>
	<!--Efetuando a busca por nome -->
	<?php 
		if(isset($_POST['buscar'])):
			//colocando a % na variavel para facilitar a busca no banco de dados com o LIKE.						
			$pesquisa = '%'.$_POST['pesquisa'].'%';
						
			 	
			foreach ($usuario->busca_nome($pesquisa) as $key => $listar){
				
				if($_POST['pesquisa'] == ""){
					echo "<script>alert('Favor digitar algo!')</script>";
					return false;				
				} 				
				else{
					echo $listar->nome."<br />";
					echo $listar->email."<br />";
				}

			}

			if(@$listar->nome == ""){
				echo "<script>alert('Nada foi encontrado nessa merda!!')</script>";
			}

			
		endif;
	?>

	<h3>Cadastrando dados</h3>
	<form action="" method="post">
		Nome: <input type="text" name="nome" /> E-mail: <input type="text" name="email"> 
		<input type="submit" name="cadastrar" value="Cadastrar">
	</form><br /><hr /><br />

	<h3>Selecionando dados</h3>
	<table border="1" style="border-color: #ccc;">
		
		<thead>
			<tr>
				<th>#</th>
				<th>Nome:</th>
				<th>E-mail:</th>
				<th>Ações</th>
			</tr>
		</thead>
		<!--Fazendo o looping retornado os dados da tabela.-->
		<?php foreach ($usuario->busca_tudo() as $key => $listar): ?>

		<tbody>
			<tr>
				<td><?php echo $listar->id; ?></td>
				<td><?php echo $listar->nome; ?></td>
				<td><?php echo $listar->email; ?></td>
				<!--Criando os dois botões de açoes, sendo update de delete.-->
				<td>
					<?php echo "<a href='testes.php?acao=editar&id=" .$listar->id. "'>| Editar |</a>"; ?>
					<?php echo "<a href='testes.php?acao=deletar&id=" .$listar->id. "' onclick='return confirm(\"Deseja realmente deletar?\")'>| Deletar| </a>"; ?>
				</td>
			</tr>
		</tbody>

		<?php endforeach; ?>

	</table><br /><hr /><br>	

	
	<!--Editando dados da tabela-->
	<?php 
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'):
			$id = (int)$_GET['id'];
			$resultado = $usuario->busca_id($id);
			#$nome = $resultado->nome;
			#$email = $resultado->email;
	 ?>
	 <h3>Editando dados</h3>
	<form action="" method="post">
		Nome: <input type="text" name="nome" value="<?php echo $resultado->nome;?>" /> E-mail: <input type="text" name="email" value="<?php echo $resultado->email;?>" /> 
		<input type="hidden" name="id" value="<?php echo $resultado->id;?>" />
		<input type="submit" name="atualizar" value="Atualizar">
	</form>
	<?php endif; ?>	
	
</body>
</html>