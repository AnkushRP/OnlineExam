<?php
// mail_config.php
return [
  'host' => '127.0.0.1',      // MailHog runs locally
  'port' => 1025,             // default MailHog SMTP port
  'auth' => false,            // no authentication
  'username' => '',           // not needed
  'password' => '',           // not needed
  'secure' => false,          // no SSL/TLS
  'from_email' => 'no-reply@example.com',
  'from_name' => 'Online Exam System'
];
?>