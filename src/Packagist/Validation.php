<?php
namespace Lametric\Packagist;

class Validation
{
    /**
     * @var array
     */
    private $parameters = [
        'package',
        'period'
    ];

    /**
     * @var array
     */
    private $period = [
        'total',
        'monthly',
        'daily'
    ];

    /**
     * Validation constructor.
     * @param array $parameters
     * @throws \Exception
     */
    public function __construct($parameters = [])
    {
        foreach ($this->parameters as $name) {
            if (empty($parameters[$name])) {
                throw new \Exception('Missing parameter');
            }

            if ($name == 'period' && !in_array($parameters[$name], $this->period)) {
                throw new \InvalidArgumentException('Invalid period');
            }

            $this->parameters[$name] = addslashes(urldecode($parameters[$name]));
        }
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param $parameter
     * @return mixed|null
     */
    public function getParameter($parameter)
    {
        return isset($this->parameters[$parameter]) ? $this->parameters[$parameter] : null;
    }
}