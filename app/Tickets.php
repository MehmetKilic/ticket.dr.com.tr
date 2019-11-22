<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table    = "tickets";

    protected $fillable = [
        "id",
        "title",
        "content",
        "ip",
        "tags",
        "status",
        "created_at",
        "updated_at"
    ];
}