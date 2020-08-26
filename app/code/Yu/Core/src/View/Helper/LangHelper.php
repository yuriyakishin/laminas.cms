<?php
namespace Yu\Core\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Core\DataHelper;
use Yu\Site\ValueObject\Lang;

class LangHelper extends AbstractHelper
{
    private $data;

    /**
     * @param string|null $data
     * @return $this|mixed|string
     */
    public function __invoke(string $data = null)
    {
        if(empty($data)) {
            return $this;
        }

        return $this->getDataByLang($data);
    }

    /**
     * @param string|null $data
     * @return mixed|string
     */
    public function getDataByLang(string $data = null)
    {
        if(empty($data)) {
            return '';
        }

        // unserialize для сериализованных данных
        if (DataHelper::checkSerializeString($data)) {
            $unserializ = DataHelper::unserialize($data);
            return $unserializ;
        }
        return $data;
    }

    public function getCurrentLangCode()
    {
        return Lang::getCurrentLang()['code'];
    }

    public function __toString()
    {
        return '';
    }
}