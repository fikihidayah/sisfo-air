<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('error_m', 'error');

    if (!$this->ion_auth->logged_in()) {
      redirect('gate/login', 'refresh');
    }

    if (!$this->ion_auth->is_admin()) {
      redirect('');
    }
  }


  public function index()
  {
    $data = [
      'title' => 'Pengaturan',
      'data' => $this->master->baca('sett_anggaran', ['id_sett' => 1])->row()
    ];

    view('pengaturan', $data);
  }


  public function aksi_edit()
  {
    if ($this->form_validation->run('pengaturan')) {
      $post = $this->input->post();
      $oldData = $this->master->baca('sett_anggaran', ['id_sett' => 1])->row();

      $param = [
        'nama_penyetuju' => $post['nama_penyetuju'],
        'jabatan_penyetuju' => $post['jabatan_penyetuju'],
        'nama_pemeriksa' => $post['nama_pemeriksa'],
        'jabatan_pemeriksa' => $post['jabatan_pemeriksa'],
        'nama_pembuat' => $post['nama_pembuat'],
        'jabatan_pembuat' => $post['jabatan_pembuat'],
        'nama_pengesah' => $post['nama_pengesah'],
        'jabatan_pengesah' => $post['jabatan_pengesah'],
      ];

      // upload tanda tangan penyetuju
      $ttd_penyetuju = upload_gambar('pengaturan', 'ttd_penyetuju', $oldData->ttd_penyetuju);
      if ($ttd_penyetuju['status']) {
        $param['ttd_penyetuju'] = $ttd_penyetuju['file'];
      } elseif ($ttd_penyetuju['status'] === false) {
        $this->error->ttd_penyetuju = $ttd_penyetuju['error'];
      }


      // upload tanda tangan pemeriksa
      $ttd_pemeriksa = upload_gambar('pengaturan', 'ttd_pemeriksa', $oldData->ttd_pemeriksa);
      if ($ttd_pemeriksa['status']) {
        $param['ttd_pemeriksa'] = $ttd_pemeriksa['file'];
      } elseif ($ttd_pemeriksa['status'] === false) {
        $this->error->status = false;
        $this->error->ttd_pemeriksa = $ttd_pemeriksa['error'];
      }

      // upload tanda tangan pembuat
      $ttd_pembuat = upload_gambar('pengaturan', 'ttd_pembuat', $oldData->ttd_pembuat);
      if ($ttd_pembuat['status']) {
        $param['ttd_pembuat'] = $ttd_pembuat['file'];
      } elseif ($ttd_pembuat['status'] === false) {
        $this->error->status = false;
        $this->error->ttd_pembuat = $ttd_pembuat['error'];
      }

      // upload tanda tangan pengesah
      $ttd_pengesah = upload_gambar('pengaturan', 'ttd_pengesah', $oldData->ttd_pengesah);
      if ($ttd_pengesah['status']) {
        $param['ttd_pengesah'] = $ttd_pengesah['file'];
      } elseif ($ttd_pengesah['status'] === false) {
        $this->error->status = false;
        $this->error->ttd_pengesah = $ttd_pengesah['error'];
      }

      if (!$this->error->status) {
        json(['error' => $this->error]);
        exit;
      }

      $this->master->ubah('sett_anggaran', $param, ['id_sett' => 1]);
      json(['message' => 'Berhasil mengubah pengaturan']);
    } else {
      foreach ($_POST as $key => $val) {
        $this->error->status = false;
        $this->error->$key = form_error($key);
        json(['error' => $this->error]);
      }
    }
  }

  public function hapusGambar()
  {
    $type = $this->input->post('type');
    $gambar = $this->input->post('gambar');
    $target_file = "./assets/img/pengaturan/" . $gambar;

    if (is_file($target_file)) {
      unlink($target_file);
    }

    $this->master->ubah('sett_anggaran', [$type => null], ['id_sett' => 1]);

    json(['message' => 'Berhasil menghapus tanda tangan']);
  }
}
