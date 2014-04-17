<?php

use \HTML;

class NavigationTreeController extends \BaseController {

	/**
	 * Constructor.
	 *
	 * @return NavigationTreeController
	 */
	public function __construct()
	{
		parent::__construct();
		// Check if the current project has been set
		$this->beforeFilter('@isCurrentProjectSet');
	}

	// --------- Utility methods

	/**
	 * Create a navigation tree with the nodes returned from DB.
	 *
	 * @param array   $nodes
	 * @param NavigationTreeNode $root
	 * @return array
	 */
	protected function createNavigationTree($nodes, $root)
	{
		$tree = array();
		foreach ($nodes as $node)
		{
			$node = (object) $node;
			if ($node->ancestor == $node->descendant && $node->ancestor == $root)
			{
				$node->children = array();
				$tree[$root] = $node;
			}
			else if ($node->ancestor !== $node->descendant)
			{
				$this->addChild($tree, $node);
			}
		}
		$this->sortNavigationTree($tree);
		return $tree;
	}

	/**
	 * Adds a child node into the navigation tree.
	 *
	 * @param array $tree
	 * @param NavigationTreeNode $node
	 */
	protected function addChild($tree, $node)
	{
		foreach ($tree as $edge)
		{
			if ($edge->descendant == $node->ancestor)
			{
				$node->children = array();
				$node->ancestor = $node->descendant;
				$edge->children[$node->descendant] = $node;
			}
			else
			{
				$this->addChild($edge->children, $node);
			}
		}
	}

	protected function sortNavigationTree(&$nodes)
	{
		// Sort by execution type and display name
		usort($nodes, function($left, $right) {
			$leftAncestor = $left->ancestor;
			$rightAncestor = $right->ancestor;
			list($leftExecutionType, $leftNodeId) = explode("-", $leftAncestor);
			list($rightExecutionType, $rightNodeId) = explode("-", $rightAncestor);
			if ($leftExecutionType > $rightExecutionType)
				return 1;
			elseif ($leftExecutionType < $rightExecutionType)
				return -1;
			else
				return $left->display_name > $right->display_name;
		});

		foreach ($nodes as $node)
		{
			$this->sortNavigationTree($node->children);
		}
	}

	/**
	 * Creates the navigation tree HTML to be displayed in the theme UI.
	 *
	 * @param array $navigationTree
	 * @param int $nodeId selected node
	 * @param string $themeName Used to build HTML links with theme assets
	 * @return string HTML
	 */
	protected function createTreeHTML($navigation_tree = array(), $nodeId, $theme_name = '')
	{
		$buffer = '';
		if (is_null ( $navigation_tree ) || empty ( $navigation_tree ))
			return $buffer;

		foreach ($navigation_tree as $node) {
			$extra_classes = "";
			if ($node->descendant == $nodeId && $node->ancestor == $nodeId) {
				$extra_classes = " active";
			}
			if ($node->node_type_id == 1) { // project
				$buffer .= "<ul id='treeData' style='display: none;'>";
				$buffer .= sprintf ("<li data-icon='places/folder.png' data-node-type='%s' data-node-id='%s' class='expanded%s'>%s", 
					$node->node_type_id, 
					$node->node_id,
					$extra_classes, 
					HTML::link('/specification/nodes/' . $node->descendant, $node->display_name, array('target' => '_self')
				));
				if (! empty ( $node->children )) {
					$buffer .= "<ul>";
					$buffer .= $this->createTreeHTML($node->children, $nodeId, $theme_name);
					$buffer .= "</ul>";
				}
				$buffer .= "</li></ul>";
			} else if ($node->node_type_id == 2) { // test suite
				$buffer .= sprintf("<li data-icon='actions/document-open.png' data-node-type='%s' data-node-id='%s' class='expanded%s'>%s", 
					$node->node_type_id, 
					$node->node_id,
					$extra_classes, 
					HTML::link('/specification/nodes/' . $node->descendant, $node->display_name, array('target' => '_self')
				));
				if (! empty ( $node->children )) {
					$buffer .= "<ul>";
					$buffer .= $this->createTreeHTML($node->children, $nodeId, $theme_name);
					$buffer .= "</ul>";
				}
				$buffer .= "</li>";
			} else {
				$buffer .= sprintf("<li data-icon='mimetypes/text-x-generic.png' data-node-type='%s' data-node-id='%s' class='%s'>%s</li>", 
					$node->node_type_id, 
					$node->node_id,
					$extra_classes, 
					HTML::link ('/specification/nodes/' . $node->descendant, $node->display_name, array('target' => '_self')
				));
			}
		}

		return $buffer;
	}

