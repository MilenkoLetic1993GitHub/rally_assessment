<?php


namespace App\DataTransferObjects;


use Spatie\DataTransferObject\DataTransferObject;

class JsonApiCommentData extends DataTransferObject
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $name;

    /** @var string */
    public string $email;

    /** @var string */
    public string $body;

    /** @var int  */
    public int $post_id;

    /**
     * @param array $data
     * @return static
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public static function fromJSONPlaceholderApi(array $data): self
    {
        return new self([
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'body' => $data['body'],
            'post_id' => $data['postId'],
        ]);
    }
}
