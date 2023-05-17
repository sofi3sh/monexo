<?php


namespace App\Repositories\UserIp;


use App\Models\Admin\UserIpBrowser;
use App\Models\Admin\UserIpDevice;
use App\Models\Admin\UserIpPlatform;
use App\Models\User;
use App\Models\Admin\UserIp;
use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\DB;

class UserIpRepository extends Repository implements UserIpRepositoryInterface
{
    /**
     * @var UserIp
     */
    protected $model;

    /**
     * UserIpRepository constructor.
     *
     * @param UserIp $model
     */
    public function __construct(UserIp $model)
    {
        parent::__construct($model);
    }

    /**
     * Создание записи IP при регистрации
     *
     * @param User $user
     * @param string $ip
     */
    public function insertRegister(User $user, string $ip)
    {
        $this->model->updateOrCreate(
            ['user_id' => $user->id],
            [
                'ip_registration' => $ip,
                'platform_id' => $this->getPlatform()->id,
                'browser_id' => $this->getBrowser()->id,
                'device_id' => $this->getDevice()->id,
            ]
        );
    }

    /**
     * Создание/изменение записи IP при авторизации
     *
     * @param User $user
     * @param string $ip
     */
    public function insertAuth(User $user, string $ip)
    {
        $this->model->updateOrCreate(
            ['user_id' => $user->id],
            [
                'ip_last_auth' => $ip,
                'platform_id' => $this->getPlatform()->id,
                'browser_id' => $this->getBrowser()->id,
                'device_id' => $this->getDevice()->id,
            ]
        );
    }

    /**
     * Получение IP адресов с информацией о пользователе
     *
     * @param string|null $search - поисковый запрос
     * @param int $perPage - елементов на странице
     *
     * @return mixed
     */
    public function get(string $search = null, int $perPage = 50, string $sort = 'updated_at')
    {
        return DB::table('user_ips as t1')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('users.name', 'like', $search . '%')
                    ->orWhere('users.surname', 'like', $search . '%')
                    ->orWhere('users.email', 'like', $search . '%')
                    ->orWhere('users.id', '=', $search)
                    ->orWhere('t1.ip_last_auth', '=', $search)
                    ->orWhere('t1.ip_registration', '=', $search);
            })
            ->select(
                't1.*',
                't2.cnt as count_auth',
                'users.name as user_name',
                'users.surname as user_surname',
                'users.email as user_email',
                'user_ip_platforms.name as platform',
                'user_ip_devices.name as device',
                'user_ip_browsers.name as browser'
            )
            ->join('users', 'users.id', '=', 't1.user_id')
            ->leftJoin('user_ip_platforms', 'user_ip_platforms.id', '=', 't1.platform_id')
            ->leftJoin('user_ip_devices', 'user_ip_devices.id', '=', 't1.device_id')
            ->leftJoin('user_ip_browsers', 'user_ip_browsers.id', '=', 't1.browser_id')
            ->leftJoin(DB::raw(
                "(SELECT ip_last_auth,COUNT(*) AS cnt FROM user_ips WHERE ip_last_auth IS NOT NULL GROUP BY ip_last_auth) as t2"
            ), function ($join) {
                $join->on('t1.ip_last_auth', '=', 't2.ip_last_auth');
            })
            ->groupBy(['t1.id'])
            ->when(in_array($sort, ['updated_at', 'created_at']), function ($query) use ($sort) {
                $query->orderBy($sort, 'DESC');
            })
            ->when(($sort === 'popularity'), function ($query) {
                $query ->orderBy('count_auth', 'DESC');
            })
            ->paginate($perPage);
    }

    public function searchIp(string $search): array
    {
        $arr = array_merge(
            $this->model->select('ip_last_auth')->where('ip_last_auth', 'like', '%'.$search.'%')
                ->distinct()->pluck('ip_last_auth')->toArray(),
            $this->model->select('ip_registration')->where('ip_registration', 'like', '%'.$search.'%')
                ->distinct()->pluck('ip_registration')->toArray()
        );

        $arr = array_filter($arr, function ($var){
            return ($var !== NULL && $var !== FALSE && $var !== "");
        });

        return $arr;
    }

    /**
     * Получение платфомы (ОС) устройства пользователя
     *
     * @return mixed
     */
    protected function getPlatform()
    {
        return UserIpPlatform::firstOrCreate(
            ['name' => Browser::platformName()]
        );
    }

    /**
     * Получение имени браузера пользователя
     *
     * @return mixed
     */
    protected function getBrowser()
    {
        return UserIpBrowser::firstOrCreate(
            ['name' => Browser::browserName()]
        );
    }

    /**
     * Получение имя устройства пользователя
     *
     * @return mixed
     */
    protected function getDevice()
    {
        return UserIpDevice::firstOrCreate(
            ['name' => Browser::deviceFamily() . ' ' . Browser::deviceModel()]
        );
    }
}
