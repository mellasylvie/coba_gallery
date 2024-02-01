<div class="container">
    <div class="row">
        <span class="badge text-bg-primary mt-4"><?= $gallery_foto[0]['nama_album'] ?></span>
        <?php foreach ($gallery_foto as $foto) : ?>
            <div class="col my-5">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $foto['judul_foto'] ?></h5>
                        <p class="card-text"><?= $foto['deskripsi_foto'] ?></p>

                        <a href="<?= base_url('gallery/detail_foto/') . base64_encode($foto['foto_id']) ?>" class="btn btn-primary">Detail</a>

                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>