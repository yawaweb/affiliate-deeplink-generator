<?php

namespace yawaweb\AffiliateDeeplinkGenerator\Networks;

class Digistore24
{
    const AFFILIATE_DOMAIN = 'https://www.digistore24.com/redir/';

    public function generate($publisherId, $advertiserId, $clickRef = null)
    {
        return self::AFFILIATE_DOMAIN.$advertiserId.'/'.$publisherId.'/'.$clickRef;
    }
}
