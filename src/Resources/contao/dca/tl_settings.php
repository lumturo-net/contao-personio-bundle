<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{personio_legend},personio_webservice_url';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['personio_webservice_url'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['personio_webservice_url'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array(
        'mandatory'      => true,
        // 'allowHtml'      => false,
        // 'decodeEntities' => false,
        'useRawRequestData' => true // sonst wird das = entity_decoded
    ),
);
