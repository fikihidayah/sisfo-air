<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF extends Dompdf
{
  // private $ci;

  // public function __construct($options = null)
  // {
  //   parent::__construct($options);
  //   // $this->ci = &get_instance();
  // }

  private function &ci()
  {
    return get_instance();
  }

  /**
   * Load a CodeIgniter view into domPDF
   *
   * @access    public
   * @param    string    $view The view to load
   * @param    array    $data The view data
   * @return    void
   */
  public function load_view($view, $data = array())
  {
    $html = $this->ci()->load->view($view, $data, TRUE);
    $options = new Options();
    $options->setIsRemoteEnabled(true); // set jika ingin file ditampilkan
    $this->setOptions($options);
    $this->load_html($html);
    // Render the PDF
    $this->render();
    // Output the generated PDF to Browser
    $this->stream($this->filename, array("Attachment" => false));
  }
}
