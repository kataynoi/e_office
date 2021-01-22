<?php
class Excel_import_model extends CI_Model
{
	function select()
	{
		$this->db->order_by('CustomerID', 'DESC');
		$query = $this->db->get('tbl_customer');
		return $query;
	}

	function update($items)
	{
		//$this->db->insert_batch('person_survey_test', $data);
	$n=0;
		$this->db->trans_start();
		foreach ($items as $item) {
			$this->db->set($item);
			$this->db->where('user_id',$item['user_id']);
			$this->db->where('date_work',$item['date_work']);
			$rs = $this->db->update('sign_work',$item);
			//print_r($this->db->last_query());
			if($rs){$n++;}
		}
		//$this->calculate_sign_in();
		$this->db->trans_complete();

		return $n;
	}

	public function check_person_cid($cid)
	{
		$rs = $this->db
			->from("person_survey")
			->where('cid', $cid)
			->count_all_results();
		return $rs;
	}
	public function calculate_sign_in()
	{
		$query = $this->db->query("CALL update_sign_work();");
        return $query->result();
	}

}
