<?php 

	require_once 'C:\xampp\htdocs\CRUD_POO\classes\class_crud.php';

	//criando a classe usuario, herdando da classe Crud
	class Usuarios extends Crud{

		protected $table = 'usuarios';
		private $nome;
		private $email;

		

		//criando um método para setar um valor para o nome.
		public function setNome($nome){
			$this->nome = $nome;			
		}

		public function getNome(){
			return $this->nome;
		}
		//criando um método para setar um valor para o e-mail.
		public function setEmail($email){
			$this->email = $email;
		}

		//criando um método insert, para inserir uma dado na tabela.
		public function insert(){
			$sql  = "INSERT INTO $this->table (nome, email) VALUES (:nome, :email)";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			return $stmt->execute();
		}

		//criando um método de update, alteração de um dado da tabela.
		public function update($id){
			$sql = "UPDATE $this->table SET nome = :nome, email = :email WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':id', $id);
			return $stmt->execute();
		}
		
	}

 ?>