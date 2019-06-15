<?php

namespace App\GraphQL\Mutation;

use App\NavigationGroups;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationNavigationGroups extends Mutation
{

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check() && Auth::user()->role->name == 'admin';
    }
    protected $attributes = [
        'name' => 'NavigationGroups',
        'description' => 'A NavigationGroups',
        'model' => NavigationGroups::class,
    ];
    //graphql?query=mutation+NavigationGroups{mutationNavigationGroups(name: "defaultValueFor_name ",slug: "defaultValueFor_slug ")NavigationGroups{id,name,slug}}

    //`graphql?query=mutation+NavigationGroups{mutationNavigationGroups(id:${data.id},flag:"",name: "${data.name}",slug: "${data.slug}"){id,name,slug}}`

    public function type()
    {
        return GraphQL::type('NavigationGroups');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the NavigationGroups'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the NavigationGroups operation'
            ],
            'name' => [
                'type' => (Type::string()),
                'description' => 'The name of the NavigationGroups'

            ],
            'slug' => [
                'type' => (Type::string()),
                'description' => 'The slug of the NavigationGroups'
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
            $NavigationGroups = NavigationGroups::create(
                [
                    'name' => $args['name'],

                    'slug' => $args['slug']
                ]
            );
            return $NavigationGroups;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $NavigationGroups = NavigationGroups::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'name' => $args['name'],

                    'slug' => $args['slug']
                ]

            );

            return $NavigationGroups;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = NavigationGroups::findOrFail($args['id']);
                $isDone =  NavigationGroups::destroy($record->id);
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
            'name' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $NavigationGroupsError = new NavigationGroups;

            $NavigationGroupsError->name = $error->messages()['name'][0];
            $NavigationGroupsError->slug = $error->messages()['slug'][0];

            return $NavigationGroupsError;
        }

        return null;
    }
}