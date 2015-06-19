<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	/**
     * @author : Hartanto Kurniawan,S.Kom and Aditya Nursyahbani,S.SI
     * @web : http://www.risetkomputer.com
     * @keterangan : Model untuk menangani 
     **/
	
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	


	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('tbl_admin', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'aingLoginYeuh';
						$sess_data['username'] = $qad->username;
						$sess_data['nama_lengkap'] = $qad->nama_lengkap;
						$sess_data['foto'] = $qad->foto;
						$sess_data['id_level'] = $qad->id_level;
                        $sess_data['nip'] = $qad->nip;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'index.php/home');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'index.php/login');
		}
	}

    public function CariNamaPengguna(){
        $id = $this->session->userdata('username');
        $t = "SELECT * FROM tbl_admin WHERE username='$id'";
        $d = $this->app_model->manualQuery($t);
        $r = $d->num_rows();
        if($r>0){
            foreach($d->result() as $h){
                $hasil = $h->nama_lengkap;
            }
        }else{
            $hasil = '';
        }
        return $hasil;
    }
    public function CariUserPengguna(){
        $id = $this->session->userdata('username');
        $t = "SELECT * FROM tbl_admin WHERE username='$id'";
        $d = $this->app_model->manualQuery($t);
        $r = $d->num_rows();
        if($r>0){
            foreach($d->result() as $h){
                $hasil = $h->username;
            }
        }else{
            $hasil = '';
        }
        return $hasil;
    }

    public function CariFotoPengguna(){
        $id = $this->session->userdata('username');
        $t = "SELECT * FROM tbl_admin WHERE username='$id'";
        $d = $this->app_model->manualQuery($t);
        $r = $d->num_rows();
        if($r>0){
            foreach($d->result() as $h){
                $hasil = $h->foto;
            }
        }else{
            $hasil = '';
        }
        return $hasil;
    }

    public function CariLevel($id){
        $t = "SELECT * FROM tbl_level WHERE id_level='$id'";
        $d = $this->app_model->manualQuery($t);
        $r = $d->num_rows();
        if($r>0){
            foreach($d->result() as $h){
                $hasil = $h->level;
            }
        }else{
            $hasil = '';
        }
        return $hasil;
    }

    public function CariWp($id){
        $t = "SELECT * FROM tbl_wp WHERE wp_code='$id'";
        $d = $this->app_model->manualQuery($t);
        $r = $d->num_rows();
        if($r>0){
            foreach($d->result() as $h){
                $hasil = $h->wp_name;
            }
        }else{
            $hasil = '';
        }
        return $hasil;
    }

    public function CariIcon($id){
        $t = "SELECT * FROM tbl_icon WHERE icon_id='$id'";
        $d = $this->app_model->manualQuery($t);
        $r = $d->num_rows();
        if($r>0){
            foreach($d->result() as $h){
                $hasil = $h->icon_name;
            }
        }else{
            $hasil = '';
        }
        return $hasil;
    }

    /*---------------- Kode Otomatis ------------*/
    public function MaxKodeMitra(){
        $bln = date('m');
        $th = date('y');
        $text = "SELECT max(mitra_code) as no FROM tbl_mitra";
        $data = $this->app_model->manualQuery($text);
        if($data->num_rows() > 0 ){
            foreach($data->result() as $t){
                $no = $t->no;
                $tmp = ((int) substr($no,2,8))+1;
                $hasil = 'MT'.sprintf("%08s", $tmp);
            }
        }else{
            $hasil = 'MT'.'00000001';
        }
        return $hasil;
    }
    public function MaxKodeAgenda(){
        $bln = date('m');
        $th = date('y');
        $text = "SELECT max(agenda_code) as no FROM tbl_agenda";
        $data = $this->app_model->manualQuery($text);
        if($data->num_rows() > 0 ){
            foreach($data->result() as $t){
                $no = $t->no;
                $tmp = ((int) substr($no,2,8))+1;
                $hasil = 'AG'.sprintf("%08s", $tmp);
            }
        }else{
            $hasil = 'AG'.'00000001';
        }
        return $hasil;
    }
    public function MaxKodeDokumen(){
        $bln = date('m');
        $th = date('y');
        $text = "SELECT max(dok_code) as no FROM tbl_dokumen";
        $data = $this->app_model->manualQuery($text);
        if($data->num_rows() > 0 ){
            foreach($data->result() as $t){
                $no = $t->no;
                $tmp = ((int) substr($no,2,8))+1;
                $hasil = 'DO'.sprintf("%08s", $tmp);
            }
        }else{
            $hasil = 'DO'.'00000001';
        }
        return $hasil;
    }

    public function MaxKodeTugas(){
        $bln = date('m');
        $th = date('y');
        $text = "SELECT max(tugas_code) as no FROM tbl_tugas";
        $data = $this->app_model->manualQuery($text);
        if($data->num_rows() > 0 ){
            foreach($data->result() as $t){
                $no = $t->no;
                $tmp = ((int) substr($no,2,9))+1;
                $hasil = 'TU'.sprintf("%09s", $tmp);
            }
        }else{
            $hasil = 'TU'.'000000001';
        }
        return $hasil;
    }

    public function MaxKodeTopik(){
        $bln = date('m');
        $th = date('y');
        $text = "SELECT max(topik_code) as no FROM tbl_topik";
        $data = $this->app_model->manualQuery($text);
        if($data->num_rows() > 0 ){
            foreach($data->result() as $t){
                $no = $t->no;
                $tmp = ((int) substr($no,2,9))+1;
                $hasil = 'TU'.sprintf("%09s", $tmp);
            }
        }else{
            $hasil = 'TO'.'000000001';
        }
        return $hasil;
    }
    /*-------  All of Trasaction -----------*/

    function get_all_wbs() {
       $this->db->select('tbl_wbs.wbs_id,tbl_wbs.wbs_code, tbl_wbs.wbs_name,tbl_wbs.wbs_desc,tbl_admin.nama_lengkap');
        $this->db->from('tbl_wbs');
	$this->db->join('tbl_admin', 'tbl_admin.username = tbl_wbs.username', 'left');
        $this->db->order_by('wbs_code', 'asc');
        $query = $this->db->get();

        return $query->result_array();
    }
    function get_all_wp() {
        $this->db->select('tbl_wp.wp_code, tbl_wp.wp_name,tbl_wp.wp_desc,tbl_wp.wbs_code,tbl_admin.nama_lengkap');
        $this->db->from('tbl_wp');
	$this->db->join('tbl_admin', 'tbl_admin.username = tbl_wp.username', 'left');        
	$this->db->order_by('wp_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }
	function get_wp_by_wbs_code($wbs_code){
        $this->db->order_by('wp_code', 'asc');
        $query = $this->db->get_where('tbl_wp', array('wbs_code' => $wbs_code));

        return $query->result_array();
    }
    function get_all_stkk() {
        $this->db->select('tbl_stkk.stkk_code,tbl_stkk.stkk_name,tbl_stkk.stkk_desc');
        $this->db->from('tbl_stkk');
        $this->db->order_by('stkk_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }
    function get_all_mitra() {
        $this->db->select('tbl_mitra.mitra_code,tbl_mitra.mitra_name,tbl_mitra.mitra_addr,tbl_mitra.mitra_telp,tbl_mitra.mitra_email,
                            tbl_mitra.mitra_desc,tbl_mitra.mitra_cp');
        $this->db->from('tbl_mitra');
        $this->db->order_by('mitra_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }
    function get_all_agenda() {
        $pengguna = $this->session->userdata('username');

        $this->db->select('tbl_agenda.agenda_id,tbl_agenda.agenda_code,tbl_agenda.agenda_name,tbl_agenda.agenda_desc,tbl_agenda.agenda_mulai,
            tbl_agenda.agenda_akhir,tbl_agenda.agenda_lokasi,tbl_agenda.mitra_code');
        $this->db->from('tbl_agenda');

        $lvl = $this->session->userdata('id_level');
        if($lvl !== '01' ){
            $this->db->where('username',$pengguna);
        }

        $this->db->order_by('agenda_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }    
    //function get_all_dokumen() {
        //$this->db->select('tbl_dokumen.dok_code,tbl_dokumen.dok_judul,tbl_dokumen.dok_desc');
        //$this->db->from('tbl_dokumen');
        //$this->db->order_by('dok_code', 'desc');

        //$query = $this->db->get();

        //return $query->result_array();
    //}

    function get_all_dokumen_tampil() {
        $this->db->select('tbl_dokumen.dok_code,tbl_dokumen.dok_judul,tbl_dokumen.dok_desc');
        $this->db->from('tbl_dokumen');
        $this->db->order_by('dok_code', 'desc');

        $query = $this->db->get();

        {
            if($query->num_rows() > 0){
                return $query->result();
            }
            else {
                return array();
            }
        }
    }

    function get_all_tugas() {
        $pengguna = $this->session->userdata('username');

        $this->db->select('tbl_tugas.tugas_code,tbl_tugas.tugas_name,tbl_tugas.icon_id,tbl_tugas.username');
        $this->db->from('tbl_tugas');
        $this->db->where('username',$pengguna);
        $this->db->order_by('tugas_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_all_topik() {
        $this->db->select('*');
        $this->db->from('tbl_topik');
        $this->db->order_by('topik_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_all_topik_reply($per_page, $offset) {
        $id = $this->uri->segment(3);
        if($offset!=0) $offset = ($offset-1) * $per_page;

        $this->db->select('tbl_admin.nama_lengkap,tbl_admin.foto,tbl_admin.nip,tbl_topik_reply.reply_id,tbl_topik_reply.reply_code,
                            tbl_topik_reply.reply_title,tbl_topik_reply.reply_post,tbl_topik_reply.reply_time,tbl_topik_reply.username,tbl_admin.hp,tbl_admin.email');
        $this->db->from('tbl_topik_reply');
        $this->db->join('tbl_admin','tbl_topik_reply.username = tbl_admin.username');
        $this->db->order_by('tbl_topik_reply.reply_code', 'desc');
        $this->db->limit($per_page, $offset);
        $this->db->where('tbl_topik_reply.reply_code',$id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
            return false;
    }

    function get_all_topik_reply_count() {
        $id = $this->uri->segment(3);

        $this->db->select('tbl_admin.nama_lengkap,tbl_admin.foto,tbl_admin.nip,tbl_topik_reply.reply_id,tbl_topik_reply.reply_code,
                            tbl_topik_reply.reply_title,tbl_topik_reply.reply_post,tbl_topik_reply.reply_time,tbl_topik_reply.username,tbl_admin.hp,tbl_admin.email');
        $this->db->from('tbl_topik_reply');
        $this->db->join('tbl_admin','tbl_topik_reply.username = tbl_admin.username');
        $this->db->order_by('tbl_topik_reply.reply_code', 'desc');
        $query = $this->db->get();

        $this->db->where('tbl_topik_reply.reply_code',$id);

       return $query->num_rows();
    }
	
    function get_all_forum_perkenalan() {
        $pengguna = 'perkenalan';

        $this->db->select('*');
        $this->db->from('tbl_topik');
        $this->db->where('kategori_id',$pengguna);
        $this->db->order_by('topik_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_all_forum_pengumuman() {
        $pengguna = 'pengumuman';

        $this->db->select('*');
        $this->db->from('tbl_topik');
        $this->db->where('kategori_id',$pengguna);
        $this->db->order_by('topik_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_all_forum_saran() {
        $pengguna = 'saran';

        $this->db->select('*');
        $this->db->from('tbl_topik');
        $this->db->where('kategori_id',$pengguna);
        $this->db->order_by('topik_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_all_forum_pojok() {
        $pengguna = 'pojok';

        $this->db->select('*');
        $this->db->from('tbl_topik');
        $this->db->where('kategori_id',$pengguna);
        $this->db->order_by('topik_code', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }
	
	// event calendar
	function get_all_event()
	{
		$this->db->select('a.agenda_code as id, a.agenda_name as title, a.agenda_mulai as start, a.agenda_akhir as end, a.agenda_desc as description, a.agenda_lokasi as location, m.mitra_name as mitra, u.nama_lengkap as nama, u.hp as tlp');
		$this->db->from('tbl_agenda a');
		$this->db->join('tbl_mitra m', 'a.mitra_code=m.mitra_code');
		$this->db->join('tbl_admin u', 'a.username=u.username');	
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function insert_lampiran($data){
		$this->db->insert('tbl_lampiran',$data);
		return $this->db->insert_id();
	}
	
	function get_lampiran_by_id($id)
	{
		$this->db->select("*");
		$this->db->from("tbl_lampiran");
		$this->db->where("lampiran_id",$id);
		return $this->db->get()->row();
	}
	
	function get_list_lampiran($id)
	{
		$this->db->select("la.agenda_code,la.lampiran_id, l.lampiran_nama, l.lampiran_size, l.lampiran_ext");
		$this->db->from("tbl_lampiran_agenda la");
		$this->db->join('tbl_lampiran l', 'la.lampiran_id=l.lampiran_id');
		$this->db->where("la.agenda_code",$id);
		return $this->db->get()->result_array();
	}

    function get_list_lampiran_dokumen($id)
	{
		$this->db->select("la.dok_code,la.lampiran_id, l.lampiran_nama, l.lampiran_size, l.lampiran_ext");
		$this->db->from("tbl_lampiran_dokumen la");
		$this->db->join('tbl_lampiran l', 'la.lampiran_id=l.lampiran_id');
		$this->db->where("la.dok_code",$id);
		return $this->db->get()->result_array();
	}

    function hapus_lampiran($id){
        $sql = "DELETE FROM tbl_lampiran WHERE lampiran_id =? ";
        $this->db->query($sql, array($id));
        return $this->db->affected_rows();
    }

    function hapus_lampiran_agenda($id)
    {
        $sql = "DELETE FROM tbl_lampiran_agenda WHERE lampiran_id =? ";
        $this->db->query($sql, array($id));
        return $this->db->affected_rows();
    }

    function hapus_lampiran_dokumen($id)
    {
        $sql = "DELETE FROM tbl_lampiran_dokumen WHERE lampiran_id =? ";
        $this->db->query($sql, array($id));
        return $this->db->affected_rows();
    }

    // Menghitung Jumlah Topik Diskusi Berdasarkan Kategori

    public function JmlTopikPerkenalan(){
        $query = $this->db->query("SELECT * FROM tbl_topik WHERE kategori_id = 'perkenalan'");

        return $query->num_rows();
    }

    public function JmlTopikPengumuman(){
        $query = $this->db->query("SELECT * FROM tbl_topik WHERE kategori_id = 'pengumuman'");

        return $query->num_rows();
    }

    public function JmlTopikSaran(){
        $query = $this->db->query("SELECT * FROM tbl_topik WHERE kategori_id = 'saran'");

        return $query->num_rows();
    }

    public function JmlTopikPojok(){
        $query = $this->db->query("SELECT * FROM tbl_topik WHERE kategori_id = 'pojok'");

        return $query->num_rows();
    }
	
	// Last edited by Adit 17042015
    /* PENCARIAN */
     public function cari_agenda($katakunci){
        $this->db->select('*');
        $this->db->from('v_agenda');
        $this->db->like('agenda_name', $katakunci);
        $this->db->or_like('agenda_desc', $katakunci);
		$this->db->or_like('agenda_lokasi', $katakunci);
		$this->db->or_like('mitra_name', $katakunci);
		$this->db->or_like('agenda_mulai', $katakunci);
		$this->db->or_like('agenda_akhir', $katakunci);
        $this->db->or_like('lampiran_agenda', $katakunci);

        $query = $this->db->get();

        return $query->result_array();
    }
    public function cari_dokumen($katakunci){
		/*
        $this->db->select('d.*, l.lampiran_nama as lampiran');
        $this->db->from('tbl_dokumen d');
        $this->db->join('tbl_lampiran_dokumen ld', 'd.dok_code = ld.dok_code', 'left');
        $this->db->join('tbl_lampiran l', 'ld.lampiran_id = l.lampiran_id', 'left');
        $this->db->like('d.dok_judul', $katakunci);
        $this->db->or_like('d.dok_desc', $katakunci);
        $this->db->or_like('l.lampiran_nama', $katakunci);
		*/
		$this->db->select('*');
        $this->db->from('v_dokumen');
        $this->db->like('dok_judul', $katakunci);
        $this->db->or_like('dok_desc', $katakunci);
        $this->db->or_like('lampiran_dokumen', $katakunci);
		

        $query = $this->db->get();

        return $query->result_array();
    }
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */