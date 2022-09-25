<h1 align="center">
  <br>
	<img alt="Adobe logo" height="50px" src="https://www.adobe.com/content/dam/cc/icons/Adobe_Corporate_Horizontal_Red_HEX.svg"/>
  <br>
  Magento 2 Export Reviews Extension
  <br>
  <a href="https://packagist.org/packages/pauloharaujos/magento2-export-reviews"><img src="https://img.shields.io/packagist/v/pauloharaujos/magento2-export-reviews.svg" alt="Magento 2 Export Reviews Stable Version"/></a>
  <a href="https://packagist.org/packages/pauloharaujos/magento2-export-reviews"><img src="https://img.shields.io/packagist/dt/pauloharaujos/magento2-export-reviews.svg" alt="Magento 2 Export Reviews Stable Version"/></a>
</h1>


## How does it works?

Export your product reviews to a CSV File

## Install

### Via Composer

Install using [Composer](https://getcomposer.org).

```
composer require pauloharaujos/magento2-export-reviews
php bin/magento module:enable PHAS_ExportReviews
php bin/magento setup:upgrade
```

## How to use

```
php bin/magento phas:export_reviews
```

[Paulo Henrique Araujo da Silva](https://github.com/pauloharaujos)