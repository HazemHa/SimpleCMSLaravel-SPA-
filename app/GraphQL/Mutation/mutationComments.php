<?php

namespace App\GraphQL\Mutation;

use App\Comments;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationComments extends Mutation
{

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check();
    }

    protected $attributes = [
        'name' => 'Comments',
        'description' => 'A Comments',
        'model' => Comments::class,
    ];
    //graphql?query=mutation+Comments{mutationComments(user_id: "defaultValueFor_user_id ",post_id: "defaultValueFor_post_id ",name: "defaultValueFor_name ",email: "defaultValueFor_email ",subject: "defaultValueFor_subject ",message: "defaultValueFor_message ")Comments{id,user_id,post_id,name,email,subject,message}}

    //`graphql?query=mutation+Comments{mutationComments(id:${data.id},flag:"",user_id: "${data.user_id}",post_id: "${data.post_id}",name: "${data.name}",email: "${data.email}",subject: "${data.subject}",message: "${data.message}"){id,user_id,post_id,name,email,subject,message}}`

    public function type()
    {
        return GraphQL::type('Comments');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Comments'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Comments operation'
            ],
            'user_id' => [
                'type' => (Type::string()),
                'description' => 'The user_id of the Comments'

            ],
            'post_id' => [
                'type' => (Type::string()),
                'description' => 'The post_id of the Comments'

            ],
            'name' => [
                'type' => (Type::string()),
                'description' => 'The name of the Comments'

            ],
            'email' => [
                'type' => (Type::string()),
                'description' => 'The email of the Comments'

            ],
            'subject' => [
                'type' => (Type::string()),
                'description' => 'The subject of the Comments'

            ],
            'message' => [
                'type' => (Type::string()),
                'description' => 'The message of the Comments'
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
            $Comments = Comments::create(
                [
                    'user_id' => $args['user_id'],

                    'post_id' => $args['post_id'],

                    'name' => $args['name'],

                    'email' => $args['email'],

                    'subject' => $args['subject'],

                    'message' => $args['message']
                ]
            );
            return $Comments;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Comments = Comments::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'user_id' => $args['user_id'],

                    'post_id' => $args['post_id'],

                    'name' => $args['name'],

                    'email' => $args['email'],

                    'subject' => $args['subject'],

                    'message' => $args['message']
                ]

            );

            return $Comments;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Comments::findOrFail($args['id']);
                $isDone =  Comments::destroy($record->id);
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
            'user_id' => 'required',
            'post_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $CommentsError = new Comments;

            $CommentsError->user_id = $error->messages()['user_id'][0];
            $CommentsError->post_id = $error->messages()['post_id'][0];
            $CommentsError->name = $error->messages()['name'][0];
            $CommentsError->email = $error->messages()['email'][0];
            $CommentsError->subject = $error->messages()['subject'][0];
            $CommentsError->message = $error->messages()['message'][0];

            return $CommentsError;
        }

        return null;
    }
}