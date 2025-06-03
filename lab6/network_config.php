<?php
// Get server IP address
function getServerIP() {
    $serverIP = $_SERVER['SERVER_ADDR'] ?? 'localhost';
    
    // Try to get the actual IP address
    if ($serverIP === '::1' || $serverIP === '127.0.0.1') {
        // Get local IP address
        $output = shell_exec('hostname -I 2>/dev/null || ipconfig 2>/dev/null');
        if ($output) {
            $ips = explode(' ', trim($output));
            foreach ($ips as $ip) {
                if (filter_var(trim($ip), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return trim($ip);
                }
            }
            // If no public IP, use the first private IP
            foreach ($ips as $ip) {
                if (filter_var(trim($ip), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    return trim($ip);
   }
            }
        }
    }
    
    return $serverIP;
}

function getNetworkInfo() {
    return [
        'server_ip' => getServerIP(),
        'server_port' => $_SERVER['SERVER_PORT'] ?? '80',
        'current_url' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        'access_url' => 'http://' . getServerIP() . ($_SERVER['SERVER_PORT'] != '80' ? ':' . $_SERVER['SERVER_PORT'] : '') . dirname($_SERVER);
        ]
    }