<?php

require_once('Database.php');

class Database {

	private $db;

	/**
	 * Constructor
	 */
	public function Database() {
		$this->db = new Database();
		$this->db->connect();
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
}