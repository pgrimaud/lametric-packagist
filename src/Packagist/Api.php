<?php

declare(strict_types=1);

namespace Packagist;

use GuzzleHttp\Client;

class Api
{
    /** @var array */
    private array $parameters = [];

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResult(): array
    {
        $endpoint = 'https://packagist.org/packages/' . $this->parameters['package'] . '.json';

        $client = new Client();
        $result = $client->request('GET', $endpoint);

        $body = $result->getBody();

        $data = json_decode((string)$body, true);

        return [
            'downloads' => (int)$data['package']['downloads'][$this->parameters['period']],
            'suffix'    => $this->getSuffix(),
            'package'   => $this->parameters['package'],
        ];
    }

    /**
     * @return string
     */
    private function getSuffix(): string
    {
        $suffixes = [
            'total'   => '',
            'monthly' => '/m',
            'daily'   => '/d',
        ];

        return $suffixes[$this->parameters['period']];
    }
}
