<?php
namespace App\GraphQL\Query;

use App\Users;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Auth;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'Users query'
    ];

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check() && $args['id'] == Auth::id();
    }


    public function type()
    {
        return Type::listOf(GraphQL::type('Users'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'about' => ['name' => 'about', 'type' => Type::string()],
            'image' => ['name' => 'image', 'type' => Type::string()],
            'about' => ['name' => 'about', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {


        if (isset($args['id'])) {
            return Users::where('id', $args['id'])->get();
        }

        if (isset($args['name'])) {
            return Users::where('name', $args['name'])->get();
        }
        if (isset($args['about'])) {
            return Users::where('about', $args['about'])->get();
        }
        if (isset($args['email'])) {
            return Users::where('email', $args['email'])->get();
        }
        if (isset($args['image'])) {
            return Users::where('image', $args['image'])->get();
        }
        if (isset($args['email_verified_at'])) {
            return Users::where('email_verified_at', $args['email_verified_at'])->get();
        }
        if (isset($args['about'])) {
            return Users::where('about', $args['about'])->get();
        }
        if (isset($args['password'])) {
            return Users::where('password', $args['password'])->get();
        }

        return Users::all();
    }
}