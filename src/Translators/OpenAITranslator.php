<?php

namespace Datashaman\LaravelTranslators\Translators;

use Datashaman\LaravelTranslators\Contracts\TranslatorInterface;
use OpenAI\Client;

class OpenAITranslator implements TranslatorInterface
{
    public function __construct(
        protected Client $client
    ) {}

    public function translate(
        array $contents,
        string $locale,
        array $options = []
    ): array {
        $contents = json_encode($contents, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

        $prompt = config('translators.services.openai.prompt');

        $prompt .= "\n\nTarget locale: {$locale}";
        $prompt .= "\n\nMessages:\n\n```\n{$contents}\n```\n";

        $messages = [
            [
                'role' => 'system',
                'content' => $prompt,
            ],
        ];

        $arguments = array_merge(
            [
                'model' => config('translators.services.openai.model'),
                'messages' => $messages,
                'response_format' => config('translators.services.openai.response_format'),
            ],
            $options
        );

        $response = $this->client->chat()->create($arguments);
        $content = json_decode($response->choices[0]->message->content, true, 512, JSON_THROW_ON_ERROR);

        return $content['translations'];
    }
}
