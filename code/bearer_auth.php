<?php


function getBearerToken() {
    $headers = getallheaders();
    
    // Check if Authorization header exists
    if (isset($headers['Authorization'])) {
        // Extract token from "Bearer TOKEN_HERE" format
        if (preg_match('/Bearer\s+(.*)$/i', $headers['Authorization'], $matches)) {
            return trim($matches[1]);
        }
    }
    
    return null;
}

function generateSecureToken() {
    return bin2hex(random_bytes(32)); // 64 character hex string
}

function requireAuth() {
    $token = getBearerToken();
    
    if (!$token) {
        sendJsonError(401, 'Bearer token required');
    }
    
    $user = isValidToken($token);
    if (!$user) {
        sendJsonError(401, 'Invalid or expired token');
    }
    
    return $user;
}


?>