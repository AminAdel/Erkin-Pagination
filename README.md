# Erkin-Pagination version 1.1.0
a back-end and front-end pagination system with PHP and JavaScript

at php serverside simply use this code :
```
<?php
$pages_count = 15; // all pages count
$active_page = 5; // the active page number
$lint_pattern = "http://yourwebsite.com/articles?page=[%page%]"; // this is sample pattern for links; you can use local urls too;
$link_replace = "[%page%]"; this is part of above pattern that will be replaced with page number;

new pagination(
	$pages_count,
	$active_page,
	$lint_pattern,
	$link_replace,
	1 // echo? ... or 0 to get the html results
);
```
