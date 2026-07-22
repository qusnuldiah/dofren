<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $branches = Branch::where('is_active', true)->get();
        $products = Product::with('category')
            ->where('is_available', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category.name');

        return view('pages.pesan', compact('branches', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'        => 'required|exists:branches,id',
            'customer_name'    => 'required|string|max:100',
            'customer_phone'   => 'required|string|max:20',
            'customer_email'   => 'nullable|email|max:100',
            'order_type'       => 'required|in:dine_in,takeaway,delivery',
            'delivery_address' => 'nullable|string',
            'notes'            => 'nullable|string|max:500',
            'payment_method'   => 'required|in:cash,transfer,qris',
            'items'            => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1|max:99',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = 0;
            $orderItems = [];

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                $orderItems[] = [
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'unit_price'   => $product->price,
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $itemSubtotal,
                    'notes'        => $item['notes'] ?? null,
                ];
            }

            $deliveryFee = $validated['order_type'] === 'delivery' ? 10000 : 0;
            $totalPrice = $subtotal + $deliveryFee;

            $order = Order::create([
                'order_number'     => Order::generateOrderNumber(),
                'branch_id'        => $validated['branch_id'],
                'customer_name'    => $validated['customer_name'],
                'customer_phone'   => $validated['customer_phone'],
                'customer_email'   => $validated['customer_email'] ?? null,
                'order_type'       => $validated['order_type'],
                'delivery_address' => $validated['delivery_address'] ?? null,
                'notes'            => $validated['notes'] ?? null,
                'subtotal'         => $subtotal,
                'delivery_fee'     => $deliveryFee,
                'total_price'      => $totalPrice,
                'status'           => 'pending',
                'payment_method'   => $validated['payment_method'],
            ]);

            foreach ($orderItems as &$oi) {
                $oi['order_id'] = $order->id;
                $oi['created_at'] = now();
                $oi['updated_at'] = now();
            }

            OrderItem::insert($orderItems);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'order_number' => $order->order_number,
                'total' => $order->formatted_total,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
            ], 500);
        }
    }

    public function track(Request $request)
    {
        $order = null;
        if ($request->has('no_pesanan') && $request->no_pesanan) {
            $order = Order::with(['items.product', 'branch'])
                ->where('order_number', $request->no_pesanan)
                ->first();
        }
        return view('pages.track', compact('order'));
    }
}
