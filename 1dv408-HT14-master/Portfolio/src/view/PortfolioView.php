<?php

class PortfolioView {
	private $getLocation = "portfolio";

	public function visitorHasChosenPortfolio() {
		if (isset($_GET[$this->getLocation])) 
			return true;

		return false;
	}

	public function showPortfolioOwners(\model\ParticipantBook $portfolioOwners) {
		$ret = "<h1>PortfolioView</h1>";

		foreach ($portfolioOwners->getParticipants() as $participant) {
			$ret .= "<a href='?$this->getLocation=" . 
					$participant->getUnique() ."'>" . 
					$participant->getName(). "</a>";

		};

		return $ret;
	}

	public function getChosenOwner() {
		throw new \Exception("NOT implemented yet!");
	}
}