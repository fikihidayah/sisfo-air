<?php

function red($name)
{
  if (form_error($name)) {
    return 'is-invalid';
  }
}

function dibagr($str)
{
  echo '<pre>';
  print_r($str);
  echo '</pre>';
}

function dibag($str)
{
  dibagr($str);
  die;
}

function ass_url($url)
{
  return base_url('assets/' . $url);
}

function admin_url($url)
{
  // silahkan customize admin url sesuai temanya
  return base_url('assets/tinydash/light/' . $url);
}

function bulan($tanggal)
{
  $bulan = array(
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => "Agustus",
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
  );

  return $bulan[$tanggal];
}

function cari_array($arr, $field, $value)
{
  foreach ($arr as $key => $val) {
    if ($val[$field] === $value)
      return $key;
  }
  return false;
}

function ubah_array($arr, $field = false, $value = false, $value2 = false)
{
  // dibagr($field);
  // dibagr($value);
  foreach ($arr as $k => $v) {
    if ($field != false || $value != false || $value2 != false)
      if ($v[$field] === $value) {
        // dibag('ok');
        $arr[$k]['jlh_bulan'] = $value2;
      }
  }
  return $arr;
}

// utilites dari ci library
function upload_gambar($path, $name, $data = false)
{
  $ci = &get_instance();
  $config['upload_path'] = './assets/img/' . $path . '/';
  $config['allowed_types'] = 'jpg|jpeg|png';
  $config['max_size'] = '2048';

  if (!empty($_FILES[$name]['name'])) {
    $ci->load->library('upload', $config, $name);
    $upload = $ci->{$name};
    if ($upload->do_upload($name)) {
      if ($data) {
        // edit data
        $gambar_lama = $data;
        if ($gambar_lama != 'default.png') {
          $target_file = './assets/img/' . $path . '/' . $gambar_lama;
          if (is_file($target_file)) {
            unlink($target_file);
          }
        }
      }

      return [
        'status' => true,
        'file' => $upload->data('file_name')
      ];
    } else {
      // jika uploadnya gagal
      return [
        'status' => false,
        'error' => $upload->display_errors('<small class="text-danger">', '</small>')
      ];
    }
  } else {
    return ['status' => null];
  }
}

function act_hapus_gambar($gambar, $path)
{
  if ($gambar != 'default.png') {
    $target_file = './assets/img/' . $path . '/' . $gambar;
    if (file_exists($target_file)) {
      unlink($target_file);
    }
  }
}

function act_hapus_dokumen($dok, $path)
{
  $target_file = './assets/dokumen/' . $path . '/' . $dok;
  if (file_exists($target_file)) {
    unlink($target_file);
  }
}

function upload_dokumen($path, $name, $data = false)
{
  $ci = &get_instance();
  $config['upload_path'] = './assets/img/' . $path . '/';
  $config['allowed_types'] = 'jpg|jpeg|png';
  $config['max_size'] = '2048';

  if (!empty($_FILES[$name]['name'])) {
    $ci->load->library('upload', $config, $name);
    $upload = $ci->{$name};

    // jika folder tidak ada maka buat dlu
    $folder = substr($config['upload_path'], 0, -1);
    if (!is_dir($folder)) {
      mkdir($folder);
    }

    if ($upload->do_upload($name)) {
      if ($data) {
        // edit data
        $gambar_lama = $data;
        if ($gambar_lama != 'default.png') {
          $target_file = './assets/img/' . $path . '/' . $gambar_lama;
          if (file_exists($target_file)) {
            unlink($target_file);
          }
        }
      }

      return [
        'status' => true,
        'file' => $upload->data('file_name')
      ];
    } else {
      // jika uploadnya gagal
      return [
        'status' => false,
        'error' => $upload->display_errors('<small class="text-danger">', '</small>')
      ];
    }
  } else {
    return ['status' => null];
  }
}

function view($page, $data)
{
  // sesuaikan tema
  $ci = &get_instance();
  $ci->load->view('_parts/admin/header', $data);
  $ci->load->view('_parts/admin/navbar');
  $ci->load->view('_parts/admin/sidebar');
  $ci->load->view($page);
  $ci->load->view('_parts/admin/footer');
}

