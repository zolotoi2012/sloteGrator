<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\PrizeType;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;

/**
 * Class PrizeController
 * @package App\Http\Controllers
 */
class PrizeController extends Controller
{
    /**
     * @var float
     */
    private $amount = 0;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPrize(Faker $faker)
    {
        $prize = $this->getRandomPrize();

        if ($prize->name === 'Money') {
            $this->amount = $faker->randomFloat(2);
        }

        return view('win', ['prize' => $this->getRandomPrize(), 'amount' => $this->amount]);
    }

    public function convert(float $amount)
    {

    }

    /**
     * @return bool|mixed
     */
    private function getRandomPrize()
    {
        return $this->getRandom(PrizeType::all()->toArray());
    }

    /**
     * @param array $prizes
     * @return bool|mixed|string
     */
    private function getRandom(array $prizes)
    {
        $prize = array_rand($this->checkCountOfPrize($prizes));

        try {
            $prize = PrizeType::find($prizes[$prize]['id']);

            if ($prize->name === 'Bonus') {
                return $prize;
            }

            $prize->count = $prize->count - 1;

            if ($prize->save()) {
                return $prize;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return false;
    }

    /**
     * @param array $prizes
     * @return array
     */
    private function checkCountOfPrize(array $prizes): array
    {
        return array_filter($prizes, function ($prize) {
            var_dump($prize['count']);
            return $prize['count'] > 0 || $prize['count'] === null;
        });
    }
}
