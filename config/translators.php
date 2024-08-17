<?php

return [
    'default' => env('TRANSLATOR_DRIVER', 'openai'),

    'services' => [
        'azure' => [
            'key' => env('TRANSLATORS_AZURE_KEY'),
            'region' => env('TRANSLATORS_AZURE_REGION', 'westus'),
        ],

        'deepl' => [
            'api_key' => env('TRANSLATORS_DEEPL_API_KEY'),
        ],

        'google-v2' => [
            'project' => env('TRANSLATORS_GOOGLE_KEY'),
        ],

        'google-v3' => [
            'project' => env('TRANSLATORS_GOOGLE_PROJECT'),
        ],

        'openai' => [
            'api_key' => env('TRANSLATORS_OPENAI_API_KEY', env('OPENAI_API_KEY')),
            'model' => env('TRANSLATORS_OPENAI_MODEL', 'gpt-4o-mini'),
            'prompt' => 'Translate the following list of messages into the target locale. Preserve the original meaning and formatting.',
            'response_format' => [
                'type' => 'json_schema',
                'json_schema' => [
                    'name' => 'translation',
                    'strict' => true,
                    'schema' => [
                        'type' => 'object',
                        'properties' => [
                            'translations' => [
                                'type' => 'array',
                                'description' => 'List of translated messages in the same order as the input',
                                'items' => [
                                    'type' => 'string',
                                    'description' => 'Translated message',
                                ],
                            ],
                        ],
                        'required' => ['translations'],
                        'additionalProperties' => false,
                    ],
                ],
            ],
        ],
    ],
];
