<?php
namespace App\GraphQL\Query;

use App\Gallery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class GalleryQuery extends Query
{
    protected $attributes = [
        'name' => 'Gallery query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Gallery'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'path' => ['name' => 'path', 'type' => Type::string()],

            'status_id' => ['name' => 'status_id', 'type' => Type::string()],

        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Gallery::where('id', $args['id'])->get();
        }

        if (isset($args['name'])) {
            return Gallery::where('name', $args['name'])->get();
        }
        if (isset($args['path'])) {
            return Gallery::where('path', $args['path'])->get();
        }
        if (isset($args['status_id'])) {
            return Gallery::where('status_id', $args['status_id'])->get();
        }
        return Gallery::all();
    }
}