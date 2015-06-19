<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman Dokumen
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('upload');
        $this->load->library('functions');
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


            $d['judul']         ="list_dokumen";
            $d['judul_halaman'] = "Daftar DOKUMEN";

            $d['all_dokumen']	    = $this->app_model->get_all_dokumen_tampil();

            $d['content']= $this->load->view('dokumen/view',$d,true);
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

            $d['judul']='add_dokumen';
            $d['judul_halaman']="Tambah Dokumen";

            $kode	= $this->app_model->MaxKodeDokumen();

            $d['code']      = $kode;
            $d['judul']     = '';
            $d['desc']      = '';
            $d['l_lampiran']= '';

            $text = "SELECT * FROM tbl_dok_status";
            $d['l_status'] = $this->app_model->manualQuery($text);

            $d['content']= $this->load->view('dokumen/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function simpan (){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
	    $nama = $this->app_model->CariUserPengguna();
            $up['username']	= $nama;
            $up['dok_code']     = $this->input->post('code');
            $up['dok_judul']	= $this->input->post('judul');
            $up['dok_desc']	= $this->input->post('desc');
	    $up['status']	    = $this->input->post('status');
            
            $id['dok_code']	= $this->input->post('code');

            $this->db->trans_start();

            $data = $this->app_model->getSelectedData("tbl_dokumen",$id);

            if($data->num_rows()>0){
                $this->app_model->updateData("tbl_dokumen",$up,$id);

            }else{
                $this->app_model->insertData("tbl_dokumen",$up);

            }

            // handling file upload
            if($this->input->post('lampiran')){
                $lampiranid=$this->input->post('lampiran');
                foreach($lampiranid as $id){
                    $datalamp=array(
                        'dok_code'=>$this->input->post('code'),
                        'lampiran_id'=>$id
                    );
                    //print_r($datalamp); exit;
                    $this->app_model->insertData("tbl_lampiran_dokumen",$datalamp);
                    $lamp=$this->app_model->get_lampiran_by_id($id);
                    #print $lamp; exit;
                    $source_dir = './uploads/temp/';
                    $target_dir = './uploads/';
                    $nama_file = $lamp->lampiran_nama;

                    if(file_exists($source_dir . $nama_file)){
                        // pindahkan dari temporary
                        rename($source_dir . $nama_file, $target_dir . $nama_file);
                        // finally remove file from temp
                        if(is_file($source_dir . $nama_file)){
                            unlink($source_dir . $nama_file);
                        }
                    }
                }
            }

            $this->db->trans_complete();

            //jika transaksi gagal maka rollback
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('notif', 'Data Dokumen gagal disimpan!');
            }else{
                //jika berhasil lakukan disini
                $this->db->trans_commit();
                $this->session->set_flashdata('notif', 'Data Dokumen berhasil disimpan!');
            }

            redirect('dokumen');
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

            $d['judul']='edit_dokumen';
            $d['judul_halaman']='Edit DOKUMEN';

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_dokumen WHERE dok_code='$id'";
            $data = $this->app_model->manualQuery($text);

            if($data->num_rows() > 0){
                foreach($data->result() as $db){
                    $d['code']	   = $id;
                    $d['judul']	   = $db->dok_judul;
                    $d['desc']     = $db->dok_desc;
		    $d['status']    = $db->status;
                    $d['l_lampiran'] = $this->app_model->get_list_lampiran_dokumen($id);
                }
            }else{

                $d['code']		    = $id;
                $d['judul']		    = '';
                $d['desc']          = '';
		$d['status']        = '';
            }

	    $text = "SELECT * FROM tbl_dok_status";
            $d['l_status'] = $this->app_model->manualQuery($text);


            $d['content']= $this->load->view('dokumen/form',$d,true);
            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function hapus()  {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);
            $this->app_model->manualQuery("DELETE FROM tbl_dokumen WHERE dok_code='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/dokumen'>";
        }else{
            header('location:'.base_url());
        }
    }

    public function hapus_lampiran($lampiran_id)
    {
        // delete di table lampiran agenda
        $this->app_model->manualQuery("DELETE FROM tbl_lampiran_dokumen WHERE lampiran_id='$lampiran_id'");

        // get filename
        $lampiran = $this->app_model->get_lampiran_by_id($lampiran_id);

        // hapus file existing
        $dir = './uploads/';
        if(file_exists($dir . $lampiran->lampiran_nama)){
            unlink($dir . $lampiran->lampiran_nama);
        }

        // delete di table lampiran
        $this->app_model->manualQuery("DELETE FROM tbl_lampiran WHERE lampiran_id='$lampiran_id'");

        return true;
    }

    // qqfileuploader
    public function upload()
    {
        $method=$this->input->server('REQUEST_METHOD');
        if(strtolower($method)=="post"){

            $this->load->library('QQFileUploader');

            // target upload directory
            $folder="./uploads/temp/";

            //array("jpg","jpeg","gif","exe","mov" and etc...
            $allowedExtensions = array("doc", "docx", "pdf", "xls","xlsx");
            $sizeLimit = 10 * 1024 * 1024; // maximum file size in bytes
            $uploader = new QQFileUploader($allowedExtensions, $sizeLimit);

            $result = $uploader->handleUpload($folder);

            $data=array(
                'lampiran_nama'=>$result['filename'],
                'lampiran_size'=>$result['size'],
                'lampiran_ext'=>$result['ext']
            );

            $id=$this->app_model->insert_lampiran($data);
            //idlampiran nanti ditaruh di id untuk hidden field
            $result['idlampiran']=$id;
            $return = json_encode($result);
            echo $return;
        }else{
            header("HTTP/1.1 403 Forbidden");
            echo "Not Allowed";
        }
    }

    // hapus lampiran
    function delete_lampiran()
    {
        $lampId =  $this->input->post('lampiran_id');

        // get filename
        $lampiran = $this->app_model->get_lampiran_by_id($lampId);
        // hapus file existing
        $dir = './uploads/';
        if(file_exists($dir . $lampiran->lampiran_nama)){
            unlink($dir . $lampiran->lampiran_nama);
        }

        $this->app_model->hapus_lampiran($lampId);
        $query = $this->app_model->hapus_lampiran_dokumen($lampId);

        $status = "false";
        if ($this->db->affected_rows() > 0){
            $status = "true";
        }
        echo $status;
    }
}

/* End of file dok.php */
/* Location: ./application/controllers/dok.php */