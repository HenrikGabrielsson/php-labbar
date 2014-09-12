<?php

class HTMLView {

		public function echoHTML($body) {
			echo "
				<!DOCTYPE html>
				<html>
				<body>
					$body
				</body>
				</html>";
		}
}