<?php


namespace App\DataTransferObjects;


use Spatie\DataTransferObject\DataTransferObject;

class JsonApiPostData extends DataTransferObject
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $title;

    /** @var string */
    public string $body;

    /** @var int */
    public int $user_id;

    /**
     * @param array $data
     * @return static
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public static function fromJSONPlaceholderApi(array $data): self
    {
        return new self([
            'id' => $data['id'],
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => $data['userId']
        ]);
    }
}
