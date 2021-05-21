# affiliate-deeplink-generator
Create dynamic affiliate deeplink urls from different networks.

Requirements
------------
- PHP >=7.4

Supported Affiliate Networks
------------

- Ebay
- Awin
- Belboon
- Digistore24

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```bash
composer require --prefer-dist yawaweb/affiliate-deeplink-generator "*"
```

Usage
-----

Once the is installed, simply use it in your code. The following example shows you how to create a valid tracking url. 

For awin :

```php
use yawaweb\AffiliateDeeplinkGenerator\Networks\Awin;

$awin = new Awin();
$awin->generate(YOUR_PUBLISHER_ID, ADVERTISER_ID,'https://www.shop.de/search/?sSearch=football', 'custom click ref', 'custom view ref', 'custom page ref');
```

this generates:

```bash
https://www.awin1.com/cread.php?awinmid=123456&awinaffid=123456&pref1=custom+page+ref&clickref=custom+click+ref&viewref1=custom+view+ref&ued=https%3A%2F%2Fwww.shop.de%2Fsearch%2F%3FsSearch%3Dfootball
```
