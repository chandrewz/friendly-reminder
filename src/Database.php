<?php

class Database {
	private $host = 'ec2-54-197-241-94.compute-1.amazonaws.com';
	private $port = '5432';
	private $user = 'mbykljryroouwe';
	private $password = '2QKn-hc70AaFuxzAvwj-Mh3f22';
	private $dbname = 'db1rn4rj1g5jdl';
	private $db;

	public function Database() {
		
	}

	public function connect() {
		$this->db = pg_connect($this->pgConnectionString());
		if (!$this->db) return false;
		return true;
	}

	/**
	 * postgres db connection string
	 * return 'dbname=db1rn4rj1g5jdl host=ec2-54-197-241-94.compute-1.amazonaws.com port=5432 user=mbykljryroouwe password=2QKn-hc70AaFuxzAvwj-Mh3f22 sslmode=require';
	 * return "dbname=$this->dbname host=$this->host port=$this->port user=$this->user password=$this->password sslmode=require";
	 */
	public function pgConnectionString() {
		return sprintf('dbname=%s host=%s port=%s user=%s password=%s sslmode=require', $this->dbname, $this->host, $this->port, $this->user, $this->password);
	}

	/**
	 * Adds a reminder into the reminder table
	 * init: CREATE TABLE reminder(reminder_id serial, reminder_type text, reminder_to text, reminder_message text, reminder_time timestamp, reminder_sent boolean);
	 */
	public function addReminder($type, $to, $message, $timestamp) {
		$query = sprintf('INSERT INTO reminder(reminder_type, reminder_to, reminder_message, reminder_time, reminder_sent) VALUES ("%s", "%s", "%s", "%s", false);',
			$type, $to, $message, $timestamp);
		//$query = "INSERT INTO reminder(reminder_type, reminder_to, reminder_message, reminder_time, reminder_sent) VALUES ('$type', '$to', '$message', '$timestamp', false);";
		return pg_query($this->db, $query);
	}

	/**
	 * Selects and returns reminders that are ready to be sent.
	 * Reminders are ready when <= current time and reminder_sent is false.
	 */
	public function getReadyReminders() {
		date_default_timezone_set('America/Chicago'); // using CST, because I'm in Austin!
		$date = date('Y-m-d H:i:s');
		$query = "SELECT * FROM reminder WHERE reminder_time <= $date AND reminder_sent = false;";
		return pg_query($this->db, $query);
	}

}