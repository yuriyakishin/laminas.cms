<?php

namespace Yu\Admin\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Laminas\Paginator\Paginator;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class TableDataPlugin extends AbstractPlugin
{
    /**
     * @var object
     */
    private $tableManager;

    /**
     * TableManagerPlugin constructor.
     * @param object $tableManager
     */
    public function __construct(object $tableManager)
    {
        $this->tableManager = $tableManager;
    }

    public function tableManager()
    {
        return $this->tableManager;
    }

    public function getAjaxData(Query $query, array $params, string $tableName)
    {
        $draw = $params['draw'];
        $start = $params['start'];
        $length = $params['length'];
        $currentPage = intdiv($start, $length)+1;

        // Создаем пагинатор.
        $ormPaginator = new ORMPaginator($query, false);
        $ormPaginator->setUseOutputWalkers(false);
        $adapter = new DoctrinePaginatorAdapter($ormPaginator);
        $paginator = new Paginator($adapter);

        $paginator->setCurrentPageNumber($currentPage);
        $paginator->setDefaultItemCountPerPage($length);

        $count = $paginator->getTotalItemCount();
        $data = array();
        $result = [
            "draw" => $draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
        ];

        $table = $this->tableManager()->createTable($tableName);

        foreach ($paginator as $row) {
            foreach ($table->getColumns() as $collumn) {
                $_data[$collumn['key']] = (string)$this->tableManager()->retrieveValue($row, $collumn['key'], $collumn);
            }

            $_data['edit'] = '<button type="button" class="btn btn-primary btn-flat btn-sm button-edit" data-id="'.$this->tableManager()->retrieveValue($row, 'id').'"><i class="fas fa-edit"></i></button>';
            $_data['delete'] = '<button type="button" class="btn btn-danger btn-flat btn-sm button-delete" data-id="'.$this->tableManager()->retrieveValue($row, 'id').'"><i class="fas fa-trash"></i></button>';

            $data[] = $_data;
        }

        $result["data"] = $data;

        return $result;
    }
}