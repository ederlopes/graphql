<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\GraphQL\Types\UserType;
use GraphQL;


class UserPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'userPaginateQuery',
        'description' => 'Paginate list of users'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('user');
    }

    public function args(): array
    {
        return [
            'paginate' => [
                'type' => Type::int(),
                'description' => 'Quantidade de registro por pagina'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'a partir de que pagina'
            ]
        ];
    }

    /* example
    {
    users_paginated(page:2){
    current_page,
    per_page,
    last_page,
    total,
    data{
    id,
    name,
    email
    }
    }
}*/
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields, SelectFields $fields)
    {

       $paginate = 15;

        if (isset($args['paginate'])){
            $paginate = $args['paginate'];
        }

        $page = 1;
        if (isset($args['page'])) {
            $page = $args['page'];
        }


        $with = $fields->getRelations();

        return User::with($with)->paginate($paginate, ['*'], 'page', $page);
    }
}
