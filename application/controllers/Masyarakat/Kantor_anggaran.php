<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kantor_anggaran extends CI_Controller
{
  private $user;
  public function __construct()
  {
    parent::__construct();
    $role = $this->ion_auth->get_users_groups()->row()->id;

    $type = $this->ion_auth->user()->row()->is_cabang;

    if ($type == 0) {
      redirect('', 'refresh');
    }

    if ($role != 5) {
      redirect('', 'refresh');
    }

    if (!$this->ion_auth->logged_in()) {
      redirect('gate/login', 'refresh');
    }

    $this->user = $this->ion_auth->user()->row();
  }

  public function index()
  {
    $data['title'] = 'Kantor Anggaran';
    $data['kantor'] = null;
    $kantor_anggaran = $this->master->baca('kantor_anggaran', ['users_id' => $this->user->id]);
    // cek apakah user sudah menambahkan kantor anggaran
    if ($kantor_anggaran->num_rows() > 0) {
      // jika sudah maka tinggal edit data saja
      $data['kantor'] = $kantor_anggaran->row();
    }

    if ($this->form_validation->run('aksi_kantor_anggaran')) {
      $post = $this->input->post(null, true);
      $param['lokasi'] = $post['lokasi'];
      $param['cabang'] = $post['cabang'];

      if ($kantor_anggaran->num_rows()) {
        $this->master->ubah('kantor_anggaran', $param, [
          'id_kantor' => $post['id'],
          'users_id' => $this->user->id
        ]);
        message('success', 'Berhasil mengubah kantor anggaran', 'kantor_anggaran');
      }

      $param['users_id'] = $this->user->id;
      $this->master->simpan('kantor_anggaran', $param);
      message('success', 'Berhasil menambahkan kantor anggaran', 'kantor_anggaran');
    }

    view('users/kantor-anggaran/data', $data);
  }
}
