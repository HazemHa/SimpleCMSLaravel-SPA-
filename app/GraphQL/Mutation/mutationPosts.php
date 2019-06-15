<?php

namespace App\GraphQL\Mutation;

use App\Posts;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationPosts extends Mutation
{

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check();
    }
    protected $attributes = [
        'name' => 'Posts',
        'description' => 'A Posts',
        'model' => Posts::class,
    ];
    //graphql?query=mutation+Posts{mutationPosts(user_id: "defaultValueFor_user_id ",title: "defaultValueFor_title ",content: "defaultValueFor_content ",category_id: "defaultValueFor_category_id ",image: "defaultValueFor_image ",status_id: "defaultValueFor_status_id ",click: "defaultValueFor_click ")Posts{id,user_id,title,content,category_id,image,status_id,click}}

    //`graphql?query=mutation+Posts{mutationPosts(id:${data.id},flag:"",user_id: "${data.user_id}",title: "${data.title}",content: "${data.content}",category_id: "${data.category_id}",image: "${data.image}",status_id: "${data.status_id}",click: "${data.click}"){id,user_id,title,content,category_id,image,status_id,click}}`

    public function type()
    {
        return GraphQL::type('Posts');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Posts'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Posts operation'
            ],
            'user_id' => [
                'type' => (Type::string()),
                'description' => 'The user_id of the Posts'

            ],
            'title' => [
                'type' => (Type::string()),
                'description' => 'The title of the Posts'

            ],
            'content' => [
                'type' => (Type::string()),
                'description' => 'The content of the Posts'

            ],
            'category_id' => [
                'type' => (Type::string()),
                'description' => 'The category_id of the Posts'

            ],
            'image' => [
                'type' => (Type::string()),
                'description' => 'The image of the Posts'

            ],
            'status_id' => [
                'type' => (Type::string()),
                'description' => 'The status_id of the Posts'

            ],
            'click' => [
                'type' => (Type::string()),
                'description' => 'The click of the Posts'
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
            $Posts = Posts::create(
                [
                    'user_id' => $args['user_id'],

                    'title' => $args['title'],

                    'content' => $args['content'],

                    'category_id' => $args['category_id'],

                    'image' => $args['image'],

                    'status_id' => $args['status_id'],

                ]
            );
            return $Posts;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Posts = Posts::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'user_id' => $args['user_id'],

                    'title' => $args['title'],

                    'content' => $args['content'],

                    'category_id' => $args['category_id'],

                    'image' => $args['image'],

                    'status_id' => $args['status_id'],

                    'click' => $args['click']
                ]

            );

            return $Posts;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Posts::findOrFail($args['id']);
                $isDone =  Posts::destroy($record->id);
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
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required',
            'status_id' => 'required',
            'click' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $PostsError = new Posts;

            $PostsError->user_id = $error->messages()['user_id'][0];
            $PostsError->title = $error->messages()['title'][0];
            $PostsError->content = $error->messages()['content'][0];
            $PostsError->category_id = $error->messages()['category_id'][0];
            $PostsError->image = $error->messages()['image'][0];
            $PostsError->status_id = $error->messages()['status_id'][0];
            $PostsError->click = $error->messages()['click'][0];

            return $PostsError;
        }

        return null;
    }
}
