<?php
namespace App\GraphQL\Query;

use App\Subscribes;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class SubscribesQuery extends Query
{

    public function authorize(array $args)
    {
        // true, if logged in
        return \Auth::check() && \Auth::user()->role->name == 'admin';
    }
    protected $attributes = [
        'name' => 'Subscribes query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Subscribes'));
    }


    //Subscribes{id,email}
    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'email' => ['name' => 'email', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Subscribes::where('id', $args['email'])->get();
        }
        if (isset($args['email'])) {
            return Subscribes::where('email', $args['email'])->get();
        }
        return Subscribes::all();
    }
}
