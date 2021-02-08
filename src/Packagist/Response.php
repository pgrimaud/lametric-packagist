<?php

declare(strict_types=1);

namespace Packagist;

class Response
{
    /**
     * @return string
     */
    public function setUnAuthorized(): string
    {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text'  => 'Unknown package',
                    'icon'  => 'i4663',
                ],
            ],
        ]);
    }

    /**
     * @param array $data
     * @return string
     */
    public function asJson(array $data = []): string
    {
        header("Content-Type: application/json");
        return json_encode($data);
    }

    /**
     * @param array $array
     *
     * @return string
     */
    public function setData(array $array = []): string
    {
        if ($array['downloads'] > 10e5) {
            $array['downloads'] = round(($array['downloads'] / 10e5), 2) . 'M';
        }

        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text'  => $array['package'],
                    'icon'  => 'i4663',
                ],
                [
                    'index' => 1,
                    'text'  => $array['downloads'],
                    'icon'  => 'i4663',
                ],
            ],
        ]);
    }
}
