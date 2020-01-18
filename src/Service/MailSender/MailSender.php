<?php


namespace App\Service\MailSender;


use App\Entity\Application;
use Twig\Environment;

class MailSender
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $environment;

    private $mail;

    /**
     * MailSender constructor.
     * @param $mail
     * @param \Swift_Mailer $mailer
     * @param Environment $environment
     */
    public function __construct(string $mail, \Swift_Mailer $mailer, Environment $environment)
    {
        $this->mail = $mail;
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function sendNotification(Application $application)
    {
        $message = (new \Swift_Message('Стомасвит новая заявка'))
            ->setFrom($this->mail)
            ->setTo($this->mail)
            ->setBody(
                $this->environment->render(
                    'admin/mail.html.twig',
                    [
                        'application' => $application
                    ]
                ),
                'text/html'
                );

        $this->mailer->send($message);
    }
}