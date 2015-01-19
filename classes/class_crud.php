<?php

	require_once 'C:\xampp\htdocs\CRUD_POO\classes\DB.php';

	//criando classe abstrata para ser o molde para as demais.

	abstract class Crud extends DB{

		protected $table;

		abstract public function insert();
		abstract public function update($id);

		//fazendo um (método) que busca tudo da tabela referente ao $id selecionado.
		public function busca_id($id){
			$sql  = "SELECT * FROM $this->table WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
		}

		//Fazendo um (método) que busca tudo da tabela referente ao nome digitado pelo usuário.
		public function busca_nome($nome){
			$sql  = "SELECT * FROM $this->table WHERE nome LIKE :nome";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		//fazendo um (método) que busca tudo da tabela.
		public function busca_tudo(){
			$sql  = "SELECT * FROM $this->table";
			$stmt = DB::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		//fazendo um (método) que deleta algo da tabela referende ao $id selecionado.
		public function delete($id){
			$sql  = "DELETE FROM $this->table WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			return $stmt->execute();
		}

		#Em caso de busca por nome, para funcionar o LIKE, sendo que ira buscar tudo antes de alguma letra e tudo depois de uma letra.
		#exemplo LIKE % $nome % Se passa assim no PDO:		
		#$buscar->bindParam(':bus_valor', "%$valor_bus%", PDO::PARAM_STR);
		#se passa a porcentagem na hora do bindParam e não no SELECT.
	}

?>