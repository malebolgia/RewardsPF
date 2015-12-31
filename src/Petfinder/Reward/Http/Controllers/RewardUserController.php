<?php
namespace Petfinder\Reward\Http\Controllers;

use Former;
use Response;
use User;
use App\Http\Controllers\UserController as UserController;

use Petfinder\Reward\Http\Requests\RewardUserRequest;
use Petfinder\Reward\Interfaces\RewardRepositoryInterface;

/**
 *
 * @package Reward
 */

class RewardUserController extends UserController
{

    /**
     * Redirect path after an action.
     */
    protected $redirectPath = '/user/reward/reward/';


    /**
     * Initialize reward controller
     * @param type RewardRepositoryInterface $reward
     * @return type
     */
    public function __construct(RewardRepositoryInterface $reward)
    {
        $this->model = $reward;
        $this->model->setUserFilter();
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RewardUserRequest $request)
    {

        $rewards  = $this->model->all();

        $this->theme->prependTitle(trans('reward::reward.names').' :: ');

        return $this->theme->of('reward::user.reward.index', compact('rewards'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return Response
     */
    public function show(RewardUserRequest $request, $id)
    {
        $reward = $this->model->find($id);

        return $this->theme->of('reward::user.reward.show', compact('reward'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(RewardUserRequest $request)
    {
        $reward = $this->model->findOrNew(0);

        Former::populate($reward);

        return $this->theme->of('reward::user.reward.create', compact('reward'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RewardUserRequest $request)
    {
        try {
            $attributes             = $request->all();
            $reward       = $this->model->create($attributes);
            return $this->success(trans('messages.success.created', ['Module' => trans('reward::reward.name')]));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function edit(RewardUserRequest $request, $id)
    {
        $reward = $this->model->find($id);

        Former::populate($reward);

        return $this->theme->of('reward::user.reward.edit', compact('reward'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(RewardUserRequest $request, $id)
    {
        try {
            $attributes         = $request->all();
            $reward       = $this->model->update($attributes, $id);
            return $this->success(trans('messages.success.updated', ['Module' => trans('reward::reward.name')]));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(RewardUserRequest $request, $id)
    {
        try {
            $this->model->delete($id);
            return $this->success(trans('message.success.deleted', ['Module' => trans('reward::reward.name')]), 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
