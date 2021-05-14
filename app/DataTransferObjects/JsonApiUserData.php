<?php


namespace App\DataTransferObjects;


use Spatie\DataTransferObject\DataTransferObject;

class JsonApiUserData extends DataTransferObject
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $name;

    /** @var string */
    public string $email;

    /** @var string */
    public string $username;

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
            'username' => $data['username']
        ]);
    }
}
