/*****************************/
// version 1.3.0    :   2018.08.16  :   1397.05.25
// version 1.1.0    :   2017.07.11  :   1396.04.20
/*****************************/
$(document).ready(function () {
	pagination = new class_pagination();
	
	$('#pagination .li.dots a, #pagination .li.disabled a').click(function(e) {
		return false;
	});
});


function class_pagination () {
	
	/**
	 * max : pages counts
	 * active : page-number to display
	 * link : the href string for anchors -> example : http://siteName.com/news/[$newsId$]/
	 * link_replace : string part inside link to be replaced with page-number -> example : [$newsId$]
	 ******************************/
	
	var self = this;
	
	/*****************************/
	
	this.init = function(max, active, link, link_replace) {
		
		max = parseInt(max);
		active = parseInt(active);
		
		// set values :
		self.max = max;
		self.active = active;
		self.link = link;
		self.link_replace = link_replace;
		
		self.check_a(max, active);
		self.mainJob(max, active, link, link_replace);
	}
	
	/*****************************/
	
	this.path_root = '#pagination';
	this.path_ul = '#pagination > .ul';
	this.path_li = '#pagination > .ul > .li';
	
	this.max = '';
	this.active = '';
	this.link = '';
	this.link_replace = '';
	
	this.i1 = ''; // .disable
	this.i2 = ''; // 1
	this.i3 = ''; // .dots , 2
	this.i4 = ''; //
	this.i5 = ''; //
	this.i6 = ''; //
	this.i7 = ''; // .dots , max-1
	this.i8 = ''; // max
	this.i9 = ''; // .disable
	
	/*****************************/
	
	this.check_a = function(max, active) {
		
		var i1 = {};
		var i2 = {};
		var i3 = {};
		var i4 = {};
		var i5 = {};
		var i6 = {};
		var i7 = {};
		var i8 = {};
		var i9 = {};
		
		// i1.prev :
		i1.disabled = 0;
		i1.link_num = active - 1;
		if (active == 1) {
			i1.disabled = 1;
			i1.link_num = '';
		}
		
		
		
		// i2.min :
		i2.link_num = 1;
		i2.text = 1;
		
		
		
		// i3.dots : // dots or 2 or hidden
		i3.link_num = '';
		i3.text = '';
		i3.status = '';
		if (max >= 2) {
			i3.link_num = 2;
			i3.text = 2;
			i3.status = 'normal';
			
			if (max > 7  &&  active >= 5) {
				i3.link_num = '';
				i3.text = '...';
				i3.status = 'dots';
			}
		} // ok
		
		
		
		// i4 :
		i4.link_num = '';
		i4.text = '';
		if (max >= 3) {
			i4.link_num = 3;
			i4.text = 3;
			
			if (max > 7) {
				if (active >= 5  &&  (max - active) > 4) {
					i4.link_num = active - 1;
					i4.text = active - 1;
				}
				else if (active >= 5) {
					i4.link_num = max - 4;
					i4.text = max - 4;
				}
			}
		}
		
		
		
		// i5 middle :
		i5.link_num = '';
		i5.text = '';
		if (max >= 4) {
			i5.link_num = 4;
			i5.text = 4;
			
			if (max > 7) {
				if (active >= 5  &&  (max - active) > 4) {
					i5.link_num = active;
					i5.text = active;
				}
				else if (active >= 5) {
					i5.link_num = max - 3;
					i5.text = max - 3;
				}
			}
		}
		
		
		
		// i6 :
		i6.link_num = '';
		i6.text = '';
		if (max >= 5) {
			i6.link_num = 5;
			i6.text = 5;
			
			if (max > 7) {
				if (active >= 5  &&  (max - active) > 4) {
					i6.link_num = active + 1;
					i6.text = active + 1;
				}
				else if (active >= 5) {
					i6.link_num = max - 2;
					i6.text = max - 2;
				}
			}
		}
		
		
		
		// i7.dots : // dots or max-1 or hidden
		i7.link_num = '';
		i7.text = '';
		i7.status = '';
		if (max >= 6) {
			i7.link_num = 6;
			i7.text = 6;
			i7.status = 'normal';
			
			if (max > 7) {
				if (i6.link_num + 2 == max) {
					i7.link_num = max - 1;
					i7.text = max - 1;
					i7.status = 'normal';
				}
				else {
					i7.link_num = '';
					i7.text = '...';
					i7.status = 'dots';
				}
			}
		}
		
		
		
		// i8.max :
		i8.link_num = max;
		i8.text = max;
		
		
		
		// i9.next :
		i9.disabled = 0;
		i9.link_num = active + 1;
		if (active == max) {
			i9.disabled = 1;
			i9.link_num = '';
		}
		
		
		
		self.i1 = i1;
		self.i2 = i2;
		self.i3 = i3;
		self.i4 = i4;
		self.i5 = i5;
		self.i6 = i6;
		self.i7 = i7;
		self.i8 = i8;
		self.i9 = i9;
		
	}
	
	this.reset = function() {
		// hide, reset, mainJob, show,
	}
	
	this.mainJob = function(max, active, link, link_replace) {
		
		// remove active class :
		$('#pagination > .ul > .li').removeClass('active');
		
		
		// i1.prev :
		if (self.i1.disabled == 1) {
			$('#pagination > .ul > .li.i1 a').removeAttr('href');
			$('#pagination > .ul > .li.i1').addClass('disabled');
		} else { // enable :
			self.i1.link = link;
			self.i1.link = self.i1.link.replace(link_replace, self.i1.link_num);
			$('#pagination > .ul > .li.i1 a').attr('href', self.i1.link);
			$('#pagination > .ul > .li.i1').removeClass('disabled');
		}
		
		
		
		// i2.min :
		$('#pagination > .ul > .li.i2 a').html(self.i2.link_num).attr('href', link.replace(link_replace, self.i2.link_num));
		if (active == self.i2.link_num) { $('#pagination > .ul > .li.i2').addClass('active'); }
		
		
		
		// i3 : // dots, 2, hidden
		if (max >= 2) {
			$('#pagination > .ul > .li.i3').removeClass('hide');
			if (self.i3.status == 'normal') {
				$('#pagination > .ul > .li.i3 a').html(self.i3.link_num).attr('href', link.replace(link_replace, self.i3.link_num));
				$('#pagination > .ul > .li.i3').removeClass('dots');
				if (active == self.i3.link_num) { $('#pagination > .ul > .li.i3').addClass('active'); }
			} else
			if (self.i3.status == 'dots') {
				$('#pagination > .ul > .li.i3').addClass('dots');
				$('#pagination > .ul > .li.i3 a').html(self.i3.text).removeAttr('href');
			}
		} else {
			$('#pagination > .ul > .li.i3').addClass('hide');
		}
		
		
		
		// i4 :
		if (max >= 3) {
			$('#pagination > .ul > .li.i4').removeClass('hide');
			$('#pagination > .ul > .li.i4 a').html(self.i4.link_num).attr('href', link.replace(link_replace, self.i4.link_num));
			if (active == self.i4.link_num) { $('#pagination > .ul > .li.i4').addClass('active'); }
		} else {
			$('#pagination > .ul > .li.i4').addClass('hide');
		}
		
		
		
		// i5 :
		if (max >= 4) {
			$('#pagination > .ul > .li.i5').removeClass('hide');
			$('#pagination > .ul > .li.i5 a').html(self.i5.link_num).attr('href', link.replace(link_replace, self.i5.link_num));
			if (active == self.i5.link_num) { $('#pagination > .ul > .li.i5').addClass('active'); }
		} else {
			$('#pagination > .ul > .li.i5').addClass('hide');
		}
		
		
		
		// i6 :
		if (max >= 5) {
			$('#pagination > .ul > .li.i6').removeClass('hide');
			$('#pagination > .ul > .li.i6 a').html(self.i6.link_num).attr('href', link.replace(link_replace, self.i6.link_num));
			if (active == self.i6.link_num) { $('#pagination > .ul > .li.i6').addClass('active'); }
		} else {
			$('#pagination > .ul > .li.i6').addClass('hide');
		}
		
		
		
		// i7 : // dots, active+1, hidden
		if (max >= 6) {
			$('#pagination > .ul > .li.i7').removeClass('hide');
			if (self.i7.status == 'normal') {
				$('#pagination > .ul > .li.i7 a').html(self.i7.link_num).attr('href', link.replace(link_replace, self.i7.link_num));
				$('#pagination > .ul > .li.i7').removeClass('dots');
				if (active == self.i7.link_num) { $('#pagination > .ul > .li.i7').addClass('active'); }
			} else
			if (self.i7.status == 'dots') {
				$('#pagination > .ul > .li.i7').addClass('dots');
				$('#pagination > .ul > .li.i7 a').html(self.i7.text).removeAttr('href');
			}
		} else {
			$('#pagination > .ul > .li.i7').addClass('hide');
		}
		
		
		
		// i8.max :
		if (max >= 7) {
			$('#pagination > .ul > .li.i8').removeClass('hide');
			$('#pagination > .ul > .li.i8 a').html(self.i8.link_num).attr('href', link.replace(link_replace, self.i8.link_num));
			if (active == self.i8.link_num) { $('#pagination > .ul > .li.i8').addClass('active'); }
		} else {
			$('#pagination > .ul > .li.i8').addClass('hide');
		}
		
		
		
		// i9.next :
		if (self.i9.disabled == 1) {
			$('#pagination > .ul > .li.i9 a').removeAttr('href');
			$('#pagination > .ul > .li.i9').addClass('disabled');
		} else { // enable :
			self.i9.link = link;
			self.i9.link = self.i9.link.replace(link_replace, self.i9.link_num);
			$('#pagination > .ul > .li.i9 a').attr('href', self.i9.link);
			$('#pagination > .ul > .li.i9').removeClass('disabled');
		}
		
	}
	
	/*****************************/
	// After All Methods :
	var __construct = function(that) {
		//that.init();
	}(self)
}
