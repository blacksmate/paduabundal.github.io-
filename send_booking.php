<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: booking.php');
    exit;
}

$name = htmlspecialchars(trim($_POST['name'] ?? ''));
$email = htmlspecialchars(trim($_POST['email'] ?? ''));
$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
$checkin = htmlspecialchars(trim($_POST['checkin'] ?? ''));
$checkout = htmlspecialchars(trim($_POST['checkout'] ?? ''));
$room = htmlspecialchars(trim($_POST['room'] ?? ''));
$guests = intval($_POST['guests'] ?? 1);
$requests = htmlspecialchars(trim($_POST['requests'] ?? ''));

$errors = [];
if (empty($name)) $errors[] = "Name is required";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required";
if (empty($phone)) $errors[] = "Phone number required";
if (empty($checkin) || empty($checkout)) $errors[] = "Dates required";
if ($checkin >= $checkout) $errors[] = "Check-out must be after check-in";
if (empty($room)) $errors[] = "Please select a room";

if (!empty($errors)) {
    $error_msg = implode(', ', $errors);
    header("Location: booking.php?toast_type=error&toast_msg=" . urlencode($error_msg));
    exit;
}

// Optional database save
if ($pdo) {
    $pdo->exec("CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        checkin DATE NOT NULL,
        checkout DATE NOT NULL,
        room VARCHAR(50),
        guests INT,
        requests TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $stmt = $pdo->prepare("INSERT INTO bookings (name, email, phone, checkin, checkout, room, guests, requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $checkin, $checkout, $room, $guests, $requests]);
}

// Send email
$to = ADMIN_EMAIL;
$subject = "New Booking at Padua Bundal from $name";
$message = "Name: $name\nEmail: $email\nPhone: $phone\nCheck-in: $checkin\nCheck-out: $checkout\nRoom: $room\nGuests: $guests\nRequests: $requests\n\nContact: $phone_1 / $phone_2";
$headers = "From: $email\r\nReply-To: $email";
mail($to, $subject, $message, $headers);

header("Location: booking.php?toast_type=success&toast_msg=" . urlencode("Booking request sent! We'll contact you within 24 hours."));
exit;
?>