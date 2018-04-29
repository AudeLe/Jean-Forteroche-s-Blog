<?php $this->title = 'Accueil'; ?>

    <div class="row" id="listPostsWelcome">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1>Bienvenue sur mon blog</h1>

            <p>
                Je souhaite vous faire partager mon ouvrage : "Billet simple pour l'Alaska".
                Les chapitres seront publiés au fur et à mesure de leur écriture. N'hésitez pas à me faire part de vos remarques et de vos corrections.
            </p>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <?php

            foreach($posts[0] as $post):
                ?>
                <div class="news">
                    <h4><a href="../public/index.php?action=post&id=<?= strip_tags($post->getId()); ?>"><?= strip_tags($post->getTitle()); ?></a></h4>
                    <p class="date datePosts">Créé le <em><?= strip_tags($post->getCreationDate()); ?></em></p>
                    <div class="postContent"><?= strip_tags($post->getContent()); ?>
                        <span class="ellipsis">&#133;</span>
                        <span class="fill"></span>
                    </div>

                </div>
                <br />

            <?php endforeach; ?>

        </div>

        <div id="authorPresentation" class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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