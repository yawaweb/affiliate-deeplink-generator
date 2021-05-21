<?php
/**
 * Ebay Deeplink Generator for Affiliates
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

class Ebay{

    /**
     * Rotate IDs
     */
    const countrys = [
        'at' => ['rotateId' => '5221-53469-19255-0', 'siteid' => 16, 'tld' => 'at'],
        'au' => ['rotateId' => '705-53470-19255-0', 'siteid' => 15, 'tld' => 'com.au'],
        'be' => ['rotateId' => '1553-53471-19255-0', 'siteid' => 23, 'tld' => 'be'],
        'ca' => ['rotateId' => '706-53473-19255-0', 'siteid' => 2, 'tld' => 'ca'],
        'ch' => ['rotateId' => '5222-53480-19255-0', 'siteid' => 193, 'tld' => 'ch'],
        'de' => ['rotateId' => '707-53477-19255-0', 'siteid' => 77, 'tld' => 'de'],
        'es' => ['rotateId' => '1185-53479-19255-0', 'siteid' => 186, 'tld' => 'es'],
        'fr' => ['rotateId' => '709-53476-19255-0', 'siteid' => 71, 'tld' => 'fr'],
        'ie' => ['rotateId' => '5282-53468-19255-0', 'siteid' => 205, 'tld' => 'ie'],
        'gb' => ['rotateId' => '710-53481-19255-0', 'siteid' => 3, 'tld' => 'co.uk'],
        'it' => ['rotateId' => '724-53478-19255-0', 'siteid' => 101, 'tld' => 'it'],
        'nl' => ['rotateId' => '1346-53482-19255-0', 'siteid' => 146, 'tld' => 'nl'],
        'pl' => ['rotateId' => '4908-226936-19255-0', 'siteid' => 212, 'tld' => 'pl'],
        'us' => ['rotateId' => '711-53200-19255-0', 'siteid' => 0, 'tld' => 'com']
    ];

    /**
     * Generate affiliate url for ebay
     * Description of url parameter: https://developer.ebay.com/api-docs/buy/static/ref-epn-link.html
     *
     * @param int $campaignId The unique EPN campaign ID assigned to the eBay partner.
     * @param string $country country of ebay in ISO 3166 Alpa-2 format (ex.: de for ebay.de)
     * @param string $deeplink your deeplink of ebay
     * @param string $clickRef click reference for your tracking
     * @param int $channelId The channel ID. Valid values: 1 – EPN, 2 – Paid Search, 3 – Natural Search, 4 – Display, 7 – Site Email, 8 – Marketing Email, 16 – Social Media
     * @param int $eventType The tracking event type. Valid values: 1 – Click, 2 – Impression, 3 – Viewable Impression
     * @param int $toolid The unique ID assigned to the data source (such as API, link generator, or data feed) that provided the link.
     * @return string
     */
    public function generate($campaignId, $country, $deeplink, $clickRef = null, $channelId = 1, $eventType = 1, $toolid = 10001)
    {
        $url_params_array = [
            'mkcid' => $channelId,
            'mkrid' => self::countrys[$country]['rotateId'],
            'siteid' => self::countrys[$country]['siteid'],
            'campid' => $campaignId,
            'customid' => $clickRef,
            'toolid' => $toolid,
            'mkevt' => $eventType
        ];

        $url_params = http_build_query($url_params_array);

        if (parse_url($deeplink, PHP_URL_QUERY)) {
            return $deeplink.'&'.$url_params;
        }

        return $deeplink.'?'.$url_params;
    }

    /**
     * Generate affiliate search url for ebay
     * Description of url parameter: https://developer.ebay.com/api-docs/buy/static/ref-epn-link.html
     *
     * @param int $campaignId The unique EPN campaign ID assigned to the eBay partner.
     * @param string $country country of ebay in ISO 3166 Alpa-2 format (ex.: de for ebay.de)
     * @param string $keyword keyword for search
     * @param null $clickRef click reference for your tracking
     * @param int $channelId The channel ID. Valid values: 1 – EPN, 2 – Paid Search, 3 – Natural Search, 4 – Display, 7 – Site Email, 8 – Marketing Email, 16 – Social Media
     * @param int $eventType The tracking event type. Valid values: 1 – Click, 2 – Impression, 3 – Viewable Impression
     * @param int $toolid The unique ID assigned to the data source (such as API, link generator, or data feed) that provided the link.
     * @return string
     */
    public function search($campaignId, $country, $keyword, $clickRef = null, $channelId = 1, $eventType = 1, $toolid = 10001)
    {
        $search = 'https://www.ebay.'.self::countrys[$country]['tld'].'/sch/?_nkw='.str_replace(' ', '+', $keyword);
        return $this->generate($campaignId, $country, $search, $clickRef, $channelId, $eventType, $toolid);
    }
}
