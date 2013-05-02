<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigation_Tree extends CI_Model {
	
	/**
	 * Creates a new node into the navigation tree.
	 * 
	 * @visibility public
	 * @param object $navigation_tree_node
	 */
	public function create($navigation_tree_node) {
		if (!$navigation_tree_node || empty($navigation_tree_node) || !is_object($navigation_tree_node)) 
			return;
		
		if (!$this->db->insert('navigation_tree', $navigation_tree_node)) {
			throw new Exception('Failed to create navigation tree node');
		}
	}
	
}