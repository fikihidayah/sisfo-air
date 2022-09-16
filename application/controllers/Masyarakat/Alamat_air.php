<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat_air extends CI_Controller
{
  private $user;
  public function __construct()
  {
    parent::__construct();
    $role = $this->ion_auth->get_users_groups()->row()->id;
    $type = $this->ion_auth->user()->row()->is_cabang;

    if ($type == 1) {
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
    $data['title'] = 'Alamat Rumah Aliran Air';
    $data['kantor'] = null;
    $kantor_aliran = $this->master->baca('kantor_aliran', ['users_id' => $this->user->id]);
    // cek apakah user sudah menambahkan kantor aliran
    if ($kantor_aliran->num_rows() > 0) {
      // jika sudah maka tinggal edit data saja
      $data['kantor'] = $kantor_aliran->row();
    }

    if ($this->form_validation->run('aksi_kantor_aliran')) {
      $post = $this->input->post(null, true);
      $param['nama_pemilik'] = $post['nama_pemilik'];
      $param['alamat'] = $post['alamat'];
      $param['no_register'] = !empty($post['no_register']) ? $post['no_register'] : NULL;

      if ($kantor_aliran->num_rows()) {
        $this->master->ubah('kantor_aliran', $param, [
          'id_kantor_aliran' => $post['id'],
          'users_id' => $this->user->id
        ]);
        message('success', 'Berhasil mengubah kantor aliran', 'alamat_air');
      }

      $param['users_id'] = $this->user->id;
      $this->master->simpan('kantor_aliran', $param);
      message('success', 'Berhasil menambahkan kantor aliran', 'alamat_air');
    }

    view('users/kantor-aliran/data', $data);
  }
}
