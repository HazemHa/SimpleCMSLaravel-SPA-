<?php
namespace App\GraphQL\Query;

use App\Posts;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class PostsQuery extends Query
{
    protected $attributes = [
        'name' => 'Post query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Posts'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'user_id' => ['name' => 'user_id', 'type' => Type::string()],
            'title' => ['name' => 'title', 'type' => Type::string()],
            'content' => ['name' => 'content', 'type' => Type::string()],
            'category_id' => ['name' => 'category_id', 'type' => Type::string()],
            'image' => ['name' => 'image', 'type' => Type::string()],
            'status_id' => ['name' => 'status_id', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Posts::where('id', $args['id'])->get();
        }
        if (isset($args['user_id'])) {
            return Posts::where('user_id', $args['user_id'])->get();
        }
        if (isset($args['title'])) {
            return Posts::where('title', $args['title'])->get();
        }
        if (isset($args['content'])) {
            return Posts::where('content', $args['content'])->get();
        }
        if (isset($args['category_id'])) {
            return Posts::where('category_id', $args['category_id'])->get();
        }
        if (isset($args['image'])) {
            return Posts::where('image', $args['image'])->get();
        }
        if (isset($args['status_id'])) {
            return Posts::where('status_id', $args['status_id'])->get();
        }
        return Posts::all();
    }
}