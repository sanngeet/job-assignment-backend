<?php

class Home_model extends CI_Model
{
	function steps($return = false)
	{
		$query = "SELECT s.id step_id, s.step step_name, s.created, s.updated, GROUP_CONCAT(i.id ORDER BY i.id SEPARATOR':::') AS item_id, GROUP_CONCAT(i.item ORDER BY i.id SEPARATOR ':::') AS item_name, GROUP_CONCAT(i.title ORDER BY i.id SEPARATOR ':::') AS item_title, GROUP_CONCAT(i.description ORDER BY i.id SEPARATOR ':::') AS item_description, GROUP_CONCAT(i.updated ORDER BY i.id SEPARATOR ':::') AS item_updated, GROUP_CONCAT(i.created ORDER BY i.id SEPARATOR ':::') AS item_created 
			FROM steps s 
		    LEFT JOIN items i ON i.step_id=s.id AND i.deleted IS NULL 
			WHERE s.deleted IS NULL 
			GROUP BY s.id";

		$res = $this->db->query($query)->result_array();

		foreach ($res as &$v) {
			$v['created'] = Date('d M Y, H:i:s', strtotime($v['created']));
			$v['updated'] = Date('d M Y, H:i:s', strtotime($v['updated']));

			$v['items'] = array();

			if ($v['item_id'] != null) {
				// item id
				$item_ids = explode(':::', $v['item_id']);
				foreach ($item_ids as $k => $item_id) {
					$v['items'][$k]['item_id'] = $item_id;
				}

				// item name
				$item_names = explode(':::', $v['item_name']);
				foreach ($item_names as $k => $item_name) {
					$v['items'][$k]['item_name'] = $item_name;
				}

				// item title
				$item_titles = explode(':::', $v['item_title']);
				foreach ($item_titles as $k => $item_title) {
					$v['items'][$k]['item_title'] = $item_title;
				}

				// item description
				$item_descriptions = explode(':::', $v['item_description']);
				foreach ($item_descriptions as $k => $item_description) {
					$v['items'][$k]['item_description'] = $item_description;
				}

				// item updated
				$item_updated_dts = explode(':::', $v['item_updated']);
				foreach ($item_updated_dts as $k => $item_updated_dt) {
					$v['items'][$k]['item_updated'] = Date('d M Y, H:i:s', strtotime($item_updated_dt));
				}

				// item created
				$item_created_dts = explode(':::', $v['item_created']);
				foreach ($item_created_dts as $k => $item_created_dt) {
					$v['items'][$k]['item_created'] = Date('d M Y, H:i:s', strtotime($item_created_dt));
				}
			}
			// delete redundant
			unset($v['item_id']);
			unset($v['item_name']);
			unset($v['item_description']);
			unset($v['item_title']);
			unset($v['item_created']);
			unset($v['item_updated']);
		}

		if ($return)
			return $res;

		api_json_res(True, $res);
	}

	function add_step()
	{
		$_POST = trim_array($this->input->post());

		if (!isset($_POST['step']))
			api_json_res(False, array('msg' => 'Please enter step name'));

		if (!$this->is_step_unique($_POST['step'])) {
			api_json_res(False, array('msg' => 'Step name already exists. Please choose a different name'));
		}

		$data = array(
			'step' => $_POST['step'],
			'created' => currentDT(),
			'updated' => currentDT()
		);

		$this->db->insert('steps', $data);

		if ($this->db->affected_rows()) {
			$data = $this->steps(true);
			api_json_res(True, array('steps' => $data, 'msg' => "Step added successfully"));
		} else {
			api_json_res(False, array('msg' => 'Server Error! Please try again later'));
		}
	}

	// todo - not used
	function update_step()
	{
		$_POST = trim_array($this->input->post());

		if (!$_POST['id'] && !is_numeric($_POST['id']))
			api_json_res(False, array('msg' => 'Invalid Id'));

		if (!$_POST['step'])
			api_json_res(False, array('msg' => 'Please enter step name'));

		if (!$this->is_step_unique($_POST['step'])) {
			api_json_res(False, array('msg' => 'Step name alreay exists. Please choose a different name'));
		}

		$data = array(
			'step' => $_POST['step'],
			'updated' => currentDT(),
		);

		$this->db->where('id', $_POST['id'])
			->update('steps', $data);

		if ($this->db->affected_rows()) {
			$updated = Date('d M Y, H:i:s', strtotime($data['updated']));
			api_json_res(True, array('updated' => $updated, 'msg' => "Step updated successfully"));
		} else {
			api_json_res(False, array('msg' => 'Server Error! Please try again later'));
		}
	}

