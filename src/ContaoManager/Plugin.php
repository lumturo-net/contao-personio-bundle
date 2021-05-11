<?php

declare(strict_types=1);

/*
 * This file is part of contao-personio-bundle.
 *
 * (c) rolf.staege@lumturo.net
 *
 * @license LGPL-3.0-or-later
 */

namespace LumturoNet\ContaoPersonioBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use LumturoNet\ContaoPersonioBundle\ContaoPersonioBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoPersonioBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
