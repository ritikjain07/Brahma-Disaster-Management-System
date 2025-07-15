<?php
/**
 * Common Functions for Brahma Disaster Management System
 * 
 * @author Ritik Jain
 * @version 1.0
 */

// Try to include database config
try {
    require_once __DIR__ . '/../database/config.php';
} catch (Exception $e) {
    // Database connection failed, continue without database
    $conn = null;
    $db_connection_error = "Database configuration error: " . $e->getMessage();
}

/**
 * Sanitize input data
 * @param string $data Input data to sanitize
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Validate email format
 * @param string $email Email to validate
 * @return bool True if valid, false otherwise
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Generate secure password hash
 * @param string $password Plain text password
 * @return string Hashed password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verify password against hash
 * @param string $password Plain text password
 * @param string $hash Hashed password
 * @return bool True if password matches, false otherwise
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Start secure session
 */
function startSecureSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Check if user is logged in
 * @return bool True if logged in, false otherwise
 */
function isLoggedIn() {
    startSecureSession();
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Check if user is admin
 * @return bool True if admin, false otherwise
 */
function isAdmin() {
    startSecureSession();
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

/**
 * Redirect to login page if not logged in
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../auth/login.php');
        exit();
    }
}

/**
 * Redirect to admin login if not admin
 */
function requireAdmin() {
    if (!isAdmin()) {
        header('Location: ../admin/admin_login.html');
        exit();
    }
}

/**
 * Generate CSRF token
 * @return string CSRF token
 */
function generateCSRFToken() {
    startSecureSession();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 * @param string $token Token to verify
 * @return bool True if valid, false otherwise
 */
function verifyCSRFToken($token) {
    startSecureSession();
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Upload file with security checks
 * @param array $file File array from $_FILES
 * @param string $uploadDir Upload directory
 * @param array $allowedTypes Allowed file types
 * @return array Result array with status and message
 */
function uploadFile($file, $uploadDir, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']) {
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
        return ['status' => false, 'message' => 'No file uploaded'];
    }
    
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    
    if ($fileError !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => 'File upload error'];
    }
    
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    if (!in_array($fileExtension, $allowedTypes)) {
        return ['status' => false, 'message' => 'Invalid file type'];
    }
    
    if ($fileSize > 5 * 1024 * 1024) { // 5MB limit
        return ['status' => false, 'message' => 'File too large'];
    }
    
    $newFileName = uniqid() . '.' . $fileExtension;
    $uploadPath = $uploadDir . '/' . $newFileName;
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        return ['status' => true, 'filename' => $newFileName, 'path' => $uploadPath];
    } else {
        return ['status' => false, 'message' => 'Failed to upload file'];
    }
}

/**
 * Log system activity
 * @param string $action Action performed
 * @param string $description Description of action
 * @param int $userId User ID (optional)
 */
function logActivity($action, $description, $userId = null) {
    global $conn;
    
    // Skip if no database connection
    if (!$conn) {
        return;
    }
    
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    
    $stmt = $conn->prepare("INSERT INTO system_logs (user_id, action, description, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $userId, $action, $description, $ipAddress, $userAgent);
    $stmt->execute();
    $stmt->close();
}

/**
 * Format date for display
 * @param string $date Date string
 * @return string Formatted date
 */
function formatDate($date) {
    return date('M j, Y g:i A', strtotime($date));
}

/**
 * Get user information by ID
 * @param int $userId User ID
 * @return array|null User data or null if not found
 */
function getUserById($userId) {
    global $conn;
    
    // Return null if no database connection
    if (!$conn) {
        return null;
    }
    
    $stmt = $conn->prepare("SELECT id, username, email, first_name, last_name, phone, address, city, state FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    
    return $user;
}

/**
 * Send email notification (placeholder for future implementation)
 * @param string $to Recipient email
 * @param string $subject Email subject
 * @param string $message Email message
 * @return bool True if sent successfully
 */
function sendEmail($to, $subject, $message) {
    // TODO: Implement email sending functionality using PHPMailer
    return true;
}
?>
