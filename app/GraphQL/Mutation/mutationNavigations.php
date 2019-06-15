<?php

namespace App\GraphQL\Mutation;

use App\Navigations;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationNavigations extends Mutation
{

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check() && Auth::user()->role->name == 'admin';
    }

    protected $attributes = [
        'name' => 'Navigations',
        'description' => 'A Navigations',
        'model' => Navigations::class,
    ];
    //graphql?query=mutation+Navigations{mutationNavigations(link_text: "defaultValueFor_link_text ",url: "defaultValueFor_url ",description: "defaultValueFor_description ",group_id: "defaultValueFor_group_id ",click_count: "defaultValueFor_click_count ")Navigations{id,link_text,url,description,group_id,click_count}}

    //`graphql?query=mutation+Navigations{mutationNavigations(id:${data.id},flag:"",link_text: "${data.link_text}",url: "${data.url}",description: "${data.description}",group_id: "${data.group_id}",click_count: "${data.click_count}"){id,link_text,url,description,group_id,click_count}}`

    public function type()
    {
        return GraphQL::type('Navigations');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Navigations'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Navigations operation'
            ],
            'link_text' => [
                'type' => (Type::string()),
                'description' => 'The link_text of the Navigations'

            ],
            'url' => [
                'type' => (Type::string()),
                'description' => 'The url of the Navigations'

            ],
            'description' => [
                'type' => (Type::string()),
                'description' => 'The description of the Navigations'

            ],
            'group_id' => [
                'type' => (Type::string()),
                'description' => 'The group_id of the Navigations'

            ],
            'click_count' => [
                'type' => (Type::string()),
                'description' => 'The click_count of the Navigations'
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
            $Navigations = Navigations::create(
                [
                    'link_text' => $args['link_text'],

                    'url' => $args['url'],

                    'description' => $args['description'],

                    'group_id' => $args['group_id'],

                    'click_count' => $args['click_count']
                ]
            );
            return $Navigations;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Navigations = Navigations::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'link_text' => $args['link_text'],

                    'url' => $args['url'],

                    'description' => $args['description'],

                    'group_id' => $args['group_id'],

                    'click_count' => $args['click_count']
                ]

            );

            return $Navigations;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Navigations::findOrFail($args['id']);
                $isDone =  Navigations::destroy($record->id);
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
            'link_text' => 'required',
            'url' => 'required',
            'description' => 'required',
            'group_id' => 'required',
            'click_count' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $NavigationsError = new Navigations;

            $NavigationsError->link_text = $error->messages()['link_text'][0];
            $NavigationsError->url = $error->messages()['url'][0];
            $NavigationsError->description = $error->messages()['description'][0];
            $NavigationsError->group_id = $error->messages()['group_id'][0];
            $NavigationsError->click_count = $error->messages()['click_count'][0];

            return $NavigationsError;
        }

        return null;
    }
}