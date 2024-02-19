--------------------------------
[Version]
--------------------------------
v13


--------------------------------
[Overview]
--------------------------------
These code samples describe how to use PHP to call APIs.

--------------------------------
[Contents]
--------------------------------
conf/
  - api_config.ini      : Config files to specify IDs.

src/jp/co/yahoo/adssearchapi
  - sample/             : Examples of Report services.

--------------------------------
[Development environment]
--------------------------------
To construct PHP environment, install followings.

1. PHP 8.1.x or above
2. Composer 2.4.2 or above
3. OpenAPI generator 6.2.0 or above
4. Set the following environment variables.
    - ACCOUNT_ID          : Account ID (required)
    - ACCESS_TOKEN        : Access token (required)
    - BASE_ACCOUNT_ID     : Account ID that should be specified in 'x-z-base-account-id' header. (required)

--------------------------------
[How to execute Sample Code]
--------------------------------
Move to the directory where you stored the cloned sample program, and execute OpenAPI Generator to generate a PHP client.
```
openapi-generator generate -i https://yahoojp-marketing.github.io/ads-search-api-documents/design/v13/Route.yaml -g php -o ./
```

Then, composer.json is generated immediately below, so execute client install.
```
composer install
```

Execution example
```
php ./src/jp/co/yahoo/adssearchapi/sample/ReportDefinitionServiceSample.php
```

--------------------------------
NOTICE：　Yahoo! JAPAN Ads Search Ads API - For use of sample code
--------------------------------


The sample code of Yahoo! JAPAN Ads API is provided to API users only who concluded the contract of "Application to Use Yahoo! JAPAN Ads API" with LY Corporation.

Additionally, please note that LY Corporation may change the contents and the specification of the sample code, and may discontinue providing the sample code without any notice.
