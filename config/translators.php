<?php

return [
    'default' => env('TRANSLATOR_DRIVER', 'openai'),

    'services' => [
        'azure' => [
            'key' => env('TRANSLATORS_AZURE_KEY'),
            'region' => env('TRANSLATORS_AZURE_REGION', 'westus'),
            'options' => [
                'api-version' => '3.0',
            ],
        ],

        'deepl' => [
            'api_key' => env('TRANSLATORS_DEEPL_API_KEY'),
            'options' => [],
        ],

        'google-v2' => [
            'construct' => [
                'keyFilePath' => env('TRANSLATORS_GOOGLE_KEY_FILE', base_path('keys/google.json')),
            ],
            'options' => [
                'format' => 'text',
            ],
        ],

        'google-v3' => [
            'project' => env('TRANSLATORS_GOOGLE_PROJECT', env('GOOGLE_CLOUD_PROJECT')),
            'options' => [],
        ],

        'openai' => [
            'api_key' => env('TRANSLATORS_OPENAI_API_KEY', env('OPENAI_API_KEY')),
            'prompt' => 'Translate the following list of messages into the target locale. Preserve the original meaning and formatting.',
            'options' => [
                'model' => env('TRANSLATORS_OPENAI_MODEL', 'gpt-4o-mini'),

                // You probably don't want to change this
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
    ],
];
