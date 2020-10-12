<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
   
    use SoftDeletes;
    
    protected $fillable = [
        'name', 
        'date', 
        'time', 
        'is_delete'];

    public static function list() {
        return DB::table('employees')->select('id', 'name', 'date', 'time')->where('is_delete', 1)->get();;
    }
}
