<?php
namespace App\GraphQL\Query;

use App\Settings;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class SettingsQuery extends Query
{
    protected $attributes = [
        'name' => 'Settings query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Settings'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],

            'site_name' => ['name' => 'site_name', 'type' => Type::string()],
            'site_email' => ['name' => 'site_email', 'type' => Type::string()],
            'site_location' => ['name' => 'site_location', 'type' => Type::string()],
            'site_aboutUs' => ['name' => 'site_aboutUs', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Settings::where('id', $args['id'])->get();
        }
        if (isset($args['site_name'])) {
            return Settings::where('site_name', $args['site_name'])->get();
        }
        if (isset($args['site_email'])) {
            return Settings::where('site_email', $args['site_email'])->get();
        }
        if (isset($args['site_location'])) {
            return Settings::where('site_location', $args['site_location'])->get();
        }
        if (isset($args['site_aboutUs'])) {
            return Settings::where('site_aboutUs', $args['site_aboutUs'])->get();
        }
        return Settings::all();
    }
}