<?php $this->title = 'Accueil'; ?>


    <h1>Bienvenue sur mon blog</h1>

    <p>
        Je souhaite vous faire partager mon ouvrage : "Billet simple pour l'Alaska".
        Les chapitres seront publiés au fur et à mesure de leur écriture. N'hésitez pas à me faire part de vos remarques et de vos corrections.
    </p>

    <p>Derniers chapitres :</p>

    <div class="row">
        <div id="chaptersPresentation" class="col-md-9">

            <?php

            foreach($posts[0] as $post):
                ?>
                <div class="news">
                    <h3><a href="../public/index.php?action=post&id=<?= $post->getId(); ?>"><?= $post->getTitle(); ?></a></h3>
                    <p class="date datePosts">Créé le <em><?= $post->getCreationDate(); ?></em></p>
                    <div class="postContent"><?= $post->getContent(); ?>
                        <span class="ellipsis">&#133;</span>
                        <span class="fill"></span>
                    </div>

                </div>
                <br />

            <?php endforeach; ?>

        </div>

        <div id="authorPresentation" class="col-md-3">
            <h3>Jean Forteroche</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mauris tortor, euismod a augue in, lacinia semper ante.<br/>
                Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse sed quam tempus risus rutrum ullamcorper quis in eros. Nulla neque dui, eleifend ultricies dolor eu, molestie accumsan nisl. Fusce congue risus et turpis finibus fermentum ut gravida tortor.<br />
                Nunc ut consectetur nunc, ut lobortis mi. Mauris venenatis vulputate turpis quis sagittis. Vestibulum lacinia ex dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
            </p>
        </div>
    </div>

    <div class="pages">
        <?php foreach($posts[1] as $page): ?>
            <span><?= $page; ?></span>

        <?php endforeach;?>
    </div>