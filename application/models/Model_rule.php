<?php 
 
class Model_rule extends CI_Model{	

	public function data_rule() {
		$data = $this->db->query('SELECT * FROM tb_rule ORDER BY id ASC');
		return $data->result();
	}

    public function data_variabel() {
        $data = $this->db->query('SELECT * FROM tb_variabel ORDER BY id ASC');
        return $data->result();
    }

    public function data_variabel_khusus() {
        $data = $this->db->query('SELECT * FROM tb_variabel_khusus ORDER BY id ASC');
        return $data->result();
    }

    public function simpan($table, $data){
        return $this->db->insert($table, $data);
    }

    public function hapus($table,$where){
        return $this->db->delete($table,$where);
    }

    public function edit($where= "") {
        $data = $this->db->query('SELECT * FROM tb_rule '.$where);
        return $data->result();
    }

    public function update($data){
        $this->db->where('id',$data['id']);
        $this->db->update('tb_rule',$data);
    }

    public function kode_variabel() {
        $data = $this->db->query('SELECT DISTINCT(kode_variabel) AS kode FROM tb_variabel ORDER BY kode_variabel ASC');
        return $data->result();
    }
}