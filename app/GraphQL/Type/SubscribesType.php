<?php
namespace App\GraphQL\Type;

use App\Subscribes;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SubscribesType extends GraphQLType{
protected $attributes = [
        'name' => 'Subscribes',
        'description' => 'A Subscribes',
        'model' => Subscribes::class,
];
public function fields()
    {
return ['id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the Subscribes'],
'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the Subscribes'],
'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the Subscribes',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the Subscribes']
];
}


// If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);}

}
