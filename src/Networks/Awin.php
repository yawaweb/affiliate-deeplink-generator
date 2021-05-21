<?php
/**
 * Awin Deeplink Generator for Affiliates
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

class Awin
{
    /**
     * Affiliate Domain
     */
    const AFFILIATE_DOMAIN = 'https://www.awin1.com/cread.php?';

    /**
     * Generate affiliate url for Awin
     * Description of url parameter: https://wiki.awin.com/index.php/Deeplink_Builder
     *
     * @param int $publisherId
     * @param int $advertiserId
     * @param string $deeplink
     * @param string $clickRef
     * @param string $viewRef
     * @param string $pRef
     * @return string
     */
    public function generate($publisherId, $advertiserId, $deeplink, $clickRef = null, $viewRef = null, $pRef = null)
    {
        $url_params_array = [];
        $url_params_array['awinmid'] = $advertiserId; //ADVERTISER_ID
        $url_params_array['awinaffid'] = $publisherId; //PUBLISHER_ID

        /**
         * Publisher Reference (available for clicks and views)
         * Max.: 6
         */
        if($pRef != null){
            if(is_array($pRef)) {
                foreach($pRef as $key => $value){
                    $keyForRef = $key+1;
                    $url_params_array['pref' . $keyForRef] = $value;
                }
            }
            else{
                $url_params_array['pref1'] = $pRef;
            }
        }

        /**
         * Click Reference (only available for clicks)
         * Max.: 6
         */
        if($clickRef != null){
            if(is_array($clickRef)) {
                foreach($clickRef as $key => $value){
                    $keyForRef = ($key == 0) ? '' : $key+1;
                    $url_params_array['clickref' . $keyForRef] = $value;
                }
            }
            else{
                $url_params_array['clickref'] =$clickRef;
            }
        }

        /**
         * View Reference (only available for views)
         * Max.: 6
         */
        if($viewRef != null){
            if(is_array($viewRef)) {
                foreach($viewRef as $key => $value){
                    $keyForRef = $key+1;
                    $url_params_array['viewref' . $keyForRef] = $value;
                }
            }
            else{
                $url_params_array['viewref1'] = $viewRef;
            }
        }

        $url_params_array['ued'] = $deeplink; //DEEPLINK

        $url_params = http_build_query($url_params_array);

        return self::AFFILIATE_DOMAIN.$url_params;
    }
}
