<?php
	
	require_once('model/PostManager.php');
	require_once('model/CommentManager.php');

	function listPosts(){
		$postManager = new \Openclassrooms\Blog_Model\PostManager();
		$posts = $postManager -> getPosts();

		require('view/frontend/listPostsView.php');
	}

	function post(){
		$postManager = new \Openclassrooms\Blog\Model\PostManager();
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$post = $postManager -> getPost($_GET_['id']);
		$comments = $commentManager -> getComments($_GET['id']);

		require('view/frontend/postView.php');
	}

	function addComment($postId, $author, $comment){
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$affectedLines = $commentManager -> postComment($post, $author, $comment);

		if($affectedLines === false){
			throw new Exception('Impossible d\'ajouter le commentaire !');
		} else {
			header('Location: index.php?action=post&id=' . $postId);
		}
	}

	function editComment($id){
		$commentManager = new \Openclassrooms\blog\Model\CommentManager();

		$editedComment = $commentManager -> editComment($id);

		require('view/frontend/editCommentView.php');
	}

	// Rediriger vers la page du post
	function editedComment($id, $newComment){
		$commentManager = new \Openclassrooms\Blog\Model\CommentManager();

		$newlyEditedComment = $commentManager -> editedComment($id, $newComment);

		header('Location: index.php');
	}