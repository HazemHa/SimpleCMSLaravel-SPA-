<?php
namespace App\GraphQL\Type;

use App\Comments;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

use Rebing\GraphQL\Support\Type as GraphQLType;

class CommentsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Comments',
        'description' => 'A Comments',
        'model' => Comments::class,
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the Comments'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The user_id of the Comments'
            ],
            'post_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The post_id of the Comments'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the Comments'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the Comments'
            ],
            'subject' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The subject of the Comments'
            ],
            'message' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The message of the Comments'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('Users')),
                'description' => 'The message of the Comments'
            ],
            'post' => [
                'type' => Type::nonNull(GraphQL::type('Posts')),
                'description' => 'The message of the Comments'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the Comments',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the Comments'
            ]
        ];
    }


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveUser_idField($root, $args)
    {
        return strtolower($root->user_id);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolvePost_idField($root, $args)
    {
        return strtolower($root->post_id);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveNameField($root, $args)
    {
        return strtolower($root->name);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveSubjectField($root, $args)
    {
        return strtolower($root->subject);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveMessageField($root, $args)
    {
        return strtolower($root->message);
    }
}
