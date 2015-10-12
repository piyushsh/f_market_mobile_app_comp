<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaModel extends Model
{
    protected $table = "idea";

    protected $fillable = ["user_id","idea_title","total_team_members","startup_experience","about_startup_experience",
        "about_app_idea","additional_information","app_designs_link","status"];

    protected $primaryKey = "idea_id";

    public $timestamps = false;


    /**One to one Relationship between Idea and User
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function user()
    {
        return $this->belongsTo("App\UserModel","user_id");
    }


    /**
     * Relationship between idea and Team table i.e. one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamMembers()
    {
        return $this->hasMany("App\TeamModel","idea_id");
    }
}
