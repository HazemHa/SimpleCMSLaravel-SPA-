<?php
namespace App\GraphQL\Query;

use App\Comments;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class CommentsQuery extends Query
{
    protected $attributes = [
        'name' => 'Comments query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Comments'));
    }


    //Comments{id,user_id,post_id,name,email,subject,message}
    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'user_id' => ['name' => 'user_id', 'type' => Type::string()],
            'post_id' => ['name' => 'post_id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'subject' => ['name' => 'subject', 'type' => Type::string()],
            'message' => ['name' => 'message', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {

        if (isset($args['user_id'])) {
            return Comments::where('user_id', $args['user_id'])->get();
        }

        if (isset($args['post_id'])) {
            return Comments::where('post_id', $args['post_id'])->get();
        }

        if (isset($args['name'])) {
            return Comments::where('name', $args['name'])->get();
        }

        if (isset($args['email'])) {
            return Comments::where('email', $args['email'])->get();
        }

        if (isset($args['subject'])) {
            return Comments::where('subject', $args['subject'])->get();
        }

        if (isset($args['message'])) {
            return Comments::where('message', $args['message'])->get();
        }
        return Comments::all();
    }
}
