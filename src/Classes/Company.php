<?php

namespace LumturoNet\ContaoPersonioBundle\Classes;

use LumturoNet\ContaoPersonioBundle\Helpers;
use LumturoNet\ContaoPersonioBundle\Traits\Reader;

/**
 *
 */
class Company
{
    use Reader;

    /**
     * @var null
     */
    protected $strWsUrl = null;
    /**
     * @var null
     */
    protected $strWsCacheKey = null;
    /**
     * @var null
     */
    protected $intWsCacheTime = null;

    /**
     * @return array
     */
    public function getCompaniesAsOptions()
    {
        $this->strWsUrl       = \Config::get('personio_webservice_url');
        $this->strWsCacheKey  = \Config::get('personio_webservice_url');
        $this->intWsCacheTime = \Config::get('personio_webservice_url');

        $arrVacancies = $this->getXml();

        return array_unique(Helpers::array_pluck($arrVacancies, 'subcompany'));
    }
}
