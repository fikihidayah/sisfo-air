<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atribut extends CI_Controller
{
  private $resultAdd = false;
  private $resultEdit = false;
  private int $role;
  public function __construct()
  {
    parent::__construct();
    $this->role = $this->ion_auth->get_users_groups()->row()->id;

    if (!$this->ion_auth->logged_in()) {
      redirect('gate/login', 'refresh');
    }
  }

  // satuan add, edit
  public function satuan()
  {
    if (!$this->ion_auth->is_admin()) {
      redirect('', 'refresh');
    }


    $data = [
      'title' => 'satuan',
      'satuan' => $this->master->baca('satuan')->result()
    ];

    if ($this->form_validation->run('aksi_satuan')) {
      $post = $this->input->post(null, true);
      $param['nama_satuan'] = $post['nama_satuan'];

      // aksi db
      if (isset($post['id'])) {
        // jika idnya ada maka data diedit
        $this->resultEdit =  $this->master->ubah('satuan', $param, ['id_satuan' => $post['id']]);
      } else {
        $this->resultAdd =  $this->master->simpan('satuan', $param);
      }

      // pesan
      if ($this->resultAdd > 0) {
        message('success', 'Berhasil menambahkan satuan', 'atribut/satuan');
      }

      if ($this->resultEdit > 0) {
        message('success', 'Berhasil mengubah satuan', 'atribut/satuan');
      } else {
        message('error', 'Satuan tidak ada perubahan', 'atribut/satuan');
      }
    }

    view('atribut/satuan/data', $data);
  }

  public function getSatuan($id)
  {
    $satuan = $this->master->baca('satuan', ['id_satuan' => $id])->row();
    json($satuan);
  }

  // kategori add, edit
  public function kategori()
  {
    if (!$this->ion_auth->is_admin()) {
      redirect('', 'refresh');
    }


    $data = [
      'title' => 'kategori',
      'kategori' => $this->master->baca('kategori')->result()
    ];

    if ($this->form_validation->run('aksi_kategori')) {
      $post = $this->input->post(null, true);
      $param['nama_kategori'] = $post['nama_kategori'];
      $param['keterangan'] = !empty($post['keterangan']) ? $post['keterangan'] : NULL;

      // aksi db
      if (isset($post['id'])) {
        // jika idnya ada maka data diedit
        $this->resultEdit =  $this->master->ubah('kategori', $param, ['id_kat' => $post['id']]);
      } else {
        $this->resultAdd =  $this->master->simpan('kategori', $param);
      }

      // pesan
      if ($this->resultAdd > 0) {
        message('success', 'Berhasil menambahkan kategori', 'atribut/kategori');
      }

      if ($this->resultEdit > 0) {
        message('success', 'Berhasil mengubah kategori', 'atribut/kategori');
      } else {
        message('error', 'Tidak ada perubahan pada kategori', 'atribut/kategori');
      }
    }

    view('atribut/kategori/data', $data);
  }

  public function getKategori($id)
  {
    $kategori = $this->master->baca('kategori', ['id_kat' => $id])->row();
    json($kategori);
  }

  // kantor anggaran add, edit
  public function kantor_anggaran()
  {
    if ($this->role == 5) {
      redirect('', 'refresh');
    }

    $data = [
      'title' => 'Kantor Anggaran',
      'kantor' => $this->master->getKantorAnggaran()->result()
    ];

    if ($this->form_validation->run('aksi_kantor_anggaran')) {
      $post = $this->input->post(null, true);
      $param['lokasi'] = $post['lokasi'];
      $param['cabang'] = $post['cabang'];

      // aksi db
      if (isset($post['id'])) {

        $this->resultEdit =  $this->master->ubah('kantor_anggaran', $param, ['id_kantor' => $post['id']]);
      } else {
        $this->resultAdd =  $this->master->simpan('kantor_anggaran', $param);
      }

      // pesan
      if ($this->resultAdd > 0) {
        message('success', 'Berhasil menambahkan kantor anggaran air', 'atribut/kantor_anggaran');
      }

      if ($this->resultEdit > 0) {
        message('success', 'Berhasil mengubah kantor anggaran air', 'atribut/kantor_anggaran');
      } else {
        message('error', 'Tidak ada pereubahan pada data Kantor Anggaran Air', 'atribut/kantor_anggaran');
      }
    }

    view('atribut/kantor/anggaran/data', $data);
  }

  public function getKantorAnggaran($id)
  {
    $satuan = $this->master->baca('kantor_anggaran', ['id_kantor' => $id])->row();
    json($satuan);
  }

  // kantor aliran add, edit
  public function kantor_aliran()
  {
    if ($this->role == 5) {
      redirect('', 'refresh');
    }

    $data = [
      'title' => 'Kantor Aliran',
      'kantor' => $this->master->getKantorAliran()->result()
    ];

    if ($this->form_validation->run('aksi_kantor_aliran')) {
      $post = $this->input->post(null, true);
      $param['nama_pemilik'] = $post['nama_pemilik'];
      $param['alamat'] = $post['alamat'];
      $param['no_register'] = !empty($post['no_register']) ? $post['no_register'] : NULL;

      // aksi db
      if (isset($post['id'])) {

        $this->resultEdit =  $this->master->ubah('kantor_aliran', $param, ['id_kantor_aliran' => $post['id']]);
      } else {
        $this->resultAdd =  $this->master->simpan('kantor_aliran', $param);
      }

      // pesan
      if ($this->resultAdd > 0) {
        message('success', 'Berhasil menambahkan kantor aliran air', 'atribut/kantor_aliran');
      }

      if ($this->resultEdit > 0) {
        message('success', 'Berhasil mengubah kantor aliran air', 'atribut/kantor_aliran');
      } else {
        message('error', 'Tidak ada pereubahan pada data Kantor Aliran Air', 'atribut/kantor_aliran');
      }
    }

    view('atribut/kantor/aliran/data', $data);
  }

  public function getKantorAliran($id)
  {
    $satuan = $this->master->baca('kantor_aliran', ['id_kantor_aliran' => $id])->row();
    json($satuan);
  }

  // hapus seluruh atribut
  public function hapus($where, $additional = '')
  {
    $post = $this->input->post(null, true);

    if ($post['_method'] == 'delete') {
      if (!$this->ion_auth->is_admin()) {
        redirect('', 'refresh');
      }

      // satuan
      if ($where == 'satuan') {
        $result = $this->master->hapus('satuan', ['id_satuan' => $post['id']]);
        if ($result > 0) {
          message('success', 'Berhasil menghapus satuan', 'atribut/satuan');
        }
      }

      // kategori
      if ($where == 'kategori') {
        $result = $this->master->hapus('kategori', ['id_kat' => $post['id']]);
        if ($result > 0) {
          message('success', 'Berhasil menghapus kategori', 'atribut/kategori');
        }
      }

      // Kantor
      if ($where == 'kantor') {
        if ($additional == 'aliran') {
          $result = $this->master->hapus('kantor_aliran', ['id_kantor_aliran' => $post['id']]);

          if ($result > 0) {
            message('success', 'Berhasil menghapus kantor aliran air!', 'atribut/kantor_aliran');
          }
        }

        if ($additional == 'anggaran') {
          $result = $this->master->hapus('kantor_anggaran', ['id_kantor' => $post['id']]);

          if ($result > 0) {
            message('success', 'Berhasil menghapus kantor anggaran air!', 'atribut/kantor_anggaran');
          }
        }
      }
    }
  }

  public function hapus_status()
  {
    $post = $this->input->post(null, true);

    if ($post['_method'] == 'delete') {
      $result = $this->master->hapus('status', [
        'id_status' => $post['id_status']
      ]);
      if ($result > 0) {
        $this->util->msgsuccess('message', 'Berhasil menghapus status', 'atribut/status');
      }
    }
  }

  public function email_check()
  {
    $email = $this->input->post('email', true);
    $result = $this->ion_auth->email_check($email);

    // jika email terdaftar
    $data = false;
    if (!$result) {
      // jika email tidak terdaftar
      $data = true;
    }
    echo json_encode($data);
  }

  public function email_check_edit()
  {
    $email = $this->input->post('email', true);
    $id = $this->input->post('id', true);

    $result = $this->master->email_check($email, $id);

    // dibagr($result);

    // jika email tidak terdaftar
    $data = true;
    if ($result > 0) {
      // jika email terdaftar
      $data = false;
    }
    echo json_encode($data);
  }
}
