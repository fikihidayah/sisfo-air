<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
  private ?int $type;
  private int $role;
  private int $userId;

  public function __construct()
  {
    parent::__construct();
    $this->role = $this->ion_auth->get_users_groups()->row()->id;
    $this->type = $this->ion_auth->user()->row()->is_cabang;
    $this->userId = $this->ion_auth->user()->row()->id;

    if (!$this->ion_auth->logged_in()) {
      redirect('gate/login', 'refresh');
    }
    $this->load->helper('date');
  }


  public function anggaran()
  {
    // jika dia cabang alias orang pt maka
    if (($this->role == 5) &&  $this->type != 1) {
      redirect('', 'refresh');
    }

    $data = [
      'title' => 'Data Anggaran',
      'anggaran' => $this->master->getAnggaranGroup()->result()
    ];

    view('master/anggaran/data', $data);
  }

  public function cetak_anggaran()
  {
    if (($this->role == 5) &&  $this->type != 1) {
      redirect('', 'refresh');
    }
    $get = $this->input->get(null, true);
    $data = $this->data_detail_anggaran($get);

    $data['title'] = 'Cetak Dokumen Anggaran';
    $data['sett'] = $this->master->baca('sett_anggaran')->row();

    if (isset($data['detail'])) {
      $this->load->library('PDF');
      $this->load->helper('date');
      $this->pdf->setPaper('legal', 'potrait');
      $sekarang = now();
      $this->pdf->filename = "laporan{$sekarang}.pdf";
      $this->pdf->load_view('master/anggaran/cetak', $data);
    }
  }

  private function data_detail_anggaran(array $get)
  {
    if (($this->role == 5) &&  $this->type != 1) {
      redirect('', 'refresh');
    }
    $date = date('Y-m-d', $get['date']);
    $anggaran = $this->master->getAnggaranDetail([$get['ang'], $date])->row();

    if (!$anggaran) notfound('Belum ada data yang ditambahkan', 'master/anggaran');

    $anggaranDetail = $this->master->getAnggaranDetailKategori([$anggaran->kantor_id, $anggaran->date_created]);
    // dibag($anggaranDetail);
    $data = [
      'data' => $anggaranDetail,
      // inisiasi array
      'detail' => [
        'lokasi' => null,
        'cabang' => null,
        'kantor' => null,
        'date' => $anggaran->date_created
      ]
    ];

    // keterangan bagian atas
    if (!empty($anggaranDetail)) {
      $data['detail']['lokasi'] = $anggaranDetail[0]['anggaran'][0]->lokasi;
      $data['detail']['cabang'] = $anggaranDetail[0]['anggaran'][0]->cabang;
      $data['detail']['kantor'] = $anggaranDetail[0]['anggaran'][0]->kantor_id;
      $data['detail']['date'] = $anggaranDetail[0]['anggaran'][0]->date_created;
    }

    return $data;
  }

  public function cetak_aliran()
  {
    if ($this->role != 1 &&  $this->type == 1) {
      redirect('', 'refresh');
    }
    $get = $this->input->get(null, true);
    $data = $this->data_detail_aliran($get);


    $data['title'] = 'Cetak Dokumen Aliran Pipa';
    $data['sett'] = $this->master->baca('sett_anggaran')->row();

    if (isset($data['detail'])) {
      $this->load->library('PDF');
      $this->load->helper('date');
      $this->pdf->setPaper('legal', 'potrait');
      $sekarang = now();
      $this->pdf->filename = "laporan{$sekarang}.pdf";
      $this->pdf->load_view('master/aliran/cetak', $data);
    }
  }

  private function data_detail_aliran($get)
  {
    $aliran = $this->master->getAliranDetail([$get['air']])->row();
    // dibag($aliran);

    if (!$aliran) {
      return notfound('Belum ada data yang ditambahkan', 'master/aliran');
    }

    $aliranDetail = $this->master->getaliranDetailKategori([$aliran->pengisian_id]);

    $data = [
      'data' => $aliranDetail,
      'detail' => [
        'nama_pemilik' => null,
        'alamat' => null,
        'kantor' => null,
        'date' => $aliran->tgl_pengisian,
        'no_register' => null
      ]
    ];

    if (!empty($aliranDetail)) {
      $data['detail']['nama_pemilik'] = $aliranDetail[0]['aliran'][0]->nama_pemilik;
      $data['detail']['alamat'] = $aliranDetail[0]['aliran'][0]->alamat;
      $data['detail']['kantor'] = $aliranDetail[0]['aliran'][0]->id_kantor_aliran;
      $data['detail']['no_register'] = $aliranDetail[0]['aliran'][0]->no_register;
      $data['detail']['date'] = $aliranDetail[0]['aliran'][0]->tgl_pengisian;
      $data['detail']['keterangan'] = $aliran->keterangan;
      $data['detail']['pengisian'] = $aliran->pengisian_id;
    }
    return $data;
  }

  public function detail()
  {

    $get = $this->input->get(null, true);

    if (isset($get['ang'])) {
      $data = $this->data_detail_anggaran($get);
      $data['title'] = 'Detail Anggaran Biaya PT';
      view('master/anggaran/detail', $data);
    }


    if (isset($get['air'])) {
      $data = $this->data_detail_aliran($get);
      $data['title'] = 'Detail Aliran Biaya PT';

      if (isset($data['detail'])) {
        view('master/aliran/detail', $data);
      }
    }
  }

  public function tambah_anggaran()
  {
    if ($this->role == 5 &&  $this->type != 1) {
      redirect('', 'refresh');
    }
    $data = [
      'title' => 'Tambah Data Anggaran',
      'kantor' => $this->master->baca('kantor_anggaran')->result(),
      'satuan' => $this->master->baca('satuan')->result(),
      'kategori' => $this->master->baca('kategori')->result(),
      'users' => $this->ion_auth->users(5)->result()
    ];

    $post = $this->input->post(null, true);
    if (!empty($post)) {
      $ukuran = '-';
      if ($post['ukuran'] != '-') {
        $ukuran = $post['ukuran'] . ' ' . $post['ukuran_satuan'];
      }

      $param = [
        'nama_bahan' => $post['nama_bahan'],
        'ukuran' => $ukuran,
        'jumlah' => $post['jumlah'],
        'satuan_id' => (int) $post['satuan_id'],
        'kategori_id' => (int) $post['kategori_id'],
        'kantor_id' => (int) $post['kantor_id'],
        'analisa' => $post['analisa'],
        'jumlah_harga' => $post['jumlah_harga'],
        'harga_satuan' => $post['harga_satuan'],
        'date_created' => date('Y-m-d', now())
      ];

      if ($this->role == 5) {
        $param['user_id'] = $this->userId;
      }


      $this->master->simpan('anggaran', $param);
      message('success', 'Berhasil menambahkan anggaran investasi PIPA PDAM', 'master/anggaran');
    }

    view('master/anggaran/tambah', $data);
  }

  public function edit_anggaran($id)
  {
    if ($this->role == 5 &&  $this->type != 1) {
      redirect('', 'refresh');
    }
    $data = [
      'title' => 'Edit Data Anggaran',
      'kantor' => $this->master->baca('kantor_anggaran')->result(),
      'satuan' => $this->master->baca('satuan')->result(),
      'kategori' => $this->master->baca('kategori')->result(),
      'anggaran' => $this->master->baca('anggaran', $id)->row(),
      'users' => $this->ion_auth->users(5)->result()
    ];

    $post = $this->input->post(null, true);
    if (!empty($post)) {
      $ukuran = '-';
      if ($post['ukuran'] != '-') {
        $ukuran = $post['ukuran'] . ' ' . $post['ukuran_satuan'];
      }

      $param = [
        'nama_bahan' => $post['nama_bahan'],
        'ukuran' => $ukuran,
        'jumlah' => $post['jumlah'],
        'satuan_id' => (int) $post['satuan_id'],
        'kategori_id' => (int) $post['kategori_id'],
        'kantor_id' => (int) $post['kantor_id'],
        'analisa' => $post['analisa'],
        'jumlah_harga' => $post['jumlah_harga'],
        'harga_satuan' => $post['harga_satuan']
      ];

      $this->master->ubah('anggaran', $param, $post['id']);
      message('success', 'Berhasil mengubah item anggaran investasi PIPA PDAM', uri_string());
    }

    view('master/anggaran/edit', $data);
  }

  public function aliran()
  {
    if ($this->role != 1 &&  $this->type == 1) {
      redirect('', 'refresh');
    }
    $data = [
      'title' => 'Data Aliran Air',
      'aliran' => $this->master->getIsian()->result()
    ];

    view('master/aliran/data', $data);
  }

  public function tambahisian_aliran()
  {
    if ($this->role != 1 &&  $this->type == 1) {
      redirect('', 'refresh');
    }


    $data['title'] = 'Tambah Pengisian';
    $data['kantor'] = $this->master->baca('kantor_aliran')->result();

    $post = $this->input->post(null);
    if (!empty($post)) {
      $param = [
        'kantor_id_aliran' => (int) $post['kantor_id'],
        'tgl_pengisian' => dateslash_todb($post['tgl_pengisian']),
        'keterangan' => !empty($post['keterangan']) ? $post['keterangan'] : null
      ];

      // jika user yang menambahkan maka simpan siapa yang mengisi
      if ($this->role == 5) {
        $param['user_id'] = $this->userId;
      }

      $this->master->simpan('pengisian', $param);

      message('success', 'Berhasil menambahkan isian, silahkan tambahkan aliran!', 'master/aliran/tambah');
    }

    view('master/aliran/isian', $data);
  }

  public function tambah_aliran()
  {
    if ($this->role != 1 &&  $this->type == 1) {
      redirect('', 'refresh');
    }

    $data = [
      'title' => 'Tambah Data Anggaran',
      'kantor' => $this->master->baca('kantor_anggaran')->result(),
      'satuan' => $this->master->baca('satuan')->result(),
      'kategori' => $this->master->baca('kategori')->result(),
      'isian' => $this->master->getIsian()->result(),
      'users' => $this->ion_auth->users(5)->result()
    ];


    $post = $this->input->post(null, true);
    if (!empty($post)) {
      $ukuran = '-';
      if ($post['ukuran'] != '-') {
        $ukuran = $post['ukuran'] . ' ' . $post['ukuran_satuan'];
      }

      $param = [
        'nama_material' => $post['nama_material'],
        'ukuran' => $ukuran,
        'jumlah' => $post['jumlah'],
        'satuan_id' => (int) $post['satuan_id'],
        'kategori_id' => (int) $post['kategori_id'],
        'pengisian_id' => (int) $post['pengisian_id'],
      ];

      if ($this->role == 5) {
        $param['user_id'] = $this->userId;
      } else {
        $param['user_id'] = !empty($post['user_id']) ? $post['user_id'] : null;
      }

      $this->master->simpan('aliran_air', $param);
      message('success', 'Berhasil menambahkan aliran air PIPA PDAM', 'master/aliran');
    }

    view('master/aliran/tambah', $data);
  }

  public function edit_aliran($id)
  {
    if ($this->role != 1 &&  $this->type == 1) {
      redirect('', 'refresh');
    }
    $data = [
      'title' => 'Tambah Data Anggaran',
      'kantor' => $this->master->baca('kantor_anggaran')->result(),
      'satuan' => $this->master->baca('satuan')->result(),
      'kategori' => $this->master->baca('kategori')->result(),
      'isian' => $this->master->getIsian()->result(),
      'aliran' => $this->master->getAliran($id)->row(),
      'users' => $this->ion_auth->users(5)->result()
    ];


    $post = $this->input->post(null, true);
    if (!empty($post)) {
      $ukuran = '-';
      if ($post['ukuran'] != '-') {
        $ukuran = $post['ukuran'] . ' ' . $post['ukuran_satuan'];
      }

      $param = [
        'nama_material' => $post['nama_material'],
        'ukuran' => $ukuran,
        'jumlah' => $post['jumlah'],
        'satuan_id' => (int) $post['satuan_id'],
        'kategori_id' => (int) $post['kategori_id'],
        'pengisian_id' => (int) $post['pengisian_id']
      ];

      $this->master->ubah('aliran_air', $param, ['id_aliran' => $post['id']]);
      message('success', 'Berhasil mengubah aliran air PIPA PDAM', uri_string());
    }

    view('master/aliran/edit', $data);
  }

  public function check_isian_uniq()
  {
    $post = $this->input->post(null);

    $isianCheck = $this->master->baca('pengisian', [
      'kantor_id_aliran' => $post['kantor_id'],
      'tgl_pengisian' => dateslash_todb($post['tgl_pengisian']),
    ])->num_rows();

    $valid = true;
    if ($isianCheck > 0) {
      $valid = false;
    }

    echo json_encode($valid);
  }

  public function konfirmasi($type)
  {
    if ($this->role == 4) {
      $post = $this->input->post(null, true);

      if ($type == 'aliran') {
        $this->master->ubah('pengisian', ['status_konfirmasi' => 1], ['id_isian' => $post['pengisian_id']]);

        message('success', 'Berhasil mengkonfirmasi surat aliran air', 'master/aliran');
      }

      if ($type == 'anggaran') {
        $this->master->ubah('anggaran', ['status_konfirmasi' => 1], [
          'kantor_id' => $post['kantor_id'],
          'date_created' => $post['date_created']
        ]);

        message('success', 'Berhasil menkonfirmasi surat anggaran', 'master/anggaran');
      }
    }
    notfound();
  }

  public function hapus($type)
  {
    $post = $this->input->post(null, true);

    if ($post['_method'] == 'delete') {
      if ($type == 'anggaran') {
        if ($this->role != 1 &&  $this->type != 1) {
          redirect('', 'refresh');
        }
        // Hapus 1 data
        if (isset($post['id'])) {
          $oldData = $this->master->getAnggaran($post['id'])->row();
          $this->master->hapus('anggaran', $post['id']);
          message('success', 'Berhasil menghapus item anggaran', 'master/detail?ang=' . $oldData->kantor_id . '&date=' . strtotime($oldData->date_created));
        }

        // hapus beberapa data berdasarkan kantor
        if (isset($post['kantor_id'])) {
          $this->master->hapus('anggaran', [
            'kantor_id' => $post['kantor_id'],
            'date_created' => $post['date_created'],
          ]);
          message('success', 'Berhasil menghapus seluruh data anggaran pada surat ini', 'master/anggaran');
        }
      }

      if ($type == 'aliran') {
        if ($this->role == 4 || $this->type == 1) {
          echo 'ok';
          redirect('', 'refresh');
        }
        dibag($this->role);
        // Hapus 1 data
        if (isset($post['id'])) {
          $oldData = $this->master->getAliran($post['id'])->row();
          $this->master->hapus('aliran_air', ['id_aliran' => $post['id']]);
          message('success', 'Berhasil menghapus item aliran', 'master/detail?air=' . $oldData->pengisian_id);
        }

        // hapus beberapa data berdasarkan pengisian
        if (isset($post['pengisian_id'])) {
          $this->master->hapus('pengisian', ['id_isian' => $post['pengisian_id']]);
          message('success', 'Berhasil menghapus seluruh data aliran pada surat ini', 'master/aliran');
        }
      }
    }
  }
}
