<?php

namespace LumturoNet\ContaoPersonioBundle\Classes;

use LumturoNet\ContaoPersonioBundle\Helpers;
use LumturoNet\ContaoPersonioBundle\Traits\Reader;

class Company
{
    use Reader;

    public function getCompaniesAsOptions()
    {
        $arrVacancies = $this->getXml();

        return array_unique(Helpers::array_pluck($arrVacancies, 'subcompany'));
    }
}