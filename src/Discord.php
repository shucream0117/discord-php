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
     * テキストメッセージだけ送信
     *
     * @param string $message
     * @param string[] $mentionMemberIds ユーザー名ではないDiscordの内部ID的なもの
     * @param string[] $mentionRoleIds ロール名ではないDiscordの内部ID的なもの
     * @return void
     */
    public function sendText(string $message, array $mentionMemberIds = [], array $mentionRoleIds = []): void
    {
        $this->sendTextWithEmbeds($message, [], $mentionMemberIds, $mentionRoleIds);
    }

    /**
     * Embed付きメッセージを送信
     *
     * @param string|null $message
     * @param Embed[] $embeds
     * @param string[] $mentionMemberIds ユーザー名ではないDiscordの内部ID的なもの
     * @param string[] $mentionRoleIds ロール名ではないDiscordの内部ID的なもの
     * @return void
     */
    public function sendTextWithEmbeds(
        ?string $message,
        array $embeds,
        array $mentionMemberIds = [],
        array $mentionRoleIds = []
    ): void {
        $mention = $this->createMentionLine($mentionMemberIds, $mentionRoleIds);
        $this->httpClient->post($this->incomingWebHookUrl, [
            'json' => [
                'content' => $mention . $message,
                'embeds' => array_map(fn(Embed $e) => $e->getData(), $embeds),
            ],
        ]);
    }

    /**
     * @param string[] $mentionMemberIds
     * @param string[] $mentionRoleIds
     * @return string
     */
    private function createMentionLine(array $mentionMemberIds, array $mentionRoleIds): string
    {
        $mention = '';
        foreach ($mentionMemberIds as $id) {
            $mention .= "<@{$id}> ";
        }
        foreach ($mentionRoleIds as $id) {
            $mention .= "<@&{$id}> ";
        }
        return $mention;
    }
}
