<?php
//
// jQuery File Tree PHP Connector
//
// Version 1.01
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 24 March 2008
//
// History:
//
// 1.01 - updated to work with foreign characters in directory/file names (12 April 2008)
// 1.00 - released (24 March 2008)
//
// Output a list of files for jQuery File Tree
//
// Modified by Chris Lenk

$_POST['dir'] = urldecode($_POST['dir']);
$_POST['foldersOnly'] = urldecode($_POST['foldersOnly']);
$root = $_SERVER['DOCUMENT_ROOT'];

if( file_exists($root . $_POST['dir']) ) {
	$files = scandir($root . $_POST['dir']);
	natcasesort($files);
	if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach ( $files as $file ) {
			if ( $file != '.' && $file != '..' && file_exists($root . $_POST['dir'] . $file) ) {
				if (is_dir($root . $_POST['dir'] . $file)) { //dirs
					echo "<li class=\"directory collapsed\"><a href=\"#\" file=\"" . $file ."\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
				}
				else if (!is_dir($root . $_POST['dir'] . $file) && $_POST['foldersOnly'] == 'false') { //files; don't use for kinect data
					$ext = preg_replace('/^.*\./', '', $file);
					echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
				}
			}
		}
		echo "</ul>";	
	}
	else {
		echo 'Not enough files';
	}
}
else {
	echo 'Path not found: ' . $root . $_POST['dir'];
}

?>