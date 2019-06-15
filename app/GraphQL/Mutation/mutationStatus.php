<?php

namespace App\GraphQL\Mutation;

use App\Status;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationStatus extends Mutation
{

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check() && Auth::user()->role->name == 'admin';
    }

    protected $attributes = [
        'name' => 'Status',
        'description' => 'A Status',
        'model' => Status::class,
    ];
    //graphql?query=mutation+Status{mutationStatus(name: "defaultValueFor_name ",description: "defaultValueFor_description ")Status{id,name,description}}

    //`graphql?query=mutation+Status{mutationStatus(id:${data.id},flag:"",name: "${data.name}",description: "${data.description}"){id,name,description}}`

    public function type()
    {
        return GraphQL::type('Status');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Status'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Status operation'
            ],
            'name' => [
                'type' => (Type::string()),
                'description' => 'The name of the Status'

            ],
            'description' => [
                'type' => (Type::string()),
                'description' => 'The description of the Status'
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
            $Status = Status::create(
                [
                    'name' => $args['name'],

                    'description' => $args['description']
                ]
            );
            return $Status;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Status = Status::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'name' => $args['name'],

                    'description' => $args['description']
                ]

            );

            return $Status;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Status::findOrFail($args['id']);
                $isDone =  Status::destroy($record->id);
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
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $StatusError = new Status;

            $StatusError->name = $error->messages()['name'][0];
            $StatusError->description = $error->messages()['description'][0];

            return $StatusError;
        }

        return null;
    }
}