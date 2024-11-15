<?php

namespace App\Http\Controllers\Callback;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Plan;
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
        Log::info('Received deposit request:', [$request->all()]);

        try {
            if ($request->status === 'COMPLETED') {
                // Parse the incoming request
                $data = $request->all();

                // Validate required metadata before accessing it
                if (!isset($data['metadata']['customerId']) || !isset($data['metadata']['orderId'])) {
                    return response()->json(['error' => 'Invalid metadata provided'], 400);
                }

                $payer = User::where('id', $data['metadata']['customerId'])->first();

                if (!$payer) {
                    return response()->json(['error' => 'User not found'], 404);
                }

                $order = Order::where('id', (int)$data['metadata']['orderId'])->first();


                if ($order) {
                    $this->createPayment($data, $order);
                    $plan = Plan::where('id', $order->plan_id)->first();
                    $sub_expdate = $this->getSubscriptionExpirationDate($plan);
                    switch ($order->type) {
                        case 'subscription':
                            Subscription::create([
                                'name'                => 'Subscription Plan',
                                'company_id'          => 1,
                                'plan_id'             => $order->plan_id ?? null,
                                'user_id'             => $data['metadata']['customerId'],
                                'amount'              => $data['depositedAmount'],
                                'is_promo'            => false,
                                'promo_name'          => null,
                                'promo_duration'      => null,
                                'promo_duration_value'=> null,
                                'promo_code'          => null,
                                'discount'            => 0,
                                'status'              => 'active',
                                'cancellation_run_at' =>  $sub_expdate,
                            ]);
                            $payer->notify(new PaymentMade(
                                'You have successfully subscribed to package ID ' . ($order->plan_id ?? 'N/A'),
                                'Square Subscription Plan'
                            ));
                            break;

                        case 'post_boost':
                            PropertyPost::where('post_id', $order->post_id ?? null)
                                ->update([
                                    'on_bid'    => 1,
                                    'bid_value' => $data['depositedAmount'],
                                ]);
                            $payer->notify(new PaymentMade(
                                'You have successfully boosted your post ID ' . ($order->post_id ?? 'N/A'),
                                'Post Boost'
                            ));
                            break;
                        default:
                            break;
                    }
                    $order->status = 1;
                    $order->save();
                }
                return response()->json(['message' => 'Payment processed successfully'], 200);
            }
        } catch (\Throwable $th) {
            // Log the exception properly with context as an array
            Log::error('Error processing payment callback:', ['exception' => $th]);
            return response()->json(['error' => 'An error occurred while processing the payment'], 500);
        }
    }

    public function createPayment($data, $order){
        // Insert into Payment Table
        return Payment::create([
            'user_id'       => $data['metadata']['customerId'],
            'post_id'       => $order->post_id ?? null,
            'description'   => $data['statementDescription'] ?? 'No description provided',
            'amount'        => $data['depositedAmount'],
            'item'          => 'payment',
            'txn_fee'       => 0, // Adjust txn fee if applicable
            'txn_ref'       => $data['payer']['address']['value'] ?? 'No ref available',
            'txn_status'    => $data['status'],
            'status'        => ($data['status'] == 'COMPLETED') ? 'success' : 'failed'
        ]);
    }


    public function getSubscriptionExpirationDate($plan)
    {
        switch ($plan->duration_type) {
            case 'day':
                // Return the date after adding the specified number of days to the current date
                return now()->addDays($plan->duration);

            case 'week':
                // Return the date after adding the specified number of weeks to the current date
                return now()->addWeeks($plan->duration);

            case 'month':
                // Return the date after adding the specified number of months to the current date
                return now()->addMonths($plan->duration);

            case 'year':
                // Return the date after adding the specified number of years to the current date
                return now()->addYears($plan->duration);

            default:
                // Handle an invalid or unrecognized duration type (optional)
                return null;
        }
    }
    // {
    //     "correspondent":"ZAMTEL_ZMB",
    //     "correspondentIds":{
    //         "financialTransactionId":"000620731093"
    //     },
    //     "country":"ZMB",
    //     "created":"2024-11-12T08:57:17Z",
    //     "currency":"ZMW",
    //     "customerTimestamp":"2024-11-12T08:57:17Z",
    //     "depositId":"14c2e973-6b88-4a84-adcf-4e1301a97d70",
    //     "depositedAmount":"19.9900",
    //     "metadata":{
    //         "orderId":"1",
    //         "customerId":"24"
    //     },
    //     "payer":{
    //         "address":{
    //             "value":"260952564843"
    //         },
    //         "type":"MSISDN"
    //     },
    //     "requestedAmount":"19.9900",
    //     "statementDescription":"Payment of item on SQr",
    //     "status":"COMPLETED"
    // }

}
