<?php
namespace App\GraphQL\Query;

use App\Posts;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class PostsPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'Post query'
    ];

    public function type()
    {
        return GraphQL::paginate('Posts');
    }

    public function args()
    {
        return [
            'limit' => ['name' => 'id', 'type' => Type::string()],

        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['limit'])) {
            return Post::paginate($args['limit']);
        }
        return Posts::paginate(5);
    }
}