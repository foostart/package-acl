<?php

return [
    /*
      |--------------------------------------------------------------------------
      | ITEM STATUS
      |--------------------------------------------------------------------------
      | @public = 99
      | @in_trash = 55 delete from list
      | @draft = 11 auto save
      | @unpublish = 33
     */
    'item' => [
        'status' => [
            'draft'     => 11,
            'unpublish' => 33,
            'in_trash'  => 55,
            'publish'    => 99,
        ],
        'pluck_status' => [
            11 => 'draft',
            33 => 'unpublish',
            55 => 'in_trash',
            99 => 'publish',
        ]
    ],
];
