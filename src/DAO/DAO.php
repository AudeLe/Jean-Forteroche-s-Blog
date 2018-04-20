<?php

	namespace Blog\src\DAO;

	abstract class DAO {

		const DB_HOST = 'mysql:host=localhost;dbname=blog;charset=utf8';
		const DB_USER = 'root';
		const DB_PASS = '';

		private $connection;

		private function checkConnection(){
			// Vérifie si la connexion est nulle et fait appel à dbConnect
			if($this->connection == null){
				return $this -> dbConnect();
			}

			// Si la connexion existe, elle est renvoyée, inutile de refaire une connexion
			return $this->connection;
		}

		protected function dbConnect(){

			// Tentative de connexion à notre base de données
			try{
				$this->connection = new \PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
				$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

				return $this->connection;
			}
			// On lève une exception si la connexion échoue
			catch(Exception $errorConnection){
				die('Erreur de connexion : ' . $errorConnection->getMessage());
			}
		}

		protected function sql($sql, $parameters = null){
			if($parameters){
				$result = $this -> checkConnection() -> prepare($sql);
				$result -> execute($parameters);

				return $result;
			} else {
				$result = $this -> checkConnection() -> query($sql);
				return $result;
			}
		}

	}