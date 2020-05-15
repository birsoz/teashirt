<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait;
     /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.category' => 10,
            'products.sub_category' => 10,
            'products.tag' => 10,
            'products.description' => 10,
            // 'user.name' => 2,
            // 'users.email' => 1,
        ],
        // 'joins' => [
        //     'posts' => ['users.id','posts.user_id'],
        // ],
    ];
}
