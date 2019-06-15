<?php


use example\Mutation\ExampleMutation;
use example\Query\ExampleQuery;
use example\Type\ExampleRelationType;
use example\Type\ExampleType;

return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',

    // Any middleware for the graphql route group
    'middleware' => [],

    // Additional route group attributes
    //
    // Example:
    //
    // 'route_group_attributes' => ['guard' => 'api']
    //
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\ProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\MyProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ]
    //
    'schemas' => [
        'default' => [
            'query' => [
                'Users' => App\GraphQL\Query\UsersQuery::class,
                'Status' => App\GraphQL\Query\StatusQuery::class,
                'Settings' => App\GraphQL\Query\SettingsQuery::class,
                'Posts' => App\GraphQL\Query\PostsQuery::class,
                'postsPaginate' => App\GraphQL\Query\PostsPaginateQuery::class,
                'Navigations' => App\GraphQL\Query\NavigationsQuery::class,
                'NavigationGroups' => App\GraphQL\Query\NavigationGroupsQuery::class,
                'Comments' => App\GraphQL\Query\CommentsQuery::class,
                'Category' => App\GraphQL\Query\CategoryQuery::class,

                'Messages' => App\GraphQL\Query\MessagesQuery::class,

                'Subscribes' => App\GraphQL\Query\SubscribesQuery::class,
                'Gallery' => App\GraphQL\Query\GalleryQuery::class,

            ],
            'mutation' => [

                'mutationCategory'  => App\GraphQL\Mutation\mutationCategory::class,
                'mutationComments'  => App\GraphQL\Mutation\mutationComments::class,
                'mutationSubscribes'  => App\GraphQL\Mutation\mutationSubscribes::class,
                'mutationGallery'  => App\GraphQL\Mutation\mutationGallery::class,


                'mutationNavigationGroups'  => App\GraphQL\Mutation\mutationNavigationGroups::class,

                'mutationNavigations'  => App\GraphQL\Mutation\mutationNavigations::class,


                'mutationPosts'  => App\GraphQL\Mutation\mutationPosts::class,

                'mutationSettings'  => App\GraphQL\Mutation\mutationSettings::class,
                'mutationStatus'  => App\GraphQL\Mutation\mutationStatus::class,

                'mutationMessages'  => App\GraphQL\Mutation\mutationMessages::class,
                'mutationUsers'  => App\GraphQL\Mutation\mutationUsers::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
        'Users' => App\GraphQL\Type\UserType::class,
        'Status' => App\GraphQL\Type\StatusType::class,
        'Settings' => App\GraphQL\Type\SettingsType::class,
        'Posts' => App\GraphQL\Type\PostsType::class,
        'postPaginate' => App\GraphQL\Type\PostsPaginateType::class,
        'Navigations' => App\GraphQL\Type\NavigationsType::class,
        'NavigationGroups' => App\GraphQL\Type\NavigationGroupsType::class,
        'Gallery' => App\GraphQL\Type\GalleryType::class,
        'Comments' => App\GraphQL\Type\CommentsType::class,
        'Category' => App\GraphQL\Type\CategoryType::class,
        'Subscribes' => App\GraphQL\Type\SubscribesType::class,

        'Messages' => App\GraphQL\Type\MessagesType::class,
        // 'example'           => ExampleType::class,
        // 'relation_example'  => ExampleRelationType::class,
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    /**
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key'    => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix' => '/graphiql/{graphql_schema?}',
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],

];