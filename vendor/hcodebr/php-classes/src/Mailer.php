<?php 
namespace Hcode;
use Rain\Tpl;

class Mailer {
	const USERNAME = "rodrigorolimveras92@gmail.com";
	const PASSWORD = "szpvnp77";
	const NAME_FROM = "Hcode Store";
	private $email;
	public function __construct($toAddress, $toName, $subject, $tplName, $data = array()){
		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/email/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false // set to false to improve the speed
	   );

		Tpl::configure( $config );
		$tpl = new Tpl;
		foreach ($data as $key => $value) {
			$tpl->assign($key, $value);
		}
		$html = $tpl->draw($tplName, true);
		$this->email = new \PHPMailer;

		$this->email->isSMTP();

		$this->email->SMTPDebug = 0;

		//Set the hostname of the mail server
		$this->email->Host = 'smtp.gmail.com';
		// use
		// $this->email->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$this->email->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$this->email->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$this->email->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$this->email->Username = "rodrigorotaract@gmail.com";

		//Password to use for SMTP authentication
		$this->email->Password = "lichiking";

		//Set who the message is to be sent from
		$this->email->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);

		//Set an alternative reply-to address
		//$this->email->addReplyTo('replyto@example.com', 'First Last');

		//Set who the message is to be sent to
		$this->email->addAddress($toAddress, $toName);

		//Set the subject line
		$this->email->Subject = $subject;

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$this->email->msgHTML($html);

		//Replace the plain text body with one created manually
		$this->email->AltBody = 'This is a plain-text message body';

		//Attach an image file
		//$this->email->addAttachment('images/phpmailer_mini.png');

		//send the message, check for errors
		if (!$this->email->send()) {
		    echo "Mailer Error: " . $this->email->ErrorInfo;
		} else {
		    echo "Message sent!";
		    //Section 2: IMAP
		    //Uncomment these to save your message in the 'Sent Mail' folder.
		    #if (save_mail($this->email)) {
		    #    echo "Message saved!";
		    #}
		}

		//Section 2: IMAP
		//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
		//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
		//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
		//be useful if you are trying to get this working on a non-Gmail IMAP server.

	} 
	public function send() {
		return $this->email->send();
	}
}

 ?>