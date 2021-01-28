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
    <center>
      <iframe src="<?= base_url(); ?>upload/<?= $dokumen['file'] ?>" width="1000" height="400"></iframe>
    </center>
  </div>