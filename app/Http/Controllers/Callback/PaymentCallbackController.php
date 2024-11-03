<?php

namespace App\Http\Controllers\Callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PropertyPost;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\PaymentMade;

// use App\Models\PostBoost;

class PaymentCallbackController extends Controller
{
    public function deposit(Request $request)
    {
        try {
            // Parse the incoming request
            $data = $request->all();
            $payer = User::where('id', $data['metadata']['user_id'])->first();

            // Insert into Payment Table
            $payment = Payment::create([
                'user_id'       => $data['metadata']['user_id'],
                'post_id'       => $data['metadata']['post_id'],
                'description'   => $data['statementDescription'],
                'amount'        => $data['depositedAmount'],
                'item'          => $data['metadata']['type'],
                'txn_fee'       => 0, // Set txn fee if available
                'txn_ref'       => $data['payer']['address']['value'],
                'txn_status'    => $data['status'],
                'status'        => ($data['status'] == 'COMPLETED') ? 'success' : 'failed'
            ]);

            // Switch based on what the user is paying for using the metadata type
            switch ($data['metadata']['type']) {
                case 'subscription':
                    // Insert into Subscription Table
                    Subscription::create([
                        'name'                => 'Subscription Plan', // Provide a name or get from plan details
                        'company_id'          => 1, // Assuming you have a company ID or fetch dynamically
                        'plan_id'             => $data['metadata']['plan_id'],
                        'user_id'             => $data['metadata']['user_id'],
                        'amount'              => $data['depositedAmount'], // Payment amount
                        // 'payment_id'          => $payment->id, // Payment ID
                        'is_promo'            => false, // Set promo details if applicable
                        'promo_name'          => null,
                        'promo_duration'      => null,
                        'promo_duration_value'=> null,
                        'promo_code'          => null,
                        'discount'            => 0, // Set discount if applicable
                        'status'              => 'active', // Default to active if payment is completed
                        'cancellation_run_at' => now()->addMonth(),
                    ]);
                    $payer->notify(new PaymentMade(
                        'You have successfully subscribed to package ID'.$data['metadata']['plan_id'],
                        'Square Subscription Plan'
                    ));
                    break;

                case 'post_boost':
                    // Insert into PostBoost Table or handle post boost logic
                    $post = PropertyPost::where('post_id', $data['metadata']['post_id'])
                    ->update([
                        'on_bid'       => 1,
                        'bid_value'    => $data['depositedAmount'],
                        // 'bid_due_date' => $data['metadata']['boost']['bid_due_date'], // Set status to boosted or as per your logic
                    ]);
                    $payer->notify(new PaymentMade(
                        'You have successfully boosted your post ID'.$data['metadata']['post_id'],
                        User::first(),
                        $post
                    ));
                    break;

                // Add other cases for additional types
                default:
                    // Handle other payment types or do nothing
                    break;
            }

            return response()->json(['message' => 'Payment processed successfully'], 200);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
