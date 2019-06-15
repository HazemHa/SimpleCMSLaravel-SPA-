<?php
namespace App\GraphQL\Query;

use App\Status;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class StatusQuery extends Query
{
    protected $attributes = [
        'name' => 'Status query'
    ];

    public function authorize(array $args)
    {
        // true, if logged in
      //  return \Auth::check();
      return true;
    }

    public function type()
    {
        return Type::listOf(GraphQL::type('Status'));
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'description' => ['name' => 'description', 'type' => Type::string()]
        ];
    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Status::where('id', $args['id'])->get();
        }
        if (isset($args['name'])) {
            return Status::where('name', $args['name'])->get();
        }
        if (isset($args['description'])) {
            return Status::where('description', $args['description'])->get();
        }
        return Status::all();
    }
}
