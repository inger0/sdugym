<?php
/**
 * Created by HBUILDER.
 * User: hefan
 * Date: 17-04-27
 * Time: 16:22
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $table = "finances";

    protected $primaryKey = "id";

    protected $fillable = ['department','content','money','billing_time','remark','campus','admin','u_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}