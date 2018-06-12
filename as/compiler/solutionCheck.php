<?php
if(sha1_file("README.md")===sha1_file("test.md"))
	echo "strings are equal";
else
	echo "strings are not equal";
?>
