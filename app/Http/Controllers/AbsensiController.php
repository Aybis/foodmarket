<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DetailAbsen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $absensi = Absensi::with(['user', 'detail'])->paginate(10);
        return view('absensi.index', [
            'absensi' => $absensi 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $month = date('m');
        $year = date('Y');

        $dataLast = Absensi::with(['user', 'detail'])
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->latest()
        ->first();
        if($dataLast->status == 'in') {
            return view('absensi.check_out', ['data' => $dataLast]);
        } else {
            return view('absensi.check_in');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $absensi = new Absensi();

        DB::beginTransaction();

        try {
         
            DB::commit();
            return redirect()->route('absensis.index');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
      



    }

    public function checkIn(Request $request)
    {
        $convertToDate  = date('Ymd');
        $data           = $request->all();
        $data['image']  = $request->file('photo')->store('assets/absensi/'.$data['user_id'].'/'.$convertToDate, 'public');
        $absensi = new Absensi();

        DB::beginTransaction();

        try {
            $absensi->checkIn($data);

            dd($absensi);

            DB::commit();

            return redirect()->route('absensis.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function checkOut(Request $request, Absensi $absensi)
    {
        $convertToDate = date('Ymd', strtotime($absensi->created_at));
        $data = $request->all();
        $data['image'] = $request->file('photo')->store('assets/absensi/'.$absensi->user_id.'/'.$convertToDate, 'public');

        $detailAbsensi = new DetailAbsen();

        DB::beginTransaction();

        try {
            $detailAbsensi->checkOut($data, $absensi);
            dd($detailAbsensi);
            
            DB::commit();

            return redirect()->route('absensis.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $data = $request->all();
        $convertToDate = date('Ymd', strtotime($absensi->created_at));
        $detail_absen = new DetailAbsen();
        $data['image'] = $request->file('photo')->store('assets/absensi/'.$absensi->user_id.'/'.$convertToDate, 'public');
        // dd($absensi->detail, $data);
        DB::beginTransaction();

        try {
            // update status absen 
            $absensi->status = 'out';
            $absensi->save();
            // insert detail checkout 
            $detail_absen->absensi_id = $absensi->id;
            $detail_absen->check = 'out';
            $detail_absen->status = $absensi->detail->status;
            $detail_absen->lang = $data['lat'];
            $detail_absen->long = $data['long'];
            $detail_absen->location = $data['location'];
            $detail_absen->detail_status = $absensi->detail->detail_status;
            $detail_absen->image = $data['image'];
            $detail_absen->ip_address = $absensi->getIp();
            $detail_absen->save();
            DB::commit();

            return redirect()->route('absensis.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
