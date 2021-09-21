--------------------------------
【バージョン】
--------------------------------
v6


--------------------------------
【概要】
--------------------------------
このサンプルプログラムは、PHPを使用して各APIを呼び出す処理のサンプルです。

--------------------------------
【内容物】
--------------------------------
conf/
  - api_config.ini      : 各種IDを記述する設定ファイルです。

src/jp/co/yahoo/adssearchapi
  - sample/             : レポートのサンプルです。

--------------------------------
【環境設定】
--------------------------------
PHP環境を構築するために、以下をインストールしてください。

1. PHP 7.1以上のバージョン
2. Composer 1.9.3以上
3. OpenAPI generator 4.2.3以上の4.x系
4. confディレクトリ配下にあるapi_config.iniに各IDを記述します。
  - accountId          : アカウントIDを記述してください(必須)。
  - accessToken        : アクセストークンを記述してください(必須)。

--------------------------------
【実行】
--------------------------------
OpenAPI Generatorを実行しPHP用のclientを生成します。
※インストール方法によってOpenAPI Generatorの実行方法に違いがあります。該当の例はHomebrewでインストールした場合
```
openapi-generator generate -i https://yahoojp-marketing.github.io/ads-search-api-documents/design/v6/Route.yaml -g php -o ./
```

直下にcomposer.jsonが生成されますので、clientのinstallを実行する。
```
composer install
```

実行例
```
php ./src/jp/co/yahoo/adssearchapi/sample/ReportDefinitionServiceSample.php
```

--------------------------------
ご注意：　Yahoo!広告 検索広告 API - サンプルコードの利用に関して
--------------------------------

Yahoo! JAPANの提供するAPIに関するサンプルコードは、別途Yahoo! JAPANとの間で締結いただいた当該APIの提供に関する契約に基づき、APIユーザー様に提供されるものであり、Yahoo! JAPANとの間で当該契約を締結いただいていない場合は、サンプルコードをご利用いただけません。
また、APIユーザー様に予め通知することなく、サンプルコードの内容や仕様の変更または提供の停止もしくは中止をする場合があります。ご了承のうえご利用ください。
