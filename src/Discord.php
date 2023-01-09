<?php

declare(strict_types=1);

namespace Shucream0117\DiscordPHP;

use GuzzleHttp\Client;

class Discord
{
    private string $incomingWebHookUrl;
    private Client $httpClient;

    public function __construct(string $webhookUrl, ?Client $client = null)
    {
        $this->incomingWebHookUrl = $webhookUrl;
        $this->httpClient = $client ?: new Client();
    }

    /**
     * @param string $message
     * @param string[] $mentionMemberIds ユーザー名ではないDiscordの内部ID的なもの(snowflake)。
     * @return void
     */
    public function sendText(string $message, array $mentionMemberIds = []): void
    {
        $mention = '';
        foreach ($mentionMemberIds as $id) {
            $mention .= "<@{$id}> ";
        }
        $this->httpClient->post($this->incomingWebHookUrl, [
            'json' => [
                'content' => $mention . $message,
            ],
        ]);
    }
}
