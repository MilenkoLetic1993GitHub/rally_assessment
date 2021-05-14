<?php


namespace App\Support;


use App\Contracts\Services\Support\HttpClientInterface;
use GuzzleHttp\Client;

class HttpClient implements HttpClientInterface
{
    /** @var \GuzzleHttp\Client */
    private Client $client;

    /**
     * HttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @param array $query
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function get(string $url, array $query = []): array
    {
        try {
            $response = $this->client->request('GET', $url,[
                'query' => $query
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to get resource ' . $url, $e);
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
