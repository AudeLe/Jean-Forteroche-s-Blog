<?php
	
	namespace Openclassrooms\Blog\Model;

	require_once('Manager.php');

	class PostManager extends Manager{

		public function getPosts(){
			$db = $this -> dbConnect();
			$req = $db -> query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

			return $req; 
		}

		public function getPost($postId){
			$db = $this -> dbConnect();
			$req = $db -> prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
			$req -> execute(array($postId));
			$post = $req -> fetch();

			return $post;
		}

		public function addPost($title, $article){
			$db = $this -> dbConnect();
			
			$newPost = $db -> prepare('INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW())');
			$affectedPost = $newPost -> execute(array($title, $article));

			return $affectedPost; 
		}

		public function editPost($id){
			$db = $this -> dbConnect();

			$post = $db -> prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d%m%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
			$post -> execute(array($id));

			return $post;
		}

		public function editedPost($id, $newTitle, $newPost){
			$db = $this -> dbConnect();

			$newlyEditedPost = $db -> prepare('UPDATE posts SET title = :newTitle, content = :newPost WHERE id = :id');
			$newlyEditedPost = $newlyEditedPost -> execute(array(
				'id' => $id,
				'newTitle' => $newTitle,
				'newPost' => $newPost
			));

			return $newlyEditedPost;
		}


		public function deletePost($id){
			$db = $this -> dbConnect();

			$deletedPost = $db -> prepare('DELETE FROM posts WHERE id = :id');
			$deletedPost = $deletedPost -> execute(array(
				'id' => $id
			));
		}
	}