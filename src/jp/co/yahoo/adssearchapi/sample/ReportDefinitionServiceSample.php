<?php
/**
 * Copyright (C) 2020 Yahoo Japan Corporation. All Rights Reserved.
 */

namespace jp\co\yahoo\adssearchapi\sample;

require_once __DIR__ . '/../../../../../../vendor/autoload.php';

use Exception;
use GuzzleHttp\Client;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Api\ReportDefinitionServiceApi;
use OpenAPI\Client\Model\{
    ReportDefinition,
    ReportDefinitionServiceOperation,
    ReportDefinitionServiceReportDateRangeType,
    ReportDefinitionServiceReportDownloadEncode,
    ReportDefinitionServiceReportDownloadFormat,
    ReportDefinitionServiceReportType,
    ReportDefinitionServiceSelector,
    ReportDefinitionServiceReportJobStatus,
    ReportDefinitionServiceDownloadSelector
};


/**
 * example ReportDefinitionService operation and Utility method collection.
 */
class ReportDefinitionServiceSample
{

    private static $apiConfig = null;

    /**
     * example report fields.
     */
    const REPORT_FIELDS = [
        'ACCOUNT_ID',
        'IMPS',
        'CLICKS'
    ];

    /**
     * ReportDefinitionServiceSample constructor.
     */
    public static function init(): void
    {
        self::$apiConfig = parse_ini_file(__DIR__ . '/../../../../../../conf/api_config.ini');

    }

    /**
     * example ReportDefinitionService operation.
     * @throws Exception
     */
    public static function runExample(): void
    {
        self::init();

        $config = Configuration::getDefaultConfiguration()->setAccessToken(self::$apiConfig['accessToken']);

        $apiInstance = new ReportDefinitionServiceApi(
            new Client(),
            $config
        );
        $job_id = null;

        // Add
        $operand = new ReportDefinition();
        $operand->setAccountId(self::$apiConfig['accountId']);
        $operand->setReportName("REPORT_SAMPLE");
        $operand->setReportType(ReportDefinitionServiceReportType::ACCOUNT);
        $operand->setFields(self::REPORT_FIELDS);
        $operand->setReportDateRangeType(ReportDefinitionServiceReportDateRangeType::YESTERDAY);
        $operand->setReportDownloadEncode(ReportDefinitionServiceReportDownloadEncode::UTF8);
        $operand->setReportDownloadFormat(ReportDefinitionServiceReportDownloadFormat::CSV);

        $report_definition_service_operation = new ReportDefinitionServiceOperation();
        $report_definition_service_operation->setAccountId(self::$apiConfig['accountId']);
        $report_definition_service_operation->setOperand([$operand]);

        try {
            $result = $apiInstance->reportDefinitionServiceAddPost($report_definition_service_operation);

            $job_id = $result->getRval()->getValues()[0]->getReportDefinition()->getReportJobId();

        } catch (Exception $e) {
            echo 'Exception when calling ReportDefinitionServiceApi->reportDefinitionServiceAddPost: ', $e->getMessage(), PHP_EOL;
        }

        // Get
        $report_definition_service_selector = new ReportDefinitionServiceSelector();
        $report_definition_service_selector->setReportJobIds([$job_id]);
        $report_definition_service_selector->setAccountId(self::$apiConfig['accountId']);

        try {
            $result = $apiInstance->reportDefinitionServiceGetPost($report_definition_service_selector);
            $job_status = $result->getRval()->getValues()[0]->getReportDefinition()->getReportJobStatus();

            while($job_status != ReportDefinitionServiceReportJobStatus::COMPLETED){
                sleep(1);
                $result = $apiInstance->reportDefinitionServiceGetPost($report_definition_service_selector);
                $job_status = $result->getRval()->getValues()[0]->getReportDefinition()->getReportJobStatus();
            }

        } catch (Exception $e) {
            echo 'Exception when calling ReportDefinitionServiceApi->reportDefinitionServiceGetPost: ', $e->getMessage(), PHP_EOL;
        }

        // Download
        $report_definition_service_download_selector = new ReportDefinitionServiceDownloadSelector();
        $report_definition_service_download_selector->setAccountId(self::$apiConfig['accountId']);
        $report_definition_service_download_selector->setReportJobId($job_id);

        try {
            $data = $apiInstance->reportDefinitionServiceDownloadPost($report_definition_service_download_selector);

            if ( file_exists( './download/sample.csv' )) {
                unlink('./download/sample.csv');
            }

            foreach( $data as $line ) {
                file_put_contents('./download/'.'sample.csv', $line, FILE_APPEND);
            }
        } catch (Exception $e) {
            echo 'Exception when calling ReportDefinitionServiceApi->reportDefinitionServiceDownloadPost: ', $e->getMessage(), PHP_EOL;
        }

    }

}

if (__FILE__ != realpath($_SERVER['PHP_SELF'])) {
    return;
}

try {
    ReportDefinitionServiceSample::runExample();
} catch (Exception $e) {
    print $e->getMessage();
}
