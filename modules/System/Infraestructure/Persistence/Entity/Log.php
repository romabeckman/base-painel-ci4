<?php

namespace System\Infraestructure\Persistence\Entity;

use \CodeIgniter\Entity;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Log extends Entity {

    protected $dates = [
        'created_at'
    ];

    protected $casts = [
        'description' => 'json-array'
    ];

}
