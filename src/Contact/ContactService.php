<?php
namespace App\Contact;

use App\Entity\Contact;

class ContactService
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailFromContact(Contact $contact) {
        $email =new \Swift_Message();
        $email->setFrom($contact->getEmail())
                ->setTo('admin@super-hangman.com')
                ->setSubject($contact->getSubject())
                ->setBody($contact->getmessage());

        $this->mailer->send($email);
    }
}