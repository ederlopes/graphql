<?php

declare(strict_types=1);

namespace App\GraphQL\Types;


use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'Representa um post'
    ];

    public function fields(): array
    {
        return [
            'id' => [ //quando um campo fica com ! é porque ele nao pode ser nullo id: Int!
                'type' => Type::nonNull(Type::int()),
                'description' => 'O id do posts no banco'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'O title do title no banco'
            ],
            'active' => [
                'type' => Type::boolean(),
                'description' => 'O active do active no banco'
            ]
        ];
    }
}
