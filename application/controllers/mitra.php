<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mitra extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman WP
     **/

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


            $d['judul']         ="list_mitra";
            $d['judul_halaman'] = "Daftar MITRA";

            $d['all_mitra']	    = $this->app_model->get_all_mitra();

            $d['content']= $this->load->view('mitra/view',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url().'index.php/login');
        }
    }

    public function tambah(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']           = $this->config->item('prg');
            $d['web_prg']       = $this->config->item('web_prg');

            $d['nama_program']  = $this->config->item('nama_program');
            $d['instansi']      = $this->config->item('instansi');
            $d['usaha']         = $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');

            $d['judul']='add_mitra';
            $d['judul_halaman']='Tambah MITRA';

            $kode	= $this->app_model->MaxKodeMitra();

            $d['code']      = $kode;
            $d['name']      = '';
            $d['addr']      = '';
            $d['telp']      = '';
            $d['email']      = '';
            $d['desc']      = '';
            $d['cp']        = '';
            $d['stkk']        = '';

            $text = "SELECT * FROM tbl_stkk";
            $d['l_stkk'] = $this->app_model->manualQuery($text);


            $d['content']= $this->load->view('mitra/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function simpan (){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $up['mitra_code']   = $this->input->post('code');
            $up['mitra_name']	= $this->input->post('name');
            $up['mitra_addr']	= $this->input->post('addr');
            $up['mitra_telp']   = $this->input->post('telp');
            $up['mitra_email']  = $this->input->post('email');
            $up['mitra_desc']   = $this->input->post('desc');
            $up['mitra_cp']     = $this->input->post('cp');
            $up['stkk_code']    = $this->input->post('stkk');

            $id['mitra_code']	= $this->input->post('code');

            $data = $this->app_model->getSelectedData("tbl_mitra",$id);

            if($data->num_rows()>0){
                $this->app_model->updateData("tbl_mitra",$up,$id);

            }else{
                $this->app_model->insertData("tbl_mitra",$up);
            }
        }else{
            header('location:'.base_url());
        }
    }

    public function edit(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $d['prg']= $this->config->item('prg');
            $d['web_prg']= $this->config->item('web_prg');

            $d['nama_program']= $this->config->item('nama_program');
            $d['instansi']= $this->config->item('instansi');
            $d['usaha']= $this->config->item('usaha');
            $d['alamat_instansi']= $this->config->item('alamat_instansi');

            $d['judul']='edit_mitra';
            $d['judul_halaman']='Edit MITRA';

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_mitra WHERE mitra_code='$id'";
            $data = $this->app_model->manualQuery($text);

            if($data->num_rows() > 0){
                foreach($data->result() as $db){
                    $d['code']	   = $id;
                    $d['name']	   = $db->mitra_name;
                    $d['addr']     = $db->mitra_addr;
                    $d['telp']     = $db->mitra_telp;
                    $d['email']    = $db->mitra_email;
                    $d['desc']     = $db->mitra_desc;
                    $d['cp']       = $db->mitra_cp;
                    $d['stkk']     = $db->stkk_code;
                }
            }else{

                $d['code']		    = $id;
                $d['name']		    = '';
                $d['addr']          = '';
                $d['telp']          = '';
                $d['email']         = '';
                $d['desc']          = '';
                $d['cp']            = '';
                $d['stkk']          = '';
            }

            $text = "SELECT * FROM tbl_stkk";
            $d['l_stkk'] = $this->app_model->manualQuery($text);

            $d['content']= $this->load->view('mitra/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function hapus()  {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);
            $this->app_model->manualQuery("DELETE FROM tbl_mitra WHERE mitra_code='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/mitra'>";
        }else{
            header('location:'.base_url());
        }
    }
}

/* End of file stkk.php */
/* Location: ./application/controllers/stkk.php */