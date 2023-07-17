<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Subkriteria extends CI_Model
{
    public function join_kriteria()
    {
        $this->db->select('t1.id, t1.idKriteria, t2.kriteria, t1.subkriteria, t1.slug');
        $this->db->from('subkriteria as t1');
        $this->db->join('kriteria as t2', 't1.idKriteria = t2.id');
        $this->db->order_by('t1.idKriteria', 'ASC');
        $this->db->order_by('t2.id', 'ASC');
        return $this->db->get();
    }
}
