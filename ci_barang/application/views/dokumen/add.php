<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm border-bottom-primary">
      <div class="card-header bg-white py-3">
        <div class="row">
          <div class="col">
            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
              Form Tambah Dokumen
            </h4>
          </div>
          <div class="col-auto">
            <a href="<?= base_url('supplier') ?>" class="btn btn-sm btn-secondary btn-icon-split">
              <span class="icon">
                <i class="fa fa-arrow-left"></i>
              </span>
              <span class="text">
                Kembali
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?= $this->session->flashdata('pesan'); ?>
        <?= form_open_multipart('barang/addDokumenBarang'); ?>
        <div class="row form-group">
          <label class="col-md-3 text-md-right" for="id_dokumen">ID Dokumen</label>
          <div class="col-md-9">
            <div class="input-group">
              <input value="<?= set_value('id_dokumen'), $id_dokumen; ?>" name="id_dokumen" id="id_dokumen" type="text" class="form-control" placeholder="Id Dokumen...">
            </div>
            <?= form_error('id_dokumen', '<small class="text-danger">', '</small>'); ?>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-3 text-md-right" for="nama_dokumen">Nama Dokumen</label>
          <div class="col-md-9">
            <div class="input-group">
              <input value="<?= set_value('nama_dokumen'); ?>" name="nama_dokumen" id="nama_dokumen" type="text" class="form-control" placeholder="Nama dokumen...">
            </div>
            <?= form_error('nama_dokumen', '<small class="text-danger">', '</small>'); ?>
          </div>
        </div>
        <div class="row form-group">
          <label class="col-md-3 text-md-right" for="jenis_dokumen">Jenis Dokumen</label>
          <div class="col-md-9">
            <div class="input-group">
              <select name="jenis_dokumen" id="jenis_dokumen" class="custom-select" required>
                <option value="" selected disabled>Pilih Satuan Barang</option>
                <option value="BM">Barang Masuk</option>
                <option value="BK">Barang Keluar</option>
              </select>
            </div>
            <?= form_error('jenis_dokumen', '<small class="text-danger">', '</small>'); ?>
          </div>
        </div>
        <div class="row form-group">
          <label class="col-md-3 text-md-right" for="file">File Dokumen</label>
          <div class="col-md-9">
            <div class="input-group">
              <input value="<?= set_value('file'); ?>" name="userfile" id="file" type="file" class="form-control" placeholder="Jenis Dokumen...">
            </div>
            <?= form_error('file', '<small class="text-danger">', '</small>'); ?>
          </div>
        </div>
        <!-- <div class="row form-group">
          <label class="col-md-3 text-md-right" for="file">file</label>
          <div class="col-md-9">
            <div class="input-group">
              <input type="file" name="userfile">
            </div>
          </div>
        </div> -->
        <div class="row form-group">
          <div class="col-md-9 offset-md-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </div>
        <?= form_close(); ?>

      </div>
    </div>
  </div>
</div>