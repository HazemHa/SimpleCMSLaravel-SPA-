<?php
namespace App\GraphQL\Type;

use App\Posts;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostsPaginateType extends GraphQLType
{
    protected $attributes = [
        'name' => 'postsPaginate',
        'description' => 'A postsPaginate',
        'model' => Posts::class,
    ];
    public function fields()
    {
        return [

            'current_page' => [
                'type' => (Type::int()),
                'description' => 'The id of the user',
            ],
            'data' => [
                'type' => Type::listOf(GraphQL::type('Posts')),
                'description' => 'The id of the user',
            ], 'per_page' => [
                'type' => (Type::int()),
                'description' => 'The id of the user',
            ], 'to' => [
                'type' => (Type::int()),
                'description' => 'The id of the user',
            ], 'total' =>  [
                'type' => (Type::int()),
                'description' => 'post category.',
            ],
            'from' => [
                'type' => (Type::int()),
                'description' => 'The updated_at of the Category',
            ],


        ];
    }
}