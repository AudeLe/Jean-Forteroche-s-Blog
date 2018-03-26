<?php
	require('controller/fronted.php');

	try{
		if(isset($_GET['action'])){
			if($_GET['action'] == 'listPosts'){
				listPosts();
			}

			elseif($_GET['action'] == 'post'){
				if(isset($_GET['id']) && $_GET['id'] > 0){
					post();
				} else {
					throw new Exception('Aucun identifiant de billet envoyé');
				}
			}

			elseif($_GET['action'] == 'addComment'){
				if(isset($_GET['id']) && $_GET['id'] > 0){
					if(!empty($_POST['author']) && !empty($_POST['comment'])){
						addComment($_GET['id'], $_POST['author'], $_POST['comment']);
					} else {
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
				} else {
					throw new Exception('Aucun identifiant de billet envoyé.');
				}
			}

			elseif($_GET['action'] == 'editComment'){
				if(isset($_GET['id']) && $_GET['id'] > 0){
					editComment($_GET['id']);
				} else {
					throw new Exception('Impossible de récupérer le commentaire.')
				}
			}

			elseif($_GET['action'] == 'editedComment'){
				if(isset($_GET['id']) && $_GET['id'] > 0){
					editedComment($_GET['id'], $_POST['newComment']);
				} else {
					throw new Exception('Aucune modification effectuée sur le commentaire');
				}
			}
		} else {
			listPosts();
		}
	} catch(Exception $e){
		echo 'Erreur : ' . $e->getMessage();
	}