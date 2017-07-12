<?php

namespace Ankitjain28may\HackerEarth\Models;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_id', 'async', 'compile_status', 'time_used', 'memory_used', 'output', 'output_html', 'status', 'status_details',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $table = "hackerearth_outputs";

    public static function getId($id = "") {
    	$row = Self::firstOrCreate(["id" => $id]);
    	return bin2hex($row->id);
    }

    public static function saveResult($data = []) {
        if (is_null($data)) {
            return json_encode(["error" => "Empty data"]);
        }
        $output = new Output;
        $output = Self::putOutput($output, $data);
        $output->save();
        return $output->id;
    }

    public static function savePayload($data = [])
    {   
    	$id = "";
        $output = [];
    	try {
    		$id = hex2bin($data['id']);
    	} finally {
    		$output = Self::find($id);
    	}
    	if (is_null($output)) {
    		return json_encode(["error" => "Id doesn't exist"]);
    	}
    	$output = Self::putOutput($output, $data);
    	$output->save();
        return $output->id;
    }

    public static function putOutput($output, $data = [])
    {
        $output->code_id            = $data['code_id'];
        $output->async              =(isset($data['async'])) ? $data['async'] : 0;
        $output->compile_status     = $data['compile_status'];
        $output->time_used          = (isset($data['run_status']['time_used'])) ? $data['run_status']['time_used'] : 5;
        $output->memory_used        = (isset($data['run_status']['memory_used'])) ? $data['run_status']['memory_used'] : 262144;
        $output->output             = (isset($data['run_status']['output'])) ? $data['run_status']['output'] : "";
        $output->output_html        = (isset($data['run_status']['output_html'])) ? $data['run_status']['output_html'] : "";
        $output->status             = (isset($data['run_status']['status'])) ? $data['run_status']['status'] : "";
        $output->status_details     = (isset($data['run_status']['status_details'])) ? $data['run_status']['status_details'] : "";
        $output->stderr             = (isset($data['run_status']['stderr'])) ? $data['run_status']['stderr'] : "";
        return $output;
    }
}
