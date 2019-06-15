<?php
namespace App\GraphQL\Type;

use App\NavigationGroups;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class NavigationGroupsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'NavigationGroups',
        'description' => 'A NavigationGroups',
        'model' => NavigationGroups::class,
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the NavigationGroups',
            ],
            'navigation' =>  [
                'type' => Type::listOf(GraphQL::type('Navigations')),
                'description' => 'navigation.',
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
    protected function resolveNameField($root, $args)
    {
        return strtolower($root->name);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveSlugField($root, $args)
    {
        return strtolower($root->slug);
    }
}