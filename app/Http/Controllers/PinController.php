<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MAPを表示
        return view('pin.map');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //DBへ登録
        $pins = DB::select("select max(id) from pins");
        $pins = array_column($pins, 'max(id)');
        $pins = $pins[0] +1;
        $pin = new Pin();
        $pin->id = $pins;
        $pin->title = $request->title;
        $pin->content = $request->content;
        $pin->latitude = $request->latitude;
        $pin->longitude = $request->longitude;
        $pin->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //TEST
        // $pins = DB::select("select max(id) from pins");
        // $pins = array_column($pins, 'max(id)');
        // $pins = $pins[0] +1;
        // var_dump($pins);
        // return view('pin.show', compact('pins'));
      
        //DBからデータを取得
        $pins_data = DB::select("select * from pins");
        return $pins_data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $pin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pin $pin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $pin)
    {
        //
    }
}
