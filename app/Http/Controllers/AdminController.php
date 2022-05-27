<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\City;
use App\Models\Order;
use App\Models\Domain;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Address;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\SubCategory;

class AdminController extends Controller
{

// status pending
// status accepted
// status completed
// status canceled
// status ongoing

    public function index(Request $request){
        $all        = Order::count();
        $pending    = Order::where('status', 'pending')->count();
        $ongoing    = Order::where('status', 'ongoing')->count();
        $completed  = Order::where('status', 'completed')->count();
        $canceled   = Order::where('status', 'canceled')->count();

        return view('admin.dashboard', compact('all', 'pending', 'ongoing', 'completed', 'canceled'));
    }


    public function notifications()
    {
        return view('admin.notifications');
    }

    
    public function users()
    {
        return view('admin.users');
    }
    public function get_users()
    {
        try{

            $users = User::where('role', 2)->orderBy('id', 'DESC')->get();
            return response()->json([
                'status'    => true,
                'message'   => "Users List",
                'data'      => $users
            ], 200);

        }catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      => null
            ], 400);
        }

    }
    public function user_status($id, $status)
    {
        try{
            $user = User::find($id);
            $msg;
            if ($status == 1 && $user->status == 0) 
            {
                $msg = "User Verified Successfully";
            }
            else if ($status == 1 && $user->status == 2) 
            {
                $msg = "User Unblocked Successfully";
            }
            else if ($status == 2) 
            {
                $msg = "User blocked Successfully";
            }
            else
            {
                $msg = "User status updated Successfully";
            }
            $user->status = $status;
            $user->save();
            return response()->json([
                'status'    => true,
                'message'   => $msg,
                'data'      => null
            ], 200);
        }catch(\Exception $e){

            return response()->json([
                'status'    => false,
                'error'     => $e->getMessage(),
                'data'      => null
            ], 400);
        }

    }
    public function delete_user($id){
        $user = User::find($id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => "User deleted Successfully",
            'data'      => null
        ], 200);
    }


    public function cities(Request $request){
        return view('admin.cities');
    }
    public function get_cities(Request $request){
        $cities = City::orderBy('id', 'DESC')->get();
        return response()->json([
            'status'    => true,
            'message'   => "Cities List",
            'data'      => $cities
        ], 200);
    }
    public function delete_city($id){
        $categories = City::find($id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => "City deleted Successfully",
            'data'      => null
        ], 200);
    }
    public function add_edit_city(Request $request)
    {
        // return $request->all();
        $validator = \Validator::make($request->all(), [
            'name'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'error'     => $validator->errors()->first(),
                'data'      => null
            ], 200);
        }else{
            $city         = new City;
            $city->name   = $request->name;
            $city->save();
            return response()->json([
                'status'    => true,
                'message'   => "City added Successfully",
                'data'      => null
            ], 200);
        }
    }


    public function domains(Request $request)
    {
        return view('admin.domains');
    }
    public function get_domains(Request $request)
    {
        $domains = Domain::orderBy('id', 'DESC')->get();
        return response()->json([
            'status'    => true,
            'message'   => "Domains List",
            'data'      => $domains
        ], 200);
    }
    public function delete_domain($id){
        $categories = Domain::find($id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => "Domain deleted Successfully",
            'data'      => null
        ], 200);
    }
    public function add_domains(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'domain_name'       => 'required',
            'urdu_domain_name'  => 'required',
            'city'              => 'required',
            'image'             => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->first(),
                'data' => null
            ], 200);
        }else{
            $domain = new Domain;
            $domain->name             = $request->domain_name;
            $domain->urdu_name        = $request->urdu_domain_name;
            $domain->city             = implode(',', $request->city);
            if ($request->has('image')) 
            {
                $newfilename = time() .'.'. $request->image->getClientOriginalExtension();
                $request->file('image')->move(public_path("domains"), $newfilename);
                $domain->image = 'domains/'.$newfilename;
            }
            $domain->save();
            return response()->json([
                'status'    => true,
                'message'   => "Domains added Successfully",
                'data'      => null
            ], 200);
        }
    }


    public function banners($id = null,  Request $request){

        $domains = Domain::orderBy('id', 'DESC')->get();
        return view('admin.banners', compact('domains'));

    }
    public function get_banners($id, Request $request){
        $banners = Banner::orderBy('id', 'DESC');
        if ($id !== 'all') 
        { 
            $banners = $banners->where('domain_id', $id);
        }
        $banners = $banners->with('domain')->get();
        
        return response()->json([
            'status'    => true,
            'message'   => "Categories List",
            'data'      => $banners
        ], 200);
    }
    public function add_edit_banners(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'domain'        => 'required',
            'city'          => 'required',
            'banner_image'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->first(),
                'data' => null
            ], 200);
        }else{
            $banner             = new Banner;
            $banner->domain_id  = $request->domain;
            $banner->city       = implode(',', $request->city);
            if ($request->has('banner_image')) 
            {
                $newfilename = time() .'.'. $request->banner_image->getClientOriginalExtension();
                $request->file('banner_image')->move(public_path("banners"), $newfilename);
                $banner->image = 'banners/'.$newfilename;
            }
            $banner->save();
            return response()->json([
                'status'    => true,
                'message'   => "banner added Successfully",
                'data'      => null
            ], 200);
        }
    }
    public function delete_banner($id){
        $banner = Banner::find($id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => "Banner deleted Successfully ",
            'data'      => null
        ], 200);
    }


    public function categories(Request $request)
    {
        $domains = Domain::all();
        return view('admin.categories', compact('domains'));
    }
    public function get_categories($id, Request $request){
        $categories = Category::orderBy('id', 'DESC');
        if ($id !== 'all') 
        { 
            $categories = $categories->where('domain_id', $id);
        }
        $categories = $categories->get();
        

        return response()->json([
            'status'    => true,
            'message'   => "Categories List",
            'data'      => $categories
        ], 200);
    }
    public function delete__category($id){
        $categories = Category::find($id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => "Category deleted Successfully",
            'data'      => null
        ], 200);
    }
    public function add_edit_category(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'domain'       => 'required',
            'city'          => 'required',
            'name'              => 'required',
            'category_image'             => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->first(),
                'data' => null
            ], 200);
        }else{
            $category                   = new Category;
            $category->name             = $request->name;
            $category->city             = implode(',', $request->city);
            $category->domain_id        = $request->domain;
            if ($request->has('category_image')) 
            {
                $newfilename          = time() .'.'. $request->category_image->getClientOriginalExtension();
                $request->file('category_image')->move(public_path("category_images"), $newfilename);
                $category->image        = 'category_images/'.$newfilename;
            }
            $category->save();
            return response()->json([
                'status'    => true,
                'message'   => "Category added Successfully",
                'data'      => null
            ], 200);
        }
    }


    public function sub__categories(Request $request)
    {
        $cat =  Category::find($request->id);
        return view('admin.sub__categories', compact('cat'));
    }
    public function add_edit_sub_category(Request $request)
    {
        // return $request->all();
        $validator = \Validator::make($request->all(), [
            'category_id'           => 'required',
            'city'                  => 'required',
            'name'                  => 'required',
            'sub_category_image'    => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'error'     => $validator->errors()->first(),
                'data'      => null
            ], 400);
        }else{
            $subcategory                   = new SubCategory;
            $subcategory->name             = $request->name;
            $subcategory->city             = implode(',', $request->city);
            $subcategory->category_id      = $request->category_id;
            if ($request->has('sub_category_image')) 
            {
                $newfilename            = time() .'.'. $request->sub_category_image->getClientOriginalExtension();
                $request->file('sub_category_image')->move(public_path("sub_category_image"), $newfilename);
                $subcategory->image     = 'sub_category_image/'.$newfilename;
            }
            $subcategory->save();
            return response()->json([
                'status'    => true,
                'message'   => "subcategory added Successfully",
                'data'      => null
            ], 200);
        }
    }
    public function get_sub_categories($id, Request $request){
        $subcategories = SubCategory::where('category_id', $id)->orderBy('id', 'DESC')->get();
        return response()->json([
            'status'    => true,
            'message'   => "Sub Categories List",
            'data'      => $subcategories
        ], 200);
    }
    public function delete_sub_category($id){
        $categories = Category::find($id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => "Category deleted Successfully",
            'data'      => null
        ], 200);
    }


    public function services(Request $request)
    {
        $sub_category = SubCategory::find($request->id);
        return view('admin.services', compact('sub_category'));
    }
    public function get_services(Request $request){
        $services = Service::orderBy('id', 'DESC')->get();
        return response()->json([
            'status'    => true,
            'message'   => "services List",
            'data'      => $services
        ], 200);
    }
    public function add_edit_service(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'city'              => 'required',
            'name'              => 'required',
            'price'             => 'required',
            'pricetype'         => 'required',
            'service_image'     => 'required',
            'sub_category_id'   => 'required',
            'description'       => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->first(),
                'data' => null
            ], 400);
        }else{
            $service                   = new Service;
            $service->name              = $request->name;
            $service->price_type        = $request->pricetype;
            $service->price             = $request->price;
            $service->description       = $request->description;

            if ($request->has('old_price')) 
            {
                $service->old_price     = $request->old_price;
            }
            $service->sub_category_id   = $request->sub_category_id;
            $service->city              = implode(',', $request->city);
            if ($request->has('service_image')) 
            {
                $newfilename          = time() .'.'. $request->service_image->getClientOriginalExtension();
                $request->file('service_image')->move(public_path("service_image"), $newfilename);
                $service->image        = 'service_image/'.$newfilename;
            }
            $service->save();
            return response()->json([
                'status'    => true,
                'message'   => "Service added Successfully",
                'data'      => null
            ], 200);
        }
    }
    public function delete_service($id){
        $service = Service::find($id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => "Service deleted Successfully",
            'data'      => null
        ], 200);
    }


    public function change_password(Request $request)
    {
        return view('admin.changePassword');
    }
    public function update_password(Request $request)
    {
        if (Hash::check($request->curr__password, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new__password);
            if($user->save())
            {
                return Redirect::back()->with('msg', 'Password updated Successfully');
            }


        }
    }
    public function change_email(Request $request)
    {
        return view('admin.changeEmail');
    }
    public function update_email(Request $request)
    {
        if (Hash::check($request->password, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->email = $request->email;
            if($user->save())
            {
                return Redirect::back()->with('msg', 'Password updated Successfully');
            }


        }
    }

}
