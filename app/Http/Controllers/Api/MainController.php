<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Service;
use App\Models\Domain;
use App\Models\Banner;
use App\Models\Point;
use App\Models\Order;
use App\Models\City;
use Carbon\Carbon;
use DB;

// status pending
// status accepted
// status completed
// status canceled
// status removed

class MainController extends Controller
{

    public function domains(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'city' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'error'     => $validator->errors()->first(),
                    'data'      => null
                ], 400);
            }
            $city_id = City::where('name', $request->city)->first()->id;
            $domains = Domain::whereRaw("find_in_set($city_id , city)")->get();
            return response()->json([
                'status'    => true,
                'message'   => 'Domain List',
                'data'      => $domains,
            ], 200);

        } catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  0,
            ], 400);
        }
    }

    public function categories(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'domain'    => 'required',
                'city'      => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $city_id = City::where('name', $request->city)->first()->id;
            $category = Category::whereRaw("find_in_set($city_id , city)")->where('domain_id', $request->domain)->get();

            // $category = Category::where('city', $request->city)->get();
            return response()->json([
                'status'    => true,
                'message'   => 'category details',
                'data'      => $category->makeHidden(['updated_at', 'created_at']),
            ], 200);

        } catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  0,
            ], 400);
        }
    }

    public function sub_categories(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'category_id'   => 'required',
                'city'          => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $city_id = City::where('name', $request->city)->first()->id;
            $category = SubCategory::where('category_id', $request->category_id)->whereRaw("find_in_set($city_id , city)")->get();
            return response()->json([
                'status'    => true,
                'message'     => 'sub category details',
                'data'      => $category->makeHidden(['verified_at', 'updated_at', 'created_at']),
            ], 200);

        } catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  0,
            ], 400);
        }
    }

    public function services(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'sub_category_id'   => 'required',
                'city'              => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $city_id = City::where('name', $request->city)->first()->id;
            $Service = Service::where('sub_category_id', $request->sub_category_id)->whereRaw("find_in_set($city_id , city)")->get();
            
            return response()->json([
                'status'    => true,
                'message'     => 'service details',
                'data'      => $Service->makeHidden(['updated_at', 'created_at']),
            ], 200);

        } catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  0,
            ], 400);
        }
    }

    public function trending(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'domain'   => 'required',
                'city'     => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $city_id = City::where('name', $request->city)->first()->id;
            $categories  = Category::whereRaw("find_in_set($city_id , city)")->where('domain_id', $request->domain)->get();
            $sub_categories;
            $i = 0;
            foreach ($categories as  $category) 
            {
                if ($i == 0) 
                {
                    $sub_categories  = SubCategory::whereRaw("find_in_set($city_id , city)")->where('category_id', $category->id)->get();
                    $i = 2;
                }else
                {
                    $sub_categories  = $sub_categories->merge(SubCategory::whereRaw("find_in_set($city_id , city)")->where('category_id', $category->id)->get());
                }
            }
            $sub_categories_ids = $sub_categories->pluck('id');
            
            // return $sub_categories_ids;

            $Service     = Service::where('trending', 1)->whereIn('sub_category_id', $sub_categories_ids)->whereRaw("find_in_set($city_id , city)")->get();
            return response()->json([
                'status'    => true,
                'message'     => 'Trending Service details',
                'data'      => $Service->makeHidden(['updated_at', 'created_at']),
            ], 200);

        } catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      => null,
            ], 400);
        }
    }

    public function search(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'domain'    => 'required',
                'city'      => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $city_id = City::where('name', $request->city)->first()->id;
            $categories  = Category::whereRaw("find_in_set($city_id , city)")->where('domain_id', $request->domain)->get();
            $sub_categories;
            $i = 0;
            foreach ($categories as  $category) 
            {
                if ($i == 0) 
                {
                    $sub_categories  = SubCategory::whereRaw("find_in_set($city_id , city)")->where('category_id', $category->id)->get();
                    $i = 2;
                }else
                {
                    $sub_categories  = $sub_categories->merge(SubCategory::whereRaw("find_in_set($city_id , city)")->where('category_id', $category->id)->get());
                }
            }
            $sub_categories_ids = $sub_categories->pluck('id');
            
            $service     = Service::whereIn('sub_category_id', $sub_categories_ids)->whereRaw("find_in_set($city_id , city)")->where('name', 'LIKE',"%{$request->name}%")->get();

            return response()->json([
                'status'    => true,
                'message'     => 'service details',
                'data'      => $service->makeHidden(['updated_at', 'created_at']),
            ], 200);

        } catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  0,
            ], 400);
        }
    }

    public function banner(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'domain'    => 'required',
            'city'      => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->first(),
                'data' => null
            ], 400);
        }
        $city_id = City::where('name', $request->city)->first()->id;
        $baner = Banner::where('domain_id', $request->domain)->whereRaw("find_in_set($city_id , city)")->get();
            
        // $service = Banner::where('city', $request->city)->where('category_id', $request->category)->get();
        
        return response()->json([
            'status'    => true,
            'message'     => 'service details',
            'data'      => $baner->makeHidden(['updated_at', 'created_at']),
        ], 200);
    }

    public function points(Request $request){
        
        try
        {
            $validator = \Validator::make($request->all(), [
                'user_id'    => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $points = Point::where('user_id', $request->user_id)->first();
            if ($points) {
                $points = [
                    'points' => $points->total_points
                ];
            }
            return response()->json([
                'status'        => true,
                'message'       => 'Total Points',
                'data'          => $points
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  null,
            ], 400);
        }
    }

    public function order(Request $request){
        try{

            $validator = \Validator::make($request->all(), [
                'user_id'   => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error'  => $validator->errors()->first(),
                    'data'   => null
                ], 400);
            }
            $order = new Order;
            $order->user_id             = $request->user_id;
            $order->date                = $request->date;
            $order->time                = date('H:i', strtotime($request->time));
            $order->selected_address    = $request->selected_address;
            $order->description    = $request->description;
            if ($request->has('image')) 
            {
                $newfilename = time() .'.'. $request->image->getClientOriginalExtension();
                $request->file('image')->move(public_path("order"), $newfilename);
                $order->image = 'order/'.$newfilename;
            }
            if($order->save()){
                foreach ($request->items as $order_items){
                    $item               = new OrderItem;
                    $item->order_id     = $order->id;
                    $item->service_id   = $order_items['service_id'];
                    $item->total_items  = $order_items['qty'];
                    $item->save();
                    $service = Service::find($item->service_id);
                    $service->orders = $service->orders + $order_items['qty'];;
                    $service->save();
                }
            }
            return response()->json([
                'status'    => true,
                'message'   => 'Order Succesfully Submitted',
                'data'      => null,
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  null,
            ], 400);
        }
    }

    public function orders_list(Request $request){
        if ($request->status == 'current') {
            $status = ['pending', 'accepted'];
        }
        if ($request->status == 'past') {
            $status = ['canceled', 'removed', 'completed'];
        }
        $orders = Order::select('id', 'status', 'date', 'time', 'selected_address', 'ordernumber', 'scadualed')
                    ->where('user_id', $request->user_id)
                    ->whereIn('status', $status)
                    -> with('items')
                    ->get();

        foreach ($orders as $order) {
            $myservice = Service::find($order->items[0]->service_id);
            $sub_category = SubCategory::find($myservice->sub_category_id);
            $order->sub_category =  $sub_category->name;
            $order->address = Address::where('id', $order->selected_address)->select('id', 'title', 'city', 'area', 'street')->first();
            $total = 0;
            foreach ($order->items as $item) {
                $service = Service::find($item->service_id);
                $item->service = $service->name;
                $item->amount  = $item->number * $service->price;
                $total = $total + $item->amount;
                unset($item->created_at);
                unset($item->updated_at);
                unset($item->order_id);
                unset($item->service_id);
            }
            unset($order->selected_address);
            $order->total_amount = $total;
        }
        // orderItems
        // service
        return response()->json([
            'status'    => true,
            'message'     => 'Orders List',
            'data'      => $orders,
        ], 200);
    }

    public function notifications(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'user_id'   => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error'  => $validator->errors()->first(),
                    'data'   => null
                ], 400);
            }
            $notification = Notification::where('user_id', $request->user_id)->get();
            return response()->json([
                'status'    => true,
                'message'   => 'Notifications List',
                'data'      => $notification,
            ], 200);
        } 
        catch(\Exception $e)
        {
            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      =>  null,
            ], 400);
        }
    }
}
