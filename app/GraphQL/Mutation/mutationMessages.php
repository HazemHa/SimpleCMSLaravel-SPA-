<?php

namespace App\GraphQL\Mutation;

use App\Messages;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationMessages extends Mutation
{
    protected $attributes = [
        'name' => 'Messages',
        'description' => 'A Messages',
        'model' => Messages::class,
    ];
    //graphql?query=mutation+Messages{mutationMessages(name: "defaultValueFor_name ",email: "defaultValueFor_email ",subject: "defaultValueFor_subject ",content: "defaultValueFor_content ")Messages{id,name,email,subject,content}}

    //`graphql?query=mutation+Messages{mutationMessages(id:${data.id},flag:"",name: "${data.name}",email: "${data.email}",subject: "${data.subject}",content: "${data.content}"){id,name,email,subject,content}}`

    public function type()
    {
        return GraphQL::type('Messages');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Messages'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Messages operation'
            ],
            'name' => [
                'type' => (Type::string()),
                'description' => 'The name of the Messages'

            ],
            'email' => [
                'type' => (Type::string()),
                'description' => 'The email of the Messages'

            ],
            'subject' => [
                'type' => (Type::string()),
                'description' => 'The subject of the Messages'

            ],
            'content' => [
                'type' => (Type::string()),
                'description' => 'The content of the Messages'
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
            $Messages = Messages::create(
                [
                    'name' => $args['name'],

                    'email' => $args['email'],

                    'subject' => $args['subject'],

                    'content' => $args['content']
                ]
            );
            return $Messages;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Messages = Messages::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'name' => $args['name'],

                    'email' => $args['email'],

                    'subject' => $args['subject'],

                    'content' => $args['content']
                ]

            );

            return $Messages;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Messages::findOrFail($args['id']);
                $isDone =  Messages::destroy($record->id);
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
            'email' => 'required',
            'subject' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $MessagesError = new Messages;

            $MessagesError->name = $error->messages()['name'][0];
            $MessagesError->email = $error->messages()['email'][0];
            $MessagesError->subject = $error->messages()['subject'][0];
            $MessagesError->content = $error->messages()['content'][0];

            return $MessagesError;
        }

        return null;
    }
}