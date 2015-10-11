<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "user";

    protected $fillable = ["name","email","country","contact_no"];

    protected $primaryKey = "user_id";

    public $timestamps = false;

}
