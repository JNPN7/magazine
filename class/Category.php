<?php
	class Category extends Database{
		function __construct(){
			Database::__construct();
			$this->table = 'categories';
		}
		public function addCategory($data, $is_die = false){
			return $this->addData($data, $is_die);
		}

		public function getAllCategory($is_die=false){
			$args = array(
				'fields' => '',
				'where' => array(
					'or' => array(
						'status' => 'Active'
					)
				),
				'order' => 'ASC'
			);
			return $this->getData($args,$is_die);
		}

		public function getCategorybyId($category_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $category_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateCategorybyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteCategorybyId($id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->deleteData($args,$is_die);
		}
	}

?>