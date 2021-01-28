<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Barang";
        $data['barang'] = $this->admin->getBarang();
        // foreach ($data as $row) {
        //     $a = $row['id_barang'];
        // }
        // // $a = 'B000001';
        // $data = array(
        //     'title' => "Barang",
        //     'barang' => $this->admin->getBarang(),
        // );
        $this->template->load('templates/dashboard', 'barang/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('jenis_id', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('satuan_id', 'Satuan Barang', 'required');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');

            // Mengenerate ID Barang
            $kode_terakhir = $this->admin->getMax('barang', 'id_barang');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_barang'] = 'B' . $number;

            $this->template->load('templates/dashboard', 'barang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('barang', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('barang');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('barang/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
            $data['barang'] = $this->admin->get('barang', ['id_barang' => $id]);
            $this->template->load('templates/dashboard', 'barang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('barang', 'id_barang', $id, $input);

            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('barang');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('barang/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang', 'id_barang', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barang');
    }

    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStok($id);
        output_json($query);
    }


    // ini digunakan untuk memanggil detail barang

    public function detailBarang()
    {
        $data['title'] = 'Halaman Detail Barang';
        $data['dbarang'] = $this->admin->getDetailBarang('detail_barang');
        $this->template->load('templates/dashboard', 'detail_barang/data', $data);
    }

    public function detailBarangId($getId)
    {
        $id = encode_php_tags($getId);
        $data['title'] = 'Halaman Detail Barang';
        $data['dbarang'] = $this->admin->getDetailBarang('detail_barang', ['id_barang' => $id]);
        $data['id_barang'] = $id;
        // $data['dbarang'] = $this->admin->getDetailBarang('detail_barang');
        $this->template->load('templates/dashboard', 'detail_barang/data', $data);
    }

    public function detailBarangKeluarId($getId)
    {
        $id = encode_php_tags($getId);
        $data['title'] = 'Halaman Detail Barang Keluar';
        $data['dbarang'] = $this->admin->getDetailBarang('detail_barang', ['id_barang' => $id]);
        $data['id_barang'] = $id;
        // $data['dbarang'] = $this->admin->getDetailBarang('detail_barang');
        $this->template->load('templates/dashboard', 'detail_barang/dataKeluar', $data);
    }

    private function _validasiDetailBarang()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('id_barang', 'Id Barang', 'required');
    }

    public function addDetailBarang()
    {
        $this->_validasiDetailBarang();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Detail Barang";
            $data['id_barang'] = $this->input->post('id_barang');
            $data['barang'] = $this->admin->get('barang');

            $id_barang1 = $this->input->post('id_barang');
            $kode_terakhir = $this->admin->getMax('detail_barang', 'id_detail_barang', $id_barang1);
            $kode_tambah = substr($kode_terakhir, -4, 4);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 4, '0', STR_PAD_LEFT);
            $data['id_detail_barang'] = $id_barang1 . '-' . $number;

            $this->template->load('templates/dashboard', 'detail_barang/add', $data);
        } else {
            $id_barang = $this->input->post('id_barang');
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('detail_barang', $input);

            if ($insert) {
                if (isset($id_barang) == TRUE) {
                    set_pesan('data berhasil disimpan');
                    redirect('barang/detailBarangId/' . $id_barang);
                } else {
                    set_pesan('data berhasil disimpan');
                    redirect('barang/detailBarang');
                }
            } else {
                set_pesan('gagal menyimpan data');
                redirect('barang/addDetailBarang');
            }
        }
    }

    public function editDataBarang($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasiDetailBarang();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Detail Barang";
            $data['barang'] = $this->admin->get('detail_barang', ['id_detail_barang' => $id]);
            $this->template->load('templates/dashboard', 'detail_barang/edit', $data);
        } else {
            $id_barang = $this->input->post('id_barang');
            $input = $this->input->post(null, true);
            $update = $this->admin->update('detail_barang', 'id_detail_barang', $id, $input);

            if ($update) {
                if (isset($id_barang) == TRUE) {
                    set_pesan('data berhasil disimpan');
                    redirect('barang/detailBarangId/' . $id_barang);
                } else {
                    set_pesan('data berhasil disimpan');
                    redirect('barang/detailBarang');
                }
            } else {
                set_pesan('gagal menyimpan data');
                redirect('barang/editDataBarang/' . $id);
            }
        }
    }

    public function deleteDataBarang($getId, $id_barang)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('detail_barang', 'id_detail_barang', $id)) {
            if (isset($id_barang) == TRUE) {
                set_pesan('data berhasil dihapus.');
                redirect('barang/detailBarangId/' . $id_barang);
            } else {
                set_pesan('data berhasil dihapus.');
                redirect('barang/detailBarang');
            }
        } else {
            set_pesan('data gagal dihapus.', false);
            redirect('barang/detailBarangId/' . $id_barang);
        }
    }

    public function dokumenBarang()
    {
        $data['title'] = 'Dokumen Barang';
        $data['dokumen'] = $this->admin->getFor('dokumen');
        $this->template->load('templates/dashboard', 'dokumen/data', $data);
    }

    public function vAddDokumen()
    {
        $data['title'] = "Barang";
        // Mengenerate ID Barang
        $kode_terakhir = $this->admin->getMax('dokumen', 'id_dokumen');
        $kode_tambah = substr($kode_terakhir, -4, 4);
        $kode_tambah++;
        $number = str_pad($kode_tambah, 4, '0', STR_PAD_LEFT);
        $data['id_dokumen'] = 'D' . $number;

        $this->template->load('templates/dashboard', 'dokumen/add', $data);
    }

    public function addDokumenBarang()
    {

        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'pdf';
        $config['file_name']            = $this->input->post('id_dokumen');
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('userfile')) {
            $file = $this->upload->data();
        }
        $data = array(
            'id_dokumen' => $this->input->post('id_dokumen'),
            'nama_dokumen' => $this->input->post('nama_dokumen'),
            'jenis_dokumen' => $this->input->post('jenis_dokumen'),
            'file' => $file['file_name']
        );
        $insert = $this->admin->insert('dokumen', $data);

        if ($insert) {
            set_pesan('data berhasil disimpan');
            redirect('barang/dokumenBarang');
        } else {
            set_pesan('gagal menyimpan data');
            redirect('barang/dokumenBarang');
        }
    }

    public function vEditDokumen($id)
    {
        $data['title'] = "Barang";
        $data['dokumen'] = $this->admin->get('dokumen', ['id_dokumen' => $id]);
        $this->template->load('templates/dashboard', 'dokumen/edit', $data);
    }

    public function editDokumenBarang()
    {
        $id   = $this->input->post('id_dokumen');
        $name = $this->input->post('nama_dokumen');
        $jenis = $this->input->post('jenis_dokumen');
        $lama = $this->input->post('filelama');
        $path = './upload/';

        // get foto
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'pdf';
        $config['file_name']            = $this->input->post('id_dokumen');
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!empty($_FILES['userfile']['name'])) {
            if ($this->upload->do_upload('userfile')) {
                $foto = $this->upload->data();
                $data = array(
                    'nama_dokumen'   => $name,
                    'jenis_dokumen'  => $jenis,
                    'file'           => $foto['file_name'],
                );
                // hapus foto pada direktori
                @unlink($path . $this->input->post('filelama'));

                $update = $this->admin->update('dokumen', 'id_dokumen', $id, $data);
                if ($update) {
                    set_pesan('data berhasil diperbaharui');
                    redirect('barang/dokumenBarang');
                } else {
                    set_pesan('gagal memperbaharui data');
                    redirect('barang/dokumenBarang');
                }
            } else {
                die("gagal update");
            }
        } else {
            $data = array(
                'nama_dokumen'   => $name,
                'jenis_dokumen'  => $jenis,
                'file'           => $lama,
            );
            $update = $this->admin->update('dokumen', 'id_dokumen', $id, $data);
            if ($update) {
                set_pesan('data berhasil diperbaharui');
                redirect('barang/dokumenBarang');
            } else {
                set_pesan('gagal memperbaharui data');
                redirect('barang/dokumenBarang');
            }
        }
    }

    public function deleteDokumenB($getId, $file)
    {
        $path = './upload/';
        @unlink($path . $file);

        $id = encode_php_tags($getId);
        if ($this->admin->delete('dokumen', 'id_dokumen', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barang/dokumenBarang');
    }

    public function viewDokumen($id)
    {
        $data['title'] = "Barang";
        $data['dokumen'] = $this->admin->get('dokumen', ['id_dokumen' => $id]);
        $this->template->load('templates/dashboard', 'dokumen/view', $data);
    }
}
