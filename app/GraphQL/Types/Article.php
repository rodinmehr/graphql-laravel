<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Article extends GraphQLType
{
    protected $attributes = [
        'name' => 'Article',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'title' => [
                'type' => Type::string()
            ],
            'body' => [
                'type' => Type::string()
            ]
        ];
    }
}
