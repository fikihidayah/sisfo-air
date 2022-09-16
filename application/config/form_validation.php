<?php

$config = [
  'register' => [
    [
      'field' => 'full_name',
      'label' => 'Nama Lengkap',
      'rules' => 'required'
    ],
    [
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|is_unique[users.email]|max_length[100]'
    ],
    [
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required|matches[password2]|min_length[6]'
    ],
    [
      'field' => 'password2',
      'label' => 'Konfirmasi Password',
      'rules' => 'required|matches[password]'
    ],
  ],
  'tambah_user' => [
    [
      'field' => 'full_name',
      'label' => 'Nama Lengkap',
      'rules' => 'required|trim|max_length[30]'
    ],
    [
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|trim|valid_email|is_unique[users.email]'
    ],
    [
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required|min_length[6]|matches[password_confirm]'
    ],
    [
      'field' => 'password_confirm',
      'label' => 'Konfirmasi Password',
      'rules' => 'required|min_length[6]'
    ],
  ],
  'edit_user' => [
    [
      'field' => 'full_name',
      'label' => 'Nama Lengkap',
      'rules' => 'required|trim|max_length[30]'
    ],
    [
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|trim'
    ],
    [
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'min_length[6]|matches[password_confirm]'
    ],
    [
      'field' => 'password_confirm',
      'label' => 'Konfirmasi Password',
      'rules' => 'min_length[6]|matches[password_confirm]'
    ],
  ],
  'aksi_satuan' => [
    [
      'field' => 'nama_satuan',
      'label' => 'Nama Satuan',
      'rules' => 'required'
    ],
  ],
  'aksi_kantor_aliran' => [
    [
      'field' => 'nama_pemilik',
      'label' => 'Nama Pemilik',
      'rules' => 'required'
    ],
    [
      'field' => 'alamat',
      'label' => 'Nama Pemilik',
      'rules' => 'required'
    ],
    [
      'field' => 'no_register',
      'label' => 'Nomor Register',
      'rules' => 'max_length[70]'
    ],
  ],
  'aksi_kantor_anggaran' => [
    [
      'field' => 'lokasi',
      'label' => 'Lokasi',
      'rules' => 'required'
    ],
    [
      'field' => 'cabang',
      'label' => 'Cabang',
      'rules' => 'required'
    ],
  ],
  'aksi_kategori' => [
    [
      'field' => 'nama_kategori',
      'label' => 'Nama Kategori',
      'rules' => 'required'
    ],
    [
      'field' => 'keterangan',
      'label' => 'Keterangan',
      'rules' => 'max_length[300]'
    ],
  ],
  'pengaturan' => [
    [
      'field' => 'nama_penyetuju',
      'label' => 'Nama Penyetuju',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'jabatan_penyetuju',
      'label' => 'Jabatan Penyetuju',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'nama_pemeriksa',
      'label' => 'Nama Pemeriksa',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'jabatan_pemeriksa',
      'label' => 'Jabatan Pemeriksa',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'nama_pembuat',
      'label' => 'Nama Pembuat',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'jabatan_pembuat',
      'label' => 'Jabatan Pembuat',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'nama_pengesah',
      'label' => 'Nama Pengesah',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'jabatan_pengesah',
      'label' => 'Jabatan Pengesah',
      'rules' => 'max_length[100]'
    ],
  ]
];

$config['error_prefix'] = '<small class="text-danger">';
$config['error_suffix'] = '</small>';
