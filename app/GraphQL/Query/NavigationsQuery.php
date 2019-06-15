<?php
namespace App\GraphQL\Query;

use App\Navigations;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class NavigationsQuery extends Query
{
    protected $attributes = [
        'name' => 'Navigations query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Navigations'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'link_text' => ['name' => 'link_text', 'type' => Type::string()],
            'url' => ['name' => 'url', 'type' => Type::string()],
            'description' => ['name' => 'description', 'type' => Type::string()],
            'group_id' => ['name' => 'group_id', 'type' => Type::string()],
            'click_count' => ['name' => 'click_count', 'type' => Type::string()],

            'groupNavigation' => ['name' => 'groupNavigation', 'type' => GraphQL::type('NavigationGroups')],
        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Navigations::where('id', $args['id'])->get();
        }
        if (isset($args['link_text'])) {
            return Navigations::where('link_text', $args['link_text'])->get();
        }
        if (isset($args['url'])) {
            return Navigations::where('url', $args['url'])->get();
        }
        if (isset($args['description'])) {
            return Navigations::where('description', $args['description'])->get();
        }
        if (isset($args['group_id'])) {
            return Navigations::where('group_id', $args['group_id'])->get();
        }
        if (isset($args['click_count'])) {
            return Navigations::where('click_count', $args['click_count'])->get();
        }
        return Navigations::all();
    }
}