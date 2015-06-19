<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pencarian extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani,S.SI
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk Pencarian Dokumen
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
    }

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $d['judul']         ="";
            $d['judul_halaman'] = "Pencarian Dokumen dan Agenda";

            // cek apakah form search tidak kosong
            if(!empty($this->input->post('katakunci'))){
                $d['agenda'] = $this->app_model->cari_agenda($this->input->post('katakunci'));
                $d['dokumen'] = $this->app_model->cari_dokumen($this->input->post('katakunci'));
            }

            $d['content']= $this->load->view('pencarian',$d,true);
            $this->load->view('home',$d);

           // print_r($d); exit;
        }else{
            header('location:'.base_url().'index.php/login');
        }
    }


}

/* End of file pencarian.php */
/* Location: ./application/controllers/pencarian.php */