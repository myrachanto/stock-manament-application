<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Organizer;
class Extra extends Model
{
    use Organizer; 

    protected $fillable =  [

        'classid','curriculumid','team','description','achievements','comments'

    ];
	
//whitelist of filter-able columns 
    protected $filter = [

        'id', 'classid','curriculumid','team','description','achievements','comments'

    ];
    public static $rules = array(
		'name'=>'required|min:2|alpha_num|no_spaces',
		'desciption'=>'required|min:2|alpha',
	);
	  
    
    public function students(){

        return $this->belongsTo(Student::class);
    }
}