	/**
	 * Creates the navigation tree HTML to be displayed in the theme UI.
	 *
	 * @param array $navigationTree
	 * @param int $nodeId selected node
	 * @param string $themeName Used to build HTML links with theme assets
	 * @return string HTML
	 */
	protected function createTestPlanTreeHTML($navigation_tree = array(), $nodeId, $theme_name = '', $nodesSelected = array())
	{
		$buffer = '';
		if (is_null ( $navigation_tree ) || empty ( $navigation_tree ))
			return $buffer;

		foreach ($navigation_tree as $node) {
			$extra_classes = "";
			if ($node->descendant == $nodeId && $node->ancestor == $nodeId) {
				$extra_classes = " expanded active";
			}
			$nodeTypeId = $node->node_type_id;
			if ($nodeTypeId == 3 && array_key_exists($node->node_id, $nodesSelected))
			{
				$extra_classes = " selected";
			}
			if ($nodeTypeId == 1) { // project
				$buffer .= "<ul id='treeData' style='display: none;'>";
				$buffer .= sprintf ( "<li data-icon='places/folder.png' id='%s' class='expanded%s'>%s", $node->descendant, $extra_classes, $node->display_name);
				if (! empty ( $node->children )) {
					$buffer .= "<ul>";
					$buffer .= $this->createTestPlanTreeHTML ($node->children, $nodeId, $theme_name, $nodesSelected);
					$buffer .= "</ul>";
				}
				$buffer .= "</li></ul>";
			} else if ($node->node_type_id == 2) { // test suite
				$buffer .= sprintf ( "<li data-icon='actions/document-open.png' id='%s' class='%s'>%s", $node->descendant, $extra_classes, $node->display_name);
				if (! empty ( $node->children )) {
					$buffer .= "<ul>";
					$buffer .= $this->createTestPlanTreeHTML ($node->children, $nodeId, $theme_name, $nodesSelected);
					$buffer .= "</ul>";
				}
				$buffer .= "</li>";
			} else {
				$buffer .= sprintf ( "<li data-icon='mimetypes/text-x-generic.png' id='%s' class='%s'>%s</li>", $node->descendant, $extra_classes, $node->display_name);
			}
		}

		return $buffer;
	}

	protected function isNodeInTree($tree, $node)
	{
		$r = false;
		foreach ($tree as $entry)
		{
			if ($entry->ancestor === $node->ancestor && $entry->descendant === $node->descendant)
			{
				return true;
			}
			if (isset($entry->children) && !empty($entry->children))
			{
				$r = $this->isNodeInTree($entry->children, $node);
				if ($r)
					return true;
			}
		}
		return $r;
	}

	/**
	 * Creates the navigation tree HTML to be displayed in the theme UI.
	 *
	 * @param array $navigationTree
	 * @return string HTML
	 */
	protected function createTestRunTreeHTML($navigation_tree = array(), $testrun_id, $testcases, $test_case_id = NULL)
	{
		$buffer = '';
		if (is_null ( $navigation_tree ) || empty ( $navigation_tree ))
			return $buffer;

		foreach ($navigation_tree as $node) {
			$extra_classes = "expanded";
			if (!is_null($test_case_id) && $node->node_type_id == 3 && $node->node_id == $test_case_id)
			{
				$extra_classes .= " active";
			}
			if ($node->node_type_id == 1) { // project
				$buffer .= "<ul id='treeData' style='display: none;'>";
				$buffer .= sprintf ("<li data-icon='places/folder.png' class='%s'>%s", $extra_classes, $node->display_name);
				if (! empty ( $node->children )) {
					$buffer .= "<ul>";
					$buffer .= $this->createTestRunTreeHTML ($node->children, $testrun_id, $testcases, $test_case_id);
					$buffer .= "</ul>";
				}
				$buffer .= "</li></ul>";
			} else if ($node->node_type_id == 2) { // test suite // FIXME: show only test suites whose test cases we display
				$buffer .= sprintf ( "<li data-icon='actions/document-open.png' class='%s'>%s", $extra_classes, $node->display_name);
				if (! empty ( $node->children )) {
					$buffer .= "<ul>";
					$buffer .= $this->createTestRunTreeHTML ($node->children, $testrun_id, $testcases, $test_case_id);
					$buffer .= "</ul>";
				}
				$buffer .= "</li>";
			} else if (array_key_exists($node->node_id, $testcases)) {
				$buffer .= sprintf ( "<li data-icon='mimetypes/text-x-generic.png' class='%s'>%s</li>", $extra_classes, HTML::link ('/execution/testruns/' . $testrun_id . "/run/testcase/" . $node->node_id, $node->display_name, array('target' => '_self')));
			}
		}

		return $buffer;
	}

}