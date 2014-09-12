<?php

namespace model;

require_once("Participant.php");

class ParticipantBook {

	public function getParticipants() {
		$portfolioOwners = array(new \model\Participant("Examiner","Daniel"), 
								 new \model\Participant("Assistant","Emil"));

		return $portfolioOwners; 
	}
}