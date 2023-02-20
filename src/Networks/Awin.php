<?php
/**
 * Awin Deeplink Generator for Affiliates
 *
 * @package   affiliate-deeplink-generator
 * @author    Ousama Yamine <hello@yawaweb.com>
 * @copyright 2016-2023 Yawaweb <hello@yawaweb.com>
 * @license   http://opensource.org/licenses/MIT MIT Public
 * @version   2.0.0
 * @sine      1.0.0
 * @link      https://yawaweb.com
 *
 */

namespace yawaweb\AffiliateDeeplinkGenerator\Networks;

class Awin
{
    public int $publisherId;
    public int $advertiserId;

    private null|string|array $clickRef = null;
    private null|string|array $campaignRef = null;

    /**
     * Affiliate Domain
     */
    public const AFFILIATE_DOMAIN = 'https://www.awin1.com/cread.php?';

    public function __construct(int $publisherId)
    {
        $this->publisherId = $publisherId;
    }

    public function setAdvertiserId(int $value): void
    {
        $this->advertiserId = $value;
    }

    /**
     * Click Reference (only available for clicks)
     * Max.: 6
     */
    public function setClickRef($value): void
    {
        $this->clickRef = $value;
    }

    /**
     * Max.: 6
     */
    public function setCampaignRef($value): void
    {
        $this->campaignRef = $value;
    }

    private function check($ref, $value): array
    {
        $result = [];

        if(is_array($value)) {
            foreach($value as $key => $row){
                $keyForRef = ($key == 0) ? '' : $key + 1;
                $result[$ref . $keyForRef] = $row;
            }

            return $result;
        }

        $result[$ref] = $value;

        return $result;
    }

    /**
     * Generate affiliate url for Awin
     * Description of url parameter: https://wiki.awin.com/index.php/Deeplink_Builder
     */
    public function getByDeeplink($value): string
    {
        $url_params_array = [];
        $url_params_array['awinmid'] = $this->advertiserId; //ADVERTISER_ID
        $url_params_array['awinaffid'] = $this->publisherId; //PUBLISHER_ID

        if($this->clickRef != null){
            $clickRef = $this->check('clickref', $this->clickRef);
            $url_params_array = array_merge($url_params_array, $clickRef);
        }

        if($this->campaignRef != null){
            $campaingRef = $this->check('campaign', $this->campaignRef);
            $url_params_array = array_merge($url_params_array, $campaingRef);
        }

        $url_params_array['ued'] = $value; //DEEPLINK

        $url_params = http_build_query($url_params_array);

        return self::AFFILIATE_DOMAIN.$url_params;
    }
}
