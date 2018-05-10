<?php

namespace App\Http\Controllers;

use App\Models\{Resale,Client};
use Illuminate\Http\Request;
use DB,Carbon\Carbon;

class ResaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == '1') {
           $resales = \App\Models\Resale::all();
        } else {
           $resales = \App\Models\Resale::where('approved',true)->get();   
        }
        
        return view('resale.index',compact('resales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        \Session::get('mobile');
        return view('resale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
              'sale_type' => 'required',
              'status' => 'required',
              'floor' => 'required',
              'location_id' => 'required',
              'project_id' => 'required',
              'built_up_area' => 'required',
              'land_area' => 'required',
              'unit_price' => 'required',
              'down_payment' => 'required',
              'transfer_fees' => 'required',
              'buyer_commission' => 'required',
              'property_type' => 'required',
              'unit_placed_in' => auth()->user()->role_id == '1' ? 'required' : '',
              'seller_commission' => 'required',
              'installment' => 'required',
              'delivery_date' => 'required',
              'mobile' => 'required'
        ]);

        if (!in_array($request->mobile,$this->getPhones())) {

              session(['number_type_mobile'=>'','number_type_international_number'=>'']);

               return response()->json(['success'=>false,'message'=>'<div class="alert alert-warning"><strong>Error!</strong> You Should Add Lead First.<a href="'.route('leads-create-get').'" class="btn btn-danger">Add New Lead</a></div>']);      
        }

        $data = array_except($request->all(),['_token','delivery_date','submit','unit_placed_in']);
        $approved = auth()->user()->role_id == '1' ? true : false;
        $client = Client::where('Phone',$request->mobile)->orWhere('mobile',$request->mobile)
                              ->orWhere('mobile_two',$request->mobile)->orWhere('international_number',$request->mobile)
                              ->orWhereHas('sub',function($query)use($request){
                                  $query->where('phone',$request->mobile)
                                        ->orWhere('mobile_one',$request->mobile)
                                        ->orWhere('mobile_two',$request->mobile)
                                        ->orWhere('international_number',$request->mobile);
                              })->first();
        

        $new_data = array_merge($data,[
                                        'date'=>\Carbon\Carbon::now(),
                                        'delivery_date'=>\Carbon\Carbon::parse($request->delivery_date),
                                        'created_by' => auth()->user()->id,
                                        'unit_now' => 'available',
                                        'client_name' => $client->name.' '.$client->last_name,
                                        'approved' => $approved,
                                        'unit_placed_in' => auth()->user()->role_id == '1' ? json_encode($request->unit_placed_in) : json_encode([]),
                                    ]);

        \App\Models\Resale::create($new_data);

         return response()->json(['success'=>true,'message'=>'<div class="alert alert-success"><strong>Error!</strong> This Resal Added Successfully.</div>']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resale  $resale
     * @return \Illuminate\Http\Response
     */
    public function show(Resale $resale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resale  $resale
     * @return \Illuminate\Http\Response
     */
    public function edit(Resale $resale)
    {
        return view('resale.edit',compact('resale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resale  $resale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resale $resale)
    {

        $this->validate($request,[
              'sale_type' => 'required',
              'status' => 'required',
              'floor' => 'required',
              'location_id' => 'required',
              'project_id' => 'required',
              'built_up_area' => 'required',
              'land_area' => 'required',
              'unit_price' => 'required',
              'down_payment' => 'required',
              'transfer_fees' => 'required',
              'buyer_commission' => 'required',
              'property_type' => 'required',
              'unit_placed_in' => 'required',
              'seller_commission' => 'required',
              'installment' => 'required',
              'delivery_date' => 'required'
        ]);

        if (!in_array($request->mobile,$this->getPhones())) {
               return response()->json(['success'=>false,'message'=>'<div class="alert alert-warning"><strong>Error!</strong> You Should Add Lead First.<a href="'.route('leads-create-get').'" class="btn btn-danger">Add New Lead</a></div>']);      
        }

        $data = array_except($request->all(),['_token','delivery_date','submit','unit_placed_in']);
        $approved = auth()->user()->role_id == '1' ? true : false;
        
        $new_data = array_merge($data,[
                                        'delivery_date'=>\Carbon\Carbon::parse($request->delivery_date),
                                        'updated_by' => auth()->user()->id,
                                        'approved' => $approved,                                        
                                        'unit_placed_in' => json_encode($request->unit_placed_in),
                                    ]);
        
        $resale->update($new_data);

         return response()->json(['success'=>true,'message'=>'<div class="alert alert-success"><strong>Error!</strong> This Resale updated Successfully.</div>']);
    }
   
   /**
    * [approve description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
   public function approve($id,$status)
   {
          \App\Models\Resale::where('id',$id)->update(['approved'=>$status]);
          session()->flash('success', ('<strong>Congrats</strong> Updated Successfully'));          
          return back();

   }

   /**
    * [search description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
   public function search(Request $request)
   {

     $unit_price_from = $request->unit_price_from != '' ? (int)$request->unit_price_from : 0;
     $unit_price_to = $request->unit_price_to != '' ? (int)$request->unit_price_to : 100000000000000;
     $down_payment_from = $request->down_payment_from != '' ? (int)$request->down_payment_from : 0;
     $down_payment_to = $request->down_payment_to != '' ? (int)$request->down_payment_to : 100000000000000;

// dd($request->all(),$unit_price_from,$unit_price_to,$down_payment_from,$down_payment_to);
      $builder = Resale::select('*');
      
      if ($request->get('sale_type') != 'none') {
         $builder->where('sale_type',$request->get('sale_type'));
      }  

      if ($request->get('status') != 'none') {
         $builder->where('status',$request->get('status'));
      }

      if ($request->get('project_id') != 'none') {
         $builder->where('project_id',$request->get('project_id'));
      }

      if ($request->get('property_type') != '10') {
         $builder->where('property_type',$request->get('property_type'));
      }

      if ($request->get('location_id') != '1') {
         $builder->where('location_id',$request->get('location_id'));
      }

      if ($request->get('id') != '') {
         $builder->where('id',$request->get('id'));
      }
      if ($request->get('delivery_date') != '') {
         $builder->whereDate('delivery_date',Carbon::parse($request->get('delivery_date')));
      }

         $builder->whereBetween('unit_price',[$unit_price_from,$unit_price_to]);
         $builder->whereBetween('down_payment',[$down_payment_from,$down_payment_to]);
      
      $resales = $builder->get();
     return view('resale.search-results',compact('resales'));



   }

   /**
    * [getPhones description]
    * @return [type] [description]
    */
   public function getPhones()
   {
      $f1 = DB::table('clients')->where('Phone','!=','')->pluck('Phone')->toArray();
      $f2 = DB::table('clients')->where('mobile','!=','')->pluck('mobile')->toArray();
      $f3 = DB::table('clients')->where('mobile_two','!=','')->pluck('mobile_two')->toArray();
      $f4 = DB::table('clients')->where('international_number','!=','')->pluck('international_number')->toArray();
      $f5 = DB::table('sub_contacts')->where('phone','!=','')->pluck('phone')->toArray();
      $f6 = DB::table('sub_contacts')->where('mobile_one','!=','')->pluck('mobile_one')->toArray();
      $f7 = DB::table('sub_contacts')->where('mobile_two','!=','')->pluck('mobile_two')->toArray();
      $f8 = DB::table('sub_contacts')->where('international_number','!=','')->pluck('international_number')->toArray();

      $array = array_unique(array_collapse([$f1,$f2,$f3,$f4,$f5,$f6,$f7,$f8]));

      return $array;

   }
}
