<?php

use LumturoNet\ContaoPersonioBundle\Classes\TemplateInjector;
use LumturoNet\ContaoPersonioBundle\Elements\Vacancies;

$GLOBALS['TL_CTE']['lumturo']['personio_vacancies'] = Vacancies::class;
$GLOBALS['TL_HOOKS']['generatePage'][] = [TemplateInjector::class, 'setOg'];