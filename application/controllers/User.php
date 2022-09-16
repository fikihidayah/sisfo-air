<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {
      redirect('gate/login');
    }

    $this->ion_auth->set_message_delimiters(null, null);
    $this->ion_auth->set_error_delimiters(null, null);

    $this->load->helper(['language']);
    $this->lang->load('auth');
  }


  public function role()
  {
    $data['title'] = 'Manajemen Role';
    $data['role'] = $this->ion_auth->groups()->result();

    view('user/role_data', $data);
  }

  public function getRole($id)
  {
    $data = $this->ion_auth->group($id)->row();
    echo json_encode($data);
  }

  public function tambah_role()
  {
    $fv = $this->form_validation;
    $fv->set_rules('name', 'Nama', 'required');

    if ($fv->run()) {
      $post = $this->input->post(null, true);
      $group = $this->ion_auth->create_group($post['name'], $post['description']);
      if (!$group) {
        messager($this->ion_auth->messages(), 'user/role');
      } else message('success', 'Berhasil Menambahkan Role', 'user/role');
    }
  }

  public function edit_role()
  {
    $fv = $this->form_validation;
    $fv->set_rules('name', 'Nama', 'required');

    if ($fv->run()) {
      $post = $this->input->post(null, true);
      $group = $this->ion_auth->update_group($post['id'], $post['name'], ['description' => $post['description']]);
      if (!$group) {
        message('error', $this->ion_auth->errors(), 'user/role');
      } else message('success', 'Berhasil Mengubah Role', 'user/role');
    }
  }


  // public function hapus_role()
  // {
  //   $post = $this->input->post(null, true);
  //   if ($post['_method'] == 'delete') {
  //     $result = $this->ion_auth->delete_group($post['id']);
  //     if ($result) {
  //       message('success', 'Berhasil menghapus role', 'user/role');
  //     } else message('error', 'Gagal menghapus role, ada user yang terdaftar di role ini', 'user/role');
  //   }
  // }

  public function manage()
  {
    $auth = $this->ion_auth;
    if (!$auth->is_admin()) {
      redirect('');
    }
    $data['title'] = 'Manajemen Pengguna';
    //list the users
    $data['users'] = $auth->users()->result();

    // group of users
    foreach ($data['users'] as $k => $user) {
      $data['users'][$k]->groups = $auth->get_users_groups($user->id)->result();
    }

    view('user/manage', $data);
  }

  public function tambah()
  {
    $auth = $this->ion_auth;
    if (!$auth->is_admin()) {
      redirect('');
    }

    $data['title'] = 'Tambah Pengguna';
    $data['group'] = $this->ion_auth->groups()->result();

    if ($this->form_validation->run('tambah_user') === TRUE) {
      $post = $this->input->post(null, true);
      $email = strtolower($post['email']);
      $password = $post['password'];

      $additional_data = [
        'full_name' => $post['full_name'],
      ];

      $upload = upload_gambar('profile', 'gambar');
      if ($upload['status'] === true) {
        $additional_data['picture'] = $upload['file'];
      } elseif ($upload['status'] === false) {
        message('file_error', $upload['error'], 'user/tambah');
      } else {
        $additional_data['picture'] = 'default.png';
      }

      $reg = $this->ion_auth->register($email, $password, $email, $additional_data, [$post['group']]);
      if ($reg) {
        message('success', $auth->messages(), 'user/manage');
      } else {
        message('error', $auth->errors(), 'user/manage');
      }
    }

    view('user/tambah', $data);
  }

  public function edit($id)
  {
    $auth = $this->ion_auth;
    $data['title'] = 'Edit User';
    $this_user = $auth->user($id)->row();
    $data['group'] = $this->ion_auth->groups()->result();

    if (!$this_user) show_error('Pengguna tidak ditemukan, <a href="' . base_url('user/manage') . '">Kembali</a>', 404);

    $data['picture'] = $this_user->picture;
    $data['id'] = $this_user->id;
    $data['user'] = $this_user;

    if ($this->form_validation->run('edit_user')) {
      $post = $this->input->post(null, true);

      $param = [
        'full_name' => $post['full_name'],
      ];

      if ($post['password']) {
        $param['password'] = $this->input->post('password');
      }

      $upload = upload_gambar('profile', 'gambar', $this_user->picture);


      if ($upload['status'] === true) {
        $param['picture'] = $upload['file'];
      } elseif ($upload['status'] === false) {
        message('file_error', $upload['error'], 'user/edit/' . $data['id']);
      }

      $regUser = $auth->update($id, $param);

      if ($regUser) {
        $users_group = $auth->get_users_groups($post['id'])->row()->id;
        $auth->remove_from_group($users_group, $post['id']);
        $auth->add_to_group($post['group'], $post['id']);
        message('success', $auth->messages(), 'user/edit/' . $id);
      } else {
        message('error', $auth->error(), 'user/edit/' . $id);
      }
    }

    view('user/edit_user', $data);
  }

  /**
   * Edit a user
   *
   * @param int|string $id
   */
  public function edit_user($id)
  {
    $auth = $this->ion_auth;
    if (!$auth->is_admin()) {
      redirect('');
    }

    $data['title'] = 'Edit User';
    $data['group'] = $this->ion_auth->groups()->result();

    $user = $auth->user($id)->row();

    $valid = $this->form_validation;
    // validate form input
    $valid->set_rules('full_name', 'Nama Lengkap', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_check_edit[' . $id . ']');

    if (isset($_POST) && !empty($_POST)) {
      // do we have a valid request?
      if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
        show_error($this->lang->line('error_csrf'));
      }

      // update the password if it was posted
      if ($this->input->post('password')) {
        $valid->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]');
        $valid->set_rules('password_confirm', 'Konfirmasi Password', 'required');
      }

      if ($valid->run() === TRUE) {
        $post = $this->input->post(null, true);
        $additional_data = [
          'full_name' => $post['full_name'],
        ];

        $upload = upload_gambar('profile', 'gambar', $user->picture);

        if ($upload['status'] === true) {
          $additional_data['picture'] = $upload['file'];
        } elseif ($upload['status'] === false) {
          message('file_error', $upload['error'], 'edit_user');
        }

        // update the password if it was posted
        if ($post['password']) {
          $additional_data['password'] = $post['password'];
        }

        // check to see if we are updating the user
        if ($auth->update($user->id, $additional_data)) {
          // redirect them back to the admin page if admin, or to the base url if non admin
          message('success', $auth->messages(), 'edit_user');
        } else {
          // redirect them back to the admin page if admin, or to the base url if non admin
          message('error', $auth->errors(), 'edit_user');
        }
      }
    }

    // display the edit user form
    $data['csrf'] = $this->_get_csrf_nonce();

    // pass the user to the view
    $data['user'] = $user;

    $data['email'] = $user->email;
    $data['role'] = $auth->get_users_groups($id)->row()->description;

    view('user/edit', $data);
  }

  public function edit_anggota()
  {
    $auth = $this->ion_auth;
    if ($auth->is_admin()) {
      redirect('');
    }

    $data['title'] = 'Edit User';

    $id = $this->ion_auth->get_user_id();
    $user = $auth->user($id)->row();

    $valid = $this->form_validation;
    // validate form input
    $valid->set_rules('full_name', 'Nama Lengkap', 'trim|required');

    if (isset($_POST) && !empty($_POST)) {
      // do we have a valid request?
      if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
        show_error($this->lang->line('error_csrf'));
      }

      // update the password if it was posted
      if ($this->input->post('password')) {
        $valid->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirm]');
        $valid->set_rules('password_confirm', 'Konfirmasi Password', 'required');
      }

      if ($valid->run() === TRUE) {
        $post = $this->input->post(null, true);
        $additional_data = [
          'full_name' => $post['full_name'],
        ];

        $upload = upload_gambar('profile', 'gambar', $user->picture);

        if ($upload['status'] === true) {
          $additional_data['picture'] = $upload['file'];
        } elseif ($upload['status'] === false) {
          message('file_error', $upload['error'], 'edit_profile');
        }

        // update the password if it was posted
        if ($post['password']) {
          $additional_data['password'] = $post['password'];
        }

        // check to see if we are updating the user
        if ($auth->update($user->id, $additional_data)) {
          // redirect them back to the admin page if admin, or to the base url if non admin
          message('success', $auth->messages(), 'edit_profile');
        } else {
          // redirect them back to the admin page if admin, or to the base url if non admin
          message('success', $auth->errors(), 'edit_profile');
        }
      }
    }

    // display the edit user form
    $data['csrf'] = $this->_get_csrf_nonce();

    // pass the user to the view
    $data['user'] = $user;

    $data['email'] = $user->email;
    $data['role'] = $auth->get_users_groups($id)->row()->description;

    view('user/edit_anggota', $data);
  }

  public function detail()
  {
    $auth = $this->ion_auth;
    $m = $this->input->get('m');
    $data['tuser'] = $auth->user($m)->row();
    $data['title'] = 'Detail Data User';
    $data['role'] = $auth->get_users_groups($m)->row()->name;
    // dibag($data);
    view('user/detail', $data);
  }

  public function hapus()
  {
    $post = $this->input->post(null, true);
    if ($post['_method'] == 'delete') {

      $user = $this->ion_auth->user($post['id'])->row();
      $picture = $user->picture;

      $file_path = './assets/img/profile/' . $picture;

      if (file_exists($file_path)) {
        unlink($file_path);
      }

      $result = $this->ion_auth->delete_user($post['id']);
      if ($result) :
        message('success', 'Berhasil menghapus pengguna', 'user/manage');
      endif;
    }
  }

  public function reset_picture($id)
  {
    $gambar_db = $this->ion_auth->user($id)->row()->picture;
    $target_file = './assets/img/profile/' . $gambar_db;
    if ($this->ion_auth->is_admin()) {
      $link = 'edit_user';
    } else {
      $link = 'edit_profile';
    }
    if ($gambar_db != 'default.png') {
      if (file_exists($target_file)) {
        unlink($target_file);
      }

      $this->ion_auth->hapusGambar($id);
      message('success', 'Berhasil mengembalikan ke gambar default', $link);
    } else {
      message('success', 'Gambar profil sudah default', $link);
    }
  }

  public function email_check_edit($email, $id)
  {
    $result = $this->master->email_check($email, $id);

    if ($result > 0) {
      $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
      $this->form_validation->set_message('email_check_edit', 'Email Sudah terdaftar');
      return false;
    } else return true;
  }

  /**
   * @return bool Whether the posted CSRF token matches
   */
  public function _valid_csrf_nonce()
  {
    $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
    if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
      return TRUE;
    }
    return FALSE;
  }
  /**
   * @return array A CSRF key-value pair
   */
  public function _get_csrf_nonce()
  {
    $this->load->helper('string');
    $key = random_string('alnum', 8);
    $value = random_string('alnum', 20);
    $this->session->set_flashdata('csrfkey', $key);
    $this->session->set_flashdata('csrfvalue', $value);

    return [$key => $value];
  }
}
