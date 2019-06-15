<?php
namespace App\GraphQL\Type;

use App\Navigations;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class NavigationsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Navigations',
        'description' => 'A Navigations',
        'model' => Navigations::class,
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'link_text' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'group_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ], 'click_count' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Navigations',
            ],
            'groupNavigation' =>  [
                'type' => GraphQL::type('NavigationGroups'),
                'description' => 'NavigationGroupsType',
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
    protected function resolveLink_textField($root, $args)
    {
        return strtolower($root->link_text);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveUrlField($root, $args)
    {
        return strtolower($root->url);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveDescriptionField($root, $args)
    {
        return strtolower($root->description);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveGroup_idField($root, $args)
    {
        return strtolower($root->group_id);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveClick_countField($root, $args)
    {
        return strtolower($root->click_count);
    }
}