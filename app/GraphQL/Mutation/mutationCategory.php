<?php

namespace App\GraphQL\Mutation;

use App\Category;
use Validator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class mutationCategory extends Mutation
{

    public function authorize(array $args)
    {
        // true, if logged in
        return Auth::check() && Auth::user()->role->name == 'admin';
    }

    protected $attributes = [
        'name' => 'Category',
        'description' => 'A Category',
        'model' => Category::class,
    ];
    //graphql?query=mutation+Category{mutationCategory(name: "defaultValueFor_name ",description: "defaultValueFor_description ")Category{id,name,description}}

    //`graphql?query=mutation+Category{mutationCategory(id:${data.id},flag:"",name: "${data.name}",description: "${data.description}"){id,name,description}}`

    public function type()
    {
        return GraphQL::type('Category');
    }
    public function args()
    {
        return [
            'id' => [
                'type' => (Type::int()),
                'description' => 'The id of the Category'
            ],
            'flag' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The flag of the Category operation'
            ],
            'name' => [
                'type' => (Type::string()),
                'description' => 'The name of the Category'

            ],
            'description' => [
                'type' => (Type::string()),
                'description' => 'The description of the Category'
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
            $Category = Category::create(
                [
                    'name' => $args['name'],

                    'description' => $args['description']
                ]
            );
            return $Category;
        } else if ($args['flag'] === 'update') {
            $validated = $this->validated($args);
            if ($validated) {
                return $validated;
            }
            $Category = Category::updateOrCreate(
                ['id' => $args['id']],

                [
                    'id' => $args['id'],

                    'name' => $args['name'],

                    'description' => $args['description']
                ]

            );

            return $Category;
        } else if ($args['flag'] === 'delete') {
            try {
                $record = Category::findOrFail($args['id']);
                $isDone =  Category::destroy($record->id);
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

            $CategoryError = new Category;

            $CategoryError->name = $error->messages()['name'][0];
            $CategoryError->description = $error->messages()['description'][0];

            return $CategoryError;
        }

        return null;
    }
}