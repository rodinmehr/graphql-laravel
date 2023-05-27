<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Illuminate\Pagination\LengthAwarePaginator;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ResultArticles extends GraphQLType
{
    protected $attributes = [
        'name' => 'ResultArticles',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'articles' => [
                'type' => Type::listOf(GraphQL::type("Article")),
                // 'resolve' => function ($data) {
                //     return $data->getCollection();
                // }
            ],
            'total' => [
                'type' => Type::int(),
                // 'resolve' => function ($data) {
                //     return $data->total();
                // }
            ],
            'current_page' => [
                'type' => Type::int(),
                // 'resolve' => function (LengthAwarePaginator $data) {
                //     return $data->currentPage();
                // }
            ]
        ];
    }

    protected function resolveArticlesField(LengthAwarePaginator $data, $args)
    {
        return $data->getCollection();
    }

    protected function resolveTotalField(LengthAwarePaginator $data, $args)
    {
        return $data->total();
    }

    protected function resolveCurrentPageField(LengthAwarePaginator $data, $args)
    {
        return $data->currentPage();
    }
}
