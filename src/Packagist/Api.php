<?php
namespace Lametric\Packagist;

use GuzzleHttp\Client;

class Api
{
    /** @var array */
    private $parameters = [];

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        $endpoint = 'https://packagist.org/packages/' . $this->parameters['package'] . '.json';

        $client = new Client();
        $result = $client->request('GET', $endpoint);

        $body = $result->getBody();

        $data = json_decode($body, JSON_OBJECT_AS_ARRAY);

        return [
            'downloads' => (int)$data['package']['downloads'][$this->parameters['period']] . $this->getSuffix(),
            'package' => $this->parameters['package']
        ];
    }

    /**
     * @return mixed
     */
    private function getSuffix()
    {
        $suffixes = [
            'total' => '',
            'monthly' => ' /m',
            'daily' => ' /d'
        ];

        return $suffixes[$this->parameters['period']];
    }
}
