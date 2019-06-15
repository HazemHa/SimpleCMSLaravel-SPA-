<?php
namespace App\GraphQL\Type;

use App\Messages;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class MessagesType extends GraphQLType{
protected $attributes = [
        'name' => 'Messages',
        'description' => 'A Messages',
        'model' => Messages::class,
];
public function fields()
    {
return ['id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the Messages'],
'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the Messages'],
'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the Messages'],
'subject' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The subject of the Messages'],
'content' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The content of the Messages'],
'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the Messages',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the Messages']
];
}


// If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveNameField($root, $args)
    {
        return strtolower($root->name);}

// If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);}

// If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveSubjectField($root, $args)
    {
        return strtolower($root->subject);}

// If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveContentField($root, $args)
    {
        return strtolower($root->content);}

}
