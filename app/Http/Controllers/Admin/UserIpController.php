<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserIp;
use App\Repositories\UserIp\UserIpRepositoryInterface;
use Illuminate\Contracts\View\View;
use Exception;
use Illuminate\Http\Request;

class UserIpController extends Controller
{
    private UserIpRepositoryInterface $userIpRepository;

    public function __construct(UserIpRepositoryInterface $userIpRepository)
    {
        $this->userIpRepository = $userIpRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page') ? $request->get('per_page') : 50;
        $sort = $request->get('sort') ? $request->get('sort') : 'updated_at';

        $usersIps = $this->userIpRepository->get($search, $perPage, $sort);
        return view('admin.includes.partials.userIp.index', compact('usersIps'));
    }

    /**
     * User IP live search
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchIp(Request $request)
    {
        $res = $this->userIpRepository->searchIp($request->input('term'));

        return response()->json($res);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param UserIp $fixip
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UserIp $fixip)
    {
        try {
            $fixip->delete();
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }
        return redirect()->route('admin.user-ip');
    }
}
