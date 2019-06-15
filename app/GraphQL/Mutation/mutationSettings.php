<?php

namespace App\GraphQL\Mutation;

use App\Settings;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationSettings extends Mutation
{
    protected $attributes = [
        'name' => 'Settings',
        'description' => 'A Settings',
        'model' => Settings::class,
    ];
    //graphql?query=mutation+Settings{mutationSettings(site_name: "defaultValueFor_site_name ",site_email: "defaultValueFor_site_email ",site_location: "defaultValueFor_site_location ",site_aboutUs: "defaultValueFor_site_aboutUs ")Settings{id,site_name,site_email,site_location,site_aboutUs}}

    //`graphql?query=mutation+Settings{mutationSettings(id:${data.id},flag:"",site_name: "${data.site_name}",site_email: "${data.site_email}",site_location: "${data.site_location}",site_aboutUs: "${data.site_aboutUs}"){id,site_name,site_email,site_location,site_aboutUs}}`

    public function type()
    {
        return GraphQL::type('Settings');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Settings'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Settings operation'
            ],
            'site_name' => [
                'type' => (Type::string()),
                'description' => 'The site_name of the Settings'

            ],
            'site_email' => [
                'type' => (Type::string()),
                'description' => 'The site_email of the Settings'

            ],
            'site_location' => [
                'type' => (Type::string()),
                'description' => 'The site_location of the Settings'

            ],
            'site_aboutUs' => [
                'type' => (Type::string()),
                'description' => 'The site_aboutUs of the Settings'
            ]
        ];
    }
    public function resolve($root, $args)
    {
        if ($args['flag'] === 'create') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Settings = Settings::create(
                [
                    'site_name' => $args['site_name'],

                    'site_email' => $args['site_email'],

                    'site_location' => $args['site_location'],

                    'site_aboutUs' => $args['site_aboutUs']
                ]
            );
            return $Settings;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Settings = Settings::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'site_name' => $args['site_name'],

                    'site_email' => $args['site_email'],

                    'site_location' => $args['site_location'],

                    'site_aboutUs' => $args['site_aboutUs']
                ]

            );

            return $Settings;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Settings::findOrFail($args['id']);
                $isDone =  Settings::destroy($record->id);
                if ($isDone) {
                    return $record;
                }
            } catch (ModelNotFoundException $e) {
                return ['id' => '-1'];
            }
        }
    }

    public function validated($args)
    {
        $validate = $this->validateFieldsNeeded($args);

        if ($validate) {
            return $validate;
        }
    }

    public function validateFieldsNeeded($args)
    {

        $validator = Validator::make($args, [
            'site_name' => 'required',
            'site_email' => 'required',
            'site_location' => 'required',
            'site_aboutUs' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $SettingsError = new Settings;

            $SettingsError->site_name = $error->messages()['site_name'][0];
            $SettingsError->site_email = $error->messages()['site_email'][0];
            $SettingsError->site_location = $error->messages()['site_location'][0];
            $SettingsError->site_aboutUs = $error->messages()['site_aboutUs'][0];

            return $SettingsError;
        }

        return null;
    }
}