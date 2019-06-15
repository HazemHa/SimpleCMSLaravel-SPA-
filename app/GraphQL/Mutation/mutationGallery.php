<?php

namespace App\GraphQL\Mutation;

use App\Gallery;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationGallery extends Mutation
{

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check();
    }

    protected $attributes = [
        'name' => 'Gallery',
        'description' => 'A Gallery',
        'model' => Gallery::class,
    ];
    //graphql?query=mutation+Gallery{mutationGallery(name: "defaultValueFor_name ",path: "defaultValueFor_path ",status_id: "defaultValueFor_status_id ")Gallery{id,name,path,status_id}}

    //`graphql?query=mutation+Gallery{mutationGallery(id:${data.id},flag:"",name: "${data.name}",path: "${data.path}",status_id: "${data.status_id}"){id,name,path,status_id}}`

    public function type()
    {
        return GraphQL::type('Gallery');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Gallery'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Gallery operation'
            ],
            'name' => [
                'type' => (Type::string()),
                'description' => 'The name of the Gallery'

            ],
            'path' => [
                'type' => (Type::string()),
                'description' => 'The path of the Gallery'

            ],
            'status_id' => [
                'type' => (Type::string()),
                'description' => 'The status_id of the Gallery'
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
            $Gallery = Gallery::create(
                [
                    'name' => $args['name'],

                    'path' => $args['path'],

                    'status_id' => $args['status_id']
                ]
            );
            return $Gallery;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Gallery = Gallery::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'name' => $args['name'],

                    'path' => $args['path'],

                    'status_id' => $args['status_id']
                ]

            );

            return $Gallery;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Gallery::findOrFail($args['id']);
                $isDone =  Gallery::destroy($record->id);
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
            'path' => 'required',
            'status_id' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('id', -1);
            $error =  $validator->errors();

            $GalleryError = new Gallery;

            $GalleryError->name = $error->messages()['name'][0];
            $GalleryError->path = $error->messages()['path'][0];
            $GalleryError->status_id = $error->messages()['status_id'][0];

            return $GalleryError;
        }

        return null;
    }
}