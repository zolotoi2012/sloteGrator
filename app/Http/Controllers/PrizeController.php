<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Item;
use App\PrizeType;
use App\User;
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
     * @param Faker $faker
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function getPrize(Faker $faker)
    {
        return view('win', ['prize' => $this->checkPrize($this->getRandomPrize(), $faker), 'amount' => $this->amount]);
    }

    public function convert(float $amount)
    {
        try {
            $user = User::find(Auth::id());

            $user->balance = $user->balance - $amount;

            $user->bonus_count = $user->bonus_count + (int) $amount / 3;

            if ($user->save()) {
                return redirect('home');
            }
        } catch (\Exception $e) {
            throw new \Exception('Unable to convert money to bonus');
        }
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
            return $prize['count'] > 0 || $prize['count'] === null;
        });
    }

    /**
     * @param $prize
     * @param Faker $faker
     * @return mixed
     * @throws \Exception
     */
    private function checkPrize(array $prize, Faker $faker)
    {
        if ($prize->name !== 'Item') {
            $this->amount = $faker->randomFloat(2, 1, 200);
            $prize->name === 'Money' ? $this->saveMoney() : $this->saveBonus();
        }

        return $prize;
    }

    /**
     * @throws \Exception
     */
    private function saveMoney()
    {
        try {
            $user = User::find(Auth::id());

            $user->balance += $this->amount;

            $user->save();
        } catch (\Exception $e) {
            throw new \Exception('Unable to update balance');
        }
    }

    /**
     * @throws \Exception
     */
    private function saveBonus()
    {
        try {
            $user = User::find(Auth::id());

            $user->bonus_count += (int) $this->amount;

            $user->save();
        } catch (\Exception $e) {
            throw new \Exception('Unable to update bonus count');
        }
    }
}
