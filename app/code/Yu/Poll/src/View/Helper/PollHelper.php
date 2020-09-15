<?php

namespace Yu\Poll\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Poll\Entity;

class PollHelper extends AbstractHelper
{
    /**
     * @var $entityManager
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCurrentTheme()
    {
        $themeRepository = $this->entityManager->getRepository(Entity\PollTheme::class);
        $theme = $themeRepository->findOneBy(['active' => 1], ['id' => 'DESC']);
        return $theme;
    }

    public function getThemeById(int $themeId)
    {
        $themeRepository = $this->entityManager->getRepository(Entity\PollTheme::class);
        $theme = $themeRepository->findOneBy(['id' => $themeId], ['id' => 'DESC']);
        return $theme;
    }

    /**
     * @return string|null
     */
    public function renderCurrentPull()
    {
        $theme = $this->getCurrentTheme();
        if(empty($theme)) {
            return null;
        }
        return $this->renderPoll($theme);
    }

    public function renderPullById(int $themeId)
    {
        $theme = $this->getThemeById($themeId);
        return $this->renderPoll($theme);
    }

    public function renderPoll(Entity\PollTheme $theme)
    {
        $optionRepository = $this->entityManager->getRepository(Entity\PollOption::class);
        $options = $optionRepository->findBy(['themeId' => $theme->getId()]);

        $resultRepository = $this->entityManager->getRepository(Entity\PollResult::class);
        $result = $resultRepository->findBy(['themeId' => $theme->getId(), 'ip' => $_SERVER['REMOTE_ADDR']]);

        $view = $this->getView();
        $view->setVars(['theme' => $theme, 'options' => $options]);

        if(empty($result)) {
            return $view->render('yu/poll/block/poll');
        } else {
            return $view->render('yu/poll/block/result');
        }
    }
}