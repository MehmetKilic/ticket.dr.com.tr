<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table    = "tags";

    protected $fillable = [
        "id",
        "ticket_id",
        "tag",
        "created_at",
        "updated_at"
    ];
}