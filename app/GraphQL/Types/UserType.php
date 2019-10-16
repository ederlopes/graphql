<?php

declare(strict_types=1);

namespace App\GraphQL\Types;


use function foo\func;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use App\User;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type for Users',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [ //quando um campo fica com ! é porque ele nao pode ser nullo id: Int!
                'type' => Type::nonNull(Type::int()),
                'description' => 'O id do usuário no banco'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'O name do usuário no banco'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'O email do usuário no banco'
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('post')),
                'description' => 'Lista de post por usuario',
                'query' => function(array  $ars, $query){
                    return $query->where('posts.active', true);
                }
            ],
        ];
    }
}
