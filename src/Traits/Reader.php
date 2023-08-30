<?php

namespace LumturoNet\ContaoPersonioBundle\Traits;

use LumturoNet\ContaoPersonioBundle\Helpers;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * Trait Reader
 * @package LumturoNet\ContaoPersonioBundle\Traits
 */
trait Reader
{
    /**
     * @return mixed
     */
    private function getXml()
    {
        $objCache = new FilesystemAdapter;

        return $objCache->get('jobs', function(ItemInterface $objItem) {
            $objItem->expiresAfter(900);

            $objXml  = simplexml_load_file($this->strWsUrl, 'SimpleXMLElement', LIBXML_NOCDATA);
            $strJson = json_encode($objXml);
            $arrPositions = json_decode($strJson, true)['position'];
            // Only one position
            if (is_array($arrPositions) && !isset($arrPositions[0])) {
                $arrPositions = [$arrPositions];
            }

            return $arrPositions;
        });
    }

    /**
     * @return mixed
     */
    public function getVacancies()
    {
        return $this->getXml();
    }

    /**
     * @param $intId
     * @return mixed|null
     */
    public function getVacancyById($intId)
    {
        $arrData = $this->getXml();
        $intSearchKey = array_search($intId, Helpers::array_pluck($arrData, 'id'));

        return $arrData[$intSearchKey]['id'] == $intId ? $arrData[$intSearchKey] : null;
    }

    /**
     * @param $strCompany
     * @return array
     */
    public function getVacanciesByCompany($strCompany): array
    {
        $arrData      = $this->getXml();
        $arrVacancies = [];
        foreach($arrData as $intIndex => $arrVacancy) {
            if($arrVacancy['subcompany'] == $strCompany) $arrVacancies[] = $arrVacancy;
        }

        return $arrVacancies;
    }
}
