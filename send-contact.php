<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: contact.php?toast_type=error&toast_msg=" . urlencode("Please fill all required fields."));
        exit;
    }
    
    if ($pdo) {
        $pdo->exec("CREATE TABLE IF NOT EXISTS contacts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100),
            email VARCHAR(100),
            phone VARCHAR(20),
            message TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $message]);
    }
    
    $to = ADMIN_EMAIL;
    $subject = "Contact from Padua Bundal - $name";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email";
    mail($to, $subject, $body, $headers);
    
    header("Location: contact.php?toast_type=success&toast_msg=" . urlencode("Message sent successfully! We'll reply soon."));
    exit;
} else {
    header('Location: contact.php');
    exit;
}
?>