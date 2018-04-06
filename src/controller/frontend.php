<?php
	
	require_once('../src/DAO/PostDAO.php');
	require_once('../src/DAO/CommentDAO.php');
	require_once('../src/DAO/ConnectionDAO.php');

	function listPosts(){
		$postManager = new \Openclassrooms\Blog\Model\PostDAO();
		$posts = $postManager -> getPosts();

		require('../template/listPostsView.php');
	}

	function post(){
		$postManager = new \Openclassrooms\Blog\Model\PostDAO();
		$commentManager = new \Openclassrooms\Blog\Model\CommentDAO();

		$post = $postManager -> getPost($_GET['id']);
		$comments = $commentManager -> getComments($_GET['id']);

		require('../template/postView.php');
	}

	// Ajout d'article
	function addPost($title, $article){
		$postManager = new \Openclassrooms\Blog\Model\PostDAO();

		$affectedPost = $postManager -> addPost($title, $article);

		header('Location: ../public/index.php');
	}

	function addComment($postId, $author, $comment){
		$commentManager = new \Openclassrooms\Blog\Model\CommentDAO();

		$affectedLines = $commentManager->postComment($postId, $author, $comment);

		if($affectedLines === false){
			throw new Exception('Impossible d\'ajouter le commentaire !');
		} else {
			header('Location: ../public/index.php?action=post&id=' . $postId);
		}
	}

	function editComment($id){
		$commentManager = new \Openclassrooms\Blog\Model\CommentDAO();

		$editedComment = $commentManager -> editComment($id);

		require('../template/editCommentView.php');
	}

	// Rediriger vers la page du post
	function editedComment($id, $newComment){
		$commentManager = new \Openclassrooms\Blog\Model\CommentDAO();

		$newlyEditedComment = $commentManager -> editedComment($id, $newComment);

		header('Location: ../public/index.php');
	}

	function deleteComment($id){
		$commentManager = new \Openclassrooms\Blog\Model\CommentDAO();

		$deletedComment = $commentManager -> deleteComment($id);

		header('Location: ../public/index.php');
	}

	function editPost($id){
		$postManager = new \Openclassrooms\Blog\Model\PostDAO();

		$editedPost = $postManager -> editPost($id);

		require('../template/editPostView.php');
	}

	function editedPost($id, $newTitle, $newPost){
		$postManager = new \Openclassrooms\Blog\Model\PostDAO();

		$newlyEditedPost = $postManager -> editedPost($id, $newTitle, $newPost);

		header('Location: ../public/index.php');
	}

	function deletePost($id){
		$postManager = new \Openclassrooms\Blog\Model\PostDAO();

		$deletedPost = $postManager -> deletePost($id);

		header('Location: ../public/index.php');
	}