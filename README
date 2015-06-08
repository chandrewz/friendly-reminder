# Friendly Reminder, written in PHP
## Schedule an automated email or text message to be sent to a friend at a certain time.


## Uses Twilio and Context.IO APIs

### Configurations

#### PostgreSQL
CREATE TABLE reminder(reminder_id serial, reminder_type text, reminder_to text, reminder_message text, reminder_time timestamp, reminder_sent boolean);
CREATE TABLE friends(friend_id serial, username text, friend_username text);
CREATE TABLE users(user_id serial, username tetxt, password text, email text, phone text);

#### Cronjob
* * * * * php ~/git/friendly-reminder/reminder-job.php