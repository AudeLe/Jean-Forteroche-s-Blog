<?php
	
	namespace Blog\src\DAO;

	require_once('DAO.php');
	require('../src/class/Post.php');

	class PostDAO extends DAO{

		public function getPosts(){
			$db = $this -> dbConnect();
			$req = $db -> query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

			/*$posts = array();
			foreach($req as $row){
			    $postId = $row['id'];
			    $posts[$postId] = $this-> buildClassObject($row);
            }*/

			return $req;
		}

		public function getPost($postId){
			$db = $this -> dbConnect();
			$req = $db -> prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
			$req -> execute(array($postId));
			$post = $req -> fetch();

            /*if ($req){
                return $this -> buildClassObject($req);
            } else {
                throw new Exception ('Il n\'y a pas d\'article correspondant à cet identifiant.');
            }*/

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

			$deletedPost = $db -> prepare('DELETE FROM posts LEFT JOIN comments ON (posts.id = comments.post_id) WHERE posts.id = :id');
			$deletedPost -> execute(array(
				'id' => $id
			));

		}

		/*protected function buildClassObject(array $row){
		    $post = new Post();
		    $post -> setId($row['id']);
		    $post -> setTitle($row['title']);
		    $post -> setContent($row['content']);
		    return $post;
        }*/
	}