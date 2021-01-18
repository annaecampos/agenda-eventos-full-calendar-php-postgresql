<?php

session_start(); 
define( 'PG_HOST', 'localhost' );
define( 'PG_DBNAME', 'agenda' );
define( 'PG_PORT', '5432' );
define( 'PG_USER', 'postgres' );
define( 'PG_PASSWORD', '####' );

class Crud_Pessoa extends PDO
{
	public function __construct(){

	}
	private function conexao(){
		try{
			$PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
			$PDO->exec("set names utf8");

			return $PDO;
		}
		catch ( PDOException $e ){
			echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
		}
	}

    //PESSOA
	function servidor_select_all(){
		$bd = Crud_Pessoa::conexao();
		$sql = "SELECT * FROM pessoa";
		$result = $bd->query($sql);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	function servidor_select($id){
		$this->id = $id;
		$bd = Crud_Pessoa::conexao();
		$sql = "SELECT * FROM pessoa where id = :id";
		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function servidor_select_ultimo(){
		$bd = Crud_Pessoa::conexao();
		$sql = "SELECT id FROM pessoa ORDER BY id DESC LIMIT 1";
		$stmt = $bd->prepare( $sql );
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	function pessoa_select_table(){
        //$this->id = $id;
		$bd = Crud_Pessoa::conexao();
		$sql = "SELECT p.id, p.nome, p.telefone, p.cpf, p.email, p.tipopessoa, p.idsetor
		FROM pessoa p

		where p.tipopessoa = 2
		order by id desc"; 
		$stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	function servidor_select_table(){
        //$this->id = $id;
		$bd = Crud_Pessoa::conexao();
		$sql = "SELECT p.id, p.nome, p.telefone, p.cpf, p.email, p.tipopessoa, p.idsetor, p.login, p.senha, p.nivel, s.nome as nomesetor
		FROM pessoa p
		INNER JOIN setor s on p.idsetor = s.id 
		where p.tipopessoa = 1
		order by id desc"; 
		$stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function select_servidor_combo(){
		$bd = Crud_Pessoa::conexao();
		$sql = "SELECT * FROM pessoa order by nome";
		$stmt = $bd->prepare( $sql );
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	}


	function pessoa_insert($nome,$telefone,$cpf,$email,$tipopessoa){
		try{
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->cpf = $cpf;
			$this->email = $email;
			$this->tipopessoa = $tipopessoa;
			
			$bd = Crud_Pessoa::conexao();
			$sql = "INSERT INTO pessoa(nome, telefone, cpf, email, tipopessoa) VALUES (:nome,:telefone,:cpf,:email,:tipopessoa)";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
			$stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
			$stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
			$stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
			$stmt->bindParam(':tipopessoa', $this->tipopessoa, PDO::PARAM_INT);
			$result = $stmt->execute();
			if($result == TRUE)
			{
				$url='../listar_pessoas.php?cad';
				echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
				exit();
			}

		}
		catch ( PDOException $e ){
			echo 'Erro ao inserir: ' . $e->getMessage();
		}    
	}

       //USUÁRIO E SERVIDOR
	function servidor_insert($nome,$telefone,$cpf,$email,$login,$senha,$tipopessoa,$idsetor,$nivel){
		try{
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->cpf = $cpf;
			$this->email = $email;
			$this->login = $login;
			$this->senha = $senha;
			$this->tipopessoa = $tipopessoa;
			$this->idsetor = $idsetor;
			$this->nivel = $nivel;
			
			$bd = Crud_Pessoa::conexao();
			$sql = "INSERT INTO pessoa(nome, telefone, cpf, email, login, senha, tipopessoa,idsetor,nivel) VALUES (:nome,:telefone,:cpf,:email,:login,:senha,:tipopessoa,:idsetor,:nivel)";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
			$stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
			$stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
			$stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
			$stmt->bindParam(':login', $this->login, PDO::PARAM_STR);
			$stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
			$stmt->bindParam(':tipopessoa', $this->tipopessoa, PDO::PARAM_INT);
			$stmt->bindParam(':idsetor', $this->idsetor, PDO::PARAM_INT);
			$stmt->bindParam(':nivel', $this->nivel, PDO::PARAM_INT);
			$result = $stmt->execute();
			if($result == TRUE)
			{
				$url='../listar_servidores.php?cad';
				echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
				exit();
			}

		}
		catch ( PDOException $e ){
			echo 'Erro ao inserir: ' . $e->getMessage();
		}    
	}



	function pessoa_update($id,$nome,$telefone,$cpf,$email,$tipopessoa){
		try{
			$this->id = $id;
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->cpf = $cpf;
			$this->email = $email;
			$this->tipopessoa = $tipopessoa;
			$bd = Crud_Pessoa::conexao();
			$sql = "UPDATE pessoa set nome = :nome, telefone = :telefone, cpf = :cpf, email = :email, tipopessoa = :tipopessoa WHERE id = :id";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
			$stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
			$stmt->bindParam(':cpf',$this->cpf,PDO::PARAM_STR);
			$stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
			$stmt->bindParam(':tipopessoa', $this->tipopessoa, PDO::PARAM_INT);
			$result = $stmt->execute();
			if($result == TRUE)
			{
				$url='../listar_pessoas.php?alt';
				echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
				exit();
			} 
		}          

		catch ( PDOException $e ){
			echo 'Erro ao alterar: ' . $e->getMessage();
		}   
	}



	function servidor_update($id,$nome,$telefone,$cpf,$email,$login,$senha,$tipopessoa,$idsetor,$nivel){
		try{
			$this->id = $id;
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->cpf = $cpf;
			$this->email = $email;
			$this->login = $login;
			$this->senha = $senha;
			$this->tipopessoa = $tipopessoa;
			$this->idsetor = $idsetor;
			$this->nivel = $nivel;
			$bd = Crud_Pessoa::conexao();
			$sql = "UPDATE pessoa set nome = :nome, telefone = :telefone, cpf = :cpf, email = :email, login = :login, senha = :senha, tipopessoa = :tipopessoa, idsetor = :idsetor, nivel = :nivel WHERE id = :id";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
			$stmt->bindParam(':telefone',$this->telefone,PDO::PARAM_STR);
			$stmt->bindParam(':cpf',$this->cpf,PDO::PARAM_STR);
			$stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
			$stmt->bindParam(':login',$this->login,PDO::PARAM_STR);
			$stmt->bindParam(':senha',$this->senha,PDO::PARAM_STR);
			$stmt->bindParam(':tipopessoa', $this->tipopessoa, PDO::PARAM_INT);
			$stmt->bindParam(':idsetor', $this->idsetor,PDO::PARAM_INT);
			$stmt->bindParam(':nivel', $this->nivel,PDO::PARAM_INT);
			$result = $stmt->execute();
			if($result == TRUE)
			{
				$url='../listar_servidores.php?alt';
				echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
				exit();
			} 
		}          

		catch ( PDOException $e ){
			echo 'Erro ao alterar: ' . $e->getMessage();
		}   
	}


	function pessoa_delete($id){
		$bd = Crud_Pessoa::conexao();

		$sql = "DELETE FROM pessoa WHERE id = :id ";
		$stmt = $bd->prepare($sql);
		$stmt->bindParam(':id',$id, PDO::PARAM_INT);

		$result = $stmt->execute();
		if($result == TRUE){

			$url='../listar_pessoas.php?excluir';

			echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
			exit();
		} 
	}

	function servidor_delete($id){
		$bd = Crud_Pessoa::conexao();

		$sql = "DELETE FROM pessoa WHERE id = :id ";
		$stmt = $bd->prepare($sql);
		$stmt->bindParam(':id',$id, PDO::PARAM_INT);

		$result = $stmt->execute();
		if($result == TRUE){

			$url='../listar_servidores.php?excluir';

			echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
			exit();
		} 
	}

	function servidor_setor_vinculo($id){
		$this->id = $id;
		$bd = Crud_Pessoa::conexao();
		$sql = "SELECT * from pessoa where idsetor = :id"; 

		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function login_select_troca_senha($login, $senha, $id){
		$this->login = $login;
		$this->senha = $senha;
		$this->id = $id;
		$bd = Crud_Pessoa::conexao();

		$sql = "SELECT login, senha, id FROM pessoa WHERE (login = :login) AND (senha = :senha) AND (id = :id) LIMIT 1";
		$stmt = $bd->prepare( $sql );

		$login1 = $stmt->bindParam(':login',$this->login, PDO::PARAM_STR);
		$senha1 = $stmt->bindParam(':senha',$this->senha, PDO::PARAM_STR);
		$id = $stmt->bindParam(':id',$this->id, PDO::PARAM_STR);

		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	}


	function login_select($login, $senha){
		$this->login = $login;
		$this->senha = md5($senha);
		$bd = Crud_Pessoa::conexao();

		$sql = "SELECT id, nome, login, senha, tipopessoa, nivel FROM pessoa WHERE (login = :login) AND (senha = :senha) LIMIT 1";
		$stmt = $bd->prepare( $sql );

		$login1 = $stmt->bindParam(':login',$this->login, PDO::PARAM_STR);
		$senha2 = $stmt->bindParam(':senha',$this->senha, PDO::PARAM_STR);

		$stmt->execute();

		if($stmt->rowCount() == 1)
		{


			while($ln = $stmt->fetch(PDO::FETCH_ASSOC))
			{

				$_SESSION['login'] = $ln['login'];
				$_SESSION['usuarionivel'] = $ln['nivel'];
				$_SESSION['usuarioLogin'] = $ln['login'];
				$_SESSION['usuarioNome'] = $ln['nome'];
				$_SESSION['id'] = $ln['id'];
				if($_SESSION['usuarionivel'] == 4){
					$url='../agenda_somente_visualizar.php';
					echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
					exit();

				}
				else{
					$url='../agenda.php';
					echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
					exit();
				}
			};
		}
		else
		{    
        $url='../login.php?erro'; //.$senha.'&'.$login
        echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
        exit();

    }


}




}  

class Crud_Setor extends PDO{
	public function __construct(){

	}
	private function conexao(){
		try{
			$PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
			$PDO->exec("set names utf8");
			return $PDO;
		}
		catch ( PDOException $e ){
			echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
		}
	}

	function setor_insert($nome){
		try{
			$this->nome = $nome;

			$bd = Crud_Setor::conexao();
			$sql = "INSERT INTO setor(nome) VALUES (:nome)";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

			$result = $stmt->execute();
			if($result == TRUE)
			{
				$url='../listar_setor.php?cad';
				echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
				exit();
			}

		}
		catch ( PDOException $e ){
			echo 'Erro ao inserir: ' . $e->getMessage();
		}    
	}
	function setor_update($id,$nome){
		try{
			$this->id = $id;
			$this->nome = $nome;
			$bd = Crud_Setor::conexao();
			$sql = "UPDATE setor set nome = :nome WHERE id = :id";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);

			$result = $stmt->execute();
			if($result == TRUE)
			{
				$url='../listar_setor.php?alt';
				echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
				exit();
			} 
		}          

		catch ( PDOException $e ){
			echo 'Erro ao alterar: ' . $e->getMessage();
		}   
	}

	function setor_delete($id){
		$bd = Crud_Setor::conexao();

		$sql = "DELETE FROM setor WHERE id = :id ";
		$stmt = $bd->prepare($sql);
		$stmt->bindParam(':id',$id, PDO::PARAM_INT);

		$result = $stmt->execute();
		if($result == TRUE){

			$url='../listar_setor.php?excluir';

			echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
			exit();
		} 
	}  

	function setor_select_table(){
        //$this->id = $id;
		$bd = Crud_Setor::conexao();
		$sql = " SELECT * from setor
		where nome != 'Ninguém'
		order by id desc"; 

		$stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function setor_select_ultimo(){
		$bd = Crud_Setor::conexao();
		$sql = "SELECT id FROM setor ORDER BY id DESC LIMIT 1";
		$stmt = $bd->prepare( $sql );
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function setor_select($id){
		$this->id = $id;
		$bd = Crud_Setor::conexao();
		$sql = "SELECT * from setor where id = :id";

		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function select_setor_combo(){
		$bd = Crud_Setor::conexao();
		$sql = "SELECT * FROM setor order by nome";
		$stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
}





class Crud_Evento extends PDO{
	public function __construct(){

	}
	private function conexao(){
		try{
			$PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
			$PDO->exec("set names utf8");
			return $PDO;
		}
		catch ( PDOException $e ){
			echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
		}
	}


	function evento_insert($nome,$idcor,$datainicio,$datafim){
		try{
			$this->nome = $nome;
			$this->idcor = $idcor;
			$this->datainicio = $datainicio;
			$this->datafim = $datafim;
			$this->status = 1;

			
			$bd = Crud_Evento::conexao();
			$sql = "INSERT INTO evento(nome, idcor, datainicio,datafim,status) VALUES (:nome,:idcor,:datainicio,:datafim,:status)";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
			$stmt->bindParam(':idcor',$this->idcor,PDO::PARAM_INT);
			$stmt->bindParam(':datainicio', $this->datainicio, PDO::PARAM_INT);
			$stmt->bindParam(':datafim', $this->datafim, PDO::PARAM_INT);
			$stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

			$result = $stmt->execute();
		}
		catch ( PDOException $e ){
			echo 'Erro ao inserir: ' . $e->getMessage();
		}    
	}


	function evento_insert2($nome, $datainicio,$datafim,$cor){
		try{
			$this->nome = $nome;
			$this->datainicio = $datainicio;
			$this->datafim = $datafim;
			$this->idcor = $cor;
			$this->status = 1;

			$bd = Crud_Evento::conexao();
			$sql = "INSERT INTO evento(nome, idcor, datainicio,datafim,status) VALUES (:nome,:idcor,:datainicio,:datafim,:status)";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
			$stmt->bindParam(':datainicio', $this->datainicio, PDO::PARAM_INT);
			$stmt->bindParam(':datafim', $this->datafim, PDO::PARAM_INT);
			$stmt->bindParam(':idcor', $this->idcor, PDO::PARAM_STR);
			$stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

			$result = $stmt->execute();

		}
		catch ( PDOException $e ){
			echo 'Erro ao inserir: ' . $e->getMessage();
		}    
	}

	function evento_pessoa_insert($idevento, $idpessoa){
		try{
			$this->idevento = $idevento;
			$this->idpessoa = $idpessoa;

			$bd = Crud_Evento::conexao();
			$sql = "INSERT INTO evento_pessoa(idevento, idpessoa) VALUES (:idevento,:idpessoa)";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':idevento',$this->idevento,PDO::PARAM_INT);
			$stmt->bindParam(':idpessoa',$this->idpessoa,PDO::PARAM_INT);
			$result = $stmt->execute();


		}
		catch ( PDOException $e ){
			echo 'Erro ao inserir: ' . $e->getMessage();
		}    
	}
//deletar evento pessoa quando alterar evento
	function evento_pessoa_delete($idevento){

		$this->idevento = $idevento;
		$this->status = 2;
		$bd = Crud_Evento::conexao();
		$sql = "UPDATE evento set status = :status WHERE idevento = :idevento";
		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':idevento',$this->idevento,PDO::PARAM_INT);
		$stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

		

		$bd = Crud_Evento::conexao();

		$sql = "DELETE FROM evento_pessoa WHERE idevento = :idevento ";
		$stmt = $bd->prepare($sql);
		$stmt->bindParam(':idevento',$idevento, PDO::PARAM_INT);

		$result = $stmt->execute();

	}  

	function evento_update($id,$nome,$idcor,$datainicio,$datafim){
		try{
			$this->id = $id;
			$this->nome = $nome;
			$this->idcor = $idcor;
			$this->datainicio = $datainicio;
			$this->datafim = $datafim;
			$bd = Crud_Evento::conexao();
			$sql = "UPDATE evento set nome = :nome, idcor = :idcor, datainicio = :datainicio, datafim = :datafim WHERE id = :id";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
			$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
			$stmt->bindParam(':idcor',$this->idcor,PDO::PARAM_INT);
			$stmt->bindParam(':datainicio', $this->datainicio, PDO::PARAM_INT);
			$stmt->bindParam(':datafim', $this->datafim, PDO::PARAM_INT);

			$result = $stmt->execute();
		}          

		catch ( PDOException $e ){
			echo 'Erro ao alterar: ' . $e->getMessage();
		}   
	}

	function evento_update2($id,$datainicio,$datafim){
		try{
			$this->id = $id;
			$this->datainicio = $datainicio;
			$this->datafim = $datafim;
			$bd = Crud_Evento::conexao();
			$sql = "UPDATE evento set datainicio = :datainicio, datafim = :datafim WHERE id = :id";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
			$stmt->bindParam(':datainicio', $this->datainicio, PDO::PARAM_INT);
			$stmt->bindParam(':datafim', $this->datafim, PDO::PARAM_INT);

			$result = $stmt->execute();
		}          

		catch ( PDOException $e ){
			echo 'Erro ao alterar: ' . $e->getMessage();
		}   
	}

	function evento_delete($id){

		try{
			$this->id = $id;
			$this->status = 2;
			$bd = Crud_Evento::conexao();
			$sql = "UPDATE evento set status = :status WHERE id = :id";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
			$stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

			$result = $stmt->execute();
		}          

		catch ( PDOException $e ){
			echo 'Erro ao excluir: ' . $e->getMessage();
		}   
		
	}  

	function evento_delete_minha_agenda($id){

		try{
			$this->id = $id;
			$this->status = 2;
			$bd = Crud_Evento::conexao();
			$sql = "UPDATE evento set status = :status WHERE id = :id";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
			$stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

			$result = $stmt->execute();
			if($result == TRUE)
			{
				$url='../minha_agenda.php?excluir';
				echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
				exit();
			} 
		}          

		catch ( PDOException $e ){
			echo 'Erro ao excluir: ' . $e->getMessage();
		}   

	}  

	function evento_select_table(){
		$bd = Crud_Evento::conexao();
		$sql = "SELECT e.id, e.nome, e.idcor, e.datainicio, e.datafim, e.status,
		array_to_string(array_agg(p.nome), ', ') as nomepessoa,
		array_to_string(array_agg(p.id), ', ') as idpessoa 



		from evento e
		left join evento_pessoa ep on e.id = ep.idevento
		left join pessoa p on ep.idpessoa = p.id
		where e.status = 1
		group by e.id, e.idcor, e.datainicio, e.datafim, e.nome, e.status
		ORDER BY E.ID DESC


		"; 


		$stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function evento_pessoa_vinculo($id){
		$this->id = $id;
		$bd = Crud_Evento::conexao();
		$sql = "SELECT * from evento_pessoa where idpessoa = :id"; 

		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function ultimo_evento_cadastrado_select(){
        //$this->id = $id;
		$bd = Crud_Evento::conexao();
		$sql = " SELECT * from evento order by id desc limit 1"; 

		$stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	function evento_pessoas_minha_agenda($idpessoa){
		$this->idpessoa = $idpessoa;
		$bd = Crud_Evento::conexao();
		$sql = "SELECT distinct (idpessoa), idevento
		FROM evento_pessoa
		WHERE idevento IN ( SELECT idevento
		FROM evento_pessoa
		WHERE idpessoa = $idpessoa and status = 1)"; 

		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':idpessoa',$this->idpessoa, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



	function evento_select_table_minhaagenda($idpessoa){
		$this->idpessoa = $idpessoa;
		$bd = Crud_Evento::conexao();
		$sql = "SELECT e.id, e.nome, e.idcor, e.datainicio, e.datafim,
		array_to_string(array_agg(p.nome), ', ') as nomepessoa,
		array_to_string(array_agg(p.id), ', ') as idpessoa 


		from evento e
		left join evento_pessoa ep on e.id = ep.idevento
		left join pessoa p on ep.idpessoa = p.id
		where idpessoa = :idpessoa and status = 1
		group by e.id, e.idcor, e.datainicio, e.datafim, e.nome
		ORDER BY E.ID DESC";

		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':idpessoa',$this->idpessoa, PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function evento_select_ultimo(){
		$bd = Crud_Evento::conexao();
		$sql = "SELECT id FROM evento ORDER BY id DESC LIMIT 1";
		$stmt = $bd->prepare( $sql );
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function evento_select($id){
		$this->id = $id;
		$bd = Crud_Evento::conexao();
		$sql = "SELECT ep.idpessoa from evento e 
		inner join evento_pessoa ep on e.id = ep.idevento
		where e.id = :id";

		$stmt = $bd->prepare( $sql );
		$stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
		
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function cor_combo(){
		$bd = Crud_Evento::conexao();
		$sql = "SELECT * FROM cor order by nome";
		$stmt = $bd->prepare( $sql );
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}



class Crud_Log extends PDO{
	public function __construct(){

	}
	private function conexao(){
		try{
			$PDO = new PDO('pgsql:host='.PG_HOST.';dbname='.PG_DBNAME.';port='. PG_PORT.';user= '.PG_USER.';password='.PG_PASSWORD);
			$PDO->exec("set names utf8");
			return $PDO;
		}
		catch ( PDOException $e ){
			echo 'Erro ao conectar com o PgAdmin: ' . $e->getMessage();
		}
	}


	function log_insert($idevento, $idpessoa, $dataatualizacao, $operacao){
		try{
			$this->idevento = $idevento;
			$this->idpessoa = $idpessoa;
			$this->dataatualizacao = $dataatualizacao;
			$this->operacao = $operacao;

			$bd = Crud_Log::conexao();
			$sql = "INSERT INTO log(idevento, idpessoa, dataatualizacao, operacao) VALUES (:idevento, :idpessoa, :dataatualizacao, :operacao)";
			$stmt = $bd->prepare( $sql );
			$stmt->bindParam(':idevento',$this->idevento,PDO::PARAM_INT);
			$stmt->bindParam(':idpessoa',$this->idpessoa,PDO::PARAM_INT);
			$stmt->bindParam(':dataatualizacao',$this->dataatualizacao,PDO::PARAM_STR);
			$stmt->bindParam(':operacao',$this->operacao,PDO::PARAM_STR);

			$result = $stmt->execute();

		}
		catch ( PDOException $e ){
			echo 'Erro ao inserir: ' . $e->getMessage();
		}    
	}

	function log_select_table(){
        //$this->id = $id;
		$bd = Crud_Log::conexao();
		$sql = "SELECT l.id, l.idevento, l.idpessoa, l.dataatualizacao, l.operacao, e.nome as nomeevento, p.nome as nomepessoa from log l
		left join evento e on e.id = l.idevento
		left join pessoa p on p.id = l.idpessoa
		order by id desc"; 
		$stmt = $bd->prepare( $sql );
        //$stmt->bindParam(':id',$this->id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	function log_select_ultimo(){
		$bd = Crud_Log::conexao();
		$sql = "SELECT id FROM log ORDER BY id DESC LIMIT 1";
		$stmt = $bd->prepare( $sql );
		$result = $stmt->execute();
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



}


?>