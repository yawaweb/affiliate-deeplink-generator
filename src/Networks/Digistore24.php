<?php
/**
 * Digistore24 Deeplink Generator for Affiliates
 *
 * @package   affiliate-deeplink-generator
 * @author    Ousama Yamine <hello@yawaweb.com>
 * @copyright 2016-2023 Yawaweb <hello@yawaweb.com>
 * @license   http://opensource.org/licenses/MIT MIT Public
 * @version   2.0.0
 * @since     1.0.0
 * @link      https://yawaweb.com
 *
 */

namespace yawaweb\AffiliateDeeplinkGenerator\Networks;

class Digistore24
{
    public const AFFILIATE_DOMAIN = 'https://www.digistore24.com/redir/';

    public function generate($publisherId, $advertiserId, $clickRef = null): string
    {
        return self::AFFILIATE_DOMAIN.$advertiserId.'/'.$publisherId.'/'.$clickRef;
    }
}
