<?php
/**
 * Created by HBUILDER.
 * User: hefan
 * Date: 17-04-10
 * Time: 10:36
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = "applications";

    protected $primaryKey = "id";

    protected $fillable = ['campus','gym','time','classtime','major','content','pnumber','charger','tel','cost','remark'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}