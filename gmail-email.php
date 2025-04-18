<?php
// Load saved data from file
$data = json_decode(file_get_contents('data.json'), true);

$to = $data['to'] ?? '';
$cc = $data['cc'] ?? '';
$bcc = $data['bcc'] ?? '';
$subject = $data['subject'] ?? '';
$body = $data['body'] ?? '';

// Only add these if they are not empty
if (!empty($cc))      $params[] = "cc=" . urlencode($cc);
if (!empty($bcc))     $params[] = "bcc=" . urlencode($bcc);
if (!empty($subject)) $params[] = "subject=" . urlencode($subject);
if (!empty($body))    $params[] = "body=" . urlencode($body);

// Start with mailto: and add main recipient if available
$mailto = 'mailto:' . urlencode($to);

// If there are any parameters, append them
if (!empty($params)) {
    $mailto .= '?' . implode('&', $params);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Opening Gmail...</title>
</head>
<body>
<a id="gmailLink" href="<?= $mailto ?>" style="display: none;">click here</a>
    <script>
        setTimeout(function() {
            document.getElementById("gmailLink").click();
        }, 200);
    </script>
</body>
</html>
