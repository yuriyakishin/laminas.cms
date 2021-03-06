<?php

namespace Yu\Realty\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Laminas\Http\Cookies;
use Yu\Price\Entity\Price;
use Yu\Realty\Service\RealtyConfigManager;
use Yu\Realty\Service\RealtyManager;
use Yu\Seo\Entity\Meta;
use Yu\Realty\Entity\Realty;
use Yu\Geo\Entity\Marker;
use Yu\Realty\Repository\RealtyRepositoryInterface;
use Yu\Eav\Entity\EavValueText;
use Yu\Eav\Entity\EavValueInt;
use Yu\Realty\Entity\RealtyValueInt;
use Yu\Realty\Entity\RealtyValueText;

class RealtyController extends AbstractAdminController
{
    /**
     * @var \Yu\Realty\Repository\RealtyRepositoryInterface
     */
    private $repository;

    /**
     * @var \Yu\Admin\Service\Table\TableManager
     */
    private $tableManager;

    /**
     * @var \Yu\Admin\Service\Form\FormManager
     */
    private $formManager;

    /**
     * @var RealtyManager
     */
    private $realtyManager;

    /**
     * @var array
     */
    private $options;

    /**
     * @var \Yu\Realty\Api\SearchCriteriaBuilderInterface
     */
    private $searchCriteriaBuilder;

    /**
     * RealtyController constructor.
     * @param RealtyManager $realtyManager
     * @param RealtyRepositoryInterface $repository
     * @param array $data
     */
    public function __construct(
        \Yu\Realty\Service\RealtyManager $realtyManager,
        \Yu\Realty\Service\RealtyConfigManager $realtyConfigManager,
        \Yu\Realty\Repository\RealtyRepositoryInterface $repository,
        \Yu\Realty\Api\SearchCriteriaBuilderInterface $searchCriteriaBuilder,
        array $data = []
    )
    {
        $this->realtyManager = $realtyManager;
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->options = $realtyConfigManager->getRealtyAdminOptions();
    }

    public function indexAction()
    {
        $params = $this->params()->fromQuery();
        $queryBuilder = $this->repository->getQueryBuilder();
        $query = $this->searchCriteriaBuilder->build($queryBuilder, $params)->getQuery();
        $rows = $query->getResult();

        //$entities = $this->repository->findRealty();

        /**
         * @var \Yu\Admin\Model\TableModel $table
         */
        $table = $this->tableManager()->createTable($this->options['table']);
        if($table->getFilter()) {
            if(!empty($params)) {
                $table->getFilter()->setData($params);
                setcookie('admin-filter-' . $this->options['type'],json_encode($params));
            } elseif (isset($_COOKIE['admin-filter-' . $this->options['type']])) {
                $params = json_decode($_COOKIE['admin-filter-' . $this->options['type']],true);
                $table->getFilter()->setData($params);
            }
        }
        if (isset($this->options['table_options'])) {
            $table->setOptions($this->options['table_options']);
        }

        $this->layout()->setVariable('h1', $this->options['title']);
        $view = new ViewModel();
        $view->setTemplate('admin/table');
        $view->setVariable('table', $table);
        $view->setVariable('rowsData', $rows);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id', 0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager()->getForm($this->options['form']);

        $realty = $this->entityManager()->getRepository(Realty::class)->findOneById($id);
        $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('realty', $id);

        // Извлекаем параметры объекта недвижимости
        $realtyRealtyParams = $this->realtyManager->getRealtyParams($realty);

        // Извлекаем цену
        $price = $this->priceManager()->getPriceByParam(['path' => 'realty', 'pathId' => $id, 'siteId' => $this->authAdmin()->getCurrentUser()->getSiteId()]);

        // Извлекаем адрес
        $marker = $this->entityManager()->getRepository(Marker::class)->findMarker('realty', $id);

        $this->formManager()->setDataToFieldset($form, 'realty', $realty);
        $this->formManager()->setDataToFieldset($form, 'params', $realtyRealtyParams);
        $this->formManager()->setDataToFieldset($form, 'price', $price);
        $this->formManager()->setDataToFieldset($form, 'geo', $marker);
        $this->formManager()->setDataToFieldset($form, 'meta', $meta);

        if (empty($id)) {
            $this->layout()->setVariable('h1', $this->options['title'] . ' - Добавить');
        } else {
            $this->layout()->setVariable('h1', $this->options['title'] . ' - Редактировать');
        }
        $view = new ViewModel();
        $view->setTemplate('admin/form');
        $view->setVariable('form', $form);
        return $view;
    }

