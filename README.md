# Xlsx to json converter

Made with php, and PhpSpreadsheet
https://github.com/PHPOffice/PhpSpreadsheet

# Install

1 . Clone repository

```
git clone https://github.com/Blackblackofficial/Converter
```

2 . Install dependencies

```
composer install
```

# Usage

1 . Set filenames in ```convert.php or test.php```

``` To Json
$inputFileName = './order.xlsx';
$outputFileName = './data/items.json';
```
``` To Xlsx
$inputFileName = './order.json';
$outputFileName = './items.xlsx';
```

2 . Convert to json

```
php convert.php
```# Converter
```

3 . Convert to Xlsx

```
php test.php or export.php
```# Converter
