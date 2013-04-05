<?php
/**
 * Copyright 2013 Wesley de Souza
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *    http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once "../src/phpuploadsaner.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<title>phpUploadSaner: Multiple Levels Example</title>
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
<style type="text/css">
pre{font-size:10px;}
</style>
	</head>
	<body>
		
		<div class="container">
			<div class="page-header">
				<h1>phpUploadSaner: Multiple Levels Example</h1>
			</div>
			<div class="row">
				<div class="span12">
					<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="control-group">
							<label class="control-label">foo[bar][1]</label>
							<div class="controls"><input type="file" name="foo[bar][1]"></div>
						</div>
						<div class="control-group">
							<label class="control-label">foo[bar][2][]</label>
							<div class="controls"><input type="file" name="foo[bar][2][]"></div>
						</div>
						<div class="control-group">
							<label class="control-label">foo[bar][2][]</label>
							<div class="controls"><input type="file" name="foo[bar][2][]"></div>
						</div>
						<div class="control-group">
							<label class="control-label">foo[bar][3][4][5]</label>
							<div class="controls"><input type="file" name="foo[bar][3][4][5]"></div>
						</div>
						<div class="control-group">
							<div class="controls"><button type="submit" class="btn btn-primary"><i class="icon-upload icon-white"></i> Upload</button></div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="span6"><small><pre><?php print_r( $_FILES ); ?></pre></small></div>
				<div class="span6"><pre><?php print_r( phpUploadSaner::parse( $_FILES ) ); ?></pre></div>
			</div>
		</div>
		
	</body>
</html>
