<?php

namespace App\Http\Controllers;

// use App\Models\District;
// use App\Models\Division;
// use App\Models\Union;
// use App\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\Union;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function index()
    {
        $data['divisions'] = Division::get(["name", "id"]);
        return view('dropdown', $data);
    }

    public function fetchDistrict(Request $request)
    {
        $data['districts'] = District::where("division_id", $request->division_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchUpazila(Request $request)
    {
        $data['upazilas'] = Upazila::where("district_id", $request->district_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchUnion(Request $request)
    {
        $data['unions'] = Union::where("upazila_id", $request->upazila_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function submit(Request $request)
    {
        // dd($request->all());

        // Retrieve IDs from the request
        $divisionId = $request->input('division');
        $districtId = $request->input('district');
        $upazilaId = $request->input('upazila');
        $unionId = $request->input('union');

        // Fetch names from the database
        $division = Division::find($divisionId)->name ?? 'Not found';
        $district = District::find($districtId)->name ?? 'Not found';
        $upazila = Upazila::find($upazilaId)->name ?? 'Not found';
        $union = Union::find($unionId)->name ?? 'Not found';

        // Display the results
        dd([
            'division' => $division,
            'district' => $district,
            'upazila' => $upazila,
            'union' => $union,
        ]);
    }
}
