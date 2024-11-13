<?php

namespace App\Http\Controllers\Callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PropertyPost;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\PaymentMade;
use Illuminate\Support\Facades\Log;

// use App\Models\PostBoost;

class PaymentCallbackController extends Controller
{
    public function deposit(Request $request)
    {
        // Log the request data properly by passing it as an array
        Log::info('Incoming payment callback request:', [$request->all()]);

        try {
            if ($request->status === 'COMPLETED') {
                // Parse the incoming request
                $data = $request->all();

                // Validate required metadata before accessing it
                if (!isset($data['metadata']['user_id']) || !isset($data['metadata']['type'])) {
                    return response()->json(['error' => 'Invalid metadata provided'], 400);
                }

                $payer = User::where('id', $data['metadata']['user_id'])->first();

                // Insert into Payment Table
                $payment = Payment::create([
                    'user_id'       => $data['metadata']['user_id'],
                    'post_id'       => $data['metadata']['post_id'] ?? null,
                    'description'   => $data['statementDescription'] ?? 'No description provided',
                    'amount'        => $data['depositedAmount'],
                    'item'          => $data['metadata']['type'],
                    'txn_fee'       => 0, // Set txn fee if available
                    'txn_ref'       => $data['payer']['address']['value'] ?? 'No ref available',
                    'txn_status'    => $data['status'],
                    'status'        => ($data['status'] == 'COMPLETED') ? 'success' : 'failed'
                ]);

                // Switch based on what the user is paying for using the metadata type
                switch ($data['metadata']['type']) {
                    case 'subscription':
                        Subscription::create([
                            'name'                => 'Subscription Plan',
                            'company_id'          => 1,
                            'plan_id'             => $data['metadata']['plan_id'] ?? null,
                            'user_id'             => $data['metadata']['user_id'],
                            'amount'              => $data['depositedAmount'],
                            'is_promo'            => false,
                            'promo_name'          => null,
                            'promo_duration'      => null,
                            'promo_duration_value'=> null,
                            'promo_code'          => null,
                            'discount'            => 0,
                            'status'              => 'active',
                            'cancellation_run_at' => now()->addMonth(),
                        ]);
                        $payer->notify(new PaymentMade(
                            'You have successfully subscribed to package ID ' . ($data['metadata']['plan_id'] ?? 'N/A'),
                            'Square Subscription Plan'
                        ));
                        break;

                    case 'post_boost':
                        $post = PropertyPost::where('post_id', $data['metadata']['post_id'] ?? null)
                            ->update([
                                'on_bid'       => 1,
                                'bid_value'    => $data['depositedAmount'],
                            ]);
                        $payer->notify(new PaymentMade(
                            'You have successfully boosted your post ID ' . ($data['metadata']['post_id'] ?? 'N/A'),
                            User::first(),
                            $post
                        ));
                        break;

                    // Add other cases for additional types
                    default:
                        break;
                }

                return response()->json(['message' => 'Payment processed successfully'], 200);
            }
        } catch (\Throwable $th) {
            // Log the exception properly with context as an array
            Log::error('Error processing payment callback:', ['exception' => $th]);
            return response()->json(['error' => 'An error occurred while processing the payment'], 500);
        }
    }


}
