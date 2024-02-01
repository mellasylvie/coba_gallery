<div class="container">
    <div class="row">
        <div class="col">
            <img class="img-fluid img-thumbnail" src="https://html.com/wp-content/uploads/flamingo.jpg" alt="" srcset="">
            <button type="button" class="btn btn-white position-relative ">
                <i class="bi bi-heart-fill text-danger fs-1 "></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $count_like ?>
                </span>
            </button>
        </div>
        <div class="col">
            <h5>Komentar</h5>
            <?php foreach ($comment_picture as $comment) : ?>
                <span class="badge text-bg-primary"><?= $comment['username'] ?></span>
                <p>
                    <?= $comment['isi_komentar'] ?>
                </p>
                <hr>
            <?php endforeach ?>
        </div>
    </div>
</div>