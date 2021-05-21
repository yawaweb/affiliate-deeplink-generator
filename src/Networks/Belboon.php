<?php
namespace yawaweb\AffiliateDeeplinkGenerator\Networks;

class Belboon
{
    /**
     * Affiliate Domain
     */
    const AFFILIATE_DOMAIN = 'https://luna.r.lafamo.com/ts/';

    /**
     * Generate affiliate url for Belboon
     * Description of url parameter: https://ingenioustechnologies.atlassian.net/wiki/spaces/KB/pages/1440383093/Working+with+deeplinks
     *
     * @param int $publisherId Affiliate ID
     * @param string $advertiseId Externe ID des Advertiser
     * @param int $adspaceId ID der Werbefläche (z.B.: affiliatesite.com)
     * @param int $creativesId ID des Werbemittels (z.B.: Deeplink)
     * @param string $deeplink Url vom Shop
     * @param string|array $clickRef Klick Referenz wenn nur eins da ist dann String wenn mehrere dann array (['ref1', 'ref2'])
     * @return string Trackingurl
     */
    public function generate($publisherId, $advertiseId, $adspaceId, $creativesId, $deeplink, $clickRef = null)
    {
        $url_params_array = [
            'amc' => 'con.blbn.'.$publisherId.'.'.$adspaceId.'.'.$creativesId, //ADVERTISER_ID
            'rmd' => 3, //PUBLISHER_ID
            'trg' => urlencode($deeplink), //DEEPLINK
        ];

        /**
         * Click Reference
         * Max.: 6
         */
        if($clickRef != null){
            if(is_array($clickRef)) {
                foreach($clickRef as $key => $value){
                    $keyForRef = $key+1;
                    $url_params_array['smc' . $keyForRef] = $value;
                }
            }
            else{
                $url_params_array['smc1'] = $clickRef;
            }
        }

        $url_params = http_build_query($url_params_array);

        return self::AFFILIATE_DOMAIN.$advertiseId.'/tsc?'.$url_params;
    }
}
