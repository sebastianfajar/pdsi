<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?= $this->session->flashdata('message'); ?>
    <?= form_error('menu', '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> ', ' </div>'); ?>
    <div class="card shadow">
        <div class="card-header py-3">
            <h class="m-0 font-weight-bold text-primary"><?= $title ?></h>
            <a href="" class="btn btn-outline-primary waves-effect btn-sm float-right" data-toggle="modal" data-target="#newLayananModal"> <i class="fas fa-fw fa-plus"></i> Tambah Grup Layanan </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Satuan Kerja</th>
                            <th scope="col">Pertanyaan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_question as $q) :  ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $q->group_layanan ?></td>
                                <td><?= $q->name ?></td>
                                <td><?= $q->question ?></td>
                                <td>
                                    <a href="" type="button" class="btn btn-outline-success waves-effect btn-sm" data-toggle="modal" data-target="#editQuestion<?= $q->id; ?>"> <i class="fas fa-fw fa-pen"></i></class=></a>
                                    <a href="<?= base_url() ?>admin/destroy_question/<?= $q->id ?>" type="button" class="btn btn-outline-danger waves-effect btn-sm" onclick="return confirm ('yakin?');"> <i class="fas fa-fw fa-trash-alt"></i></class=></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newLayananModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Grup Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/add_question'); ?>" method="post">
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="saker_id" id="saker_id" class="form-control">
                            <option value="">Select Work Unit</option>
                            <?php foreach ($get_saker as $s) : ?>
                                <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="group_id" id="group_id" class="form-control">
                            <option value="">Select Services</option>
                            <?php foreach ($get_group as $g) : ?>
                                <option value="<?= $g->id; ?>"><?= $g->group_layanan; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="question" name="question" placeholder="New Question">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->

<!-- Edit Modal -->
<?php $i = 1;
foreach ($get_question as $qu) : $i++; ?>
    <div class="modal fade" id="editQuestion<?= $qu->id; ?>" tabindex="-1" aria-labelledby="editQuestion" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestion">Ubah Grup Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/update_question'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $qu->id; ?>">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="saker_id" id="saker_id" class="form-control">
                                <?php foreach ($get_saker as $s) : ?>
                                    <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="group_id" id="group_id" class="form-control">
                                <?php foreach ($get_group as $g) : ?>
                                    <option value="<?= $g->id; ?>"><?= $g->group_layanan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="question" name="question" value="<?= $qu->question; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>