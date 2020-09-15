<?php

namespace Yu\Feedback\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Form\Factory as FormFactory;
use Laminas\Mail;
use Laminas\View\Model\JsonModel;
use Yu\Feedback\Service\FeedbackManager;
use Yu\Content\Entity\Block;

class FeedbackController extends AbstractActionController
{
    public function indexAction()
    {
        $params = $this->getRequest()->getPost();
        $config = $this->config()->get();

        $feedbackManager = new FeedbackManager($config, $params['type']);

        $formFactory = new FormFactory();
        $form = $formFactory->createForm($config['feedback'][$params['type']]);

        $data = [];
        $message = [];
        $form->setData($params);
        if($form->isValid()) {
            $data = $form->getData();

            $subject = $feedbackManager->createSubject($data);
            $body = $feedbackManager->createBody($data);
            $email = $this->entityManager()->getRepository(Block::class)->findBlockByIdentifier('email');

            $mail = new Mail\Message();
            $mail->setBody($body);
            //$mail->setFrom('Freeaqingme@example.org', "Sender's name");
            $mail->addTo($email);
            $mail->setSubject($subject);

            $transport = new Mail\Transport\Sendmail();
            $transport->send($mail);
        } else {
            $message = $form->getMessages();
        }

        return new JsonModel($message);
    }
}