<?php
/**
 * Created by PhpStorm.
 * User: piyush sharma
 * Date: 08-10-2015
 * Time: 20:54
 */

namespace App\Repository;


class APIResponse {

    const REQUEST_STATUS = "request_status";

    const SUCCESSFUL = "200";
    const INTERNAL_ERROR = "500";
    const NOT_FOUND = "400";
    const VALIDATION_ERROR = "422";

}