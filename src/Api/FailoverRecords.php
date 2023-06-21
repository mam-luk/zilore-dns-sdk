<?php

namespace Zilore\Api;

class FailoverRecords extends Client
{
    public function all(string $domain): array
    {
        return $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->get($this->baseUrl . '/dns/v1/domains/' . $domain . '/failovers/available')
            ->json('response');
    }

    public function list(string $domain): array
    {
        return $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->get($this->baseUrl . '/dns/v1/domains/' . $domain . '/failovers')
            ->json('response');
    }

    public function add(string $domain, int $recordId, string $checkType = 'HTTP', int $checkInterval = 60,
                        string $checkPath = '/', array $failOverValues = [], string $emails = '', string $smsPhones = '',
                        int $useFailoverFws = 0, int $returnToMainValue = 1, int $failOverPort = 80,
                        string $additionalRequest = '', string $additionalResponse = ''): bool
    {
        $x = $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->withBody(
                http_build_query(
                    [
                        'record_id' => $recordId,
                        'failover_check_type' => $checkType,
                        'failover_check_interval' => $checkInterval,
                        'failover_additional_path' => $checkPath,
                        'failover_record_backup_value' => $failOverValues,
                        'failover_notification_email' => $emails,
                        'failover_notification_sms' => $smsPhones,
                        'failover_use_fws' => $useFailoverFws,
                        'failover_return_to_main_value' => $returnToMainValue,
                        'failover_additional_port' => $failOverPort,
                        'failover_additional_response' => $additionalResponse,
                        'failover_additional_request' => $additionalRequest
                    ]
                ), 'application/x-www-form-urlencoded'
            )
            ->post($this->baseUrl . '/dns/v1/domains/' . $domain . '/failovers');

        if (!$x->ok()) {
            $this->logger->error($x->body());

            return false;
        }

        return true;
    }

    public function update(string $domain, int $failOverRecordId, string $checkType = 'HTTP', int $checkInterval = 60,
                           array $failOverValues = [], string $emails = '', string $smsPhones = '',
                           int $useFailoverFws = 0, int $returnToMainValue = 1, int $failOverPort = 80,
                           string $additionalRequest, string $additionalResponse): bool
    {
        $x =  $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->withBody(
                http_build_query(
                    [
                        'record_id' => $failOverRecordId,
                        'failover_check_type' => $checkType,
                        'failover_check_interval' => $checkInterval,
                        'failover_record_backup_value' => $failOverValues,
                        'failover_notification_email' => $emails,
                        'failover_notification_sms' => $smsPhones,
                        'failover_use_fws' => $useFailoverFws,
                        'failover_return_to_main_value' => $returnToMainValue,
                        'failover_additional_port' => $failOverPort,
                        'failover_additional_response' => $additionalResponse,
                        'failover_additional_request' => $additionalRequest
                    ]
                )
            )
            ->put($this->baseUrl . '/dns/v1/domains/' . $domain . '/failovers/' . $failOverRecordId);
        if (!$x->ok()) {
            $this->errors[] = $x->body();
            return false;
        }
    }

    public function delete(string $domain, string $failOverRecordIds): bool
    {
        $x = $this->http
                ->withHeaders(
                    [
                        'X-Auth-Key' => $this->apiKey
                    ]
                )
                ->delete($this->baseUrl . '/dns/v1/domains/' . $domain . '/failovers?record_id=' . $failOverRecordIds);

        if (!$x->ok()) {
            $this->errors[] = $x->body();
            return false;
        }

        return true;
    }



}