    public function saveAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            /** @var \Yu\Admin\Service\Form\FormModel $form */
            $form = $this->formManager()->getForm($this->options['form']);

            $form->setData($data);

            $id = (int)$data['realty']['id'] ?? 0;

            if ($form->isValid()) {
                try {
                    $id = (int)$data['realty']['id'] ?? 0;

                    // Сохранение объекта Realty
                    $realtyRepository = $this->entityManager()->getRepository(Realty::class);

                    $realty = $realtyRepository->findOneById($id);
                    if (empty($realty)) {
                        $realty = new Realty();
                    }

                    $this->formManager()->importDataToEntity($form, 'realty', $realty);
                    $realty->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $realty->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $realty->setType($this->options['type']);
                    $id = $realtyRepository->save($realty);

                    // Сохранить параметры
                    $this->realtyManager->saveParams($realty, $data);

                    // Сохранить цену
                    $dataPrice = $form->getData()['price'];
                    $this->priceManager()->save([
                        'siteId' => $this->authAdmin()->getCurrentUser()->getSiteId(),
                        'path' => 'realty',
                        'pathId' => $id], $dataPrice);

                    // Сохранить адрес
                    /** @var \Yu\Geo\Entity\Marker $marker */
                    $marker = $this->entityManager()->getRepository(Marker::class)->findMarker('realty', $id);
                    $marker->setPath('realty');
                    $marker->setPathId($id);
                    $this->formManager()->importDataToEntity($form, 'geo', $marker);
                    $this->entityManager()->getRepository(Marker::class)->save($marker);

                    // Сохранение Meta
                    $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('realty', $id);
                    $meta->setEntityId($id);
                    $meta->setPath('realty');
                    $this->formManager()->importDataToEntity($form, 'meta', $meta);
                    $this->entityManager()->getRepository(Meta::class)->save($meta);

                    // Сохранение фотогалереи Images
                    if (isset($data['images'])) {
                        $this->entityManager()->getRepository(\Yu\Media\Entity\Image::class)->saveGallery($data['images'],
                            [
                                'user_id' => $this->authAdmin()->getCurrentUser()->getId(),
                                'site_id' => $this->authAdmin()->getCurrentUser()->getSiteId(),
                                'path' => 'realty',
                                'path_id' => $id,
                            ]);
                    }

                    $this->flashMessenger()->addSuccessMessage("Объект сохранен");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute($this->options['route'] . '/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute($this->options['route'] . '/edit', ['id' => $id]);
                }
            } else {
                $error = json_encode($form->getMessages());
                $this->flashMessenger()->addErrorMessage("Ошибка валидации данных: " . $error);
                return $this->redirect()->toRoute($this->options['route'] . '/edit', ['id' => $id]);
            }
        }
        return $this->redirect()->toRoute($this->options['route']);
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if (!empty($id)) {
            $entity = $this->entityManager()->getRepository(Realty::class)->findOneById($id);
            $this->entityManager()->getRepository(Realty::class)->remove($entity);

            $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('realty', $id);
            $this->entityManager()->getRepository(Meta::class)->remove($meta);

            $this->entityManager()->getRepository(RealtyValueInt::class)->removeByEntityId($id);
            $this->entityManager()->getRepository(RealtyValueText::class)->removeByEntityId($id);

            $this->entityManager()->getRepository(Price::class)->removeBy(['pathId' => $id, 'path' => 'realty']);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }

}