<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani.com, S.SI
     * @web : http://www.risetkomputer.com
     * @keterangan : Controller untuk halaman ref_json
     **/
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('functions');
	} 
	
	public function InfoWbs()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kode = $this->input->post('code');
			$text = "SELECT tbl_wbs.wbs_code,tbl_wbs.wbs_name,tbl_wbs.wbs_desc
                    FROM tbl_wbs WHERE tbl_wbs.wbs_code='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['wbs_name'] = $t->wbs_name;
                    $data['wbs_desc'] = $t->wbs_desc;
					echo json_encode($data);
				}
			}else{
				$data['wbs_name'] = '';
                $data['wbs_desc'] = '';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}

    public function InfoWp()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $kode = $this->input->post('code');
            $text = "SELECT tbl_wp.wp_code,tbl_wp.wp_name,tbl_wp.wp_desc,tbl_wp.wbs_code,
                  tbl_wbs.wbs_name,tbl_wbs.wbs_desc FROM tbl_wp
                  INNER JOIN tbl_wbs ON tbl_wp.wbs_code = tbl_wbs.wbs_code WHERE tbl_wp.wp_code='$kode'";
            $tabel = $this->app_model->manualQuery($text);
            $row = $tabel->num_rows();
            if($row>0){
                foreach($tabel->result() as $t){
                    $data['wp_name'] = $t->wp_name;
                    $data['wp_desc'] = $t->wp_desc;
                    $data['wbs_code'] = $t->wbs_code;
                    echo json_encode($data);
                }
            }else{
                $data['wp_name'] = '';
                $data['wp_desc'] = '';
                $data['wbs_code'] = '';
                echo json_encode($data);
            }
        }else{
            header('location:'.base_url());
        }
    }

    public function InfoStkk()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $kode = $this->input->post('code');
            $text = "SELECT tbl_stkk.stkk_code,tbl_stkk.stkk_name,tbl_stkk.wp_code,tbl_stkk.stkk_desc,tbl_wbs.wbs_name
                    FROM tbl_stkk INNER JOIN tbl_wbs ON tbl_stkk.wp_code = tbl_wbs.wbs_code WHERE tbl_stkk.stkk_code='$kode'";
            $tabel = $this->app_model->manualQuery($text);
            $row = $tabel->num_rows();
            if($row>0){
                foreach($tabel->result() as $t){
                    $data['stkk_name'] = $t->stkk_name;
                    $data['stkk_desc'] = $t->stkk_desc;
                    $data['wp_code'] = $t->wp_code;
                    echo json_encode($data);
                }
            }else{
                $data['stkk_name'] = '';
                $data['stkk_desc'] = '';
                $data['stkk_code'] = '';
                echo json_encode($data);
            }
        }else{
            header('location:'.base_url());
        }
    }


    public function ListWbs()
    {
        if($this->session->userdata('logged_in')!="")
        {
            $id = $this->input->post('id');
            if(empty($id)){
                echo json_encode(array());
            }else{
                $text = "SELECT tbl_wbs.wbs_code,tbl_wbs.wbs_name,tbl_wbs.wbs_desc
                    FROM tbl_wbs WHERE tbl_wbs.wbs_code LIKE '%$id%' GROUP BY tbl_wbs.wbs_code";
                $d = $this->app_model->manualQuery($text);
                $data = array();
                foreach($d->result() as $t)
                    $data[] = $t->wbs_code;
                    echo json_encode($data);

            }
        }
        else
        {
            header('location:'.base_url().'index.php/login');
        }
    }

    public function ListWp()
    {
        if($this->session->userdata('logged_in')!="")
        {
            $id = $this->input->post('id');
            if(empty($id)){
                echo json_encode(array());
            }else{
                $text = "SELECT tbl_wp.wp_code,tbl_wp.wp_name,tbl_wp.wp_desc,tbl_wp.wbs_code
                        FROM tbl_wp WHERE tbl_wp.wp_code LIKE '%$id%' GROUP BY tbl_wp.wp_code";
                $d = $this->app_model->manualQuery($text);
                $data = array();
                foreach($d->result() as $t)
                    $data[] = $t->wp_code;
                echo json_encode($data);

            }
        }
        else
        {
            header('location:'.base_url().'index.php/login');
        }
    }
    public function ListStkk()
    {
        if($this->session->userdata('logged_in')!="")
        {
            $id = $this->input->post('id');
            if(empty($id)){
                echo json_encode(array());
            }else{
                $text = "SELECT tbl_stkk.stkk_code,tbl_stkk.stkk_name,tbl_stkk.wp_code,tbl_stkk.stkk_desc
                      FROM tbl_stkk WHERE tbl_stkk.stkk_code LIKE '%$id%' GROUP BY tbl_stkk.stkk_code";
                $d = $this->app_model->manualQuery($text);
                $data = array();
                foreach($d->result() as $t)
                    $data[] = $t->stkk_code;
                echo json_encode($data);

            }
        }
        else
        {
            header('location:'.base_url().'index.php/login');
        }
    }
	
	public function ListAgenda()
    {
        if($this->session->userdata('logged_in')!="")
        {
            $id = $this->input->post('id');
            if(empty($id)){
                echo json_encode(array());
            }else{
                $text = "SELECT * FROM v_agenda WHERE agenda_code = '$id'";
                $d = $this->app_model->manualQuery($text);
                $data = array();
                foreach($d->result() as $t){
                    $data['judul'] = $t->agenda_name;
                    $data['deskripsi'] = $t->agenda_desc;
                    $data['mulai'] = $this->functions->convert_date_indo(array("datetime" => $t->agenda_mulai));
                    $data['akhir'] = $this->functions->convert_date_indo(array("datetime" => $t->agenda_akhir));
                    $data['lokasi'] = $t->agenda_lokasi;
					$data['mitra'] = $t->mitra_name;
					$data['nama'] = $t->nama_lengkap;
					$data['nip'] = $t->nip;
					$data['lampiran'] = $t->lampiran_agenda;
                }
                echo json_encode($data);

            }
        }
        else
        {
            header('location:'.base_url().'index.php/login');
        }
    }
	
	public function ListDokumen()
    {
        if($this->session->userdata('logged_in')!="")
        {
            $id = $this->input->post('id');
            if(empty($id)){
                echo json_encode(array());
            }else{
                $text = "SELECT * FROM v_dokumen WHERE dok_id = '$id'";
                $d = $this->app_model->manualQuery($text);
                $data = array();
                foreach($d->result() as $t){
                    $data['judul'] 				= $t->dok_judul;
                    $data['desc2'] 				= $t->dok_desc;
					$data['status'] 			= ($t->status=="U")? "Umum" : "Rahasia";
					$data['uploadedby'] 		= $t->nama_lengkap;
					//$data['nip'] 				= $t->nip;
					$data['lampiran_dokumen'] 	= $t->lampiran_dokumen;
                }
                echo json_encode($data);

            }
        }
        else
        {
            header('location:'.base_url().'index.php/login');
        }
    }

}

/* End of file ref_json.php */
/* Location: ./application/controllers/ref_json.php */