<?php


namespace App\DataTransferObjects;


class JsonApiDataCollection
{
    /**
     * @param array $data
     * @param $callback
     * @return array|JsonApiDataCollection
     */
    public static function create(array $data, $callback): array
    {
        $collection = [];

        foreach ($data as $item) {
            $collection[] = $callback($item);
        }

        return $collection;
    }
}
