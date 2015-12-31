<?php

return [
/**
* Provider .
*/
'provider'  => 'petfinder',

/**
* Package .
*/
'package'   => 'reward',

/**
* Modules .
*/
'modules'   => [
'reward',],


'reward' => [
                    'Name'          => 'Reward',
                    'name'          => 'reward',
                    'table'         => 'rewards',
                    'model'         => 'Petfinder\Reward\Models\Reward',
                    'image'         =>
                        [
                        'xs'        => ['width' =>'60',     'height' =>'45'],
                        'sm'        => ['width' =>'100',    'height' =>'75'],
                        'md'        => ['width' =>'460',    'height' =>'345'],
                        'lg'        => ['width' =>'800',    'height' =>'600'],
                        'xl'        => ['width' =>'1000',   'height' =>'750'],
                        ],

                    'fillable'          =>  ['user_id', 'price',            'status',],
                    'listfields'        =>  ['id', 'price',            'status',],
                    'translatable'      =>  ['price',            'status',],

                    'upload-folder'     =>  '/uploads/reward/reward',
                    'uploadable'        =>  [
                                                'single' => [],
                                                'multiple' => []
                                            ],
                ],


];
