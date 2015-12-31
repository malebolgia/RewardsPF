<?php namespace Petfinder\Reward;

class Reward
{

    
/**
         * $reward object.
         */
        protected $reward;


    /**
     * Initialize reward facade.
     *
     * @param type \Petfinder\Reward\Interfaces\RewardRepositoryInterface $reward
     * @return none
     *
     */    public function __construct(
\Petfinder\Reward\Interfaces\RewardRepositoryInterface $reward, NULL)
    {
        
$this->reward     = $reward;

    }

    /**
     * Returns count of reward
     *
     * @param array $filter
     *
     * @return integer
     */
    public function count()
    {
        return  0;
    }

}
