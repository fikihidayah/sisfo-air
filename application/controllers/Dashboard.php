<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  private int $role;
  private int $userId;

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {
      redirect('gate/login');
    }

    if (is_null($this->ion_auth->user()->row())) {
      redirect('gate/logout');
    }

    $this->role = $this->ion_auth->get_users_groups()->row()->id;
    $this->userId = $this->ion_auth->user()->row()->id;
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['anggaran'] = $this->master->total('anggaran');
    $data['aliran'] = $this->master->total('aliran_air');
    if ($this->role == 1) {
      $data['satuan'] = $this->master->total('satuan');
      $data['kategori'] = $this->master->total('kategori');
      $data['kantor_anggaran'] = $this->master->total('kantor_anggaran');
      $data['kantor_aliran'] = $this->master->total('kantor_aliran');
      $data['users'] = $this->master->total('users');
      view('dashboard/admin', $data);
    } elseif ($this->role == 4) {

      $data['satuan'] = $this->master->total('satuan');
      $data['kategori'] = $this->master->total('kategori');
      $konfirm_anggaran = ($this->master->total('anggaran', ['status_konfirmasi' => 1]) / $data['anggaran']) * 100;
      $konfirm_aliran = ($this->master->total('pengisian', ['status_konfirmasi' => 1]) / $data['aliran']) * 100;
      $data['anggaran_konfirmasi'] = $konfirm_anggaran;
      $data['aliran_konfirmasi'] = $konfirm_aliran;
      view('dashboard/petugas', $data);
    } else {

      $data['anggaran_konfirmasi'] = $this->master->totalPersenAnggaranUser();
      $data['aliran_konfirmasi'] = $this->master->totalPersenAliranUser();

      view('dashboard/user', $data);
    }
  }
}
