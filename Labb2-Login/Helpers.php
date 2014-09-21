<?php
    class Helpers {
		public static function WriteLineToFile($file, $line) {
			$handle = fopen($file, "a");
			if($handle) {
				fwrite($handle, $line . PHP_EOL);
			}
			fclose($handle);
		}
    }
?>