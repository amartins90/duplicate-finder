<?php
/**
 * This script moves to another folder the duplicate files.
 *
 * @author Alexandre J. Martins <alexandre@ajmartins.com.br> github.com/amartins90
 *
 */

$dir_to_scan = __DIR__;
$duplicate_folder = __DIR__.'/DuplicateFile/';
$hash_files = array();
$duplicate = 0;

$scan_dir = scandir($dir_to_scan);

foreach ($scan_dir as $file) {

	$file_path = $dir_to_scan.'/'.$file;

	if (is_file($file_path) && $file_path <> __FILE__) {
		
		$md5_hash = md5_file($file_path);

		if (in_array($md5_hash, $hash_files)) {

			if (!is_dir($duplicate_folder)) {
				mkdir($duplicate_folder, 0700);
			}

			rename($file_path, $duplicate_folder.$file);
			$duplicate++;

		} else {

			$hash_files[$file] = $md5_hash;

		}
	}
}

if ($duplicate > 0) {

	echo $duplicate." duplicate file(s) moved to '".$duplicate_folder."'".PHP_EOL;

} else {

	echo "Duplicate files not found".PHP_EOL;

}
