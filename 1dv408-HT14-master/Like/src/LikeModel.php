 <?php

class LikeModel {
	
	
	public function __construct() {
	
	}

	public function getNumLikes() {
		$lines = @file("LikeModel.txt");
		if ($lines === FALSE) {
			return 0;
		}
		return count($lines);
	}

	public function hasLiked($clientIdentifier) {

		$lines = @file("LikeModel.txt");

		if ($lines === FALSE) {
			return false;
		}

		foreach ($lines as $existingidentifier) {
			$existingidentifier = trim($existingidentifier);
			if ($existingidentifier === $clientIdentifier) {
				return true;
			} 
		}
		return false;
	}

	public function addLike($clientIdentifier) {
		if ($this->hasLiked($clientIdentifier)) {
			return;
		}

		
		$fp = fopen("LikeModel.txt", 'a');
		fwrite($fp, $clientIdentifier . "\n");
	}
}