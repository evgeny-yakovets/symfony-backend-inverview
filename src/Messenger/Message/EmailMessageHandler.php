<?php

namespace App\Messenger\Message;

use App\Entity\Email;
use App\Repository\EmailRepository;
use App\Service\EmailVerificationService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class EmailMessageHandler implements MessageHandlerInterface
{
    private EmailVerificationService $emailVerificationService;
    private EmailRepository $emailRepository;

    public function __construct(EmailVerificationService $emailVerificationService, EmailRepository $emailRepository)
    {
        $this->emailVerificationService = $emailVerificationService;
        $this->emailRepository = $emailRepository;
    }

    public function __invoke(EmailMessage $emailMessage)
    {
        $emailObj = $this->emailRepository->findOneBy(['email' => $emailMessage->getEmail()]);

        if(isset($emailObj)){
            $this->emailVerificationService->verify($emailObj);
        }
    }
}