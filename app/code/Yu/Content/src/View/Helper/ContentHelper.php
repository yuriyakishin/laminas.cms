<?php

namespace Yu\Content\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Content\Entity\Block;

class ContentHelper extends AbstractHelper
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * MetaHelper constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $identifier
     * @return string
     */
    public function getBlock(string $identifier)
    {
        /** @var \Yu\Content\Entity\Block $block */
        $block = $this->entityManager->getRepository(Block::class)->findOneBy(['identifier' => $identifier, 'active' => 1]);
        $content = '';
        if(!empty($block)) {
            $content = $block->getContent();
        }
        return $content;
    }
}