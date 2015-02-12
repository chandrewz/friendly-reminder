<?php

class Database {
	private $host = '';
	private $port = '';
	private $user = '';
	private $password = '';
	private $dbname = '';
	private $db;

	/**
	 * Constructor
	 */
	public function Database() {
		// CREATE TABLE reminder(reminder_id serial, reminder_type text, reminder_to text, reminder_message text, reminder_time timestamp, reminder_sent boolean);
		// CREATE TABLE friends(friend_id serial, username text, friend_username text);
		// CREATE TABLE users(user_id serial, username tetxt, password text, email text, phone text);
	}

	/**
	 * Simple db connect method
	 */
	public function connect() {
		$this->db = pg_connect($this->pgConnectionString());
		if (!$this->db) return false;
		return true;
	}

	/**
	 * Postgres db connection string
	 */
	public function pgConnectionString() {
		return sprintf('dbname=%s host=%s port=%s user=%s password=%s sslmode=require', $this->dbname, $this->host, $this->port, $this->user, $this->password);
	}

	/**
	 * Adds a reminder into the reminder table
	 */
	public function addReminder($type, $to, $message, $timestamp) {
		$query = "INSERT INTO reminder(reminder_type, reminder_to, reminder_message, reminder_time, reminder_sent) VALUES ('$type', '$to', '$message', '$timestamp', false);";
		return pg_query($this->db, $query);
	}

	/**
	 * Selects and returns reminders that are ready to be sent.
	 * Reminders are ready when <= current time and reminder_sent is false.
	 */
	public function getReadyReminders() {
		date_default_timezone_set('America/Chicago'); // using CST, because I'm in Austin!
		$date = date('Y-m-d H:i:s');
		$query = "SELECT * FROM reminder WHERE reminder_time <= '$date' AND reminder_sent = false;";
		return pg_query($this->db, $query);
	}

	/**
	 * Marks reminders that have been sent.
	 */
	public function updateSentReminders($reminders) {
		$query = "";
		foreach ($reminders as $remind) {
			$query .= "UPDATE reminder SET reminder_sent = true WHERE reminder_id = " . $remind['reminder_id'] . ";";
		}
		return pg_query($this->db, $query);
	}

	/**
	 * Creates a friend for a user.
	 */
	public function addFriend($user, $friend) {
		$query = "INSERT INTO friends(username, friend_username) VALUES ('$user', '$friend');";
		return pg_query($this->db, $query);
	}

	/**
	 * Given a username, returns all of the user's friends.
	 */
	public function getFriends($user) {
		$query = "SELECT * FROM friends WHERE username = '$user';";
		return pg_query($this->db, $query);
	}

	/**
	 * Creates a new user with the paramters.
	 */
	public function createUser($username, $password, $email, $phone) {
		$query = "INSERT INTO users(username, password, email, phone) VALUES ('$username', '$password', '$email', '$phone');";
		return pg_query($this->db, $query);
	}

	/**
	 * Given a username, returns the user from the users table.
	 */
	public function getUser($user) {
		$query = "SELECT * FROM users WHERE username = '$user';";
		return pg_query($this->db, $query);
	}

	/**
	 * A safe version of getUser that excludes the password.
	 */
	public function getUserInfo($username) {
		$query = "SELECT user_id, username, email, phone FROM users WHERE username = '$username';";
		return pg_query($this->db, $query);
	}

	public function login($username, $password) {
		session_start();
		$_SESSION['user'] = $username;
	}

	public function select($table) {
		$query = "SELECT * FROM $table;";
		return pg_query($this->db, $query);
	}
}