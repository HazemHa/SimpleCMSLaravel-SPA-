<?php
namespace App\GraphQL\Query;

use App\NavigationGroups;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class NavigationGroupsQuery extends Query
{
    protected $attributes = [
        'name' => 'NavigationGroups query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('NavigationGroups'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'slug' => ['name' => 'slug', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return NavigationGroups::where('id', $args['id'])->get();
        }

        if (isset($args['name'])) {
            return NavigationGroups::where('name', $args['name'])->get();
        }
        if (isset($args['slug'])) {
            return NavigationGroups::where('slug', $args['slug'])->get();
        }
        return NavigationGroups::all();
    }
}