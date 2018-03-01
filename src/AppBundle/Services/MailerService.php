<?php

namespace AppBundle\Service;

use AppBundle\Entity\Usuario;
use Symfony\Component\Translation\TranslatorInterface;

class MailerService
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $prefix;
    private $from;
    /**
     * @var TranslatorInterface
     */
    private $translator;
    public function __construct($prefix, $from, \Swift_Mailer $mailer, TranslatorInterface $translator)
    {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->prefix = $prefix;
        $this->from = $from;
    }
    /**
     * @param User[] $users
     * @param array $subject
     * @param array $body
     * @param string|null $translation_domain
     *
     * @return int
     */
    public function sendEmail($users, $subject, $body, $translation_domain = null)
    {
        // convertir array de usuarios en lista de correos
        $to = [];
        foreach ($users as $user) {
            $to[$user->getEmail()] = (string) $user;
        }
        /**
         * @var \Swift_Message
         */
        $msg = $this->mailer->createMessage()
            ->setSubject($this->prefix . $this->translator->trans($subject['id'], $subject['parameters'], $translation_domain))
            ->setFrom($this->from)
            ->setTo($to)
            ->setBody($this->translator->trans($body['id'], $body['parameters'], $translation_domain));
        return $this->mailer->send($msg);
    }
}