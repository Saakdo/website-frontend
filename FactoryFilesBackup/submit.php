<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $firstName = isset($_POST['name1']) ? htmlspecialchars(trim($_POST['name1'])) : '';
    $lastName = isset($_POST['name2']) ? htmlspecialchars(trim($_POST['name2'])) : '';
    $streetAddress = isset($_POST['address1']) ? htmlspecialchars(trim($_POST['address1'])) : '';
    $secondAddress = isset($_POST['address2']) ? htmlspecialchars(trim($_POST['address2'])) : '';
    $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : '';
    $province = isset($_POST['province']) ? htmlspecialchars(trim($_POST['province'])) : '';
    $country = isset($_POST['country']) ? htmlspecialchars(trim($_POST['country'])) : '';
    $zip = isset($_POST['zip']) ? htmlspecialchars(trim($_POST['zip'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $feedback = isset($_POST['feedback']) ? htmlspecialchars(trim($_POST['feedback'])) : '';

    // Check if all required fields are filled
    if ($firstName && $lastName && $streetAddress && $secondAddress && $city && $province && $country && $zip && $email && $phone && $feedback) {

        // Format the data to be saved
        $formData = "Name: $firstName $lastName\n";
        $formData .= "Address: $streetAddress, $secondAddress, $city, $province, $country, $zip\n";
        $formData .= "Email: $email\nPhone: $phone\nFeedback: $feedback\n";
        $formData .= "------------------------------\n";

        // Define the path for the submission.txt file (relative to this script)
        $filePath = __DIR__ . '/submission/submission.txt';

        // Ensure the 'submission' directory exists
        if (!is_dir(__DIR__ . '/submission')) {
            mkdir(__DIR__ . '/submission', 0755, true); // Create directory with proper permissions
        }

        // Save the data to the file
        $fileSaved = file_put_contents($filePath, $formData, FILE_APPEND);

        // Check if file saving was successful
        if ($fileSaved !== false) {
            // Redirect to a thank-you page
            header("Location: thankyou.html");
            exit;
        } else {
            // Error saving to file
            echo "There was an error saving your request. Please try again later.";
        }
    } else {
        // Required fields are missing
        echo "Please fill out all the required fields.";
    }
} else {
    // Not a POST request
    echo "Invalid request.";
}
?>
