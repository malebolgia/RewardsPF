<?php

namespace Petfinder\Reward\Models;

use DB;
use Crypt;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->initialize();
    }

    /**
     * Create a unique slug
     *
     * @param  string $title
     * @return void
     */
    public function getUniqueSlug($title)
    {
        $slug = str_slug($title);

        $row = DB::table($this->table)->where('slug', $slug)->first();

        if ($row) {
            $num = 2;
            while ($row) {
                $newSlug = $slug .'-'. $num;

                $row = DB::table($this->table)->where('slug', $newSlug)->first();
                $num++;
            }

            $slug = $newSlug;
        }

        return $slug;
    }

    /**
     * Initialize modal variables form config
     */
    public function initialize()
    {

    }

    /**
     * Get the encrypted Id of
     *
     * @param  string $title
     * @return void
     */
    public function getEidAttribute()
    {
        return Crypt::encrypt($this->id);
    }

}
