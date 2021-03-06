<?php
class Paginationfront {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 4;
	public $url = '';
	public $text_first = '|&lt;';
	public $text_last = '&gt;|';
	public $text_next = '&gt;';
	public $text_prev = '&lt;';

	public function render() {
		$total = $this->total;

		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}

		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}

		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		$output = '<ul class="nav-box">';

		if ($page > 1) {
			//$output .= '<li class="first"><a href="' . str_replace('{page}', 1, $this->url) . '"><i class="fa fa-angle-double-left"></i></a></li>';
			$output .= '<li class="arrow-left"><a href="' . str_replace('{page}', $page - 1, $this->url) . '"></a></li>';
		}

		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);

				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}

				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}
                        
			if ($start > 1) {
				$output .= '<li><a href="' . str_replace(array('&amp;page={page}', '&page={page}'), '', $this->url) . '">1</a></li>';
				$output .= '<li class="ellipsis"><span>...</span></li>';
			}

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$output .= '<li><span class="page-active">' . $i . '</span></li>';
				}else {
					if ($i === 1) {
						$output .= '<li><a href="' . str_replace(array('&amp;page={page}', '&page={page}'), '', $this->url) . '">' . $i . '</a></li>';
					} else {
						$output .= '<li><a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></li>';
					}
				}
			}
                        
			if ($end < $num_pages) {
				$output .= '<li class="ellipsis"><span>...</span></li>';
				$output .= '<li><a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $num_pages . '</a></li>';
			}
		}

		if ($page < $num_pages) {
			$output .= '<li class="arrow-right"><a href="' . str_replace('{page}', $page + 1, $this->url) . '"></a></li>';
			//$output .= '<li class="last"><a href="' . str_replace('{page}', $num_pages, $this->url) . '"><i class="fa fa-angle-double-right"></i></a></li>';
		}

		$output .= '</ul>';

		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}