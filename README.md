# Affiliate Deeplink Generator 2.0
Create dynamic affiliate deeplink urls from different networks.

Requirements
------------
- PHP >=8.0

Supported Affiliate Networks
------------

- Ebay
- Awin
- Belboon
- Digistore24

You are welcome to make a pull request with more choices.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```bash
composer require yawaweb/affiliate-deeplink-generator
```

Usage
-----

Once the is installed, simply use it in your code. The following example shows you how to create a valid tracking url. 

For awin :

```php
use yawaweb\AffiliateDeeplinkGenerator\Networks\Awin;

$awin = new Awin(123456789); //Publisher ID
$awin->setAdvertiserId(1234); //REQUIRED
$awin->setCampaignRef('myCampaign'); //OPTIONAL
$awin->setClickRef('custom click reference'); //OPTIONAL

$awin->getByDeeplink('https://www.example.com/search/?sSearch=football');
```

this generates:

```
https://www.awin1.com/cread.php?awinmid=123&awinaffid=123456789&clickref=custom+click+ref&campaign=myCampaign&ued=https%3A%2F%2Fwww.example.com%2Fsearch%2F%3FsSearch%3Dfootball
```
