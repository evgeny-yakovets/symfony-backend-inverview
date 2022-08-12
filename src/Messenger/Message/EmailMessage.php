<?php

namespace App\Messenger\Message;

use App\Entity\Email;

class EmailMessage
{
    private string $email;

    public function __construct(Email $email)
    {
        $this->email = $email->getEmail();
    }

    public function getMessage(){
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }
}
