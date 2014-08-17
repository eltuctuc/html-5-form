<?php
/**
 * Created by PhpStorm.
 * User: Enrico Reinsdorf
 * Date: 17.08.2014
 */
namespace mail;

/**
 * Class Mail
 * @package mail
 */
class Mail {
	protected $to_email;
	protected $to_name;
	protected $from_email;
	protected $from_name;
	protected $subject;
	protected $message;
	protected $fields = array();

	/**
	 * @return array
	 */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * @param array $fields
	 */
	public function setFields($fields)
	{
		$this->fields = $fields;
	}

	/**
	 * @return mixed
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * @param mixed $message
	 */
	public function setMessage($message)
	{
		$this->message = $message;
	}

	/**
	 * Construtor
	 *
	 * @param array $data
	 */
	public function __construct(array $data) {

		$this->to_email = ($data['to_email']) ? $data['to_email'] : '';
		$this->to_name = ($data['to_name']) ? $data['to_name'] : '';
		$this->from_email = ($data['from_email']) ? $data['from_email'] : '';
		$this->from_name = ($data['from_name']) ? $data['from_name'] : '';
		$this->subject = ($data['subject']) ? $data['subject'] : '';
		$this->body = ($data['body']) ? $data['body'] : '';
	}

	/**
	 * @return string
	 */
	public function getFromEmail()
	{
		return $this->from_email;
	}

	/**
	 * @param string $from_email
	 */
	public function setFromEmail($from_email)
	{
		$this->from_email = $from_email;
	}

	/**
	 * @return string
	 */
	public function getFromName()
	{
		return $this->from_name;
	}

	/**
	 * @param string $from_name
	 */
	public function setFromName($from_name)
	{
		$this->from_name = $from_name;
	}

	/**
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param string $subject
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}

	/**
	 * @return string
	 */
	public function getToEmail()
	{
		return $this->to_email;
	}

	/**
	 * @param string $to_email
	 */
	public function setToEmail($to_email)
	{
		$this->to_email = $to_email;
	}

	/**
	 * @return string
	 */
	public function getToName()
	{
		return $this->to_name;
	}

	/**
	 * @param string $to_name
	 */
	public function setToName($to_name)
	{
		$this->to_name = $to_name;
	}

	public function send() {

		//email body
		$message_body = $this->message."\r\n\r\n";
		foreach($this->fields as $field) {
			$message_body .= sprintf("%s\t\t: %s", $field['name'], $field['value']);
		}

		//proceed with PHP email.
		$headers = sprintf("From: %s <%s>\r\n", $this->from_name, $this->from_email) .
			sprintf("Reply-To: %s <%s>\r\n", $this->to_name, $this->to_email) .
			sprintf('X-Mailer: PHP/%s', phpversion());

		$send_mail = mail($this->to_email, $this->subject, $message_body, $headers);

		if(!$send_mail)
		{
			return false;
		}else{
			return true;
		}
	}
}