<?php

namespace App\Http\Controllers;

use App\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Tickets::all();
        return view('home', compact('tickets'));
    }

    /**
     * @param Request $request
     */
    public function confirm(Request $request){
        $ticketConfirm = Tickets::where('id', '=', $request->get('id'))
            ->update([
                "status"         => 0
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(){
        // Aktif olan son 10 içeriği dönüyoruz
        $activeTenTickets = Tickets::where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        // Son 7 gündür açık olan en uzun 10 içerik
        $date = \Carbon\Carbon::today()->subDays(30);
        $activeLongTickets = Tickets::whereRaw('LENGTH(content) > ? and created_at >= ?', [100, $date])
            ->limit(10)
            ->get();

        // En çok kullanılan etiketleri alıyoruz
        $mostPopularTickets = DB::table('tags')
            ->select('tags.*',DB::raw('COUNT(tag) as count'))
            ->groupBy('tag')
            ->orderBy('count', 'desc')
            ->get();

        return view('dashboard', [
            'activeTenTickets' => $activeTenTickets,
            'activeLongTickets' => $activeLongTickets,
            'mostPopularTickets' => $mostPopularTickets
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ticketDetail(Request $request){
        $ticket = Tickets::where('id', $request->id)->first();
        return view('ticket_detail', compact('ticket'));
    }

    public function tagDetail(Request $request){
        $tickets = DB::table('tickets')
            ->join('tags', 'tickets.id', '=', 'tags.ticket_id')
            ->select('tickets.*')
            ->where('tags.tag', '=', $request->name)
            ->get();

        return view('home', compact('tickets'));
    }
}
