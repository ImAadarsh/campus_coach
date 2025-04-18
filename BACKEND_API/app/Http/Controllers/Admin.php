<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategorie;
use App\Models\Categorie;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Item;
use App\Models\Testimonial;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Response;

class Admin extends Controller
{
    public function insertBlog(Request $request)
{
    $rules = [
        'title' => 'required|max:500',
        'subtitle' => 'required|max:1000',
        'content' => 'required',
        'category_id' => 'required|exists:blog_categories,id',
        'author_name' => 'required|max:255',
        'quote' => 'nullable|max:500',
        'tags' => 'required|max:255',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }
    if(!User::where('remember_token',$request->token)->where('user_type','admin')->first()){
        return response(["status" =>"false", "message"=>"Session is expired. Please Login Again"], 401);
    }
    try {
        if($request->id){
            $blog = Blog::find($request->id);
        }else{
            $blog = new Blog();
        }
        if($request->title)
        $blog->title = $request->title;
        if($request->subtitle)
        $blog->subtitle = $request->subtitle;
        if($request->content)
        $blog->content = $request->content;
        if($request->category_id)
        $blog->category_id = $request->category_id;
        if($request->author_name)
        $blog->author_name = $request->author_name;
        if ($request->hasFile('icon')) {
            $file = $request->file('icon')->store('public/blog/icon');
            $blog->icon  = $file;
        }
        if ($request->hasFile('banner')) {
            $file1 = $request->file('banner')->store('public/blog/banner_image');
            $blog->banner  = $file1;
        }
        if($request->quote)
        $blog->quote = $request->quote;
        if($request->tags)
        $blog->tags = $request->tags;
        $blog->save();

        return response([
            'status' => true,
            'message' => 'Blog created successfully.',
            'data' => $blog
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert blog.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function insertBlogCategory(Request $request)
{
    $rules = [
        'name' => 'required|max:255',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }
    if(!User::where('remember_token',$request->token)->where('user_type','admin')->first()){
        return response(["status" =>"false", "message"=>"Session is expired. Please Login Again"], 401);
    }

    try {
        if($request->id){
            $category = BlogCategorie::find($request->id);
        }else{
            $category = new BlogCategorie();
        }
        
        $category->name = $request->name;
        $category->save();

        return response([
            'status' => true,
            'message' => 'Blog category created successfully.',
            'data' => $category
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert blog category.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function insertCategory(Request $request)
{
    $rules = [
        'name' => 'required|max:255',
        'sequence' => 'required|integer',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }
    

    try {
        if(!User::where('remember_token',$request->token)->where('user_type','admin')->first()){
            return response(["status" =>"false", "message"=>"Session is expired. Please Login Again"], 401);
        }
        if($request->id){
            $category = Categorie::find($request->id);
        }else{
            $category = new Categorie();
        }
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->sequence = $request->sequence;
        $category->save();

        return response([
            'status' => true,
            'message' => 'Category created successfully.',
            'data' => $category
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert category.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function insertCoupon(Request $request)
{
    $rules = [
        'coupon_code' => 'required|max:15',
        'value' => 'required|numeric',
        'valid_till' => 'required|date',
        'count' => 'required|integer',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }
    if(!User::where('remember_token',$request->token)->where('user_type','admin')->first()){
        return response(["status" =>"false", "message"=>"Session is expired. Please Login Again"], 401);
    }

    try {
        if($request->id){
            $coupon = Coupon::find($request->id);
        }else{
            $coupon = new Coupon();
        }
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount_type = 1;// Default to 2 if not provided
        $coupon->value = $request->value;
        $coupon->valid_till = $request->valid_till;
        $coupon->count = $request->count;
        $coupon->save();

        return response([
            'status' => true,
            'message' => 'Coupon created successfully.',
            'data' => $coupon
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert coupon.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function insertEvent(Request $request)
{
    $rules = [
        'name' => 'nullable|max:255',
        'description' => 'nullable|max:2000',
        'learning' => 'nullable|max:1000',
        'icon' => 'nullable',
        'banner_image' => 'nullable',
        'location' => 'nullable|max:255',
        'register_link' => 'nullable|max:255',
        'date' => 'nullable|date',
        'time' => 'nullable',
        'seat' => 'nullable|integer',
        'is_certificate' => 'nullable',
        'brand' => 'nullable|max:255',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }
    if(!User::where('remember_token',$request->token)->where('user_type','admin')->first()){
        return response(["status" =>"false", "message"=>"Session is expired. Please Login Again"], 401);
    }

    try {
        if($request->id){
            $event = Event::find($request->id);
        }else{
            $event = new Event();
        }
        $event->name = $request->name;
        $event->description = $request->description;
        $event->learning = $request->learning;
        if ($request->hasFile('icon')) {
            $file = $request->file('icon')->store('public/workshop/icon');
            $event->icon  = $file;
        }
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image')->store('public/workshop/banner_image');
            $event->banner_image  = $file;
        }
        $event->location = $request->location;
        $event->register_link = $request->register_link;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->seat = $request->seat;
        $event->is_certificate = $request->is_certificate;
        $event->brand = $request->brand;
        $event->save();

        return response([
            'status' => true,
            'message' => 'Event created successfully.',
            'data' => $event
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert event.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function insertItem(Request $request)
{
    $rules = [
        'cart_id' => 'required|integer',
        'workshop_id' => 'required|integer',
        'price' => 'required|numeric',
        'coupon_code' => 'nullable|max:255',
        'discount' => 'nullable|numeric',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }
    if(!User::where('remember_token',$request->token)->where('user_type','admin')->first()){
        return response(["status" =>"false", "message"=>"Session is expired. Please Login Again"], 401);
    }

    try {
        $item = new Item();
        $item->cart_id = $request->cart_id;
        $item->workshop_id = $request->workshop_id;
        $item->price = $request->price;
        $item->coupon_code = $request->coupon_code;
        $item->discount = $request->discount;
        $item->save();

        return response([
            'status' => true,
            'message' => 'Item created successfully.',
            'data' => $item
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert item.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function insertTestimonial(Request $request)
{
    $rules = [
        'name' => 'required|max:255',
        'review' => 'required|max:500',
        'rating' => 'required|integer|min:1|max:5',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }
    if(!User::where('remember_token',$request->token)->where('user_type','admin')->first()){
        return response(["status" =>"false", "message"=>"Session is expired. Please Login Again"], 401);
    }

    try {
       if($request->id){
        $testimonial =  Testimonial::find($request->id);
       }else{
        $testimonial = new Testimonial();
       }
        $testimonial->name = $request->name;
        $testimonial->review = $request->review;
        $testimonial->rating = $request->rating;
        $testimonial->save();

        return response([
            'status' => true,
            'message' => 'Testimonial created successfully.',
            'data' => $testimonial
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert testimonial.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function insertTrainer(Request $request)
{
    $rules = [
        'token' => 'required|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'hero_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
        'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
        'short_about' => 'nullable|string|max:500',
        'about' => 'nullable|string',
        'designation' => 'required|string|max:255',
        'email' => 'required|email|unique:trainers,email',
        'passcode' => 'required|string|min:6',
        'mobile' => 'required|string|max:15|unique:trainers,mobile'
    ];
    
    $validator = Validator::make($request->all(), $rules);
    
    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
    }
    
    $admin = User::where('remember_token', $request->token)->where('user_type', 'admin')->first();
    if (!$admin) {
        return response()->json(['status' => false, 'message' => 'Session expired. Please log in again.'], 401);
    }
    
    try {
        $trainer = $request->id ? Trainer::find($request->id) : new Trainer();
        
        if (!$trainer) {
            return response()->json(['status' => false, 'message' => 'Trainer not found.'], 404);
        }
        
        $trainer->first_name = $request->first_name;
        $trainer->last_name = $request->last_name;
        $trainer->short_about = $request->short_about;
        $trainer->about = $request->about;
        $trainer->designation = $request->designation;
        $trainer->email = $request->email;
        $trainer->passcode = bcrypt($request->passcode);
        $trainer->mobile = $request->mobile;
        
        if ($request->hasFile('hero_img')) {
            $heroImgPath = $request->file('hero_img')->store('public/trainer/hero');
            $trainer->hero_img = $heroImgPath;
        }
        
        if ($request->hasFile('profile_img')) {
            $profileImgPath = $request->file('profile_img')->store('public/trainer/profile');
            $trainer->profile_img = $profileImgPath;
        }
        
        $trainer->save();
        
        return response()->json([
            'status' => true,
            'message' => 'Trainer saved successfully.',
            'data' => $trainer
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to save trainer.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function insertWorkshop(Request $request)
{
    $rules = [
        'title' => 'required|max:255',
        'description' => 'required|max:2000',
        'category_id' => 'required|integer|exists:categories,id',
        'start_date' => 'required|date',
        'duration' => 'required|string',
        'language' => 'required|string',
        'state' => 'required|string',
        'location' => 'required|string',
        'requirements' => 'nullable|string',
        'mode' => 'required|string',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response($validator->errors(), 400);
    }

    if(!User::where('remember_token', $request->token)->where('user_type', 'admin')->first()){
        return response(["status" => "false", "message" => "Session is expired. Please Login Again"], 401);
    }

    try {
        if($request->id){
            $workshop = Workshop::find($request->id);
        } else {
            $workshop = new Workshop();
        }

        $workshop->title = $request->title;
        $workshop->description = $request->description;
        $workshop->category_id = $request->category_id;
        $workshop->start_date = $request->start_date;
        $workshop->duration = $request->duration;
        $workshop->language = $request->language;
        $workshop->state = $request->state;
        $workshop->location = $request->location;
        $workshop->requirements = $request->requirements;
        $workshop->mode = $request->mode;

        if ($request->hasFile('icon_image')) {
            $file = $request->file('icon_image')->store('public/workshop/icon_image');
            $workshop->icon_image = $file;
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image')->store('public/workshop/banner_image');
            $workshop->banner_image = $file;
        }

        $workshop->save();

        return response([
            'status' => true,
            'message' => 'Workshop created successfully.',
            'data' => $workshop
        ], 201);
    } catch (\Exception $e) {
        return response([
            'status' => false,
            'message' => 'Failed to insert workshop.',
            'error' => $e->getMessage()
        ], 500);
    }
}



}
