<?php
//$num 总记录数  $perpage 每页显示数  $curpage 当前页　　$mpurl 当前的URL地址　　$maxpages 最大页数(可不传入)
function multipage($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = TRUE, $simple = FALSE) {
	
	$showkbd = 0;
	$shownum = 0;
	$lang['prev']  = '&lsaquo;&lsaquo;';
	$lang['next']  = '&rsaquo;&rsaquo;';

	$multipage     = '';
	$mpurl        .= strpos($mpurl, '?') ? '&amp;' : '?';
	$realpages     = 1;
	if($num > $perpage) {
		$offset    = 2;

		$realpages = @ceil($num / $perpage);
		$pages     = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if($page > $pages) {
			$from  = 1;
			$to    = $pages;
		} else {
			$from  = $curpage - $offset;
			$to    = $from + $page - 1;
			if($from < 1) {
				$to     = $curpage + 1 - $from;
				$from   = 1;
				if($to - $from < $page) {
					$to = $page;
				}
			} elseif($to > $pages) {
				$from   = $pages - $page + 1;
				$to     = $pages;
			}
		}

		$multipage     = ($curpage - $offset > 1 && $pages > $page ? '<a href="'.$mpurl.'page=1" class="first">1</a>' : '').
			($curpage > 1 && !$simple ? '<a href="'.$mpurl.'page='.($curpage - 1).'" class="prev">'.$lang['prev'].'</a>' : '');
		for($i = $from; $i <= $to; $i++) {
			$multipage .= $i == $curpage ? '<strong>'.$i.'</strong>' :
				'<a href="'.$mpurl.'page='.$i.( $i == $pages && $autogoto ? '#' : '').'">'.$i.'</a>';
		}
        
		$multipage   .= ($to < ($pages-1)) ? '...' : '';
		$multipage   .= ($to < $pages ? '<a href="'.$mpurl.'page='.$pages.'" class="last">'.$realpages.'</a>' : '').
			($curpage < $pages && !$simple ? '<a href="'.$mpurl.'page='.($curpage + 1).'" class="next">'.$lang['next'].'</a>' : '').
			($showkbd && !$simple && $pages > $page ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\''.$mpurl.'page=\'+this.value; return false;}" /></kbd>' : '');

		$multipage    = $multipage ? '<div class="pages">'.($shownum && !$simple ? '<em>&nbsp;'.$num.'&nbsp;</em>' : '').$multipage.'</div>' : '';
	}
	
	return $multipage;
}
?>