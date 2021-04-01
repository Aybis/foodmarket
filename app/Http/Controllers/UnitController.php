<?php

namespace App\Http\Controllers;

use App\Models\Direktorats;
use App\Models\Employee;
use App\Models\SubUnit;
use App\Models\Units;
use App\Models\UserRoles;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    protected $employee;

    public function __construct()
    {
        $this->employee = new Employee();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Direktorats::with(['units:id,name,direktorat_id', 'units.subunits:id,name,unit_id'])->select('id','name')->get()->toArray();
        $direktorat = Direktorats::select('id','name')->get();
        $unit       = Units::select('id','name', 'direktorat_id')->get();
        $subUnit    = SubUnit::select('id','name', 'unit_id')->get();

        return [
            'direktorat' => $direktorat,
            'unit' => $unit,
            'subunit' => $subUnit,
        ];
    }

    public function getUnit(Request $request)
    {
        $data = Units::where('direktorat_id',$request->id)
                ->select('id','name','direktorat_id')
                ->get();
        return $data;
    }

    public function getSubUnit(Request $request)
    {
        $data = SubUnit::where('unit_id',$request->id)
                ->select('id','name','unit_id')
                ->get();
        return $data;
    }

    public function getDataEmployee(Request $request)
    {

        $filter = $request->filter;
        $id     = $request->id;
        if(!$filter && !$id){
            $data = UserRoles::with(
                'userRoles', 
                'userPositions:id,name,id'
                )
            ->select('user_id','direktorat_id','subunit_id','unit_id','position_id')->get();
         
            return $data;
        }else{
            $data   = UserRoles::with(['userRoles','userPositions:id,name,id'])
            ->where($filter.'_id', $id)
            ->select('user_id','direktorat_id','subunit_id','unit_id','position_id')
            ->get();
        }

        return $data;
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
        //
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
    public function update(Request $request, $id)
    {
        //
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
