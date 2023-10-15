<?php
// Include MongoDB PHP library
require 'vendor/autoload.php';


// Set up MongoDB connection
$client = new MongoDB\Client('mongodb://kenUser:KenPassword@ac-kvsfcpt-shard-00-00.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-01.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-02.qrj9egp.mongodb.net:27017/Sample?ssl=true&replicaSet=atlas-4pn5vh-shard-0&authSource=admin&retryWrites=true&w=majority');
$database = $client->selectDatabase('Sample');
$collection = $database->selectCollection('Connect');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
	$email = $_POST["email"];
	$password = $_POST["password"];

    // Check if username already exists
    $existingUser = $collection->findOne(['firstname' => $firstname]);
    if ($existingUser) {
        echo "Username already exists.";
    } else {
        // Insert new user into MongoDB
        $newUser = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
			'password' => $password
        ];
        $collection->insertOne($newUser);
        echo "Registration successful!";
    }
}



?>
