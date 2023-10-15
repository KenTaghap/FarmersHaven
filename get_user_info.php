<?php
require 'vendor/autoload.php'; // Load the MongoDB PHP library

$mongoClient = new MongoDB\Client("mongodb://kenUser:KenPassword@ac-kvsfcpt-shard-00-00.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-01.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-02.qrj9egp.mongodb.net:27017/Agriculture?ssl=true&replicaSet=atlas-4pn5vh-shard-0&authSource=admin&retryWrites=true&w=majority");

$collection = $mongoClient->Agriculture->Farmers;

if (isset($_GET['Username'])) {
    $username = $_GET['Username'];

    // Define the filter criteria based on the username
    $filter = ['Username' => $username]; // Change 'username' to the field name in your collection

    // Query MongoDB with the filter
    $result = $collection->findOne($filter);

    if ($result) {
        // Output the data as JSON
        echo json_encode([
         // Change 'name' to your actual field names
            'Fullname' => $result['Fullname'],   // Change 'address' to your actual field names
            'Email' => $result['Email'],
			'Password' => $result['Password']			// Change 'age' to your actual field names
        ]);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'No username provided']);
}
?>
