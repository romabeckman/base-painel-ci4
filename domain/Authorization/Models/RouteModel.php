<?php

namespace Authorization\Models;

use \App\Models\BaseModel;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class RouteModel extends BaseModel {

    protected $table = 'auth_route';
    protected $allowedFields = [
        'route', 'access'
    ];

}
