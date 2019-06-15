<?php

namespace App\GraphQL\Mutation;

use App\Users;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationUsers extends Mutation
{
    protected $attributes = [
        'name' => 'Users',
        'description' => 'A Users',
        'model' => Users::class,
    ];
    //graphql?query=mutation+Users{mutationUsers(name: "defaultValueFor_name ",email: "defaultValueFor_email ",image: "defaultValueFor_image ",email_verified_at: "defaultValueFor_email_verified_at ",about: "defaultValueFor_about ",password: "defaultValueFor_password ")Users{id,name,email,image,email_verified_at,about,password}}

    //`graphql?query=mutation+Users{mutationUsers(id:${data.id},flag:"",name: "${data.name}",email: "${data.email}",image: "${data.image}",email_verified_at: "${data.email_verified_at}",about: "${data.about}",password: "${data.password}"){id,name,email,image,email_verified_at,about,password}}`

    public function type()
    {
        return GraphQL::type('Users');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Users'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Users operation'
            ],
            'name' => [
                'type' => (Type::string()),
                'description' => 'The name of the Users'

            ],
            'email' => [
                'type' => (Type::string()),
                'description' => 'The email of the Users'

            ],
            'image' => [
                'type' => (Type::string()),
                'description' => 'The image of the Users'

            ],
            'email_verified_at' => [
                'type' => (Type::string()),
                'description' => 'The email_verified_at of the Users'

            ],
            'about' => [
                'type' => (Type::string()),
                'description' => 'The about of the Users'

            ],
            'password' => [
                'type' => (Type::string()),
                'description' => 'The password of the Users'
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
            $Users = Users::create(
                [
                    'name' => $args['name'],

                    'email' => $args['email'],

                    'image' => $args['image'],

                    'email_verified_at' => $args['email_verified_at'],

                    'about' => $args['about'],

                    'password' => $args['password']
                ]
            );
            return $Users;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Users = Users::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'name' => $args['name'],

                    'email' => $args['email'],

                    'image' => $args['image'],

                    'email_verified_at' => $args['email_verified_at'],

                    'about' => $args['about'],

                    'password' => $args['password']
                ]

            );

            return $Users;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Users::findOrFail($args['id']);
                $isDone =  Users::destroy($record->id);
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
            'image' => 'required',
            'email_verified_at' => 'required',
            'about' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $UsersError = new Users;

            $UsersError->name = $error->messages()['name'][0];
            $UsersError->email = $error->messages()['email'][0];
            $UsersError->image = $error->messages()['image'][0];
            $UsersError->email_verified_at = $error->messages()['email_verified_at'][0];
            $UsersError->about = $error->messages()['about'][0];
            $UsersError->password = $error->messages()['password'][0];

            return $UsersError;
        }

        return null;
    }
}