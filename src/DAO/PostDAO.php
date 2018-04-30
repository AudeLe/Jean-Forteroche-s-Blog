<?php
	
	namespace BlogJeanForteroche\src\DAO;

	use BlogJeanForteroche\src\classes\Post;

	class PostDAO extends DAO{

        /**
         * @return array
         */
	    public function getPosts(){

	        // Count how many posts/chapters exists
            $sql = 'SELECT COUNT(id) as nbChapters FROM posts';
		    $result = $this->sql($sql);
		    $countPostsData = $result -> fetch();

		    // Define the variables needed to establish the pagination
            $nbChapters = $countPostsData['nbChapters'];
            $perPage = 5;
            $nbPage = ceil($nbChapters/$perPage);

            // Define which page of posts/chapters we are on
            if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage){
                $cPage = $_GET['p'];
            } else {
                $cPage= 1;
            }

            // Recover all the posts/chapters
		    $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT '.(($cPage-1)*$perPage).','.$perPage.'';
		    $result = $this->sql($sql);
		    $posts = [];

		    foreach($result as $row){
		        $postId = $row['id'];
		        $posts[$postId] = $this -> buildObject($row);
            }

            // Return the pages needed
            $page = [];
		    for ($i = 1; $i <= $nbPage; $i++){
		        $page[$i] = '<a href ="../public/index.php?action=listPosts&p='.$i.'">'.$i.'</a>';
            }

            return [$posts, $page];
		}

        /**
         * @param $id
         * @return Post
         */
        // Select and return a specific post/chapters
		public function getPost($id){

		    $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?';
            $result = $this->sql($sql, [$id]);
            $row = $result -> fetch();

            if($row){
                return $this->buildObject($row);
            } else {
                echo 'Aucun chapitre existant avec cet identifiant.';
            }
		}

        /**
         * @return array
         */
        // Return the list of the posts/chapters without a limitation of posts/chapters per pages
		public function getPostsInsert(){

            $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC';
            $result = $this->sql($sql);
            $posts = [];

            foreach($result as $row){
                $postId = $row['id'];
                $posts[$postId] = $this -> buildObject($row);
            }

            return $posts;
        }

        /**
         * @param $title
         * @param $article
         */
        // Allows to add a post/chapter
		public function addPost($title, $article){

		    $sql = 'INSERT INTO posts(title, content, creation_date) VALUES (:title, :content, NOW())';
		    $this->sql($sql, [
		        'title' => $title,
                'content' => $article
            ]);

            header('Location: ../public/index.php?action=getChaptersAndReportedComments');
		}

        /**
         * @param $id
         * @return Post
         */
        // Recover the post/chapter we want to edit
		public function editPost($id){

		    $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d%m%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?';
            $result = $this->sql($sql, [$id]);
            $row = $result -> fetch();
            if($row){
                return $this->buildObject($row);
            } else {
                echo 'Aucun chapitre existant avec cet identifiant.';
            }
		}

        /**
         * @param $id
         * @param $newTitle
         * @param $newPost
         */
        // Recording of the changes made on the post/chapter
		public function editedPost($id, $newTitle, $newPost){

		    $sql = 'UPDATE posts SET title = :newTitle, content = :newPost WHERE id = :id';
		    $this->sql($sql, [
		        'id' => $id,
		        'newTitle' => $newTitle,
                'newPost' => $newPost
            ]);
		}

        /**
         * @param $id
         */
        // Allows to delete a post/chapter and the comments tied to it
		public function deletePost($id){

		    $sql = 'SELECT comment FROM comments WHERE post_id = ?';
		    $result = $this->sql($sql, [$id]);
		    $row = $result -> fetch();

		    // Check if they are comments tied to the post/chapter selected
            // if yes, delete both the post/chapter and the comments
            // otherwise delete only the post/chapter
		    if($row){
                $sql = 'DELETE posts, comments FROM posts INNER JOIN comments ON (posts.id = comments.post_id) WHERE posts.id = ?';
                $this->sql($sql, [$id]);
            } else{
		        $sql = 'DELETE FROM posts WHERE id = ?';
		        $this->sql($sql, [$id]);
            }

            header('Location: ../public/index.php?action=getChaptersAndReportedComments');
		}

        /**
         * @param array $row
         * @return Post
         */
		private function buildObject(array $row){
		    $post = new Post();
		    $post->setId($row['id']);
		    $post->setTitle($row['title']);
		    $post->setContent($row['content']);
		    $post->setCreationDate($row['creation_date_fr']);
		    return $post;
        }

	}