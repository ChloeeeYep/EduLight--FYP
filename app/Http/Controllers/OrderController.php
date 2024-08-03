<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Course;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function viewOrder() 
    {  
        $cart = Cart::with('cartItems')->where('userId', Auth::id())->first();
        
        $subtotal = 0;
        $total = 0;

        if ($cart) {
            foreach ($cart->cartItems as $item) {
                $subtotal += $item->coursePrice;
            }
            $total = $subtotal;
        }
        return view('order', [
        'cartItems' => $cart ? $cart->cartItems : [], 
        'subtotal' => $subtotal,
        'total' => $total
    ]);
    }

    public function exportOrdersCSV()
    {
        // Header to force download
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Column names for CSV
        $columns = ['No','Order Number', 'Username', 'Course Name', 'Price', 'Payment Method', 'Date Purchased'];

        // Fetch orders with related order items
        $orders = Order::with(['orderItems.course'])->get();

        // Open output stream
        $file = fopen('php://output', 'w');

        // Add headers to output stream
        foreach ($headers as $header => $value) {
            header("$header: $value");
        }

        // Add column headers to CSV
        fputcsv($file, $columns);

        // Add order data to CSV
        foreach ($orders as $index => $order) {
            foreach ($order->orderItems as $item) {
                fputcsv($file, [
                    $index + 1,
                    $order->id,
                    $order->user->username ?? 'N/A', // Replace 'N/A' with appropriate value if user relation is not loaded
                    $item->course->title ?? 'N/A', // Replace 'N/A' with appropriate value if course relation is not loaded
                    $item->price,
                    $order->paymentMethod,
                    $order->created_at->format('Y-m-d H:i:s'),
                ]);
            }
        }

        // Close output stream
        fclose($file);
    }

    public function store(Request $request) 
    {
         // Step 1: Verify User Authentication
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to checkout.');
        }

        // Begin Transaction
        DB::beginTransaction();
        try {
            // Step 2: Get Cart Items
            $cartItems = $request->input('items');
            $total = $request->input('total');

            Log::info($cartItems);
            
            // Step 3: Create Order
            $order = new Order();
            $order->userid = Auth::id();
            $order->name = Auth::user()->username;
            $order->total = $total;
            $order->paymentMethod = $request->input('paymentMethod');
            $order->save();

            // Step 4: Create Order Items
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->orderId = $order->id;
                $orderItem->courseId = $item['courseId'];
                $orderItem->name = $item['name'];
                $orderItem->price = $item['price'];
                $orderItem->save();
            }

            // Step 5: Clear Cart (Implement the logic as per your application)
            $userId = Auth::id(); // Get the authenticated user's ID
            Cart::where('userId', $userId)->delete(); // Delete the user's cart items

            // Commit Transaction
            DB::commit();

            // Step 6: Return Response
            return redirect()->route('orderconfirm');
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return back()->with('error', 'Error placing order: ' . $e->getMessage());
        }
    }

    private function clearCartItems($userId) {
        $cartId = Cart::where('userId', $userId)->first()->id;
        CartItem::where('cartId', $cartId)->delete();
    }
  
    public function userorder()
    {
        // Retrieve the current user's ID
        $userId = Auth::id();

        // Retrieve all orders for the authenticated user along with their order items
        $orders = Order::with('orderItems')->where('userid', $userId)->get();

        // Return the orders to the view
        return view('userorder', [
            'orders' => $orders,
        ]);
    }

    public function adminhome() {
        // Get the top 5 courses based on the number of times they've been purchased
        $topCourses = OrderItem::select('courseId', 'name', DB::raw('count(*) as totalPurchases'))
                        ->groupBy('courseId', 'name') // Group by courseId and name
                        ->orderBy('totalPurchases', 'desc')
                        ->take(5)
                        ->get();
        
        // Fetch the other required order details as previously
        $orders = Order::with('orderItems')->orderBy('created_at', 'desc')->get();
        $totalOrders = Order::count();
        $totalOrderItems = OrderItem::count();
        $totalSales = Order::sum('total');
        
        // Return the necessary data to your view
        return view('adminhome', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'totalOrderItems' => $totalOrderItems,
            'totalSales' => $totalSales,
            'topCourses' => $topCourses // now includes courseId and name
        ]);
    }
    
    
    
    

    public function showOrderDetail($id) {
        $order = Order::with('orderItems')->findOrFail($id);
    
        return view('adminorderdetail', [
            'order' => $order, 
        ]);
    }
    
    

}
