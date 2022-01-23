# Erkin-Pagination version 1.3.0
a backend and frontend pagination system with PHP and JavaScript

# Preview :
![SnapShot](https://raw.githubusercontent.com/AminAdel/Erkin-Pagination/master/snapshots/SnapShot_01.PNG)

you will need to insert css file in head section of your html codes :
use correct path for href
```css
<link rel="stylesheet" type="text/css" href="Erkin-Pagination.min.css" />
```
also add javascript file to your html. you can place it in head section or anywhere else.
use correct path for src
(you need to have jquery file added already.)
```javascript
<script type="text/javascript" src="Erkin-Pagination.js"></script>
```

at php serverside simply use this code :
```php
<?php
include "Erkin-Pagination.php";
$pages_count = 15; // all pages count
$active_page = 5; // the active page number
$lint_pattern = "http://yourwebsite.com/articles?page=[%page%]"; // this is sample pattern for links; you can use local urls too;
$link_replace = "[%page%]"; //this is part of above pattern that will be replaced with page number;

new pagination(
	$pages_count,
	$active_page,
	$lint_pattern,
	$link_replace,
	1 // echo? ... or 0 to get the html results
);
```

the main thing to do in js codes is to finaly run these lines of codes :
```javascript
pagination.init(
	15,							// example; all pages count
	5,							// example; active page number
	"http://yourwebsite.com/articles?page=[%page%]",	// example; link pattern
	"[%page%]"						// example; link replace part
);
```

the javascript file is for ajax usage purpose. to use that you need to handle the click event.
these lines is only a working pagination example. you need to do more things like ajax request and stuff like that in between;
```javascript
$('#pagination .li').click(function(e) {
	if ($(this).hasClass('dots')) return false;
			
	// only left click will be accepted;
	if (e.which != 1) return;
	
	
	// get pages-count :
	var pagesCount = $($('#pagination .li')[$('#pagination .li').length - 2]).find('a').html()
	
	
	// get clicked page number :
	var page = parseInt($(this).find('a').html());
	if ($(this).hasClass('next')) {
		page = parseInt($('#pagination .li' + '.active a').html()) + 1;
	}
	else if ($(this).hasClass('prev')) {
		page = parseInt($('#pagination .li' + '.active a').html()) - 1;
	}
	
	
	// set linkPattern :
	var linkPattern = "http://yourwebsite.com/articles?page=[%page%]";
	var linkReplace = "[%page%]";
	
	
	// pagination update :
	pagination.init(
		pagesCount,
		page,
		linkPattern,
		linkReplace
	);
	
	return false;
});
```
