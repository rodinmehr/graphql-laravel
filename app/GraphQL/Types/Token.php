<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Token extends GraphQLType
{
    protected $attributes = [
        'name' => 'Token',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'token' => [
                'type' => Type::string()
            ],
            'user' => [
                'type' => GraphQL::type('User')
            ]
        ];
    }
}
