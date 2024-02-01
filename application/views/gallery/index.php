<div class="container">
    <div class="row">
        <?php foreach ($gallery as $galleries) : ?>
            <div class="col my-5">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $galleries['nama_album'] ?></h5>
                        <p class="card-text"><?= $galleries['deskripsi'] ?></p>
                        <a href="<?= base_url('gallery/detail/') . base64_encode($galleries['album_id']) ?>" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>