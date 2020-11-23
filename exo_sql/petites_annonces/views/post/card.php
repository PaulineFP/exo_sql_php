<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
        <!--La méthode getCreatedAt() permet de récupérer un datetime, ce qui permet de formater facilement les dates:-->
        <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
        <p><?= $post->getExcerpt() ?></p>
        <p>
            <a href="<?= $router->url( 'post', ['id'=> $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>