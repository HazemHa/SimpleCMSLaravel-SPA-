<?php
namespace App\GraphQL\Query;

use App\Category;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'Category query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Category'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],

            'name' => ['name' => 'name', 'type' => Type::string()],

            'description' => ['name' => 'description', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Category::where('id', $args['id'])->get();
        }

        if (isset($args['name'])) {
            return Category::where('name', $args['name'])->get();
        }
        if (isset($args['description'])) {
            return Category::where('description', $args['description'])->get();
        }
        return Category::all();
    }
}