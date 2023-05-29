<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Article;

use App\Models\Article;
use Closure;
use Error;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteArticle extends Mutation
{
    protected $attributes = [
        'name' => 'article\DeleteArticle',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int()
            ]
        ];
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return auth()->user()->admin and Article::find($args['id'])->user_id == auth()->user()->id;
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $article = Article::find($args['id']);
        if(! $article) {
            throw new Error("Article not found!");
        }
        $delete_result = $article->delete();
        
        return $delete_result;
    }
}
