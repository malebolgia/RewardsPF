<?php
namespace Petfinder\Reward\Http\Controllers;

use Former;
use Response;
use App\Http\Controllers\AdminController as AdminController;

use Petfinder\Reward\Http\Requests\RewardAdminRequest;
use Petfinder\Reward\Interfaces\RewardRepositoryInterface;

/**
 *
 * @package Reward
 */

class RewardAdminController extends AdminController
{

    /**
     * Initialize reward controller
     * @param type RewardRepositoryInterface $reward
     * @return type
     */
    public function __construct(RewardRepositoryInterface $reward)
    {
        $this->model = $reward;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RewardAdminRequest $request)
    {
        if($request->wantsJson()){

            $array = $this->model->json();
            foreach ($array as $key => $row) {
                $array[$key] = array_only($row, config('reward.reward.listfields'));
            }

            return array('data' => $array);
        }

        $this->theme->prependTitle(trans('reward::reward.names').' :: ');

        return $this->theme->of('reward::admin.reward.index')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return Response
     */
    public function show(RewardAdminRequest $request, $id)
    {
        $reward = $this->model->find($id);

        if (empty($reward)) {

            if($request->wantsJson())
                return [];

            return view('reward::admin.reward.new');
        }

        if($request->wantsJson())
            return $reward;

        Former::populate($reward);

        return view('reward::admin.reward.show', compact('reward'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(RewardAdminRequest $request)
    {
        $reward = $this->model->findOrNew(0);
        Former::populate($reward);

        return view('reward::admin.reward.create', compact('reward'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RewardAdminRequest $request)
    {
        try {
            $attributes         = $request->all();
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
    public function edit(RewardAdminRequest $request, $id)
    {
        $reward = $this->model->find($id);

        Former::populate($reward);

        return view('reward::admin.reward.edit', compact('reward'));
    }

    /**
     * Update the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(RewardAdminRequest $request, $id)
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
    public function destroy(RewardAdminRequest $request, $id)
    {
        try {
            $this->model->delete($id);
            return $this->success(trans('message.success.deleted', ['Module' => trans('reward::reward.name')]), 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
