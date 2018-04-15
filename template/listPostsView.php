<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
	<h1>Bienvenue sur mon blog</h1>

    <p>
        Je souhaite vous faire partager mon ouvrage : "Billet simple pour l'Alaska".
        Les chapitres seront publiés au fur et à mesure de leur écriture. N'hésitez pas à me faire part de vos remarques et de vos corrections.
    </p>
	<p>Derniers chapitres :</p>

	<?php
		while($data = $posts->fetch()){
			?>
			<div class="news">
				<h3>
					<?= htmlspecialchars($data['title']) ?><br/ >
					<em>le <?= $data['creation_date_fr'] ?></em>

				</h3>

				<p>
					<?= nl2br(htmlspecialchars($data['content'])) ?><br />
					<em><a href="../public/index.php?action=post&id=<?= $data['id'] ?>">Commentaires</a></em>
				</p>
			</div>

			<?php
		}
		$posts->closeCursor();
	?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>