<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<link href="../css/not_found.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div id="main">
		<!-- header -->
		<div id="header">
			<?php if(isset($quest)){ ?>
				<h3>Please <a href="<?=$uri?>">login</a></h3>
				 <h3 style="padding-top: 30px;">to view this page</h3>
			<? } else { ?>
				<h3>Nothing alive here!</h3>
				<h3 style="padding-top: 30px;"><strong>404</strong> error - not found</h3>
			<? } ?>
		</div>
		<!-- content -->
		<div id="content">
			<ul class="nav">
         		<li class="home"><a href="/">Home Page</a></li>
         	</ul>
		</div>
		<!-- footer -->
		<div id="footer">
      	Designed by TemplateMonster - all <a href="http://www.templatemonster.com" target="_blank">website templates</a> found and safe!
      </div>
	</div>
</body>
</html>