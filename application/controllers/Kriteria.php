<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Crud');
    }

    public function kriteria()
    {
        $tabel = "kriteria";

        $data['currentPage'] = 'kriteria';

        $data['kriteria'] = $this->M_Crud->get_all_data($tabel)->result();

        $this->load->view('pages/admin/kriteria/kriteria.php', $data);
    }

    public function kriteria_add()
    {
        $data['currentPage'] = 'tambah kriteria';
        $this->load->view('pages/admin/kriteria/kriteriaAdd.php', $data);
    }

    function kriteria_insert()
    {
        $this->form_validation->set_rules('namaKriteria', 'Nama Kriteria', 'required');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('pages/admin/kriteria/kriteriaAdd.php');
        } else {

            $nama_kriteria = $this->input->post('namaKriteria');

            $slug = url_title($nama_kriteria, 'dash', TRUE);

            $tabel = "kriteria";

            $data = array(
                'kriteria'  => $nama_kriteria,
                'slug'      => $slug
            );

            $this->M_Crud->insert($tabel, $data);

            $this->session->set_flashdata('success_message', 'Kriteria berhasil ditambahkan!');

            redirect('kriteria');
        }
    }

    public function kriteria_edit($slug)
    {
        $data['currentPage'] = 'edit kriteria';

        $tabel = "kriteria";

        $pk = "slug";

        $data['kriteria'] = $this->M_Crud->get_by_id($tabel, $pk, $slug);

        $this->load->view('pages/admin/kriteria/kriteriaEdit.php', $data);
    }

    public function kriteria_update()
    {
        $this->form_validation->set_rules('namaKriteria', 'Nama Kriteria', 'required');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('pages/admin/kriteria/kriteriaEdit.php');
        } else {

            $namaKriteria = $this->input->post('namaKriteria');

            $id = $this->input->post('slug');

            $tabel = "kriteria";

            $pk = "slug";

            $updatedSlug = url_title($namaKriteria, 'dash', TRUE);

            $data = array(
                'kriteria'  => $namaKriteria,
                'slug'      => $updatedSlug
            );

            $this->M_Crud->update($tabel, $data, $pk, $id);

            $this->session->set_flashdata('success_message', 'Data kriteria berhasil diubah!');

            redirect('kriteria');
        }
    }

    public function kriteria_delete($slug)
    {
        $data['currentPage'] = 'tambah kriteria';

        $tabel = 'kriteria';

        $data = array(
            'slug' => $slug
        );

        $this->M_Crud->delete($tabel, $data);

        redirect('kriteria');
    }

    public function parameter($id)
    {
        $data['currentPage'] = 'subkriteria';

        $tabel = "subkriteria";

        $pk = "idKriteria";

        $data['subkriteria'] = $this->M_Crud->get_by_id($tabel, $pk, $id);

        $data['id'] = $id;

        $this->load->view('pages/admin/kriteria/parameter.php', $data);
    }
}
