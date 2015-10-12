<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    protected $table = "team";

    protected $fillable = ["idea_id","team_member_email"];

    protected $primaryKey = "id";

    public $timestamps = false;


    /**One to one Relationship between Idea and Team
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function idea()
    {
        return $this->belongsTo("App\IdeaModel","idea_id");
    }

}
