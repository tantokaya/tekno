<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topik extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman WP
     **/

    function __construct()
    {
        session_start(); //mengadakan session
        parent::__construct();
        $this->load->model('m_captcha');
        $this->load->helper('captcha');
    }

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');


            $d['judul']         ="list_topik";
            $d['judul_halaman'] = "Daftar Topik";

            $d['all_topik']	    = $this->app_model->get_all_topik();

            $d['content']= $this->load->view('topik/view',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url().'index.php/login');
        }
    }

    public function tambah() {

        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');


            $d['judul']         ="tambah_topik";
            $d['judul_halaman'] = "Tambah Topik";

//            $d['captcha'] = $this->m_captcha->setCaptcha();


            $d['code']      = '';
            $d['title']     = '';
            $d['kategori']  = '';
            $d['ck']        = '';
            $d['foto']      = '';

            $d['content']= $this->load->view('forum/topik',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url().'index.php/login');
        }
    }

    public function simpan()
    {

        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $nama = $this->app_model->CariUserPengguna();
            $time = gmdate("Y-m-d H:i:s", time()+60*60*7);

            $up['username']         = $nama;
            $up['post_time']        = $time;
            $up['topik_title']      = $this->input->post('title');
            $up['kategori_id']      = $this->input->post('kategori');
            $up['topik_post']       = $this->input->post('ck');
            $up['topik_image']      = $this->input->post('foto');

            $id['topik_code']       = $this->input->post('code');

            // cek jika ada file yg diupload
            if (!empty($_FILES['userfile']['name'])) {
                // upload
                $config['upload_path'] = './uploads/topik/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size']	= '1024';
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';

                $this->load->library('upload');
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload())
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error); exit();
                }
                else
                {
                    $pp = array('upload_data' => $this->upload->data());
                }

                $up['topik_image'] = $pp['upload_data']['file_name'];

            }

            //print_r($up); exit();


            $data = $this->app_model->getSelectedData("tbl_topik",$id);
            if($data->num_rows()>0){
                $result = $data->row_array();
                // print_r($result); exit();

                // hapus image lama
                $old_dir = './uploads/profile/';
                if(file_exists($old_dir . $result['foto'])){

                    unlink($old_dir . $result['foto']);
                }

            }else{
                $kode = $this->app_model->MaxKodeTopik();

                $up['topik_code'] = $kode;
                $this->app_model->insertData("tbl_topik",$up);
            }
            redirect('topik');

        }else{
            header('location:'.base_url());
        }

    }
    public function hapus()  {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);
            $this->app_model->manualQuery("DELETE FROM tbl_topik WHERE topik_id='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/topik'>";
        }else{
            header('location:'.base_url());
        }
    }
}

/* End of file stkk.php */
/* Location: ./application/controllers/stkk.php */