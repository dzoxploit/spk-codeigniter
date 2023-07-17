<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Kost extends CI_Model
{
    public function join_kost()
    {
        $this->db->select('alternatif.*, kost.kost, s1.subkriteria as namaSubkriteriaHarga, s2.subkriteria as namaSubkriteriaJarak, s3.subkriteria as namaSubkriteriaLuas, s4.subkriteria as namaSubkriteriaKeamanan');
        $this->db->from('alternatif');
        $this->db->join('kost', 'kost.id = alternatif.idKost', 'left');
        $this->db->join('subkriteria s1', 's1.id = alternatif.idSubkriteriaHarga', 'left');
        $this->db->join('subkriteria s2', 's2.id = alternatif.idSubkriteriaJarak', 'left');
        $this->db->join('subkriteria s3', 's3.id = alternatif.idSubkriteriaLuas', 'left');
        $this->db->join('subkriteria s4', 's4.id = alternatif.idSubkriteriaKeamanan', 'left');

        $query = $this->db->get();
        return $query->result();
    }

    public function join_kost_by_id($idKost)
    {
        $this->db->select('alternatif.*, kost.kost, s1.subkriteria as namaSubkriteriaHarga, s2.subkriteria as namaSubkriteriaJarak, s3.subkriteria as namaSubkriteriaLuas, s4.subkriteria as namaSubkriteriaKeamanan');
        $this->db->from('alternatif');
        $this->db->join('kost', 'kost.id = alternatif.idKost', 'left');
        $this->db->join('subkriteria s1', 's1.id = alternatif.idSubkriteriaHarga', 'left');
        $this->db->join('subkriteria s2', 's2.id = alternatif.idSubkriteriaJarak', 'left');
        $this->db->join('subkriteria s3', 's3.id = alternatif.idSubkriteriaLuas', 'left');
        $this->db->join('subkriteria s4', 's4.id = alternatif.idSubkriteriaKeamanan', 'left');
        $this->db->where('alternatif.id', $idKost);

        $query = $this->db->get();
        return $query->result();
    }
}
