                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="row">
                        <div class="col-lg-8" style="max-width: 560px;">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    </div>

                    <div class="card shadow" style="max-width: 540px;">

                        <div class="card-header py-3">
                            <h class="m-0 font-weight-bold text-primary"><?= $title ?></h>
                        </div>

                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $user['name']; ?></h5>
                                    <p class="card-text"><?= $user['email']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $user['date_created']); ?></small></p>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->