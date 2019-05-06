<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Block;
use App\Planting;
use App\FlowerType;
use App\Picking;
use App\Bouquet;
use App\BouquetPick;
use App\Boxing;
use App\Shipment;
use Illuminate\Support\Facades\DB;

class TambuziController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     //stores Profile data
    public function storeProfile(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $employeeno = $json_obj[0]["employeeno"];
            $preferredname = $json_obj[0]["preferredname"];
            $myinfo = $json_obj[0]["myinfo"];
            $logo = $json_obj[0]["logo"];
            $phoneno = $json_obj[0]["phoneno"];
            Profile::create([
                'employee_no' => $employeeno, 'preferred_name' => $preferredname, 'my_information' => $myinfo, 'photo' => $logo, 'phone_no' => $phoneno
            ]);
        }
    }
   //getprofile data
    public function getProfiles()
    {
        $profiles = Profile::all();
        echo $profiles;
    }
    public function getShipments()
    {
        $shipments = Shipment::all();
        echo $shipments;
    }
    public function getBoxNumbers()
    {
        $boxes = Boxing::all();
        echo $boxes;
    }

    //stores block data
    public function storeBlocks(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $blockno = $json_obj[0]["Block Number"];
            $profileno = $json_obj[0]["Profile Number"];

            Block::create([
                'block_number' => $blockno, 'profile_id' => $profileno
            ]);
        }
    }
    //get flower types
    public function getFlowerTypes()
    {
        $flowerTypes = FlowerType::all();
        echo $flowerTypes;
    }
    public function getBouquetDetails()
    {
        $bouquet = DB::table('profiles')
            ->where('employee_no ', '12727272')
            ->get();
        dd($bouquet);
    }
    public function bouquet()
    {

    }
    
    // store beds
    public function storePlanting(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $blockno = $json_obj[0]["blockno"];
            $flowertype = $json_obj[0]["flowertype"];
            $bednumber = $json_obj[0]["bednumber"];
            $plantingdate = $json_obj[0]["plantingdate"];

            Planting::create([
                'plant_date' => $plantingdate, 'block_id' => $blockno, 'flower_type_id' => $flowertype, 'bed_no' => $bednumber
            ]);
        }
    }
    //store picks
    public function storePicking(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $pickdate = $json_obj[0]["Pick Date"];
            $pickno = $json_obj[0]["Pick Number"];
            $bednumber = $json_obj[0]["Bed Number"];
            $flowerimage = $json_obj[0]["Flower Image"];

            Picking::create([
                'pick_date' => $pickdate, 'pick_no' => $pickno, 'bed_id' => $bednumber, 'flower_image' => $flowerimage
            ]);
        }
    }
    //store bouquet
    public function storeBouquet(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $profileno = $json_obj[0]["Profile Number"];
            $boxno = $json_obj[0]["Box Number"];
            Bouquet::create([
                'profile_id' => $profileno, 'box_id' => $boxno
            ]);
        }
    }
    // store bouquetpicks
    public function storeBouquetPick(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $profileno = $json_obj[0]["Profile Number"];
            $boxno = $json_obj[0]["Bouquet Number"];
            Bouquet::create([
                'profile_id' => $profileno, 'box_id' => $boxno
            ]);
        }
    }
    //store boxing
    public function storeBoxing(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $boxno = $json_obj[0]["Box Number"];
            $shipmentid = $json_obj[0]["Shipping Number"];

            Boxing::create([
                'box_no' => $boxno, 'shipment_id' => $shipmentid
            ]);
        }
    }
    // store Shipment
    public function storeShipment(Request $request)
    {
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $shipmentno = $json_obj[0]["Shipment Number"];
            $locationname = $json_obj[0]["Location Name"];

            Shipment::create([
                'shipment_no' => $shipmentno, 'location_friendly_name' => $locationname
            ]);
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
