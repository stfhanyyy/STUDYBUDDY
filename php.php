<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["question"]) && isset($_POST["answer"])) {
        $question = htmlspecialchars(trim($_POST["question"]));
        $answer = htmlspecialchars(trim($_POST["answer"]));
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "quizlet_db";

        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    
        $stmt = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
        $stmt->bind_param("ss", $question, $answer);

        if ($stmt->execute()) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
   
        http_response_code(400); 
        echo "Error: Missing parameters";
    }
} else { 
    header("Allow: POST", true, 405); 
    echo "Method Not Allowed";
}
?>
