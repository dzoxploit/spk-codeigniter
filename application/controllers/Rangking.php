<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rangking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Rangking');
    }

    public function index()
    {
        $data['currentPage'] = 'rangking';

        $data['rangking'] = $this->M_Rangking->getAlternatifWithNilaiAndKost();

        $this->load->view('pages/admin/rangking/index.php', $data);
    }
}
