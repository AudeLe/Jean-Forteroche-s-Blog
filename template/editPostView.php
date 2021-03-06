<?php $this->title = 'Edition de post'; ?>

    <!-- Allow the admin to edit the chapter -->
	<h2>Edition de chapitre</h2>

    <div class="row">
        <div class="col-md-12">
            <form action="../public/index.php?action=editedPost&id=<?= strip_tags($post->getId()); ?>" method="post">
                <div>
                    <label for="newTitle">Titre du post</label><br />
                    <input type="text" id="newTitle" name="newTitle" value="<?= strip_tags($post->getTitle()); ?>" />
                </div>
                <div>
                    <label for="newPost">Post</label><br />
                    <textarea id="newPost" name="newPost" class="writtingChapter"><?= strip_tags($post->getContent()); ?></textarea>
                </div>
                <div>
                    <input type="submit" value="Editer le post" class="submitButton" />
                </div>
            </form>
        </div>
    </div>