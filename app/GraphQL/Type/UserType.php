<?php
namespace App\GraphQL\Type;

use App\Users;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A user',
        'model' => Users::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user',
            ],
            'about' => [
                'type' => Type::string(),
                'description' => 'The about of user',
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('Posts')),
                'description' => 'user posts.',
            ],
            'image' => [
                'type' => Type::string(),
                'description' => 'user image.',
            ],
            'email_verified_at' => [
                'type' => Type::string(),
                'description' => 'user email_verified_at.',
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'user password.',
            ],

            'comments' => [
                'type' => Type::listOf(GraphQL::type('Comments')),
                'description' => 'user comments.',
            ],
            // Uses the 'getIsMeAttribute' function on our custom User model
            'isMe' => [
                'type' => Type::boolean(),
                'description' => 'True, if the queried user is the current user',
                'selectable' => false, // Does not try to query this from the database
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the Category',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the Category',
            ]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}