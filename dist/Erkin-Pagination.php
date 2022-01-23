<?php
/*
 * Erkin-Pagination version 1.3.0	2018.08.16	1397.05.25
 * https://github.com/AminAdel/Erkin-Pagination
 */

class pagination {
	
	private $html = '
		<!-- pagination -->
		<div id="pagination">
			<div class="ul">
				<div class="li i1 [i1_disable] prev"><a href="[i1_href]"><i class="material-icons">chevron_left</i></a></div>
				<div class="li i2 [i2_active] min"><a href="[i2_href]">[i2_text]</a></div>
				<div class="li i3 [i3_active] [i3_hide] [i3_dots]"><a href="[i3_href]">[i3_text]</a></div>
				<div class="li i4 [i4_active] [i4_hide]"><a href="[i4_href]">[i4_text]</a></div>
				<div class="li i5 [i5_active] [i5_hide] middle"><a href="[i5_href]">[i5_text]</a></div>
				<div class="li i6 [i6_active] [i6_hide]"><a href="[i6_href]">[i6_text]</a></div>
				<div class="li i7 [i7_active] [i7_hide] [i7_dots]"><a href="[i7_href]">[i7_text]</a></div>
				<div class="li i8 [i8_active] [i8_hide] max"><a href="[i8_href]">[i8_text]</a></div>
				<div class="li i9 [i9_disable] next"><a href="[i9_href]"><i class="material-icons">chevron_right</i></a></div>
			</div><!-- /ul -->
		</div><!-- /pagination -->
	';
	
	private $i = [];
	
	
	public function __construct ($max, $active, $link, $link_replace, $echo = 1) {
		
		$this->check_a($max, $active);
		$this->mainJob($max, $active, $link, $link_replace);
		
		if ($echo == 1) echo $this->html;
		else return $this->html;
	}
	
	private function check_a($max, $active) {
		
		$i = $this->i;
		
		// i1.prev :
		$i[1]['disabled'] = 0;
		$i[1]['link_num'] = $active - 1;
		if ($active == 1) {
			$i[1]['disabled'] = 1;
			$i[1]['link_num'] = '';
		}
		
		
		
		// i2.min :
		$i[2]['link_num'] = 1;
		$i[2]['text'] = 1;
		
		
		
		// i3.dots : // dots or 2 or hidden
		$i[3]['link_num'] = '';
		$i[3]['text'] = '';
		$i[3]['status'] = '';
		if ($max >= 2) {
			$i[3]['link_num'] = 2;
			$i[3]['text'] = 2;
			$i[3]['status'] = 'normal';
			
			if ($max > 7  &&  $active >= 5) {
				$i[3]['link_num'] = '';
				$i[3]['text'] = '...';
				$i[3]['status'] = 'dots';
			}
		}
		
		
		
		// i4 :
		$i[4]['link_num'] = '';
		$i[4]['text'] = '';
		if ($max >= 3) {
			$i[4]['link_num'] = 3;
			$i[4]['text'] = 3;
			
			if ($max > 7) {
				if ($active >= 5  &&  ($max - $active) > 4) {
					$i[4]['link_num'] = $active - 1;
					$i[4]['text'] = $active - 1;
				}
				else if ($active >= 5) {
					$i[4]['link_num'] = $max - 4;
					$i[4]['text'] = $max - 4;
				}
			}
		}
		
		
		
		// i5 middle :
		$i[5]['link_num'] = '';
		$i[5]['text'] = '';
		if ($max >= 4) {
			$i[5]['link_num'] = 4;
			$i[5]['text'] = 4;
			
			if ($max > 7) {
				if ($active >= 5  &&  ($max - $active) > 4) {
					$i[5]['link_num'] = $active;
					$i[5]['text'] = $active;
				}
				else if ($active >= 5) {
					$i[5]['link_num'] = $max - 3;
					$i[5]['text'] = $max - 3;
				}
			}
		}
		
		
		
		// i6 :
		$i[6]['link_num'] = '';
		$i[6]['text'] = '';
		if ($max >= 5) {
			$i[6]['link_num'] = 5;
			$i[6]['text'] = 5;
			
			if ($max > 7) {
				if ($active >= 5  &&  ($max - $active) > 4) {
					$i[6]['link_num'] = $active + 1;
					$i[6]['text'] = $active + 1;
				}
				else if ($active >= 5) {
					$i[6]['link_num'] = $max - 2;
					$i[6]['text'] = $max - 2;
				}
			}
		}
		
		
		
		// i7.dots : // dots or max-1 or hidden
		$i[7]['link_num'] = '';
		$i[7]['text'] = '';
		$i[7]['status'] = '';
		if ($max >= 6) {
			$i[7]['link_num'] = 6;
			$i[7]['text'] = 6;
			$i[7]['status'] = 'normal';
			
			if ($max > 7) {
				if ($i[6]['link_num'] + 2 == $max) {
					$i[7]['link_num'] = $max - 1;
					$i[7]['text'] = $max - 1;
					$i[7]['status'] = 'normal';
				}
				else {
					$i[7]['link_num'] = '';
					$i[7]['text'] = '...';
					$i[7]['status'] = 'dots';
				}
			}
		}
		
		
		
		// i8.max :
		$i[8]['link_num'] = $max;
		$i[8]['text'] = $max;
		
		
		
		// i9.next :
		$i[9]['disabled'] = 0;
		$i[9]['link_num'] = $active + 1;
		if ($active == $max) {
			$i[9]['disabled'] = 1;
			$i[9]['link_num'] = '';
		}
		
		
		$this->i = $i;
	}
	
