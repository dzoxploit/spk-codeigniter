<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkriteria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Crud');
        $this->load->model('M_Subkriteria');
    }

    public function subkriteria()
    {
        $data['currentPage'] = 'subkriteria';

        $tabel = "subkriteria";

        $data['subkriteria'] = $this->M_Subkriteria->join_kriteria()->result();

        $this->load->view('pages/admin/kriteria/subkriteria.php', $data);
    }

    public function subkriteria_add()
    {
        $data['currentPage'] = 'tambah subkriteria';
        $this->load->view('pages/admin/kriteria/subkriteriaAdd.php', $data);
    }

    function subkriteria_insert()
    {
        $this->form_validation->set_rules('namaSubkriteria', 'Nama Subkriteria', 'required');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('pages/admin/kriteria/kriteriaAdd.php');
        } else {

            $id_kriteria = $this->input->post('id');

            $nama_kriteria = $this->input->post('namaSubkriteria');

            $slug = url_title($nama_kriteria, 'dash', TRUE);

            $tabel = "subkriteria";

            $data = array(
                'idKriteria'    => $id_kriteria,
                'subkriteria'   => $nama_kriteria,
                'slug'          => $slug
            );

            $this->M_Crud->insert($tabel, $data);

            $this->session->set_flashdata('success_message', 'Kriteria berhasil ditambahkan!');

            redirect('subkriteria');
        }
    }

    public function subkriteria_edit($slug)
    {
        $data['currentPage'] = 'edit subkriteria';

        $tabel = "subkriteria";

        $pk = "slug";

        $data['subkriteria'] = $this->M_Crud->get_by_id($tabel, $pk, $slug);

        $this->load->view('pages/admin/kriteria/subkriteriaEdit.php', $data);
    }

    public function subkriteria_update()
    {
        $this->form_validation->set_rules('namaSubkriteria', 'Nama Subkriteria', 'required');

        if ($this->form_validation->run() === FALSE) {

            redirect($_SERVER['REQUEST_URI']);
        } else {

            $namaSubkriteria = $this->input->post('namaSubkriteria');

            $id = $this->input->post('slug');

            $tabel = "subkriteria";

            $pk = "slug";

            $updatedSlug = url_title($namaSubkriteria, 'dash', TRUE);

            $data = array(
                'subkriteria'       => $namaSubkriteria,
                'slug'              => $updatedSlug
            );

            $this->M_Crud->update($tabel, $data, $pk, $id);

            $this->session->set_flashdata('success_message', 'Data subkriteria berhasil diubah!');

            redirect('subkriteria');
        }
    }

    public function subkriteria_delete($slug)
    {
        $data['currentPage'] = 'subkriteria';

        $tabel = 'subkriteria';

        $data = array(
            'slug' => $slug
        );

        $this->M_Crud->delete($tabel, $data);

        redirect('subkriteria');
    }
}
