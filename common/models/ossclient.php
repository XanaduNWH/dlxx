<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use OSS\Core\OssException;

class ossClient{

	function putObject($ossClient, $bucket) {
		$object = "oss-php-sdk-test/upload-test-object-name.txt";
		$content = file_get_contents(__FILE__);
		try{
			$ossClient->putObject($bucket, $object, $content);
		} catch(OssException $e) {
			printf(__FUNCTION__ . ": FAILED\n");
			printf($e->getMessage() . "\n");
			return;
		}
		print(__FUNCTION__ . ": OK" . "\n");
	}
}