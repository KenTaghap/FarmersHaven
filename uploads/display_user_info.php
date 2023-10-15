<?php
require '../vendor/autoload.php';

use MongoDB\Client;

// Replace with your MongoDB Atlas connection string
$connectionString = "mongodb://kenUser:KenPassword@ac-kvsfcpt-shard-00-00.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-01.qrj9egp.mongodb.net:27017,ac-kvsfcpt-shard-00-02.qrj9egp.mongodb.net:27017/Agriculture?ssl=true&replicaSet=atlas-4pn5vh-shard-0&authSource=admin&retryWrites=true&w=majority";

try {
    $client = new Client($connectionString);
    $collection = $client->Agriculture->Vendors_Validate; // Replace with your database and collection names

    // Retrieve user information by name
    $Username = $_POST['Username'];

    $filter = ['Username' => $Username];
    $userInfo = $collection->findOne($filter);

    if ($userInfo) {
        $userName = $userInfo['Fullname'];
        $userAddress = $userInfo['Address'];
        $userAge = $userInfo['Password'];
        $userImage = $userInfo['File']; // Assuming 'image' is the field where the binary image data is stored
        // Add other fields as needed
    } else {
        $userName = "User not found";
        $userAddress = "";
        $userAge = "";
        $userImage = null;
        // Add other default values as needed
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    $userName = "An error occurred";
    $userAddress = "";
    $userAge = "";
    $userImage = null;
    // Add other error handling as needed
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
</head>
<body>
    <h1>User Information</h1>
    <p><strong>Name:</strong> <?= $userName ?></p>
    <p><strong>Address:</strong> <?= $userAddress ?></p>
    <p><strong>Pass:</strong> <?= $userAge ?></p>
    
    <?php if ($userImage): ?>
        <p><strong>Image:</strong></p>
        <img src="data:image/png;base64,<?= base64_encode($userImage) ?>" alt="User Image">
    <?php endif; ?>
    
    <form action="update_user_info.php" method="POST">
        <input type="hidden" name="name" value="<?= $userName ?>">
        <label for="new_address">New Address:</label>
        <input type="text" id="new_address" name="new_address">
        <br>

        <label for="new_age">New pass:</label>
        <input type="text" id="new_age" name="new_age">
        <br>

        <button type="submit">Update Info</button>
    </form>
</body>
</html>
