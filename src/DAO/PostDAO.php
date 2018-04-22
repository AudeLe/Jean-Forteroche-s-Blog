<?php
	
	namespace Blog\src\DAO;

	use Blog\src\classes\Post;


	class PostDAO extends DAO{

		public function getPosts(){

            $sql = 'SELECT COUNT(id) as nbChapters FROM posts';

		    $result = $this->sql($sql);
		    $countPostsData = $result -> fetch();

            $nbChapters = $countPostsData['nbChapters'];
            $perPage = 5;
            $nbPage = ceil($nbChapters/$perPage);

            if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage){
                $cPage = $_GET['p'];
            } else {
                $cPage= 1;
            }

		    $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT '.(($cPage-1)*$perPage).','.$perPage.'';
		    $result = $this->sql($sql);
		    $posts = [];

		    foreach($result as $row){
		        $postId = $row['id'];
		        $posts[$postId] = $this -> buildObject($row);
            }

            for($i = 1; $i <= $nbPage; $i++){
                if($i == $cPage){
                    echo "$i";
                } else {
                    echo "<a href =\"../public/index.php?action=listPosts&p=$i\">$i</a>";
                }
            }

            return $posts;

		}

		public function getPost($id){

		    $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?';
            $result = $this->sql($sql, [$id]);
            $row = $result -> fetch();
            if($row){
                return $this->buildObject($row);
            } else {
                echo 'Aucun chapitre existant avec cet identifiant.';
            }

		    //$db = $this -> dbConnect();
			//$req = $db -> prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
			//$req -> execute(array($postId));
			//$post = $req -> fetch();

            /*if ($req){
                return $this -> buildClassObject($req);
            } else {
                throw new Exception ('Il n\'y a pas d\'article correspondant à cet identifiant.');
            }*/

			//return $post;
		}

		public function addPost($title, $article){

		    $sql = 'INSERT INTO posts(title, content, creation_date) VALUES (:title, :content, NOW())';
		    $this->sql($sql, [
		        'title' => $title,
                'content' => $article
            ]);

		    //$db = $this -> dbConnect();
			
			//$newPost = $db -> prepare('INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW())');
			//$affectedPost = $newPost -> execute(array($title, $article));

			//return $affectedPost;
		}

		public function editPost($id){

		    $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d%m%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?';
            $result = $this->sql($sql, [$id]);
            $row = $result -> fetch();
            if($row){
                return $this->buildObject($row);
            } else {
                echo 'Aucun chapitre existant avec cet identifiant.';
            }

		    //$db = $this -> dbConnect();

			//$post = $db -> prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d%m%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
			//$post -> execute(array($id));

			//return $post;
		}

		public function editedPost($id, $newTitle, $newPost){

		    $sql = 'UPDATE posts SET title = :newTitle, content = :newPost WHERE id = :id';
		    $this->sql($sql, [
		        'id' => $id,
		        'newTitle' => $newTitle,
                'newPost' => $newPost
            ]);

		    //$db = $this -> dbConnect();

			//$newlyEditedPost = $db -> prepare('UPDATE posts SET title = :newTitle, content = :newPost WHERE id = :id');
			/*$newlyEditedPost = $newlyEditedPost -> execute(array(
				'id' => $id,
				'newTitle' => $newTitle,
				'newPost' => $newPost
			));*/

			//return $newlyEditedPost;
		}


		public function deletePost($id){

		    $sql = 'DELETE posts, comments FROM posts INNER JOIN comments ON (posts.id = comments.post_id) WHERE posts.id = :id';
		    $this->sql($sql, [
		        'id' => $id
            ]);

			//$db = $this -> dbConnect();

			/*$deletedPost = $db -> prepare('DELETE posts, comments FROM posts INNER JOIN comments ON (posts.id = comments.post_id) WHERE posts.id = :id');
			$deletedPost -> execute(array(
				'id' => $id
			));*/

		}

		private function buildObject(array $row){
		    $post = new Post();
		    $post->setId($row['id']);
		    $post->setTitle($row['title']);
		    $post->setContent($row['content']);
		    $post->setCreationDate($row['creation_date_fr']);
		    return $post;
        }

	}