<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_m extends CI_Model
{
  private int $role;
  private int $userId;
  public function __construct()
  {
    if ($this->ion_auth->logged_in()) {
      $this->role = $this->ion_auth->get_users_groups()->row()->id;
      $this->userId = $this->ion_auth->user()->row()->id;
    }
  }

  // general CRUD
  // read
  /** 
   * Menampilkan data
   * @param string $table
   * @param array or string $where
   * @return array Data
   */
  public function baca($table, $where = false)
  {
    if ($where) {
      if (!is_array($where)) {
        $where = ['id' => $where];
      }
      $this->db->where($where);
    }
    return $this->db->get($table);
  }

  // insert
  /** 
   * Menyimpan atau menambah data
   * @param string $table
   * @param array $data
   * @return int jumlah baris yang berubah
   */
  public function simpan($table, $data)
  {
    $this->db->insert($table, $data);
    return $this->db->affected_rows();
  }

  // ubah
  /** 
   * Mengubah data
   * @param string $table
   * @param array $data
   * @param array or integer $id
   * @return int jumlah baris yang berubah
   */
  public function ubah($table, $data = [], $where = [])
  {
    if (!is_array($where)) {
      $where = ['id' => $where];
    }
    $this->db->update($table, $data, $where);
    return $this->db->affected_rows();
  }

  // delete
  /** 
   * Menghapus data
   * @param string $table
   * @param array or integer $id
   * @return int jumlah baris yang berubah
   */
  public function hapus($table, $where)
  {
    if (!is_array($where)) {
      $where = ['id' => $where];
    }
    $this->db->where($where);
    $this->db->delete($table);
    return $this->db->affected_rows();
  }

  // total data
  /** 
   * total data
   * @param string $table
   */

  public function total($table, $where = [])
  {
    if (!is_array($where)) {
      $where = ['id' => $where];
    }
    $this->db->where($where);
    return $this->db->get($table)->num_rows();
  }

  public function totalPersenAnggaranUser(): int
  {
    $terkonfirmasi = $this->total('anggaran', ['status_konfirmasi' => 1, 'user_id' => $this->userId]);
    $totalAnggaranUser = $this->total('anggaran', ['user_id' => $this->userId]);

    $persen = (int) $totalAnggaranUser !== 0 ? ((int) $terkonfirmasi / (int) $totalAnggaranUser) * 100 : 0;

    return $persen;
  }

  public function totalPersenAliranUser(): int
  {
    $terkonfirmasi = $this->total('pengisian', ['status_konfirmasi' => 1, 'user_id' => $this->userId]);
    $totalAliranUser = $this->total('pengisian', ['user_id' => $this->userId]);

    $persen = (int) $totalAliranUser !== 0 ? ((int) $terkonfirmasi / (int) $totalAliranUser) * 100 : 0;

    return $persen;
  }

  public function getAnggaran($where = [])
  {
    $this->db->select('a.*, s.nama_satuan,kt.nama_kategori,ka.lokasi, ka.cabang');

    if (!is_array($where)) {
      $where = ['id' => $where];
    }

    $this->db->where($where);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('kantor_anggaran as ka', 'ka.id_kantor=a.kantor_id');

    return $this->db->get('anggaran as a');
  }

  public function getAnggaranDetail($where = [])
  {
    $this->db->select('a.*, s.nama_satuan,kt.nama_kategori,ka.lokasi, ka.cabang');
    $whereToDb = ['kantor_id' => $where[0], 'date_created' => $where[1]];
    if (isset($where[2])) $whereToDb['kategori_id'] = $where[2];

    $this->db->where($whereToDb);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('kantor_anggaran as ka', 'ka.id_kantor=a.kantor_id');

    return $this->db->get('anggaran as a');
  }

  public function getKategoriAnggaran($where)
  {
    $this->db->select('kt.id_kat, kt.nama_kategori');

    $where = ['kantor_id' => $where[0], 'date_created' => $where[1]];

    $this->db->where($where);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('kantor_anggaran as ka', 'ka.id_kantor=a.kantor_id');
    $this->db->group_by('a.kategori_id');

    return $this->db->get('anggaran as a')->result();
  }

  public function getAnggaranDetailKategori($where = [])
  {
    $data = [];
    $kategori = $this->getKategoriAnggaran($where);
    // dibag($kategori);
    foreach ($kategori as $key1 => $k) {
      $data[$key1]['nama'] = $k->nama_kategori;
      $where[2] = $k->id_kat;

      $anggaran = $this->getAnggaranDetail($where)->result();
      // dibag($anggaran);
      foreach ($anggaran as $key2 => $val) {
        $data[$key1]['anggaran'][$key2] = $val;
      }
    }

    return $data;
  }

  public function getAnggaranGroup($where = [])
  {
    $this->db->select('a.*, s.nama_satuan,kt.nama_kategori,ka.lokasi, ka.cabang');

    if (!is_array($where)) {
      $where = ['id' => $where];
    }

    if ($this->role == 5) {
      $where['user_id'] = $this->userId;
    }

    $this->db->where($where);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('kantor_anggaran as ka', 'ka.id_kantor=a.kantor_id');
    $this->db->group_by(['a.kantor_id', 'a.date_created']);

    return $this->db->get('anggaran as a');
  }

  public function getKantorAnggaran($where = [])
  {
    $this->db->select('ka.*, u.full_name');
    if (!is_array($where)) {
      $where = ['id' => $where];
    }

    $this->db->join('users as u', 'u.id=ka.users_id', 'left');
    return $this->db->get('kantor_anggaran as ka');
  }

  public function getKantorAliran($where = [])
  {
    $this->db->select('ka.*, u.full_name');
    if (!is_array($where)) {
      $where = ['id' => $where];
    }

    $this->db->join('users as u', 'u.id=ka.users_id', 'left');
    return $this->db->get('kantor_aliran as ka');
  }

  public function getAliran($where = [])
  {
    $this->db->select('a.*, s.nama_satuan,kt.nama_kategori,ka.nama_pemilik, ka.alamat, ka.no_register,p.tgl_pengisian,p.keterangan,p.user_id');

    if (!is_array($where)) {
      $where = ['id_aliran' => $where];
    }

    $this->db->where($where);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('pengisian as p', 'p.id_isian=a.pengisian_id');
    $this->db->join('kantor_aliran as ka', 'ka.id_kantor_aliran=p.kantor_id_aliran');

    return $this->db->get('aliran_air as a');
  }

  public function getAliranDetail($where)
  {
    $this->db->select('a.*, s.nama_satuan,kt.nama_kategori, p.tgl_pengisian,p.keterangan,ka.*');
    // dibag($where);
    $whereToDb = ['a.pengisian_id' => $where[0]];
    if (isset($where[1])) $whereToDb['kategori_id'] = $where[1];

    $this->db->where($whereToDb);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('pengisian as p', 'p.id_isian=a.pengisian_id');
    $this->db->join('kantor_aliran as ka', 'ka.id_kantor_aliran=p.kantor_id_aliran');

    return $this->db->get('aliran_air as a');
  }

  public function getKategoriAliran($where)
  {
    $this->db->select('kt.id_kat, kt.nama_kategori');

    $where = ['pengisian_id' => $where[0]];

    $this->db->where($where);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('pengisian as p', 'p.id_isian=a.pengisian_id');
    $this->db->join('kantor_aliran as ka', 'ka.id_kantor_aliran=p.kantor_id_aliran');
    $this->db->group_by('a.kategori_id');

    return $this->db->get('aliran_air as a')->result();
  }

  public function getAliranGroup($where = [])
  {
    $this->db->select('a.*, s.nama_satuan,kt.nama_kategori,ka.lokasi, ka.cabang');

    if (!is_array($where)) {
      $where = ['id' => $where];
    }

    $this->db->where($where);

    $this->db->join('satuan as s', 's.id_satuan=a.satuan_id');
    $this->db->join('kategori as kt', 'kt.id_kat=a.kategori_id');
    $this->db->join('kantor_aliran as ka', 'ka.id_kantor=a.kantor_id');
    $this->db->group_by(['a.kantor_id', 'a.date_created']);

    return $this->db->get('aliran_air as a');
  }

  public function getaliranDetailKategori($where)
  {
    $data = [];
    $kategori = $this->getKategoriAliran($where);
    foreach ($kategori as $key1 => $k) {
      $data[$key1]['nama'] = $k->nama_kategori;
      $where[1] = $k->id_kat;

      $anggaran = $this->getAliranDetail($where)->result();
      // dibag($anggaran);
      foreach ($anggaran as $key2 => $val) {
        $data[$key1]['aliran'][$key2] = $val;
      }
    }

    return $data;
  }

  public function getIsian($where = [])
  {
    $this->db->select('p.*,ka.nama_pemilik,ka.alamat');
    if (!is_array($where)) {
      $where = ['id_isian' => $where];
    }

    if ($this->role == 5) {
      $where['user_id'] = $this->userId;
    }

    $this->db->where($where);

    $this->db->join('kantor_aliran as ka', 'ka.id_kantor_aliran=p.kantor_id_aliran');
    return $this->db->get('pengisian p');
  }

  public function email_check($email, $id)
  {
    $query = "SELECT * FROM `users` WHERE id!=$id AND email='$email'";
    return $this->db->query($query)->num_rows();
  }

  public function getLaporanDataCenter($mulai, $selesai, $loc)
  {
    $query = "SELECT * FROM perawatan
              WHERE tgl >= '$mulai' AND tgl <= '$selesai' AND loc = '$loc'";
    return $this->db->query($query);
  }

  public function getLaporanDataTamu($mulai, $selesai, $loc)
  {
    $query = "SELECT * FROM tamu
              WHERE tgl >= '$mulai' AND tgl <= '$selesai' AND loc = '$loc'";
    return $this->db->query($query);
  }

  public function getLaporanDataMonitoringPerawatan($mulai, $selesai, $loc)
  {
    $query = "SELECT * FROM monit_perawatan
              WHERE tgl >= '$mulai' AND tgl <= '$selesai' AND loc = '$loc'";
    return $this->db->query($query);
  }
}
