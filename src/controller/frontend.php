<?php
	
	require_once('../src/DAO/PostManager.php');
	require_once('../src/DAO/CommentManager.php');

	function listPosts(){
		$postManager = new \Openclassrooms\Blog\Model\PostManager();
		$posts = $postManager -> getPosts();

		require('../template/listPostsView.php');
	}

	function post(){
		$postManager = new \Openclassrooms\Blog\Model\PostManager();
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$post = $postManager -> getPost($_GET['id']);
		$comments = $commentManager -> getComments($_GET['id']);

		require('../template/postView.php');
	}

	// Ajout d'article
	function addPost($title, $article){
		$postManager = new \Openclassrooms\Blog\Model\PostManager();

		$affectedPost = $postManager -> addPost($title, $article);

		header('Location: home.php');
	}

	function addComment($postId, $author, $comment){
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$affectedLines = $commentManager->postComment($postId, $author, $comment);

		if($affectedLines === false){
			throw new Exception('Impossible d\'ajouter le commentaire !');
		} else {
			header('Location: home.php?action=post&id=' . $postId);
		}
	}

	function editComment($id){
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$editedComment = $commentManager -> editComment($id);

		require('../template/editCommentView.php');
	}

	// Rediriger vers la page du post
	function editedComment($id, $newComment){
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$newlyEditedComment = $commentManager -> editedComment($id, $newComment);

		header('Location: home.php');
	}

	function deleteComment($id){
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$deletedComment = $commentManager -> deleteComment($id);

		header('Location: home.php');
	}

	function editPost($id){
		$postManager = new \Openclassrooms\Blog\Model\PostManager();

		$editedPost = $postManager -> editPost($id);

		require('../template/editPostView.php');
	}

	function editedPost($id, $newTitle, $newPost){
		$postManager = new \Openclassrooms\Blog\Model\PostManager();

		$newlyEditedPost = $postManager -> editedPost($id, $newTitle, $newPost);

		header('Location: home.php');
	}

	function deletePost($id){
		$postManager = new \Openclassrooms\Blog\Model\PostManager();

		$deletedPost = $postManager -> deletePost($id);

		header('Location: home.php');
	}