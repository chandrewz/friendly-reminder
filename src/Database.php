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
		$this->db = pg_connect($this->pg_connection_string());
		if (!$this->db) return false;
		return true;
	}

	/**
	 * postgresql db connection string
	 * init: CREATE TABLE reminder(reminder_id serial, reminder_type text, reminder_to text, reminder_message text, reminder_time timestamp, reminder_sent boolean);
	 */
	public function pgConnectionString() {
		//return 'dbname=db1rn4rj1g5jdl host=ec2-54-197-241-94.compute-1.amazonaws.com port=5432 user=mbykljryroouwe password=2QKn-hc70AaFuxzAvwj-Mh3f22 sslmode=require';
		return "dbname=$this->dbname host=$this->host post=$this->post user=$this->user password=$this->password sslmode=require";
	}

	public function addReminder($type, $to, $message, $timestamp) {
		$query = "INSERT INTO reminder(reminder_type, reminder_to, reminder_message, reminder_time, reminder_sent) VALUES ('$type', '$to', '$message', '$timestamp', false);";
		return pg_query($this->db, $query);
	}
}