<?php
namespace App\GraphQL\Type;

use App\Settings;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

use Rebing\GraphQL\Support\Type as GraphQLType;

class SettingsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Settings',
        'description' => 'A Settings',
        'model' => Settings::class,
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the setting',
            ],
            'site_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The site_name of the setting',
            ], 'site_email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The site_email of the setting',
            ], 'site_location' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The site_location of the setting',
            ], 'site_aboutUs' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The site_aboutUs of the Settings',
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
    protected function resolveSite_nameField($root, $args)
    {
        return strtolower($root->site_name);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveSite_emailField($root, $args)
    {
        return strtolower($root->site_email);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveSite_locationField($root, $args)
    {
        return strtolower($root->site_location);
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveSite_aboutUsField($root, $args)
    {
        return strtolower($root->site_aboutUs);
    }
}