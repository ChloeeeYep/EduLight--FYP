<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     
     public function addToCart(Request $request, $item)
     {
        $course = Course::findOrFail($item);
        $userId = Auth::id();
        
        // Check if the course was already ordered by the user
        $alreadyOrdered = Order::where('userId', $userId)
                            ->whereHas('orderItems', function ($query) use ($course) {
                                $query->where('courseId', $course->id);
                            })->exists();
    
        if ($alreadyOrdered) {
            // Flash a message that the user has already ordered this course
            Session::flash('cart_add_error', 'You have already purchased this course!');
            return back();
        }
    
        $cart = Cart::firstOrCreate(['userId' => $userId]);
        
        // Check if the course is already in the cart
        $existingCartItem = CartItem::where('cartId', $cart->id)
                                    ->where('courseId', $course->id)
                                    ->first();
        
        if ($existingCartItem) {
            // Flash a message that the course is already in the cart
            Session::flash('cart_add_error', 'This course is already in your cart!');
            return back();
        }
        
        // Proceed to add the course if it's not in the cart and not already ordered
        $cartItem = new CartItem([
            'cartId' => $cart->id,
            'courseId' => $course->id,
            'courseName' => $course->title,
            'courseLevel' => $course->level,
            'coursePrice' => $course->price,
        ]);
        $cartItem->save();
    
        // Flash a success message
        Session::flash('cart_add_success', 'Course Added To Cart!');
        
        return back();
     }     
     

    public function viewCart() 
    {  

        if (!Auth::check()) {
            return redirect()->route('signin')->with('error', 'Please Sign In To View Your Cart.');
        }

        $cart = Cart::with('cartItems')->where('userId', Auth::id())->first();
        
        if (!$cart) {
            return view('cart', ['cartItems' => [], 'total' => 0, 'removedItems' => []]);
        }

        $cartItems = CartItem::with('course')
                ->where('cartId', $cart->id) 
                ->get();

        $removedProducts = Course::where('status', '0')->get()->pluck('id')->toArray();

        $removedItems = [];
        $remainingCartItems = [];
        $subtotal = 0;
        $total = 0;
        $removedItemCount = 0; // Track the number of removed items

        foreach ($cartItems as $cartItem) {
            if (in_array($cartItem->courseId, $removedProducts)) {
                $removedItems[] = $cartItem->courseName; 
                $cartItem->delete();
                $removedItemCount++; // Increment the count
            } else {
                $subtotal += $cartItem->coursePrice;
                $remainingCartItems[] = $cartItem;
            }
            $total = $subtotal;
        }

        // If there were removed items, flash an error message
        if ($removedItemCount > 0) {
            $error = $removedItemCount == 1 ? 
                "A course has been removed from your cart because it is no longer available." : 
                "$removedItemCount courses have been removed from your cart because they are no longer available.";
            Session::flash('error', $error);
        }

        return view('cart', [
            'cartItems' => $remainingCartItems,
            'subtotal' => $subtotal,
            'total' => $total,
            'removedItems' => $removedItems
        ]);
        
    }

    public function removeCourse($item) 
    {
        $cartItem = CartItem::find($item);
        
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart')->with('success', 'Course has been Removed');
        } else {
            return redirect()->route('cart')->with('error', 'Failed to Remove Course');
        }
    }
    
}
