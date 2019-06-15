<?php
namespace App\GraphQL\Type;

use App\Gallery;
use Rebing\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class GalleryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Gallery',
        'description' => 'A Gallery',
        'model' => Gallery::class,
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the Gallery'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the Gallery'
            ],
            'path' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The path of the Gallery'
            ],
            'status_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The status_id of the Gallery'
            ],
            'status' => [
                'type' => GraphQL::type('Status'),
                'description' => 'The status of the Gallery'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the Gallery',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the Gallery'
            ]
        ];
    }


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveNameField($root, $args)
    {
        return strtolower($root->name);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolvePathField($root, $args)
    {
        return strtolower($root->path);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveStatus_idField($root, $args)
    {
        return strtolower($root->status_id);
    }
}