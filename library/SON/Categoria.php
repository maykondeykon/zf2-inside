<?php

namespace SON;

class Categoria implements CategoriaInterface
{
	private $id;
	private $nome;
	private $db;
	
	public function __construct(Db\Connection $db)
	{
		$this->db = $db;
	}
	
	public function listar()
	{
		$query = 'select * from categorias';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $nome
	 */
	public function setNome($nome) {
		$this->nome = $nome;
	}

	
}

