<?php

declare(strict_types=1);

namespace Shucream0117\DiscordPHP;

class Embed
{
    /** @var array<string, mixed> */
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function setTitle(?string $title): self
    {
        $title = $title ? mb_substr($title, 0, 256) : null;
        $this->data['title'] = $title;
        return $this;
    }

    public function setDescription(?string $description): self
    {
        $description = $description ? mb_substr($description, 0, 2048) : null;
        $this->data['description'] = $description;
        return $this;
    }

    public function setUrl(?string $url): self
    {
        $this->data['url'] = $url;
        return $this;
    }

    public function setTimestamp(?string $timestamp): self
    {
        $this->data['timestamp'] = $timestamp;
        return $this;
    }

    public function setColor(?string $color): self
    {
        $this->data['color'] = hexdec($color);
        return $this;
    }

    public function setFooter(?string $text, ?string $iconUrl = null): self
    {
        if (is_null($text) && is_null($iconUrl)) {
            $this->data['footer'] = null;
        } else {
            $this->data['footer'] = [
                'text' => $text,
                'icon_url' => $iconUrl,
            ];
        }
        return $this;
    }

    public function setImage(?string $url): self
    {
        $this->data['image'] = is_null($url) ? null : ['url' => $url];
        return $this;
    }

    public function setThumbnail(?string $url): self
    {
        $this->data['thumbnail'] = is_null($url) ? null : ['url' => $url];
        return $this;
    }

    public function setAuthor(?string $name, ?string $url = null, ?string $iconUrl = null): self
    {
        if (is_null($name) && is_null($url) && is_null($iconUrl)) {
            $this->data['author'] = null;
        } else {
            $this->data['author'] = [
                'name' => $name,
                'url' => $url,
                'icon_url' => $iconUrl,
            ];
        }
        return $this;
    }

    public function addField(string $name, string $value, bool $inline = false): self
    {
        $this->data['fields'][] = [
            'name' => $name,
            'value' => $value,
            'inline' => $inline,
        ];
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }
}
