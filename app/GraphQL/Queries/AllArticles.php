<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Article;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class AllArticles extends Query
{
    protected $attributes = [
        'name' => 'allArticles',
        'description' => 'A query for returning all articles'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $articles = Article::all()->pluck('title');
        return $articles;
    }
}
