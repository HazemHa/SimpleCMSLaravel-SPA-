<?php
namespace App\GraphQL\Query;

use App\Messages;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class MessagesQuery extends Query{
protected $attributes = [
        'name' => 'Messages query'
    ];

public function type()
    {
        return Type::listOf(GraphQL::type('Messages'));
}


//Messages{id,name,email,subject,content}
public function args()
    {
return [
'id' => ['name' => 'id', 'type' => Type::int()],
'name' => ['name' => 'name', 'type' => Type::string()],
'id' => ['name' => 'id', 'type' => Type::int()],
'email' => ['name' => 'email', 'type' => Type::string()],
'id' => ['name' => 'id', 'type' => Type::int()],
'subject' => ['name' => 'subject', 'type' => Type::string()],
'id' => ['name' => 'id', 'type' => Type::int()],
'content' => ['name' => 'content', 'type' => Type::string()]
];
}
public function resolve($root, $args){
if (isset($args['id'])) {
            return Messages::where('id', $args['name'])->get();
}
if (isset($args['name'])) {
            return Messages::where('name', $args['name'])->get();
}
if (isset($args['id'])) {
            return Messages::where('id', $args['email'])->get();
}
if (isset($args['email'])) {
            return Messages::where('email', $args['email'])->get();
}
if (isset($args['id'])) {
            return Messages::where('id', $args['subject'])->get();
}
if (isset($args['subject'])) {
            return Messages::where('subject', $args['subject'])->get();
}
if (isset($args['id'])) {
            return Messages::where('id', $args['content'])->get();
}
if (isset($args['content'])) {
            return Messages::where('content', $args['content'])->get();
}
  return Messages::all();
}

}
