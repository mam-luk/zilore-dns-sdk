<?php

namespace Zilore\Api;

class Records extends Client
{
    public function list(string $domain, array $queryParams = []): array
    {
        return $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->get($this->baseUrl . '/dns/v1/domains/' . $domain . '/records' . http_build_query($queryParams))
            ->json('response');
    }

    public function add(string $domain, string $type, string $name, string $value, int $ttl): bool
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
                        'record_type' => $type,
                        'record_name' => $name,
                        'record_value' => $value,
                        'record_ttl' => $ttl
                    ]
                ), 'application/x-www-form-urlencoded'
            )
            ->post($this->baseUrl . '/dns/v1/domains/' . $domain . '/records');
        if (!$r->ok()) {
            $this->errors[] = $r->body();

            return false;
        }

        return true;
    }

    public function update(string $domain, int $recordId, string $type, string $name, string $value, int $ttl): bool
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
                        'record_type' => $type,
                        'record_name' => $name,
                        'record_value' => $value,
                        'record_ttl' => $ttl
                    ]
                ) , 'application/x-www-form-urlencoded'
            )
            ->put($this->baseUrl . '/dns/v1/domains/' . $domain . '/records/' . $recordId);
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
                ->delete($this->baseUrl . '/dns/v1/domains/' . $domain . '/records?record_id=' . $recordId);

        if (!$r->ok()) {
            $this->errors[] = $r->body();

            return false;
        }

        return true;
    }

}
