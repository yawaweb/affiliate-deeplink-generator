<?php
/**
 * Belboon Deeplink Generator for Affiliates
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

class Belboon
{
    private int $publisherId;
    private string $trackingBaseUrl;
    private string $advertiseId = '';
    private int $adSpaceId;
    private int $creativesId;
    private string|array|null $clickRef = null;

    /**
     * @param int $publisherId
     * @param int $adSpaceId  ID der Werbefläche (z.B.: affiliatesite.com)
     */
    public function __construct(int $publisherId, int $adSpaceId)
    {
        $this->publisherId = $publisherId;
        $this->adSpaceId = $adSpaceId;
    }

    /**
     * ex.: https://luna.r.lafamo.com/ts/
     *
     * @param string $trackingBaseUrl
     */
    public function setTrackingBaseUrl(string $trackingBaseUrl): void
    {
        if(str_ends_with($trackingBaseUrl, '/')) {
            $this->trackingBaseUrl = $trackingBaseUrl;
            return;
        }

        $this->trackingBaseUrl = $trackingBaseUrl.'/';
    }

    /**
     * ID des Werbemittels (z.B.: Deeplink)
     *
     *
     * @param int $creativesId deeplinkAdmediaId
     */
    public function setCreativesId(int $creativesId): void
    {
        $this->creativesId = $creativesId;
    }

    /**
     * Externe ID des Advertiser
     * @param string $advertiserId
     */
    public function setAdvertiseId(string $advertiseId): void
    {
        $this->advertiseId = $advertiseId.'/';
    }

    /**
     * Klick Referenz wenn nur eins da ist dann String wenn mehrere dann array (['ref1', 'ref2'])
     *
     * @param array|string|null $clickRef
     */
    public function setClickRef(array|string|null $clickRef): void
    {
        $this->clickRef = $clickRef;
    }

    public function getByDeeplink($deeplink): string
    {
        $url_params_array['amc'] = 'con.blbn.'.$this->publisherId.'.'.$this->adSpaceId.'.'.$this->creativesId;

        /**
         * Click Reference
         * Max.: 6
         */
        if($this->clickRef != null){
            if(is_array($this->clickRef)) {
                foreach($this->clickRef as $key => $value){
                    $keyForRef = $key+1;
                    $url_params_array['smc' . $keyForRef] = $value;
                }
            }
            else{
                $url_params_array['smc1'] = $this->clickRef;
            }
        }

        $url_params_array['rmd'] = 3;
        $url_params_array['trg'] = $deeplink;

        $url_params = http_build_query($url_params_array);

        return $this->trackingBaseUrl.$this->advertiseId.'tsc?'.$url_params;
    }
}
