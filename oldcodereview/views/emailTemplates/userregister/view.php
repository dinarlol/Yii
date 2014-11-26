<?php 

$body = '
<html>
<head>
<title>Akimbo Registration Details</title>
<style>
body {
color: #8BB3DA;
]
</style>
</head>
<body style="background-color: #161616;">
<div style="margin-left: 10%; margin-top: 5%; background-color: #191919; color: #8BB3DA; width: 600px; overflow: none;">
<h1>Hello '. $this->email.',</h1><br/><br/>

Thank you for registering to Sterling Savvy Web Design. As a new member to our site
you will be allowed to visit more pages and access more information. As well if you
were looking for our services, you can now sign up as a client to us. Please take the
time to read our full policy, privacy and terms of service pages (located in the footer
of every page) for our guarantee and site rules. Know that we will not share your email
address to any other company without your given permission nor will you receive emails
from us unless you sign up for them. The only exception to this would be web administration
emails regarding your account.<br/><br/>

Here are the detaisl of your registration, please do not lose this information and keep it safe
from others. In the event you forget your password we have a password recovery setup
where your secret question will be displayed so your secret answer would then be required
to confirm the operation of a password change. If you have any troubles with this an administrator
can assist you. Just contact Webmaster@SterlingSavvy.com.<br/><br/>

<table cellspacing="0" cellpadding="0" width="600px">
<tr><td colspan="2">Account Details</td></tr>
<tr><td>Username:</td><td>'. $this->email .'</td></tr>
<tr><td>Password:</td><td>'. $this->initialPassword .'</td></tr>
<tr><td>Email:</td><td>'. $this->email .'</td></tr>
<tr><td>Secret Question:</td><td>'. $this->email .'</td></tr>
<tr><td>Secret Answer:</td><td>'. $this->email .'</td></tr>
</table><br/><br/>

Best regards,<br/>
AKIMBO TEAM
Web Administration
</div>
</body>
</html>
';

echo $body;

?>