	private function mainJob($max, $active, $link, $link_replace) {
		
		$html = $this->html;
		$i = $this->i;
		
		
		
		// i1.prev :
		if ($i[1]['disabled'] == 1) {
			$html = str_ireplace('[i1_href]', '', $html);
			$html = str_ireplace('[i1_disable]', 'disabled', $html);
		} else { // enable :
			$html = str_ireplace('[i1_href]', str_ireplace($link_replace, $i[1]['link_num'], $link), $html);
			$html = str_ireplace('[i1_disable]', '', $html);
		} //ok
		
		
		// i2.min :
		$html = str_ireplace('[i2_href]', str_ireplace($link_replace, $i[2]['link_num'], $link), $html);
		$html = str_ireplace('[i2_text]', $i[2]['link_num'], $html);
		if ($active == $i[2]['link_num']) {
			$html = str_ireplace('[i2_active]', 'active', $html);
		}
		else {
			$html = str_ireplace('[i2_active]', '', $html);
		} //ok
		
		
		
		// i3 : // dots, 2, hidden
		if ($max >= 2) {
			$html = str_ireplace('[i3_hide]', '', $html);
			
			if ($i[3]['status'] == 'normal') {
				$html = str_ireplace('[i3_href]', str_ireplace($link_replace, $i[3]['link_num'], $link), $html);
				$html = str_ireplace('[i3_dots]', '', $html);
				$html = str_ireplace('[i3_text]', $i[3]['link_num'], $html);
				
				if ($active == $i[3]['link_num']) {
					$html = str_ireplace('[i3_active]', 'active', $html);
				}
				else {
					$html = str_ireplace('[i3_active]', '', $html);
				}
			}
			elseif ($i[3]['status'] == 'dots') {
				$html = str_ireplace('[i3_dots]', 'dots', $html);
				$html = str_ireplace('[i3_href]', '', $html);
				$html = str_ireplace('[i3_text]', '...', $html);
			}
		}
		else {
			$html = str_ireplace('[i3_hide]', 'hide', $html);
			$html = str_ireplace('[i3_active]', '', $html);
			$html = str_ireplace('[i3_dots]', '', $html);
			$html = str_ireplace('[i3_href]', '', $html);
			$html = str_ireplace('[i3_text]', '', $html);
		} //ok
		
		
		
		// i4 :
		if ($max >= 3) {
			$html = str_ireplace('[i4_hide]', '', $html);
			$html = str_ireplace('[i4_href]', str_ireplace($link_replace, $i[4]['link_num'], $link), $html);
			$html = str_ireplace('[i4_text]', $i[4]['link_num'], $html);
			
			if ($active == $i[4]['link_num']) {
				$html = str_ireplace('[i4_active]', 'active', $html);
			}
			else {
				$html = str_ireplace('[i4_active]', '', $html);
			}
		} else {
			$html = str_ireplace('[i4_hide]', 'hide', $html);
			$html = str_ireplace('[i4_active]', '', $html);
			$html = str_ireplace('[i4_text]', '', $html);
			$html = str_ireplace('[i4_href]', '', $html);
		} //ok
		
		
		
		// i5 :
		if ($max >= 4) {
			$html = str_ireplace('[i5_hide]', '', $html);
			$html = str_ireplace('[i5_href]', str_ireplace($link_replace, $i[5]['link_num'], $link), $html);
			$html = str_ireplace('[i5_text]', $i[5]['link_num'], $html);
			
			if ($active == $i[5]['link_num']) {
				$html = str_ireplace('[i5_active]', 'active', $html);
			}
			else {
				$html = str_ireplace('[i5_active]', '', $html);
			}
		} else {
			$html = str_ireplace('[i5_hide]', 'hide', $html);
			$html = str_ireplace('[i5_active]', '', $html);
			$html = str_ireplace('[i5_text]', '', $html);
			$html = str_ireplace('[i5_href]', '', $html);
		} //ok
		
		
		
		// i6 :
		if ($max >= 5) {
			$html = str_ireplace('[i6_hide]', '', $html);
			$html = str_ireplace('[i6_href]', str_ireplace($link_replace, $i[6]['link_num'], $link), $html);
			$html = str_ireplace('[i6_text]', $i[6]['link_num'], $html);
			
			if ($active == $i[6]['link_num']) {
				$html = str_ireplace('[i6_active]', 'active', $html);
			}
			else {
				$html = str_ireplace('[i6_active]', '', $html);
			}
		}
		else {
			$html = str_ireplace('[i6_hide]', 'hide', $html);
			$html = str_ireplace('[i6_active]', '', $html);
			$html = str_ireplace('[i6_text]', '', $html);
			$html = str_ireplace('[i6_href]', '', $html);
		} //ok
		
		
		
		// i7 : // dots, active+1, hidden
		if ($max >= 6) {
			$html = str_ireplace('[i7_hide]', '', $html);
			
			if ($i[7]['status'] == 'normal') {
				$html = str_ireplace('[i7_dots]', '', $html);
				$html = str_ireplace('[i7_href]', str_ireplace($link_replace, $i[7]['link_num'], $link), $html);
				$html = str_ireplace('[i7_text]', $i[7]['link_num'], $html);
				
				if ($active == $i[7]['link_num']) {
					$html = str_ireplace('[i7_active]', 'active', $html);
				}
				else {
					$html = str_ireplace('[i7_active]', '', $html);
				}
			}
			elseif ($i[7]['status'] == 'dots') {
				$html = str_ireplace('[i7_dots]', 'dots', $html);
				$html = str_ireplace('[i7_active]', '', $html);
				$html = str_ireplace('[i7_href]', '', $html);
				$html = str_ireplace('[i7_text]', '...', $html);
			}
		}
		else {
			$html = str_ireplace('[i7_hide]', 'hide', $html);
			$html = str_ireplace('[i7_dots]', '', $html);
			$html = str_ireplace('[i7_active]', '', $html);
			$html = str_ireplace('[i7_href]', '', $html);
			$html = str_ireplace('[i7_text]', '', $html);
		} //ok
		
		
		
		// i8.max :
		if ($max >= 7) {
			$html = str_ireplace('[i8_hide]', '', $html);
			$html = str_ireplace('[i8_href]', str_ireplace($link_replace, $i[8]['link_num'], $link), $html);
			$html = str_ireplace('[i8_text]', $i[8]['link_num'], $html);
			
			if ($active == $i[8]['link_num']) {
				$html = str_ireplace('[i8_active]', 'active', $html);
			}
			else {
				$html = str_ireplace('[i8_active]', '', $html);
			}
		} else {
			$html = str_ireplace('[i8_hide]', 'hide', $html);
			$html = str_ireplace('[i8_active]', '', $html);
			$html = str_ireplace('[i8_href]', '', $html);
			$html = str_ireplace('[i8_text]', '', $html);
		} //ok
		
		
		
		// i9.next :
		if ($i[9]['disabled'] == 1) {
			$html = str_ireplace('[i9_href]', '', $html);
			$html = str_ireplace('[i9_disable]', 'disabled', $html);
		}
		else { // enable :
			$html = str_ireplace('[i9_href]', str_ireplace($link_replace, $i[9]['link_num'], $link), $html);
			$html = str_ireplace('[i9_disable]', '', $html);
		}
		
		
		
		$this->html = $html;
	}
}
