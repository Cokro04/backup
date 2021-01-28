<?php if (is_admin()) : ?>
  <?= $this->session->flashdata('pesan'); ?>
  <div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
      <div class="row">
        <div class="col">
          <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Data Dokumen
          </h4>
        </div>
        <div class="col-auto">
          <a href="<?= base_url('barang/vAddDokumen') ?>" class="btn btn-sm btn-primary btn-icon-split">
            <span class="icon">
              <i class="fa fa-plus"></i>
            </span>
            <span class="text">
              Tambah Dokumen
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
        <thead>
          <tr>
            <th>No.</th>
            <th>Id Dokumen</th>
            <th>Nama Dokumen</th>
            <th>Jenis</th>
            <th>File</th>
            <th>Lihat Dokumen</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($dokumen) :
            $no = 1;
            foreach ($dokumen as $s) :
          ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $s['id_dokumen']; ?></td>
                <td><?= $s['nama_dokumen']; ?></td>
                <td><?= $s['jenis_dokumen']; ?></td>
                <td><?= $s['file']; ?></td>
                <td><a href="<?= base_url('barang/viewDokumen/') . $s['id_dokumen'] ?>" class="btn btn-circle btn-success btn-sm"><i class="fa fa-eye" title="Lihat dokumen"></i></a>
                </td>
                <th>
                  <a href="<?= base_url('barang/vEditDokumen/') . $s['id_dokumen'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                  <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barang/deleteDokumenB/') . $s['id_dokumen'] . "/" . $s['file'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                </th>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="6" class="text-center">
                Data Kosong
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endif; ?>

<?php if (is_gudang()) : ?>
  <?= $this->session->flashdata('pesan'); ?>
  <div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
      <div class="row">
        <div class="col">
          <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Data Dokumen
          </h4>
        </div>
        <div class="col-auto">
          <a href="<?= base_url('barang/vAddDokumen') ?>" class="btn btn-sm btn-primary btn-icon-split">
            <span class="icon">
              <i class="fa fa-plus"></i>
            </span>
            <span class="text">
              Tambah Dokumen
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
        <thead>
          <tr>
            <th>No.</th>
            <th>Id Dokumen</th>
            <th>Nama Dokumen</th>
            <th>Jenis</th>
            <th>File</th>
            <th>Lihat Dokumen</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($dokumen) :
            $no = 1;
            foreach ($dokumen as $s) :
          ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $s['id_dokumen']; ?></td>
                <td><?= $s['nama_dokumen']; ?></td>
                <td><?= $s['jenis_dokumen']; ?></td>
                <td><?= $s['file']; ?></td>
                <td><a href="<?= base_url('barang/viewDokumen/') . $s['id_dokumen'] ?>" class="btn btn-circle btn-success btn-sm"><i class="fa fa-eye" title="Lihat dokumen"></i></a>
                </td>
                <th>
                  <a href="<?= base_url('barang/vEditDokumen/') . $s['id_dokumen'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                  <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barang/deleteDokumenB/') . $s['id_dokumen'] . "/" . $s['file'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                </th>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="6" class="text-center">
                Data Kosong
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endif; ?>