<?php

namespace Petfinder\Reward\Models;

use Lavalite\Filer\FilerTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use FilerTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Initialiaze page modal
     *
     * @param $name
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Initialize the modal variables.
     *
     * @return void
     */
    public function initialize()
    {
        $this->fillable             = config('reward.reward.fillable');
        $this->uploads              = config('reward.reward.uploadable');
        $this->uploadRootFolder     = config('reward.reward.upload_root_folder');
        $this->table                = config('reward.reward.table');
    }

    

}
