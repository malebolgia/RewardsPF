<?php

namespace Petfinder\Reward\Repositories\Eloquent;

use Petfinder\Reward\Interfaces\RewardRepositoryInterface;

class RewardRepository extends BaseRepository implements RewardRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return config('reward.reward.model');
    }
}
