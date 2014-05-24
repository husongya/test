<?php
/**
 * Smarty plugin 分页
 * @package Smarty
 * @subpackage plugins
 */

function smarty_block_page($params, $content, &$smarty, &$repeat) {
	$currentPage = 1;
	$totalPage = 0;
	$item = 'page';
	
	extract ( $params, EXTR_IF_EXISTS );
	static $page_list = array ( );
	
	if ($currentPage == 'index') {
		$currentPage = 1;
	}
	if ($totalPage < 1 || is_null ( $totalPage )) {
		return;
	}
	if ($currentPage > $totalPage) {
		return;
	}
	if ($currentPage < 1 || is_null ( $currentPage )) {
		$currentPage = 1;
	}
	if (is_null ( $content )) {
		//判断起始页
		if ($totalPage <= 8) {
			$start = 1;
			$end = 8;
			if ($end >= $totalPage) {
				$end = $totalPage;
			}
		} else {
			if ($currentPage <= 5) {
				$start = 1;
				$end = 8;
				if ($end > $totalPage)
					$end = $totalPage;
			} else {
				if ($currentPage == $totalPage - 4) {
					$start = $currentPage - 3;
					$end = $currentPage + 4;
					if ($end >= $totalPage) {
						$end = $totalPage;
					}
				} else {
					$start = $currentPage - 3;
					$end = $currentPage + 3;
					if ($end >= $totalPage) {
						$end = $totalPage;
						$start = $totalPage - 6;
					}
				}
			}
		}
		
		for($i = $start; $i <= $end; $i ++) {
			$page_list [] = $i;
		}
		$smarty->assign ( 'totalPage', $totalPage );
	}
	
	if (! empty ( $page_list )) {
		$current = array_shift ( $page_list );
		if ($current) {
			$smarty->assign ( $item, $current );
			$repeat = true;
		} else {
			$repeat = false;
		}
	}
	
	return $content;
}

/* vim: set expandtab: */

?>
