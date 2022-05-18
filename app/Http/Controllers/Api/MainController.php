<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Banner;
use DB;

// status pending
// status accepted
// status completed
// status canceled
// status removed


class MainController extends Controller
{
    public function categories(Request $request){
        try{
            $validator = \Validator::make($request->all(), [
                'city' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $category = Category::where('city', $request->city)->get();
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
            $category = SubCategory::where('category_id', $request->category_id)->where('city', $request->city)->get();
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
                'city'          => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()->first(),
                    'data' => null
                ], 400);
            }
            $service = Service::where('sub_category_id', $request->sub_category_id)->where('city', $request->city)->get();
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

    public function trending(Request $request){
        try{
            $service = Service::where('city', $request->city)->get();
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

    public function search(Request $request){
        try{
            $service = Service::where('city', $request->city)->where('name', 'LIKE',"%{$request->name}%")->get();
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

    public function notifications(Request $request){
        return "notifications";
    }

    public function banner(Request $request){
        $service = Banner::where('city', $request->city)->where('category_id', $request->category)->get();
        return response()->json([
            'status'    => true,
            'message'     => 'service details',
            'data'      => $service->makeHidden(['updated_at', 'created_at']),
        ], 200);
    }

    public function order(Request $request)
    {
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
            $order->user_id = $request->user_id;
            $order->date    = $request->date;
            $order->time    = $request->time;
            $order->selected_address    = $request->selected_address;


            if($order->save()){
                foreach ($request->items as $order_items){
                    $item = new OrderItem;
                    $item->order_id = $order->id;
                    $item->service_id = $order_items['service_id'];
                    $item->number = $order_items['qty'];
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
}
