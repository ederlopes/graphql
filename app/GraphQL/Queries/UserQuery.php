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

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A query get Users'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [
            'id' => [ //quando um campo fica com ! é porque ele nao pode ser nullo id: Int!
                'type' => Type::int(),
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
        if (isset($args['id'])){
            return User::where("id", $args['id'])->get();
        }


        if (isset($args['name'])){
            return User::where("name", 'like', '%'.$args['name'].'%')->get();
        }

       return User::all();
    }

}

