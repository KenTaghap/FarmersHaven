<?php
require '../vendor/autoload.php';

use MongoDB\Client;
// Replace with your MongoDB Atlas connection string
$connectionString = "mongodb://kenUser:KenPassword@ac-kvsfcpt-shard-00-00.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-01.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-02.qrj9egp.mongodb.net:27017/Agriculture?ssl=true&replicaSet=atlas-4pn5vh-shard-0&authSource=admin&retryWrites=true&w=majority";


try {
    $client = new Client($connectionString);
    $collection = $client->Agriculture->Vendors_Validate; // Replace with your database and collection names

    $Username = $_POST['name'];
    $newAddress = $_POST['new_address'];
    $newAge = $_POST['new_age'];

    // Update user information in the database
    $filter = ['Fullname' => $Username];
    $updateData = ['$set' => ['Address' => $newAddress, 'Password' => $newAge]];
    $result = $collection->updateOne($filter, $updateData);

    if ($result->getModifiedCount() > 0) {
        echo "User information updated successfully!";
    } else {
        echo "User not found or no changes made.";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
