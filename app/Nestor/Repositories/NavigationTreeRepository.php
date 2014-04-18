<?php namespace Nestor\Repositories;

interface NavigationTreeRepository {

	/**
	 * Get all navigation tree nodes
	 *
	 * @return NavigationTreeNode
	 */
	public function all();

	/**
	 * Get a NavigationTreeNode by its ancestor and length, thus returning all
	 * its children, itself included.
	 *
	 * @param string $ancestor
	 * @param int    $length
	 * @return NavigationTreeNode
	 */
	public function children($ancestor, $length);

	/**
	 * Get a list of parents of a NavigationTreeNode and itself.
	 *
	 * @param int $descendant
	 * @return NavigationTreeNode
	 */
	public function parents($descendant);

	/**
	 * Get the direct parent of the node.
	 *
	 * @param string $descendant
	 * @return NavigationTreeNode
	 */
	public function parent($descendant);

	/**
	 * Get a NavigationTreeNode by their primary key.
	 *
	 * @param  int   $ancestorId
	 * @param  int   $descendantId
	 * @return NavigationTreeNode
	 */
	public function find($nodeId, $nodeTypeId);

	/**
	 * Create a navigation tree node
	 *
	 * @param  string  $ancestor
	 * @param  string  $descendant
	 * @param  int     $node_id
	 * @param  int     $node_type_id
	 * @param  string  $display_name
	 * @return NavigationTreeNode
	 */
	public function create($ancestor, $descendant, $node_id, $node_type_id, $display_name);

	/**
	 * Update a navigation tree node
	 *
	 * @param  int     $id
	 * @param  int     $node_id
	 * @param  int     $node_type_id
	 * @param  int     $parent_id
	 * @param  string  $display_name
	 * @return NavigationTreeNode
	 */
	public function update($id, $node_id, $node_type_id, $parent_id, $display_name);

	/**
	 * Update a navigation tree node by the descendant ID
	 *
	 * @param  string  $descendant
	 * @param  int     $node_id
	 * @param  int     $node_type_id
	 * @param  string  $display_name
	 * @return NavigationTreeNode
	*/
	public function updateDisplayNameByDescendant($descendant, $display_name);

	/**
	 * Delete a navigation tree node
	 *
	 * @param int $descendant
	 */
	public function delete($descendant);

	/**
	 * Delete a navigation tree node with all its children nodes
	 *
	 * @param int $ancestor
	 * @param int $descendant
	 */
	public function deleteWithAllChildren($ancestor, $descendant);

	/**
	 * Moves a node under another node.
	 *
	 * @param string $descendant  from
	 * @param string $ancestor    to
	 * @return NavigationTreeNode
	 */
	public function move($descendant, $ancestor);

}