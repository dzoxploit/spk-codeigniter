<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perbandingan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Crud');
        $this->load->model('M_Kost');
    }

    public function index()
    {
        $data['currentPage'] = 'perbandingan kriteria';

        $output = array();

        $tabel = 'kriteria';

        $kriteria = $this->M_Crud->get_all_data($tabel)->result();

        foreach ($kriteria as $rK) {
            $output[$rK->id] = $rK->kriteria;
        }

        $data['arr'] = $output;

        $this->load->view('pages/admin/perhitungan/perbandingan.php', $data);
    }

    public function alternatif()
    {
        $data['currentPage'] = 'alternatif';

        $data['alternatif'] = $this->M_Kost->join_kost();

        $this->load->view('pages/admin/perhitungan/alternatif.php', $data);
    }

    public function alternatif_add()
    {
        $data['currentPage'] = 'tambah alternatif';

        $tabel = "subkriteria";

        $pk = "idKriteria";

        $data['kost'] = $this->M_Crud->get_all_data("kost")->result();

        $alternatifData = $this->M_Crud->get_all_data("alternatif")->result();

        $id_kost_terpilih = array();

        foreach ($alternatifData as $alternatif) {
            $id_kost_terpilih[] = $alternatif->idKost;
        }

        foreach ($data['kost'] as $key => $kost) {
            if (in_array($kost->id, $id_kost_terpilih)) {
                unset($data['kost'][$key]);
            }
        }

        $data['harga'] = $this->M_Crud->get_by_id($tabel, $pk, 1);

        $data['jarak'] = $this->M_Crud->get_by_id($tabel, $pk, 2);

        $data['luas'] = $this->M_Crud->get_by_id($tabel, $pk, 3);

        $data['keamanan'] = $this->M_Crud->get_by_id($tabel, $pk, 4);

        $this->load->view('pages/admin/perhitungan/alternatifAdd.php', $data);
    }

    public function alternatif_insert()
    {
        $this->form_validation->set_rules('kost', 'Kost', 'required');

        $this->form_validation->set_rules('harga', 'Harga', 'required');

        $this->form_validation->set_rules('jarak', 'Jarak', 'required');

        $this->form_validation->set_rules('luas', 'Luas', 'required');

        $this->form_validation->set_rules('keamanan', 'Keamanan', 'required');

        if ($this->form_validation->run() === FALSE) {

            redirect('perbandingan/alternatif_add');
        } else {

            $kost = $this->input->post('kost');

            $harga = $this->input->post('harga');

            $jarak = $this->input->post('jarak');

            $luas = $this->input->post('luas');

            $keamanan = $this->input->post('keamanan');

            $tabel = "alternatif";

            $data = array(
                'idKost'                => $kost,
                'idSubkriteriaHarga'    => $harga,
                'idSubkriteriaJarak'    => $jarak,
                'idSubkriteriaLuas'     => $luas,
                'idSubkriteriaKeamanan' => $keamanan,
            );

            $this->M_Crud->insert($tabel, $data);

            $this->session->set_flashdata('success_message', 'Kriteria berhasil ditambahkan!');

            redirect('alternatif');
        }
    }

    public function alternatif_edit($id)
    {
        $data['currentPage'] = 'edit alternatif';

        $tabel = "subkriteria";

        $pk = "idKriteria";

        $data['alternatif'] = $this->M_Kost->join_kost_by_id($id);

        $data['kost'] = $this->M_Crud->get_all_data("kost")->result();

        $data['harga'] = $this->M_Crud->get_by_id($tabel, $pk, 1);

        $data['jarak'] = $this->M_Crud->get_by_id($tabel, $pk, 2);

        $data['luas'] = $this->M_Crud->get_by_id($tabel, $pk, 3);

        $data['keamanan'] = $this->M_Crud->get_by_id($tabel, $pk, 4);


        // Filter data dari tabel alternatif
        $filteredKost = array();

        foreach ($data['kost'] as $kost) {

            $found = false;

            foreach ($data['alternatif'] as $alternatif) {

                if ($alternatif->idKost == $kost->id) {

                    $found = true;

                    break;
                }
            }

            if (!$found) {

                $filteredKost[] = $kost;
            }
        }

        $data['kost'] = $filteredKost;

        $filteredHarga = array();

        foreach ($data['harga'] as $harga) {

            $found = false;

            foreach ($data['alternatif'] as $alternatif) {

                if ($alternatif->idSubkriteriaHarga == $harga->id) {

                    $found = true;

                    break;
                }
            }

            if (!$found) {

                $filteredHarga[] = $harga;
            }
        }

        $data['harga'] = $filteredHarga;

        $filteredJarak = array();

        foreach ($data['jarak'] as $jarak) {

            $found = false;

            foreach ($data['alternatif'] as $alternatif) {

                if ($alternatif->idSubkriteriaJarak == $jarak->id) {

                    $found = true;

                    break;
                }
            }

            if (!$found) {

                $filteredJarak[] = $jarak;
            }
        }

        $data['jarak'] = $filteredJarak;

        $filteredLuas = array();

        foreach ($data['luas'] as $luas) {

            $found = false;

            foreach ($data['alternatif'] as $alternatif) {

                if ($alternatif->idSubkriteriaLuas == $luas->id) {

                    $found = true;

                    break;
                }
            }

            if (!$found) {

                $filteredLuas[] = $luas;
            }
        }

        $data['luas'] = $filteredLuas;

        $filteredKeamanan = array();

        foreach ($data['keamanan'] as $keamanan) {

            $found = false;

            foreach ($data['alternatif'] as $alternatif) {

                if ($alternatif->idSubkriteriaKeamanan == $keamanan->id) {

                    $found = true;

                    break;
                }
            }

            if (!$found) {

                $filteredKeamanan[] = $keamanan;
            }
        }

        $data['keamanan'] = $filteredKeamanan;

        $this->load->view('pages/admin/perhitungan/alternatifEdit.php', $data);
    }

    public function alternatif_update()
    {
        $this->form_validation->set_rules('id', 'id', 'required');

        $this->form_validation->set_rules('kost', 'Kost', 'required');

        $this->form_validation->set_rules('harga', 'Harga', 'required');

        $this->form_validation->set_rules('jarak', 'Jarak', 'required');

        $this->form_validation->set_rules('luas', 'Luas', 'required');

        $this->form_validation->set_rules('keamanan', 'Keamanan', 'required');

        if ($this->form_validation->run() === FALSE) {

            redirect($_SERVER['REQUEST_URI'], 'refresh');
        } else {

            $id = $this->input->post('id');

            $kost = $this->input->post('kost');

            $harga = $this->input->post('harga');

            $jarak = $this->input->post('jarak');

            $luas = $this->input->post('luas');

            $keamanan = $this->input->post('keamanan');

            $tabel = "alternatif";

            $pk = "id";

            $data = array(
                'idKost'                => $kost,
                'idSubkriteriaHarga'    => $harga,
                'idSubkriteriaJarak'    => $jarak,
                'idSubkriteriaLuas'     => $luas,
                'idSubkriteriaKeamanan' => $keamanan,
            );

            $this->M_Crud->update($tabel, $data, $pk, $id);

            $this->session->set_flashdata('success_message', 'Kriteria berhasil ditambahkan!');

            redirect('alternatif');
        }
    }

    public function alternatif_delete($id)
    {

        $tabel = 'alternatif';

        $data = array(
            'id' => $id
        );

        $this->M_Crud->delete("alternatif_nilai", array('idAlternatif'));

        $this->M_Crud->delete($tabel, $data);

        redirect('alternatif');
    }

    public function update_kriteria()
    {
        $cr = $this->input->post('sendNilaiCR');
        $nilai1_2 = $this->input->post('1_2');
        $nilai1_3 = $this->input->post('1_3');
        $nilai1_4 = $this->input->post('1_4');
        $nilai2_1 = $this->input->post('2_1');
        $nilai2_3 = $this->input->post('2_3');
        $nilai2_4 = $this->input->post('2_4');
        $nilai3_1 = $this->input->post('3_1');
        $nilai3_2 = $this->input->post('3_2');
        $nilai3_4 = $this->input->post('3_4');
        $nilai4_1 = $this->input->post('4_1');
        $nilai4_2 = $this->input->post('4_2');
        $nilai4_3 = $this->input->post('4_3');
        $nilaiPrioritas1 = $this->input->post('sendPrioritasBaris-1');
        $nilaiPrioritas2 = $this->input->post('sendPrioritasBaris-2');
        $nilaiPrioritas3 = $this->input->post('sendPrioritasBaris-3');
        $nilaiPrioritas4 = $this->input->post('sendPrioritasBaris-4');

        $dataKriteria = array(
            array('idKriteriaAsal' => 1, 'idKriteriaTujuan' => 2, 'nilai' => $nilai1_2, 'nilaiPrioritas' => $nilaiPrioritas1),
            array('idKriteriaAsal' => 1, 'idKriteriaTujuan' => 3, 'nilai' => $nilai1_3, 'nilaiPrioritas' => $nilaiPrioritas1),
            array('idKriteriaAsal' => 1, 'idKriteriaTujuan' => 4, 'nilai' => $nilai1_4, 'nilaiPrioritas' => $nilaiPrioritas1),
            array('idKriteriaAsal' => 2, 'idKriteriaTujuan' => 1, 'nilai' => $nilai2_1, 'nilaiPrioritas' => $nilaiPrioritas2),
            array('idKriteriaAsal' => 2, 'idKriteriaTujuan' => 3, 'nilai' => $nilai2_3, 'nilaiPrioritas' => $nilaiPrioritas2),
            array('idKriteriaAsal' => 2, 'idKriteriaTujuan' => 4, 'nilai' => $nilai2_4, 'nilaiPrioritas' => $nilaiPrioritas2),
            array('idKriteriaAsal' => 3, 'idKriteriaTujuan' => 1, 'nilai' => $nilai3_1, 'nilaiPrioritas' => $nilaiPrioritas3),
            array('idKriteriaAsal' => 3, 'idKriteriaTujuan' => 2, 'nilai' => $nilai3_2, 'nilaiPrioritas' => $nilaiPrioritas3),
            array('idKriteriaAsal' => 3, 'idKriteriaTujuan' => 4, 'nilai' => $nilai3_4, 'nilaiPrioritas' => $nilaiPrioritas3),
            array('idKriteriaAsal' => 4, 'idKriteriaTujuan' => 1, 'nilai' => $nilai4_1, 'nilaiPrioritas' => $nilaiPrioritas4),
            array('idKriteriaAsal' => 4, 'idKriteriaTujuan' => 2, 'nilai' => $nilai4_2, 'nilaiPrioritas' => $nilaiPrioritas4),
            array('idKriteriaAsal' => 4, 'idKriteriaTujuan' => 3, 'nilai' => $nilai4_3, 'nilaiPrioritas' => $nilaiPrioritas4)
            // Menambahkan data lainnya sesuai dengan kebutuhan
        );

        header('Content-Type: application/json');
        if ($cr <= 0.01) {
            echo json_encode(array('status' => 'no', 'msg' => "Gagal diupdate karena nilai CR kurang dari 0.01"));
        } else {

            $data = array(
                'id !=' => ''
            );

            $this->M_Crud->delete('kriteria_nilai', $data);

            $this->db->insert_batch('kriteria_nilai', $dataKriteria);

            echo json_encode(array('status' => 'ok', 'msg' => "Berhasil update nilai kriteria"));
        }
    }

    public function subkriteria()
    {
        $data['currentPage'] = 'perbandingan subkriteria';

        $tabel = 'kriteria';

        $data['kriteria'] = $this->M_Crud->get_all_data($tabel)->result_array();

        $this->load->view('pages/admin/perhitungan/subkriteria.php', $data);
    }

    public function get_subkriteria($id)
    {
        $data['currentPage'] = 'perbandingan subkriteria';

        $tabel = "subkriteria";

        $pk = "idKriteria";

        $data['result'] = $this->M_Crud->get_by_id($tabel, $pk, $id);

        $this->load->view('pages/admin/perhitungan/perbandinganSubkriteria.php', $data);
    }

    public function update_subkriteria()
    {
        $cr = $this->input->post('sendNilaiCR');
        $id_kriteria = $this->input->post('sendIdKriteria');

        header('Content-Type: application/json');
        if ($cr <= 0.01) {
            echo json_encode(array('status' => 'no', 'msg' => "Gagal diupdate karena nilai CR kurang dari 0.01"));
        } else {

            $data_where = array(
                'idKriteria =' => $id_kriteria
            );

            $this->M_Crud->delete("subkriteria_nilai", $data_where);


            $batchData = array();

            foreach ($_POST as $key => $value) {
                if ($key != 'sendNilaiCR' && $key != 'sendIdKriteria') {
                    // Parsing $key untuk mendapatkan nilai indeks
                    $index = explode('_', $key);

                    $i = intval($index[0]) + 1;
                    $j = intval($index[1]) + 1;

                    // Membuat array berdasarkan field dan nilainya
                    $dataInput = array(
                        'idKriteria' => $id_kriteria,
                        'idSubkriteriaAsal' => $i,
                        'idSubkriteriaTujuan' => $j,
                        'nilai' => $value,
                        'nilaiPrioritas' => $this->input->post('sendNilaiPrioritasBaris-' . $i - 1),
                    );

                    foreach ($batchData as &$data) {
                        $data['idKriteria'] = (int) $data['idKriteria'];
                        $data['nilai'] = (float) $data['nilai'];
                    }

                    array_push($batchData, $dataInput);
                }
            }

            $this->M_Crud->insert_batch("subkriteria_nilai", $batchData);

            $response = array(
                'status' => 'ok',
                'msg' => "Berhasil input data " . json_encode($batchData)
            );

            echo json_encode($response);

            // echo json_encode(array('status' => 'ok', 'msg' => "Berhasil input data"));
        }
    }

    public function hasil()
    {
        $data['currentPage'] = 'hasil';

        $data['kriteria'] = $this->M_Crud->get_all_data("kriteria")->result();

        $data['kriteria_nilai'] = $this->M_Crud->get_all_data("kriteria_nilai")->result();

        $data['nilai_prioritas_kriteria'] = array();

        // Perulangan untuk mengambil nilaiPrioritas dari array kriteria_nilai
        foreach ($data['kriteria_nilai'] as $elemen) {
            $idKriteriaAsal = $elemen->idKriteriaAsal;
            if (!isset($data['nilai_prioritas_kriteria'][$idKriteriaAsal])) {
                $data['nilai_prioritas_kriteria'][$idKriteriaAsal] = $elemen->nilaiPrioritas;
            }
        }

        $data['subkriteria'] = $this->M_Crud->get_all_data("subkriteria")->result();

        $data['subkriteria_nilai'] = $this->M_Crud->get_all_data("subkriteria_nilai")->result();

        // Mensortir dan mengelompokkan nilaiPrioritas berdasarkan idKriteria dan idSubkriteriaAsalnya

        $groupedData = [];

        foreach ($data['subkriteria_nilai'] as $item) {
            $idKriteria = $item->idKriteria;
            $idSubkriteriaAsal = $item->idSubkriteriaAsal;

            if (!isset($groupedData[$idKriteria])) {
                $groupedData[$idKriteria] = [];
            }

            if (!isset($groupedData[$idKriteria][$idSubkriteriaAsal])) {
                $groupedData[$idKriteria][$idSubkriteriaAsal] = $item->nilaiPrioritas;
            }
        }

        foreach ($groupedData as $idKriteria => $subkriteriaData) {
            foreach ($subkriteriaData as $idSubkriteriaAsal => $nilaiPrioritas) {
                $groupedData[$idKriteria][$idSubkriteriaAsal] = [
                    'nilaiPrioritas' => $nilaiPrioritas,
                    'idSubkriteriaAsal' => $idSubkriteriaAsal
                ];
            }
        }

        $data['groupedData'] = $groupedData;

        $data['alternatif'] = $this->M_Kost->join_kost();

        $this->load->view('pages/admin/perhitungan/hasil.php', $data);
    }

    public function update_rangking()
    {
        $alternatif_ids = $this->input->post('alternatif_id');
        $valueTotals = $this->input->post('valueTotal');

        // Memastikan data yang diterima memiliki jumlah yang sama
        if (count($alternatif_ids) === count($valueTotals)) {
            $dataToInsert = []; // Array untuk menyimpan data yang akan diinputkan ke database

            // Menggunakan loop untuk memproses data
            foreach ($alternatif_ids as $index => $alternatif_id) {
                $valueTotal = $valueTotals[$index];

                // Menambahkan pasangan alternatif_id dan valueTotal ke dalam array dataToInsert
                $dataToInsert[] = [
                    'idAlternatif' => intval($alternatif_id),
                    'nilai' => floatval($valueTotal)
                ];

                // Contoh: Menampilkan data yang diterima
                echo "Data Alternatif ID: " . $alternatif_id . "<br>";
                echo "Data Value Total: " . $valueTotal . "<br>";
                echo "<br>";
            }

            $data = array(
                'id !=' => ''
            );

            $this->M_Crud->delete('alternatif_nilai', $data);

            $this->M_Crud->insert_batch("alternatif_nilai", $dataToInsert);
        } else {
            echo "Jumlah data tidak sesuai";
        }
    }
}
