<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kost extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Crud');
    }

    public function index()
    {
        $tabel = "kost";

        $data['currentPage'] = 'kost';

        $data['kost'] = $this->M_Crud->get_all_data($tabel)->result();

        $this->load->view('pages/admin/kost/index.php', $data);
    }

    public function kost_add()
    {
        $data['currentPage'] = 'tambah kost';
        $this->load->view('pages/admin/kost/kostAdd.php', $data);
    }

    function kost_insert()
    {
        $this->form_validation->set_rules('namaKost', 'Nama Kost', 'required');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('pages/admin/kost/kostAdd.php');
        } else {

            $nama_kost = $this->input->post('namaKost');

            $slug = url_title($nama_kost, 'dash', TRUE);

            $tabel = "kost";

            $data = array(
                'kost'  => $nama_kost,
                'slug'      => $slug
            );

            $this->M_Crud->insert($tabel, $data);

            $this->session->set_flashdata('success_message', 'kost berhasil ditambahkan!');

            redirect('kost');
        }
    }

    public function kost_edit($slug)
    {
        $data['currentPage'] = 'edit kost';

        $tabel = "kost";

        $pk = "slug";

        $data['kost'] = $this->M_Crud->get_by_id($tabel, $pk, $slug);

        $this->load->view('pages/admin/kost/kostEdit.php', $data);
    }

    public function kost_update()
    {
        $this->form_validation->set_rules('namaKost', 'Nama Kost', 'required');

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('pages/admin/kost/kostEdit.php');
        } else {

            $namaKost = $this->input->post('namaKost');

            $id = $this->input->post('slug');

            $tabel = "kost";

            $pk = "slug";

            $updatedSlug = url_title($namaKost, 'dash', TRUE);

            $data = array(
                'kost'  => $namaKost,
                'slug'      => $updatedSlug
            );

            $this->M_Crud->update($tabel, $data, $pk, $id);

            $this->session->set_flashdata('success_message', 'Data kost berhasil diubah!');

            redirect('kost');
        }
    }

    public function kost_delete($slug)
    {
        $data['currentPage'] = 'tambah kost';

        $tabel = 'kost';

        $data = array(
            'slug' => $slug
        );

        $this->M_Crud->delete($tabel, $data);

        redirect('kost');
    }
}
