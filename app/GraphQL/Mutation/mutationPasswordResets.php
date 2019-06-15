<?php

namespace App\GraphQL\Mutation;

use App\PasswordResets;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationPasswordResets extends Mutation
{
    protected $attributes = [
        'name' => 'PasswordResets',
        'description' => 'A PasswordResets',
        'model' => PasswordResets::class,
    ];
    //graphql?query=mutation+PasswordResets{mutationPasswordResets(email: "defaultValueFor_email ",token: "defaultValueFor_token ",created_at: "defaultValueFor_created_at ")PasswordResets{id,email,token,created_at}}

    //`graphql?query=mutation+PasswordResets{mutationPasswordResets(id:${data.id},flag:"",email: "${data.email}",token: "${data.token}",created_at: "${data.created_at}"){id,email,token,created_at}}`

    public function type()
    {
        return GraphQL::type('PasswordResets');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the PasswordResets'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the PasswordResets operation'
            ],
            'email' => [
                'type' => (Type::string()),
                'description' => 'The email of the PasswordResets'

            ],
            'token' => [
                'type' => (Type::string()),
                'description' => 'The token of the PasswordResets'

            ],
            'created_at' => [
                'type' => (Type::string()),
                'description' => 'The created_at of the PasswordResets'
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
            $PasswordResets = PasswordResets::create(
                [
                    'email' => $args['email'],

                    'token' => $args['token'],

                    'created_at' => $args['created_at']
                ]
            );
            return $PasswordResets;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $PasswordResets = PasswordResets::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'email' => $args['email'],

                    'token' => $args['token'],

                    'created_at' => $args['created_at']
                ]

            );

            return $PasswordResets;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = PasswordResets::findOrFail($args['id']);
                $isDone =  PasswordResets::destroy($record->id);
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
            'email' => 'required',
            'token' => 'required',
            'created_at' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $PasswordResetsError = new PasswordResets;

            $PasswordResetsError->email = $error->messages()['email'][0];
            $PasswordResetsError->token = $error->messages()['token'][0];
            $PasswordResetsError->created_at = $error->messages()['created_at'][0];

            return $PasswordResetsError;
        }

        return null;
    }
}