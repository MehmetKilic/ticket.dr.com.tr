<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;
use App\Tickets;
use App\Tags;

class TicketController
{
    /**
     * Ticket oluşturulması için ilgili form sayfasını döndürür
     */
    public function showForm(){
        return view('ticket');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        // Form kontrolü için ilgili field'ları belirtiyoruz
        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:160',
            'content'       => 'required',
            'tags'          => 'required'
        ]);

        // Eğer validasyon işlemi fail olduysa
        if ($validator->fails()) {
            return redirect(route('ticket'))->with('error', 'Lütfen formda ki tüm alanları doldurunuz!');
        }

        $ticketAdd = Tickets::create([
            "title"             => $request->get('title'),
            "content"           => $request->get('content'),
            "ip"                => request()->ip()
        ]);

        // Etiketleri sisteme aktarıyoruz
        $tags = explode(',', $request->get('tags'));
        foreach ($tags as $tag){
            $tagInsert = Tags::create([
                'ticket_id'         => $ticketAdd->id,
                'tag'               => $tag
            ]);
        }

        if( $ticketAdd ){
            return redirect(route('ticket'))->with('success', 'Başarıyla kaydınız oluşturuldu.');
        }
        else {
            return redirect(route('rooms'))->with('error', 'Ne yazık ki kayıt oluşturulamadı, lütfen bu durumu sistem yöneticisi ile paylaşınız.');
        }
    }
}