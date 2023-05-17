<?php


namespace App\Repositories\Referral;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReferralStatisticChart
{
    private const DEPTH = "(SELECT count(1) - 1 FROM users as `_d` where users.deleted_at is null and users.left_id BETWEEN _d.left_id AND _d.right_id) AS `depth`";

    public function __construct(Request $request)
    {
        $user = User::find($request->route('id'));
        $carbon = new Carbon();

        $this->level = $request->route('level') + 1; // absolute level
        $this->left_id  = 1 + $user->left_id ?? 0;
        $this->right_id = $user->right_id ?? 0;
        $this->dateFrom = $carbon->create($request->get('start'));
        $this->dateTo = $carbon->create($request->get('end'));
    }

    public function getReferralCititesStatistics()
    {
        return DB::table('users')
            ->select('city as name', DB::raw('COUNT(*) as city_count'), DB::raw(Self::DEPTH))
            ->whereBetween('users.left_id', [$this->left_id, $this->right_id])
            ->whereNotNull('city')
            ->orderBy('city_count', 'DESC')
            ->groupBy('city')
            ->having('depth', '<=', $this->level)
            ->limit(10)
            ->get();
    }

    public function getReferralTimeStatistic()
    {
        $data = DB::table('users')
            ->select(DB::raw('DATE(created_at) as t'), DB::raw('COUNT(*) as y'),
            DB::raw(Self::DEPTH))
            ->whereBetween('users.left_id', [$this->left_id, $this->right_id])
            ->whereBetween('created_at', [$this->dateFrom,  $this->dateTo])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->having('depth', '<=', $this->level)
            ->get();

        return $this->transformPartnersArray($data);
    }

    private function transformPartnersArray($data)
    {
        $newArray = [];

        foreach($data as $value) {
            $newArray[] = [
                't' => $value->t,
                'y' => $value->y
            ];
        }

        for($i = 0; $i < count($newArray) - 1; $i++) {
            $newArray[$i + 1]['y'] += $newArray[$i]['y'];
        }

        return $newArray;
    }
}
