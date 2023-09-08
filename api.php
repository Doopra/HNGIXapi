<?php
header("Content-Type: application/json");
    $serverConstant = $_SERVER;
    // Set the default timezone to UTC
    date_default_timezone_set('UTC');
    
    if($serverConstant['REQUEST_METHOD'] === "GET") {
        // Let's validate if query parameters are not missing
        if(isset($_GET['slack_name'])) {
            $slack_name = $_GET['slack_name'];
        } else {
            $slack_name = '';
        }
        
        if(isset($_GET['track'])) {
            $track = $_GET['track'];
        } else {
            $track = '';
        }

        // Ternary Operator
        // $slack_name = isset($_GET['slack_name']) ? $_GET['slack_name'] : "";

        if($slack_name == "") {
            $response = ["message" => "Please provide slack name", "status" => 400];
        }
        else if($track == "") {
            $response = ["message" => "Please provide your track e.g Backend", "status" => 400];
        }
        else {
            // Get the current UTC date-time
            $utcDateTime = gmdate('Y-m-d H:i:s');
            $response = [
                "slack_name" => $slack_name,
                "track" => $track,
                "current_day" => date('l'),
                "github_file_url" => "https://github.com/username/repo/blob/main/file_name.ext",
                "github_repo_url" => "https://github.com/username/repo",
                "utc_time" => $utcDateTime,
                "status_code" => 200
            ];
        }
    }
    else {
        $response = ["message" => "Only GET Request method is allowed", "status" => 400];
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>