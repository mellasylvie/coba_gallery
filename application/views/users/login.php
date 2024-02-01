<div class="container">
    <div class="row">
        <?php if ($this->session->flashdata('err_message')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('err_message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($this->session->flashdata('message')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username">
                            <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>