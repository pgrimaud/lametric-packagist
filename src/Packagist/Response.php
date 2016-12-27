<?php
namespace Lametric\Packagist;

class Response
{
    /**
     * @return mixed
     */
    public function setUnAuthorized()
    {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text' => 'Unknown package',
                    'icon' => 'i4663'
                ]
            ]
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function asJson($data = array())
    {
        header("Content-Type: application/json");
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * @param array $array
     * @return mixed
     */
    public function setData($array = [])
    {
        if ($array['downloads'] > 10e5) {
            $array['downloads'] = round(($array['downloads'] / 10e5), 2) . 'M';
        }

        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text' => $array['package'],
                    'icon' => 'i4663'
                ],
                [
                    'index' => 1,
                    'text' => $array['downloads'],
                    'icon' => 'i4663'
                ]
            ]
        ]);
    }
}
