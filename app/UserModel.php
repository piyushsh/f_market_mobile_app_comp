<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "user";

    protected $fillable = ["name","email","country","contact_no"];

    protected $primaryKey = "user_id";

    public $timestamps = false;


    /**
     * Relationship between Users and idea
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function idea()
    {
        return $this->hasOne("App\IdeaModel","user_id");
    }

}
