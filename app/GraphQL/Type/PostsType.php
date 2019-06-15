<?php
namespace App\GraphQL\Type;

use App\Posts;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'A Post',
        'model' => Posts::class,
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'content' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'category_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'image' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'status_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Posts',
            ], 'comments' =>  [
                'type' => Type::listOf(GraphQL::type('Comments')),
                'description' => 'user comments.',
            ], 'user' =>  [
                'type' => GraphQL::type('Users'),
                'description' => 'post user.',

            ], 'status' =>  [
                'type' => GraphQL::type('Status'),
                'description' => 'post user.',

            ], 'category' =>  [
                'type' => GraphQL::type('Category'),
                'description' => 'post category.',
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the Category',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the Category',
            ],
            'total' => [
                'type' => (Type::string()),
                'description' => 'The total of the Category',
            ],
            'per_page' => [
                'type' => (Type::string()),
                'description' => 'The per_page of the Category',
            ],
            'click' => [
                'type' => (Type::int()),
                'description' => 'The click of the Category',
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
    protected function resolveTitleField($root, $args)
    {
        return strtolower($root->title);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveContentField($root, $args)
    {
        return strtolower($root->content);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveCategory_idField($root, $args)
    {
        return strtolower($root->category_id);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveImageField($root, $args)
    {
        return strtolower($root->image);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveStatus_idField($root, $args)
    {
        return strtolower($root->status_id);
    }
}