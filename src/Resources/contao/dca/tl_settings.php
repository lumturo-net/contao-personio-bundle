<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{personio_legend},personio_webservice_url,personio_webservice_cache_key,personio_webservice_cache_time';

/**
 * URL zum Personio Webservice
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

/**
 * Cache-Schlüssel für Antwort aus Personio-Webservice
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['personio_webservice_cache_key'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['personio_webservice_cache_key'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array(
        'mandatory'      => true,
        // 'allowHtml'      => false,
        // 'decodeEntities' => false,
        'useRawRequestData' => true // sonst wird das = entity_decoded
    ),
);

/**
 * Cache-Zeit in Sekunden, bevor Personio-Webservice erneut angefragt wird
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['personio_webservice_cache_time'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['personio_webservice_cache_time'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array(
        'mandatory'      => true,
        // 'allowHtml'      => false,
        // 'decodeEntities' => false,
        'useRawRequestData' => true // sonst wird das = entity_decoded
    ),
);
