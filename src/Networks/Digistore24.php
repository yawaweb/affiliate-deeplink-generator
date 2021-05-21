<?php
/**
 * Digistore24 Deeplink Generator for Affiliates
 *
 * @package   affiliate-deeplink-generator
 * @author    Ousama Yamine <hello@yawaweb.com>
 * @copyright 2016-2021 Yawaweb <hello@yawaweb.com>
 * @license   http://opensource.org/licenses/MIT MIT Public
 * @version   1.0.0
 * @link      https://yawaweb.com
 *
 */

namespace yawaweb\AffiliateDeeplinkGenerator\Networks;

class Digistore24
{
    const AFFILIATE_DOMAIN = 'https://www.digistore24.com/redir/';

    public function generate($publisherId, $advertiserId, $clickRef = null)
    {
        return self::AFFILIATE_DOMAIN.$advertiserId.'/'.$publisherId.'/'.$clickRef;
    }
}
