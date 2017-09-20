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


    /**
     *
     * Get Hash Id by encoding ID (using bin2hex for encoding)
     *
     * @param integer $id
     *
     * @return integer
     *
     */
    public static function getHashId($id = "") {
    	$row = Self::firstOrCreate(["id" => $id]);
    	return bin2hex($row->id);
    }


    /**
     *
     * Get Id by decoding Hash ID (using hex2bin for decoding)
     *
     * @param integer $hash_id
     *
     * @return integer
     */
    public static function getId($hash_id = "") {
        $hash_id = trim($hash_id);
        if ($hash_id!="" && strlen($hash_id)%2 == 0 && !preg_match("/[a-z]/i", $hash_id)) {
            return hex2bin($hash_id);
        }
        return null;
    }

    /**
     *
     * Saving Synchronous Request Data
     *
     * @param array $data
     *
     * @return integer
     */
    public static function saveResult($data = []) {
        $res = [];
        if (is_null($data)) {
            return json_encode(["error" => "Empty data"]);
        }
        foreach ($data as $key => $value) {
            $output = new Output;
            $output = Self::putOutput($output, $value);
            $output->save();
            $res[] = ["id" => $output->id];
        }
        return json_encode($res);
    }

    /**
     *
     * Saving Asynchronous Request Data using id
     *
     * @param array $data
     *
     * @return integer
     */
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
        return ["id" => $output->id];
    }


    /**
     *
     * Put data in Output Object
     *
     * @param Output/ $output
     * @param array   $data
     *
     * @return Output/
     */
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
        $output->status_details     = (isset($data['run_status']['status_detail'])) ? $data['run_status']['status_detail'] : "";
        $output->stderr             = (isset($data['run_status']['stderr'])) ? $data['run_status']['stderr'] : "";
        return $output;
    }
}