	function delete_step($id)
	{
		$_POST = trim_array($this->input->post());

		$data = array(
			'deleted' => currentDT(),
		);

		$this->db->where('id', $id)
			->update('steps', $data);

		if ($this->db->affected_rows()) {
			$data = $this->steps(true);
			api_json_res(True, array('steps' => $data, 'msg' => "Step deleted successfully"));
		} else {
			api_json_res(False, array('msg' => 'Server Error! Please try again later'));
		}
	}

	function add_item()
	{
		$_POST = trim_array($this->input->post());

		if (!isset($_POST['step_id']) && !is_numeric($_POST['step_id']))
			api_json_res(False, array('msg' => 'Invalid Id'));

		if (!isset($_POST['item']))
			api_json_res(False, array('msg' => 'Please enter item name'));

		if (!$_POST['title'])
			api_json_res(False, array('msg' => 'Please enter title'));

		if (!$_POST['description'])
			api_json_res(False, array('msg' => 'Please enter description'));

		if (!$this->is_item_unique($_POST['step_id'], $_POST['item'], '')) {
			api_json_res(False, array('msg' => 'Item name already exists. Please choose a different name'));
		}

		$data = array(
			'item' => $_POST['item'],
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'step_id' => $_POST['step_id'],
			'created' => currentDT(),
			'updated' => currentDT()
		);

		$this->db->insert('items', $data);

		if ($this->db->affected_rows()) {
			$data = $this->steps(true);
			api_json_res(True, array('steps' => $data, 'msg' => "Item added successfully"));
		} else {
			api_json_res(False, array('msg' => 'Server Error! Please try again later'));
		}
	}

	function update_item()
	{
		$_POST = trim_array($this->input->post());

		if (!$_POST['step_id'] && !is_numeric($_POST['step_id']))
			api_json_res(False, array('msg' => 'Invalid Id'));

		if (!$_POST['item_id'] && !is_numeric($_POST['item_id']))
			api_json_res(False, array('msg' => 'Invalid Id'));

		if (!$_POST['item'])
			api_json_res(False, array('msg' => 'Please enter step name'));

		if (!$_POST['title'])
			api_json_res(False, array('msg' => 'Please enter title'));

		if (!$_POST['description'])
			api_json_res(False, array('msg' => 'Please enter description'));

		if (!$this->is_item_unique($_POST['step_id'], $_POST['item'], $_POST['item_id'])) {
			api_json_res(False, array('msg' => 'Item name already exists. Please choose a different name'));
		}

		$data = array(
			'item' => $_POST['item'],
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'updated' => currentDT(),
		);

		$this->db->where('id', $_POST['item_id'])
			->update('items', $data);

		if ($this->db->affected_rows()) {
			$data = $this->steps(true);
			api_json_res(True, array('steps' => $data, 'msg' => "Item updated successfully"));
		} else {
			api_json_res(False, array('msg' => 'Server Error! Please try again later'));
		}
	}

	function delete_item($id)
	{
		$_POST = trim_array($this->input->post());

		$data = array(
			'deleted' => currentDT(),
		);

		$this->db->where('id', $id)
			->update('items', $data);

		if ($this->db->affected_rows()) {
			$data = $this->steps(true);
			api_json_res(True, array('steps' => $data, 'msg' => "Item deleted successfully"));
		} else {
			api_json_res(False, array('msg' => 'Server Error! Please try again later'));
		}
	}

	function is_step_unique($step)
	{
		$exists = $this->db->from('steps')
			->where('step', $step)
			->where('deleted IS NULL')
			->get()->num_rows();


		return !$exists;
	}

	function is_item_unique($step_id, $item, $item_id)
	{
		$this->db->from('items')
			->where('step_id', $step_id)
			->where('deleted IS NULL')
			->where('item', $item);

		if ($item_id) {
			$this->db->where('id !=', $item_id);
		}

		$exists = $this->db->get()->num_rows();

		return !$exists;
	}
}
