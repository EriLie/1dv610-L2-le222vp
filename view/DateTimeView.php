<?php

class DateTimeView {


	public function show() {
		$now = new DateTime('now', new DateTimeZone('Europe/Berlin'));

		$day = $now->format('l');
		$dayDate = $now->format('jS');
		$month = $now->format('F ');
		$year = $now->format('Y');
		$hourMinSec = $now->format('H:i:s');

		$timeString = $day . ', thfbe ' . $dayDate . ' of ' . $month . $year . ', The time is ' . $hourMinSec;

		return '<p>' . $timeString . '</p>';
	}
}