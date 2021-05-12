<?php

namespace LumturoNet\ContaoPersonioBundle\Classes;

class TemplateInjector
{
    public function setOg($objPage, $objLayout, $objPageRegular)
    {
        /**
         * $GLOBALS['personio']['ogContent']['name'] === Feld "name" in der XML Schnittstelle
         * Ausgabe in fe_page.html erfolgt mit $this->ogTitle
         */
        $objPageRegular->Template->ogTitle = $GLOBALS['personio']['ogContent']['name'] ?? null;

        /**
         * $GLOBALS['personio']['ogContent']['subcompany'] === Feld "subcompany" in der XML Schnittstelle
         * Ausgabe in fe_page.html erfolgt mit $this->ogSubcompany
         */
        $objPageRegular->Template->ogSubcompany = $GLOBALS['personio']['ogContent']['subcompany'] ?? null;

        $objPageRegular->Template->ogOffice   = $GLOBALS['personio']['ogContent']['office'] ?? null;
        $objPageRegular->Template->ogKeywords = $GLOBALS['personio']['ogContent']['keywords'] ?? null;

        $arrJobDesc = $GLOBALS['personio']['ogContent']['jobDescriptions']['jobDescription'];
        if (!isset($arrJobDesc['value'])) {
            $strDescription = $arrJobDesc[0]['value'];
        } else {
            $strDescription = $arrJobDesc['value'];
        }
        $strDescription = preg_replace('/\s{2,}/', '', str_replace(array("\r", "\n"), '', $strDescription));
        $objPageRegular->Template
            ->ogDescription = $strDescription;
    }
}
