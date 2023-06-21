<?php

namespace Zilore\Api;

class GeoRecords extends Client
{
    public function all(string $domain): array
    {
        return $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->get($this->baseUrl . '/dns/v1/domains/' . $domain . '/geo/defaults')
            ->json();
    }

    public function list(string $domain): array
    {
        return $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->get($this->baseUrl . '/dns/v1/domains/' . $domain . '/geo')
            ->json('response');
    }

    public function add(string $domain, string $type, string $name, string $value, string $region): bool
    {

        $r = $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->withBody(
                http_build_query(
                    [
                        'record_name' => $name,
                        'record_type' => $type,
                        'record_value' => $value,
                        'geo_region' => $region
                    ]
                ), 'application/x-www-form-urlencoded'
            )
            ->post($this->baseUrl . '/dns/v1/domains/' . $domain . '/geo');

        if (!$r->ok()) {
            $this->errors[] = $r->body();
            return false;
        }

        return true;

    }

    public function update(string $domain, int $recordId, string $value, string $region): bool
    {
        $r = $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->withBody(
                http_build_query(
                    [
                        'record_value' => $value,
                        'geo_region' => $region
                    ]
                ), 'application/x-www-form-urlencoded'
            )
            ->put($this->baseUrl . '/dns/v1/domains/' . $domain . '/geo/' . $recordId);
        if (!$r->ok()) {
            $this->errors[] = $r->body();
            return false;
        }

        return true;
    }

    public function delete(string $domain, int $recordId): bool
    {
        $r = $this->http
                ->withHeaders(
                    [
                        'X-Auth-Key' => $this->apiKey
                    ]
                )
                ->delete($this->baseUrl . '/dns/v1/domains/' . $domain . '/records?record_id' . $recordId);
        if (!$r->ok()) {
            $this->errors[] = $r->body();
            return false;
        }

        return true;
    }



}