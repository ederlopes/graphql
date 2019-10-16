<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;


use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\GraphQL\Types\PostType;
use GraphQL;
use App\Post;

class PostQuery extends Query
{
    protected $attributes = [
        'name' => 'postPaginateQuery',
        'description' => 'A query get Posts Paginate'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('post');
    }

    public function args(): array
    {
        return [

        ];
    }

    /*
    exemplo de utilização

    {
        users(paginate:5, page:3){
        id,name, email
      }
    }*/

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

       return Post::paginate();
    }

}

