<?php

namespace Blog\src\DAO;

use Blog\src\classes\Comment;

//require_once('DAO.php');

class CommentDAO extends DAO{

	public function getComments($postId){

	    $sql = 'SELECT COUNT(id) as nbComments FROM comments WHERE post_id = ?';
	    $result = $this->sql($sql, [$postId]);
        $countCommentsData = $result -> fetch();

		//$db = $this -> dbConnect();

        //$countComments = $db -> prepare('SELECT COUNT(id) as nbComments FROM comments WHERE post_id = :post_id');
        //$countComments -> execute(array(
            //'post_id' => $postId
        //));
        //$countCommentsData = $countComments -> fetch();

        $nbComments = $countCommentsData['nbComments'];
        $perPage = 5;
        $nbPage = ceil($nbComments/$perPage);

        if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage){
            $cPage = $_GET['p'];
        } else {
            $cPage= 1;
        }

        $sql = 'SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT '.(($cPage-1)*$perPage).','.$perPage.'';
        $result = $this->sql($sql, [$postId]);
        $comments = [];

        foreach ($result as $row){
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }

		//$comments = $db -> prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT '.(($cPage-1)*$perPage).','.$perPage.'');
		//$comments -> execute(array($postId));

        for($i = 1; $i <= $nbPage; $i++){
            if($i == $cPage){
                echo "$i /";
            } else {
                echo "<a href =\"../public/index.php?action=post&id=$postId&p=$i\">$i</a>";
            }
        }


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

	private function buildObject(array $row){
	    $comment = new Comment();
	    $comment->setId($row['id']);
	    $comment->setPostIt($row['post_id']);
        $comment->setAuthor(($row['author']));
        $comment->setComment($row['comment']);
        $comment->setCommentDate($row['comment_date_fr']);
        return $comment;
    }
}