<?php
/**
 * Belboon Deeplink Generator for Affiliates
 *
 * @package   affiliate-deeplink-generator
 * @author    Ousama Yamine <hello@yawaweb.com>
 * @copyright 2016-2021 Yawaweb <hello@yawaweb.com>
 * @license   http://opensource.org/licenses/MIT MIT Public
 * @version   1.0.2
 * @link      https://yawaweb.com
 *
 */

namespace yawaweb\AffiliateDeeplinkGenerator\Networks;

class Belboon
{

    /**
     * Generate affiliate url for Belboon
     * Description of url parameter: https://ingenioustechnologies.atlassian.net/wiki/spaces/KB/pages/1440383093/Working+with+deeplinks
     *
     * @param string $affiliate_domain ex.: https://luna.r.lafamo.com/ts/
     * @param int $publisherId Affiliate ID
     * @param string $advertiseId Externe ID des Advertiser
     * @param int $adspaceId ID der Werbefläche (z.B.: affiliatesite.com)
     * @param int $creativesId ID des Werbemittels (z.B.: Deeplink)
     * @param string $deeplink Url vom Shop
     * @param string|array $clickRef Klick Referenz wenn nur eins da ist dann String wenn mehrere dann array (['ref1', 'ref2'])
     * @return string Trackingurl
     */
    public function generate($affiliate_domain, $publisherId, $advertiseId, $adspaceId, $creativesId, $deeplink, $clickRef = null)
    {
        $url_params_array['amc'] = 'con.blbn.'.$publisherId.'.'.$adspaceId.'.'.$creativesId;


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

        $url_params_array['rmd'] = 3;
        $url_params_array['trg'] = $deeplink;

        $url_params = http_build_query($url_params_array);

        return $affiliate_domain.$advertiseId.'/tsc?'.$url_params;
    }
}
