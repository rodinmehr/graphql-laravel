<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Article;

use App\Models\Article;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateArticle extends Mutation
{
    protected $attributes = [
        'name' => 'article\CreateArticle',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Article');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::string()
            ],
            'body' => [
                'type' => Type::string()
            ]
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'title' => ['required', 'string', 'min:5'],
            'body' => ['required', 'string', 'min:5'],
        ];
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        $is_admin = auth()->user()->admin;
        return $is_admin==0?false:true;
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $article = auth()->user()->articles()->create([
            'title' => $args['title'],
            'body' => $args['body']
        ]);
        // $article = Article::create([
        //     'user_id' => 2,
        //     'title' => $args['title'],
        //     'body' => $args['body']
        // ]);
        return $article;
    }
}
