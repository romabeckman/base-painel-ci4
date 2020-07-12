<?php

namespace System\Models;

use \App\Models\BaseModel;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class RouteModel extends BaseModel {

    /**
     * Anyone can access
     */
    const ACCESS_PUBLIC = 'public';

    /**
     * Anyone can access with authentication
     */
    const ACCESS_PROTECTED = 'protected';

    /**
     * Required authentication and permission
     */
    const ACCESS_PRIVATE = 'private';

    protected $table = 'sys_route';
    protected $allowedFields = [
        'controller', 'method', 'access'
    ];

}