/** Membuat pesan error
 * @param String $name nama flash message
 * @param String $text pesan yang ditampilkan
 * @param String $redirect Alamat Mengarahkan halaman
 */
function message($name, $text, $redirect)
{
  $ci = &get_instance();
  $ci->session->set_flashdata($name, $text);
  redirect($redirect);
}

/** Membuat pesan sukses
 * @param String $text pesan yang ditampilkan
 * @param String $redirect Alamat Mengarahkan halaman
 */
function messages($text, $redirect)
{
  $ci = &get_instance();
  $ci->session->set_flashdata('success', '<div class="alert-dismiss">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  ' . $text . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span class="fa fa-times"></span>
  </button>
  </div>
  </div>');
  redirect($redirect);
}

/** Membuat pesan error
 * @param String $text pesan yang ditampilkan
 * @param String $redirect Alamat Mengarahkan halaman
 */
function messager($text, $redirect)
{
  $ci = &get_instance();
  $ci->session->set_flashdata('error', '<div class="alert-dismiss">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
       ' . $text . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span class="fa fa-times"></span>
        </button>
      </div>
    </div>');
  redirect($redirect);
}

/**
 * Mengubah tanggal ke format indo
 *
 * @param String $tanggal
 * @return String Tanggal dengan format hari
 */
function tgl_indo($tanggal, bool $isHari = false): string
{
  $tgl = date('d-F-Y', strtotime($tanggal));
  $tgl = explode('-', $tgl);

  $hari = '';
  if ($isHari) {
    $hari = hari(date('l', strtotime($tanggal))) . ', ';
  }

  return $hari . $tgl[0] . '-' . bulan($tgl[1]) . '-' . $tgl[2];
}

/**
 * Merubah tulisan hari inggris menjadi INDONESIA
 *
 * @param String $day
 * @return string Hari Format INDONESIA
 */
function hari($day)
{
  $allDay = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => "Jum'at",
    'Saturday' => "Sabtu",
  ];

  return $allDay[$day];
}

function ce($isFound, $obj, $redirect)
{
  // check data ada atau tidak
  if (is_null($isFound)) {
    $pesan = "Data $obj tidak ditemukan <a href='" . base_url($redirect) . "'>Kembali</a>";
    show_error($pesan, 404);
  }
}

/**
 * Membuat tanggal format DB MYSQL
 * @param String $date tanggal indo(d-m-Y)
 */

function dateslash_todb($date)
{
  $date = explode('/', $date);
  return $date[2] . '-' . $date[1] . '-' . $date[0];
}

// Utilites html

/**
 * Membuat tombol kembali
 * @param String url halaman redirect
 */

function btn_back($url)
{
  $str = '<button class="btn btn-outline-warning btn-sm float-right" onclick="window.location=' . '\'' . base_url($url) . '\'' . '" type="button"><i class="fe fe-chevron-left act"></i> Kembali</button>';

  return $str;
}

/**
 * Membuat tombol print
 * @param String url halaman redirect
 */

function btn_print($url)
{
  $str = '<button class="btn btn-outline-info btn-sm float-right" onclick="window.open(' . '\'' . base_url($url) . '\'' . ', \'_blank\')" type="button"><i class="fe fe-printer"></i> Cetak</button>';

  return $str;
}

/**
 * Membuat tombol tambah
 * @param String url halaman redirect
 */

function btn_add($url)
{
  $str = "<button class=\"btn btn-sm btn-outline-primary float-right\" type=\"button\" onclick=\"window.location.href=base_url + '$url'\"><i class=\"fe fe-plus\"></i> Tambah</button>";

  return $str;
}
/**
 * Membuat tombol tambah berbasis modal
 * @param String url halaman redirect
 */

function btn_addmodal()
{
  $str = '<button class="btn btn-outline-primary float-right" type="button" data-toggle="modal" data-target="#modalAdd"><i class="fe fe-plus"></i> Tambah</button>';
  return $str;
}


function btn_detail($url)
{
  $str = "<a href=\"" . base_url($url) . "\" class=\"btn btn-info btn-sm lihat mb-2\"><i class=\"fe fe-eye\"></i></a>";
  return $str;
}

function btn_edit($url)
{
  $str = "<button type=\"button\" class=\"btn btn-sm btn-success edit mb-2\" onclick=\"window.location.href=base_url + '$url'\"><i class=\"fe fe-edit\"></i></button>";
  return $str;
}

function btn_editmodal($id)
{
  $str = '<button type="button" class="btn btn-sm btn-success edit mb-2" data-toggle="modal" data-target="#modalEdit" data-id="' . $id . '"><i class="fe fe-edit"></i></button>';
  return $str;
}

function btn_hapus($url, $val)
{
  $str = form_open($url, ['class' => 'd-inline hapusForm']);
  $str .= '<input type="hidden" name="_method" value="delete">';
  $str .= "<input type='hidden' name='id' value='$val'>";
  $str .= "<button type=\"submit\" class=\"btn btn-sm btn-danger hapus mb-2\"><i class=\"fe fe-trash\"></i></button>";
  $str .= form_close();

  return $str;
}

/**
 * Converts a number to its roman presentation.
 **/
function numberToRoman($num)
{
  // Be sure to convert the given parameter into an integer
  $n = intval($num);
  $result = '';

  // Declare a lookup array that we will use to traverse the number: 
  $lookup = array(
    'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
    'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
    'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
  );

  foreach ($lookup as $roman => $value) {
    // Look for number of matches
    $matches = intval($n / $value);

    // Concatenate characters
    $result .= str_repeat($roman, $matches);

    // Substract that from the number 
    $n = $n % $value;
  }

  return $result;
}

function custom_input($name, $val = false, $alias = false, $mark = true)
{
  $nameU = ucfirst($name);
  if ($alias) {
    $nameU = ucfirst($alias);
  }
  $nameV = $val ? $val : set_value($name);
  if (!$val) $nameV = null;

  $str = '<div class="form-group">';
  $str .= "<label for=\"$name\">$nameU";
  if ($mark) {
    $str .= "<small class=\"text-danger\">*</small>";
  }
  $str .= "</label>";
  $str .= "<input type=\"text\" name=\"$name\" id=\"$name\" class=\"form-control\" value=\"$nameV\">";
  $str .= form_error($name);
  $str .= '</div>';

  return $str;
}

function custom_password($name, $alias = false, $mark = true)
{
  $nameU = ucfirst($name);
  if ($alias) {
    $nameU = ucfirst($alias);
  }
  $nameV = set_value($name);


  $str = '<div class="form-group">';
  $str .= "<label for=\"$name\">$nameU";
  if ($mark) {
    $str .= "<small class=\"text-danger\">*</small>";
  }
  $str .= "</label>";
  $str .= "<input type=\"password\" name=\"$name\" id=\"$name\" class=\"form-control\" value=\"$nameV\">";
  $str .= form_error($name);
  $str .= '</div>';

  return $str;
}

function custom_textarea($name, $val = false, $alias = false, $mark = false)
{
  $nameU = ucfirst($name);
  if ($alias) {
    $nameU = ucfirst($alias);
  }
  $nameV = $val ? $val : set_value($name);
  if (!$val) $nameV = null;

  $str = '<div class="form-group">';
  $str .= "<label for=\"$name\">$nameU";
  if ($mark) {
    $str .= "<small class=\"text-danger\">*</small>";
  }
  $str .= "</label>";
  $str .= "<textarea name=\"$name\" id=\"$name\" class=\"form-control\">$nameV</textarea>";
  $str .= form_error($name);
  $str .= '</div>';

  return $str;
}

function custom_file($name, $alias = false, $accept = '.jpg, .png, .jpeg', $mark = true)
{
  $ci = &get_instance();
  $nameU = ucfirst($name);
  if ($alias) {
    $nameU = ucfirst($alias);
  }
  $str = "<div class=\"form-group\">
  <label for=\"$name\">$nameU";
  if ($mark) {
    $str .= "<small class=\"text-danger\">*</small>";
  }
  $str .= "</label>
  <div class=\"custom-file\">
    <input type=\"file\" class=\"custom-file-input\" id=\"$name\" name=\"$name\" accept=\"$accept\">
    <label class=\"custom-file-label\" for=\"$name\">Pilih file</label>
  </div>
  <small class=\"text-muted\">Ukuran file tidak lebih dari 2mb</small> <br>";
  $str .= $ci->session->flashdata('file_error');
  $str .= '</div>';
  return $str;
}

/**
 * Tabel heading
 */
function table_head($datable = true)
{
  $tab = '';
  if ($datable) {
    $tab = "dataTable";
  }

  $str = "<div class=\"table-responsive p-2\">
  <table class=\"table table-hover table-borderless mt-2 $tab\">
  <thead class=\"bg-dark\">";
  return $str;
}

/**
 * Tabel penutup heading
 */
function table_close_head()
{
  $str = "</thead>
  <tbody>";
  return $str;
}

/**
 * Tabel kaki
 */
function table_foot()
{
  $str = "</tbody>
        </table>
      </div>";
  return $str;
}

// convert to JSON
function json($data)
{
  $ci = &get_instance();
  $ci->output->set_content_type('application/json')
    ->set_output(json_encode($data));
}

function badgenf($message = 'EMPTY')
{
  return
    <<<STR
      <div class="badge badge-info p-2">$message</div>
    STR;
}
function notfound($message = null, $back = null)
{
  $ci = &get_instance();
  $ci->output->set_status_header('404');
  $ci->load->view('errors/html/notfound', ['message' => $message, 'back' => $back]);
}

/**
 * Pembulatan Uang
 *
 * @param int $uang
 * @param int $angkaDibelakang jumlah angka dibelakang, misal 3 ribuan, 4 puluhan ribu
 * @return string
 */
function pembulatan($uang)
{
  $ratusan = substr($uang, -3);
  if ($ratusan < 500)
    $akhir = $uang - $ratusan;
  else
    $akhir = $uang + (1000 - $ratusan);
  return [
    'angka' => $akhir,
    'huruf' => number_format($akhir, 2, ',', '.')
  ];
}

function number_to_words($number)
{
  $before_comma = trim(to_word($number));
  $after_comma = trim(comma($number));
  return ucwords($results = $before_comma . ' koma ' . $after_comma);
}

function to_word($number)
{
  $words = "";
  $arr_number = array(
    "",
    "satu",
    "dua",
    "tiga",
    "empat",
    "lima",
    "enam",
    "tujuh",
    "delapan",
    "sembilan",
    "sepuluh",
    "sebelas"
  );

  if ($number < 12) {
    $words = " " . $arr_number[$number];
  } else if ($number < 20) {
    $words = to_word($number - 10) . " belas";
  } else if ($number < 100) {
    $words = to_word($number / 10) . " puluh " . to_word($number % 10);
  } else if ($number < 200) {
    $words = "seratus " . to_word($number - 100);
  } else if ($number < 1000) {
    $words = to_word($number / 100) . " ratus " . to_word($number % 100);
  } else if ($number < 2000) {
    $words = "seribu " . to_word($number - 1000);
  } else if ($number < 1000000) {
    $words = to_word($number / 1000) . " ribu " . to_word($number % 1000);
  } else if ($number < 1000000000) {
    $words = to_word($number / 1000000) . " juta " . to_word($number % 1000000);
  } else {
    $words = "undefined";
  }
  return $words;
}

function comma($number)
{
  $after_comma = stristr($number, ',');
  $arr_number = array(
    "nol",
    "satu",
    "dua",
    "tiga",
    "empat",
    "lima",
    "enam",
    "tujuh",
    "delapan",
    "sembilan"
  );

  $results = "";
  $length = strlen($after_comma);
  $i = 1;
  while ($i < $length) {
    $get = substr($after_comma, $i, 1);
    $results .= " " . $arr_number[$get];
    $i++;
  }
  return $results;
}
