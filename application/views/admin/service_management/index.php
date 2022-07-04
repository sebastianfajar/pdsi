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
                            <th scope="col">Satuan Kerja</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($get_group as $row) : ?>
                            <tr>
                                <td scope="col"><?= $no++ ?></td>
                                <td scope="col"><?= $row->name ?></td>
                                <td scope="col"><?= $row->group_layanan ?></td>
                                <td>
                                    <a href="" type="button" class="btn btn-outline-success waves-effect btn-sm" data-toggle="modal" data-target="#editGroupLayanan<?= $row->id; ?>"> <i class="fas fa-fw fa-pen"></i></class=></a>
                                    <a href="<?= base_url() ?>admin/destroy_group_layanan/<?= $row->id ?>" type="button" class="btn btn-outline-danger waves-effect btn-sm" onclick="return confirm ('yakin?');"> <i class="fas fa-fw fa-trash-alt"></i></class=></a>
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
            <form action="<?= base_url('admin/add_group_layanan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="saker_id" id="saker_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($get_saker as $s) : ?>
                                <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('menu_id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="group_layanan" placeholder="Tambah Grup Layanan">
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
<?php $i = 1;
foreach ($get_group as $r) : $i++; ?>
    <div class="modal fade" id="editGroupLayanan<?= $r->id; ?>" tabindex="-1" aria-labelledby="editGroupLayananLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupLayananLabel">Ubah Grup Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/update_group_layanan'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $r->id; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="saker_id" id="saker_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($get_saker as $s) : ?>
                                    <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('menu_id', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="group_layanan" name="group_layanan" value="<?= $r->group_layanan; ?>">
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