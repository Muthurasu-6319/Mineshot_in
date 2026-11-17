<?php
// api/contact.php - Mineshot Contact & Enquiry Form Handler
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
    exit;
}

// Extract and sanitize input
$name    = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
$phone   = htmlspecialchars(trim($_POST['phone'] ?? ''), ENT_QUOTES, 'UTF-8');
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$date    = htmlspecialchars(trim($_POST['date'] ?? ''), ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars(trim($_POST['Address'] ?? $_POST['address'] ?? ''), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');

// Basic validation
if (empty($name) || empty($phone) || empty($email)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Please provide your name, contact number, and a valid email address.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Please provide a valid email address.'
    ]);
    exit;
}

// Prepare email message
$to = 'simbhu@mineshot.in';
$subject = "New Shoot Enquiry from {$name} - Mineshot Production Hub";
$body = "New Shoot Enquiry Details:\n\n"
      . "Name: {$name}\n"
      . "Phone: {$phone}\n"
      . "Email: {$email}\n"
      . "Date Required: {$date}\n"
      . "Address / Location: {$address}\n"
      . "Requirement / Need:\n{$message}\n\n"
      . "Submitted from: https://mineshot.in/\n"
      . "Time: " . date('Y-m-d H:i:s') . " IST\n";

$headers = "From: Mineshot Hub <noreply@mineshot.in>\r\n"
         . "Reply-To: {$email}\r\n"
         . "X-Mailer: PHP/" . phpversion();

// Send email (suppress errors if mail server isn't bound on container)
$mailSent = @mail($to, $subject, $body, $headers);

// Build convenient WhatsApp message link for instant fallback
$waText = urlencode("Hi Mineshot Team, I would like to enquire about a shoot:\n*Name:* {$name}\n*Phone:* {$phone}\n*Date:* {$date}\n*Need:* {$message}");
$waLink = "https://wa.me/919962222257?text={$waText}";

echo json_encode([
    'success' => true,
    'message' => 'Thank you! Your enquiry has been received. Our team will contact you shortly.',
    'whatsapp_url' => $waLink
]);
