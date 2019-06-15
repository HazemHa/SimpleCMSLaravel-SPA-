<?php

namespace App\GraphQL\Mutation;

use App\Subscribes;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationSubscribes extends Mutation
{
    protected $attributes = [
        'name' => 'Subscribes',
        'description' => 'A Subscribes',
        'model' => Subscribes::class,
    ];
    //graphql?query=mutation+Subscribes{mutationSubscribes(email: "defaultValueFor_email ")Subscribes{id,email}}

    //`graphql?query=mutation+Subscribes{mutationSubscribes(id:${data.id},flag:"",email: "${data.email}"){id,email}}`

    public function type()
    {
        return GraphQL::type('Subscribes');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Subscribes'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Subscribes operation'
            ],
            'email' => [
                'type' => (Type::string()),
                'description' => 'The email of the Subscribes'
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
            $Subscribes = Subscribes::create(
                [
                    'email' => $args['email']
                ]
            );
            return $Subscribes;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Subscribes = Subscribes::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'email' => $args['email']
                ]

            );

            return $Subscribes;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Subscribes::findOrFail($args['id']);
                $isDone =  Subscribes::destroy($record->id);
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
            'email' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $SubscribesError = new Subscribes;

            $SubscribesError->email = $error->messages()['email'][0];

            return $SubscribesError;
        }

        return null;
    }
}