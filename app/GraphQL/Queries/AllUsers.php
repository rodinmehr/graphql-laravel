<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class AllUsers extends Query
{
    protected $attributes = [
        'name' => 'allUsers',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        // return Type::listOf(GraphQL::type('User'));
        return GraphQL::paginate('User');
    }

    public function args(): array
    {
        return [
            'page' => [
                'type' => Type::int()
            ],
            'limit' => [
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $page = $args['page'] ?? 1;
        $limit = $args['limit'] ?? 10;
        // $users = User::all();
        $users = User::paginate($limit, ['*'], 'page', $page);
        return $users;
    }
}
