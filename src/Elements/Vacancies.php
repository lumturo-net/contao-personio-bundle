<?php

namespace LumturoNet\ContaoPersonioBundle\Elements;

use Contao\BackendTemplate;
use Contao\Config;
use Contao\ContentElement;
use Contao\Controller;
use Contao\FrontendTemplate;
use Contao\Input;
use Contao\PageModel;
use Contao\System;
use InvalidArgumentException;
use LumturoNet\ContaoPersonioBundle\Helpers;
use LumturoNet\ContaoPersonioBundle\Traits\Reader;

/**
 *
 */
class Vacancies extends ContentElement
{
    use Reader;

    /**
     * @var null
     */
    private $intVacancyId  = null;
    /**
     * @var string
     */
    protected $strTemplate = 'lt_personio_vacancies';

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
     * @param $objContainer
     * @param $strColumn
     */
    public function __construct($objContainer, $strColumn)
    {
        parent::__construct($objContainer, $strColumn);
    }

    /**
     * @return mixed
     */
    public function generate()
    {
        $this->strWsUrl       = \Config::get('personio_webservice_url');
        $this->strWsCacheKey  = \Config::get('personio_webservice_url');
        $this->intWsCacheTime = \Config::get('personio_webservice_url');

        if (TL_MODE === 'BE') {
            $this->Template           = new BackendTemplate('be_wildcard');
            $this->Template->wildcard = '### Übersichtsseite + Detail zu Stellenangebot ###';

            return $this->Template->parse();
        }

        // Set the item from the auto_item parameter
        if (!isset($_GET['item']) && Config::get('useAutoItem') && isset($_GET['auto_item'])) {
            preg_match('/(\d{6})/', Input::get('auto_item'), $matches);
            $this->intVacancyId = $matches[0] ?? null;

            Input::setGet('item', Input::get('auto_item'));
        }

        return parent::generate();
    }

    /**
     * @return void
     */
    public function compile()
    {
        if (filter_var($this->strWsUrl, FILTER_VALIDATE_URL) === false) {
            $this->Template = new FrontendTemplate('lt_personio_error');
            return;
        }

        if (!is_null($this->intVacancyId) && is_numeric($this->intVacancyId)) {

            $arrVacancy = $this->getVacancyById(intval($this->intVacancyId));

            $GLOBALS['personio']['ogContent'] = $arrVacancy;

            $this->Template          = new FrontendTemplate('lt_personio_vacancy');
            $this->Template->vacancy = $arrVacancy;
        } else {
            $strDetailpage = PageModel::findById($this->personio_vacancy_detailpage)->alias;
            $strDetailpage = $strDetailpage ?? Controller::replaceInsertTags('{{page::alias}}');

            $arrVacancies = !empty($this->personio_company) ? $this->getVacanciesByCompany($this->personio_company) : $this->getVacancies();

            try {
                $strSuffix = System::getContainer()->getParameter('contao.url_suffix');
            } catch (InvalidArgumentException $objException) {
                $strSuffix = '';
            }
            foreach ($arrVacancies as $index => $arrVacancy) {
                $arrVacancies[$index]['detailpage'] = $strDetailpage . '/' . Helpers::slug($arrVacancy['name']) . '-' . $arrVacancy['id'] . $strSuffix;//'.html';
            }

            $this->Template->vacancies = $arrVacancies;
        }
    }
}
