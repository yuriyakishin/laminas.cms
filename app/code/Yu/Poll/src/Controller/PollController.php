<?php

namespace Yu\Poll\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Yu\Poll\Entity;

class PollController extends AbstractActionController
{
    public function indexAction()
    {
        $themeRepository = $this->entityManager()->getRepository(Entity\PollTheme::class);
        $themes = $themeRepository->findBy([], ['id' => 'DESC']);

        $view = new ViewModel(['themes' => $themes]);
        $view->setTemplate('yu/poll');
        return $view;
    }

    public function sendAction()
    {
        $optionId = $this->getRequest()->getQuery('id');
        $optionRepository = $this->entityManager()->getRepository(Entity\PollOption::class);
        /** @var Entity\PollOption $option */
        $option = $optionRepository->findOneById($optionId);

        $resultRepository = $this->entityManager()->getRepository(Entity\PollResult::class);
        $result = $resultRepository->findBy(['themeId' => $option->getThemeId(), 'ip' => $_SERVER['REMOTE_ADDR']]);

        if (empty($result)) {
            $result = new Entity\PollResult();
            $result->setThemeId($option->getThemeId());
            $result->setOptionId($option->getId());
            $result->setIp($_SERVER['REMOTE_ADDR']);
            $resultRepository->save($result);

            $option->setResult($option->getResult() + 1);
            $optionRepository->save($option);
        }

        $themeRepository = $this->entityManager()->getRepository(Entity\PollTheme::class);
        $theme = $themeRepository->findOneBy(['id' => $option->getThemeId()], ['id' => 'DESC']);

        $options = $optionRepository->findBy(['themeId' => $theme->getId()]);

        $view = new ViewModel(['theme' => $theme, 'options' => $options]);
        $view->setTemplate('yu/poll/block/result');
        $view->setTerminal(true);
        return $view;
    }
}