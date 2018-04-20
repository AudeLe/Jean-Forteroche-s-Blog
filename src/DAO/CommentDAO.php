<?php

namespace Blog\src\DAO;

require_once('DAO.php');

class CommentDAO extends DAO{

	public function getComments($postId){
		$db = $this -> dbConnect();
		$comments = $db -> prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
		$comments -> execute(array($postId));

		return $comments;
	}

	public function postComment($postId, $author, $comment){
		$db = $this -> dbConnect();
		$comments = $db -> prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
		$affectedLines = $comments -> execute(array($postId, $author, $comment));

		return $affectedLines;
	}

	public function editComment($id){
		$db = $this -> dbConnect();

		$comment = $db -> prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
		$comment -> execute(array($id));

		return $comment;
	}

	public function editedComment($id, $newComment){
		$db = $this -> dbConnect();

		$newlyEditedComment = $db -> prepare('UPDATE comments SET comment = ? WHERE id = ?');
		$newlyEditedComment -> execute(array($newComment, $id));

		return $newlyEditedComment;
	}

	public function deleteComment($id){
		$db = $this -> dbConnect();

		$deletedComment = $db -> prepare('DELETE FROM comments WHERE id = :id');
		$deletedComment -> execute(array(
			'id' => $id
		));
	}
}