<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'on' || $action === 'off') {
        // Execute the Python script with the appropriate action
        $command = escapeshellcmd("python3 /python/on_off.py $action");
        $output = shell_exec($command);
        echo json_encode(['status' => 'success', 'output' => $output]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
?>
