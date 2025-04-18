<?php
// Load saved data from file
$data = json_decode(file_get_contents('data.json'), true);

$to = $data['to'] ?? '';
$cc = $data['cc'] ?? '';
$bcc = $data['bcc'] ?? '';
$subject = $data['subject'] ?? '';
$body = $data['body'] ?? '';

$url = 'https://mail.google.com/mail/?view=cm&fs=1';

$params = [];

if (!empty($to))      $params[] = "to=" . urlencode($to);
if (!empty($cc))      $params[] = "cc=" . urlencode($cc);
if (!empty($bcc))     $params[] = "bcc=" . urlencode($bcc);
if (!empty($subject)) $params[] = "su=" . urlencode($subject);
if (!empty($body))    $params[] = "body=" . urlencode($body);

$gmailUrl = $url . "&" . implode("&", $params);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Opening Gmail...</title>
</head>
<body>
<a id="gmailLink" href="<?= $gmailUrl ?>" style="display: none;">click here</a>
    <script>
        setTimeout(function() {
            document.getElementById("gmailLink").click();
        }, 100);
    </script>
</body>
</html>
