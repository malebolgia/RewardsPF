<?php
namespace Petfinder\Reward\Http\Controllers;

use App\Http\Controllers\PublicController as CMSPublicController;
use Petfinder\Reward\Interfaces\RewardRepositoryInterface;

class RewardPublicController extends CMSPublicController
{

    /**
     * Constructor
     * @param type \Petfinder\Reward\Interfaces\RewardRepositoryInterface $reward
     *
     * @return type
     */
    public function __construct(RewardRepositoryInterface $reward)
    {
        $this->model = $reward;
        parent::__construct();
    }

    /**
     * Show reward's list
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $rewards = $this->model->all();

        return $this->theme->of('reward::public.reward.index', compact('rewards'))->render();
    }

    /**
     * Show reward
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $reward = $this->model->findBySlug($slug);

        return $this->theme->of('reward::public.reward.show', compact('reward'))->render();
    }
}
