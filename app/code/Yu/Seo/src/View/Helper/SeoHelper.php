<?php

namespace Yu\Seo\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\ViewModel;
use Yu\Seo\Repository;
use Yu\Seo\Repository\MetaRepository;
use Yu\Seo\Entity\Meta as MetaEntity;
use Yu\Seo\Model\Meta as MetaModel;

class SeoHelper extends AbstractHelper
{
    const TITLE = '';
    const DESCRIPTION = '';
    const KEYWORDS = '';

    /**
     * @var EntityManager
     */
    private $emtityManager;

    /**
     * @var MetaEntity
     */
    private $metaEntity;

    /**
     * @var MetaModel
     */
    private $metaModel;

    /**
     * SeoHelper constructor.
     * @param EntityManager $emtityManager
     */
    public function __construct(
        EntityManager $emtityManager
    )
    {
        $this->emtityManager = $emtityManager;
        $this->metaModel = MetaModel::getInstance();
    }

    public function loadMetaEntity()
    {
        if(empty($this->metaEntity)) {
            $metaRepository = $this->emtityManager->getRepository(MetaEntity::class);
            $this->metaEntity = $metaRepository->findMeta($this->metaModel->getPath(), $this->metaModel->getEntityId());
        }
        return $this->metaEntity;
    }

    public function getTitle()
    {
        $title = '';
        if(!empty($this->metaModel->getTitle())) {
            $title = $this->metaModel->getTitle();
        } elseif (!empty($this->metaModel->getPath()) && !empty($this->metaModel->getEntityId())) {
            $meta = $this->loadMetaEntity();
            $title = $meta->getTitle();
        }

        return $title;
    }

    public function getDescription()
    {
        $description = '';
        if(!empty($this->metaModel->getDescription())) {
            $description = $this->metaModel->getDescription();
        } elseif (!empty($this->metaModel->getPath()) && !empty($this->metaModel->getEntityId())) {
            $meta = $this->loadMetaEntity();
            $description = $meta->getDescription();
        }

        return $description;
    }

    public function getKeywords()
    {
        $keywords = '';
        if(!empty($this->metaModel->getKeywords())) {
            $keywords = $this->metaModel->getKeywords();
        } elseif (!empty($this->metaModel->getPath()) && !empty($this->metaModel->getEntityId())) {
            $meta = $this->loadMetaEntity();
            $keywords = $meta->getKeywords();
        }

        return $keywords;
    }

    public function renderMeta()
    {
        $title = $this->getTitle();
        $description = $this->getDescription();
        $keywords = $this->getKeywords();
        $view = $this->getView();
        return $view->render('yu/seo/meta',['title' => $title,'description' => $description, 'keywords' => $keywords]);
    }

}