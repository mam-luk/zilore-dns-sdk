<?php

namespace Zilore\Api;

class Domains extends Client
{
    public function list(): array
    {
        return $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->get($this->baseUrl . '/dns/v1/domains')
            ->json('response');
    }

    public function add(string $domain): bool
    {
        $x = $this->http
            ->withHeaders(
                [
                    'X-Auth-Key' => $this->apiKey
                ]
            )
            ->post($this->baseUrl . '/dns/v1/domains?domain_name='.$domain);
        if (!$x->ok()) {
            $this->errors[] = $x->body();

            return false;
        }

        return true;
    }

    public function delete(string $domain): bool
    {
        $x = $this->http
                ->withHeaders(
                    [
                        'X-Auth-Key' => $this->apiKey
                    ]
                )
                ->delete($this->baseUrl . '/dns/v1/domains?domain_name='.$domain);
        if (!$x->ok()) {
            $this->errors[] = $x->body();

            return false;
        }

        return true;

    }



}