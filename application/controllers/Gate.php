<?php defined('BASEPATH') or exit('No direct script access allowed');
// Continue or custom library development ion_auth by : Syafikihidayah

class Gate extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('ion_auth');
  }

  /**
   * Log the user in
   */
  public function login()
  {
    $auth = $this->ion_auth;
    if ($auth->logged_in()) {
      redirect('');
    }

    $data['title'] = "Masuk";

    // validate form input
    $this->form_validation->set_rules('identity', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Kata Sandi', 'required');

    if ($this->form_validation->run() === TRUE) {
      // check to see if the user is logging in
      // check for "remember me"
      $post = $this->input->post(null, true);

      if ($auth->login($post['identity'], $post['password'])) {
        //if the login is successful
        //redirect them back to the home page
        message('message', $auth->messages(), '/');
      } else {
        // if the login was un-successful
        // redirect them back to the login page
        message('message', $auth->errors(), 'gate/login');
      }
    } else {
      $this->load->view('gate/login', $data);
    }
  }

  public function register()
  {
    $data['title'] = 'Daftar';

    if ($this->form_validation->run('register')) {
      $post = $this->input->post(null, true);
      $isCabang = (int) $post['is_cabang'] ?? 0;

      $this->ion_auth->register($post['email'], $post['password'], $post['email'], [
        'full_name' => $post['full_name'],
        'is_cabang' => $isCabang,
        'picture' => 'default.png'
      ], [5]);

      if ($isCabang) {
        if ($this->ion_auth->email_check($post['email'])) {
          $idUser = $this->master->baca('users', ['email' => $post['email']])->row()->id;
          $this->ion_auth->update_user($idUser, [
            'active' => 0
          ]);
        }
        message('success', 'Berhsail Daftar silahkan tunggu akun diaktivasi oleh admin, selanjutnya login dengan email dan password', 'gate/login');
      }

      message('success', 'Berhsail Daftar silahkan login dengan email dan password', 'gate/login');
    }

    $this->load->view('gate/register', $data);
  }

  /**
   * Log the user out
   */
  public function logout()
  {
    // log the user out
    $this->ion_auth->logout();

    // redirect them to the login page
    redirect('gate/login', 'refresh');
  }

  /**
   * Activate the user
   *
   * @param int         $id   The user ID
   * @param string|bool $code The activation code
   */
  public function activate($id, $code = FALSE)
  {
    $this->ion_auth->set_message_delimiters(null, null);
    $this->ion_auth->set_error_delimiters(null, null);
    $activation = FALSE;
    $auth = $this->ion_auth;
    if ($code !== FALSE) {
      $activation = $auth->activate($id, $code);
    } else if ($auth->is_admin()) {
      $activation = $auth->activate($id);
    }

    if ($activation) {
      $pesan = $auth->messages();
      $activation = TRUE;
    } else {
      $pesan = $auth->errors();
    }

    echo json_encode(['pesan' => $pesan, 'status' => $activation]);
  }

  /**
   * Deactivate the user
   *
   * @param int|string|null $id The user ID
   */
  public function deactivate($id = NULL)
  {
    $this->ion_auth->set_message_delimiters(null, null);
    $this->ion_auth->set_error_delimiters(null, null);
    $activation = FALSE;
    $auth = $this->ion_auth;
    if (!$auth->logged_in() || !$auth->is_admin()) {
      // redirect them to the home page because they must be an administrator to view this
      $pesan = 'You must be an administrator to view this page.';
    } else {

      $id = (int)$id;

      // do we have the right userlevel?
      if ($auth->deactivate($id)) {
        $pesan = $auth->messages();
        $activation = TRUE;
      } else {
        $pesan = $auth->errors();
      }
    }

    echo json_encode(['pesan' => $pesan, 'status' => $activation]);
  }

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
