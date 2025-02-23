# Discord client for PHP

## Requirement

- PHP >= 7.4.x

## Installation

via composer.

```console
$ composer require shucream0117/discord-php
```

## Usage

```php
$discord = new Discord('http://your-discord-incoming-webhook-url');

// send a message with mention
$discord->sendText('this message will be posted');

// send a message with mention
$discord->sendText('mention!!', ['12345678']);

// send a message with embeds
$discord->sendTextWithEmbeds(
    'this message will be posted with embeds', 
    [(new Embed())->setTitle('title')]
);
```
