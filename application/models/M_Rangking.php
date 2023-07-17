<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Rangking extends CI_Model
{
    public function getAlternatifWithNilaiAndKost()
    {
        $this->db->select('alternatif_nilai.id, alternatif_nilai.idAlternatif, alternatif_nilai.nilai, kost.kost');
        $this->db->from('alternatif_nilai');
        $this->db->join('alternatif', 'alternatif_nilai.idAlternatif = alternatif.id');
        $this->db->join('kost', 'alternatif.idKost = kost.id');
        $this->db->order_by('alternatif_nilai.nilai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
