<?php
// Save form data to file when submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['subject'])) {
    $data = [
        'to' => $_GET['to'] ?? '',
        'cc' => $_GET['cc'] ?? '',
        'bcc' => $_GET['bcc'] ?? '',
        'subject' => $_GET['subject'] ?? '',
        'body' => $_GET['body'] ?? ''
    ];
    $filePath = '/tmp/data.json';
    file_put_contents($filePath, json_encode($data));
    echo "<p>Form submitted successfully.</p>";
}

// Load last saved data to prefill form
$lastData = file_exists($filePath) ? json_decode(file_get_contents('data.json'), true) : [];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Compose Gmail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #4CAF50;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
            height: 150px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Send Email via Gmail</h2>
    <div class="form-container">
        <form method="get">
            <label for="to">To:</label>
            <input type="text" id="to" name="to" value="<?= htmlspecialchars($lastData['to'] ?? '') ?>">

            <label for="cc">CC:</label>
            <input type="text" id="cc" name="cc" value="<?= htmlspecialchars($lastData['cc'] ?? '') ?>">

            <label for="bcc">BCC:</label>
            <input type="text" id="bcc" name="bcc" value="<?= htmlspecialchars($lastData['bcc'] ?? '') ?>">

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($lastData['subject'] ?? '') ?>">

            <label for="body">Body:</label>
            <textarea id="body" name="body"><?= htmlspecialchars($lastData['body'] ?? '') ?></textarea>

            <button type="submit">Compose in Gmail</button>
        </form>
    </div>
</body>
</html>
