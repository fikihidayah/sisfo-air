<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info_m extends CI_Model
{
  public function getInfo($id, $type = 'tentang')
  {
    if ($type == 'info') {
      $this->db->select('*');
      $this->db->where('id_info !=', 1);
      if ($id != null)  $this->db->where('id_info', $id);
    } elseif ($type == 'tentang') {
      $this->db->where('id_info', $id);
    }
    return $this->db->get('informasi');
  }

  public function getInfoPage($show, $offset)
  {
    $this->db->select('*');
    $this->db->where('id_info !=', 1);
    $this->db->limit($show, $offset);
    return $this->db->get('informasi');
  }


  public function infoCount()
  {
    return $this->db->get_where('informasi', ['id_info !=' => 1])->num_rows();
  }

  public function getBeritaBySlug($slug)
  {
    return $this->db->get_where('informasi', ['id_info!=' => 1, 'slug' => $slug]);
  }

  public function getInfoLain($id)
  {
    $this->db->where('id_info !=', $id);
    $this->db->where('id_info !=', 1);
    $this->db->order_by('tanggal_post', 'asc');
    $this->db->limit(3);
    return $this->db->get('informasi');
  }

  public function editTentang($param, $id)
  {
    $this->db->where('id_info', $id);
    $this->db->update('informasi', $param);
    return $this->db->affected_rows();
  }

  public function addInfo($param)
  {
    $this->db->insert('informasi', $param);
    return $this->db->affected_rows();
  }

  public function editInfo($param, $id)
  {
    $this->db->where('id_info', $id);
    $this->db->update('informasi', $param);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->where('id_info', $id);
    $this->db->delete('informasi');
    return $this->db->affected_rows();
  }
}
