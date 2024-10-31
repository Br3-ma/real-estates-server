<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\PropertyPost;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;
use Exception;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function deposit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'correspondent' => 'required',
            'phone' => 'required',
            'amount' => 'required',
            'user_id' => 'required',
        ]);

        try {
            // Generate a UUIDv4 for the depositId
            $depositId = Uuid::uuid4()->toString();

            // Prepare payload for the external API request
            $payload = $this->preparePayload($request, $depositId);

            Log::info($payload);

            // Make the API request
            $response = Http::withHeaders($this->getHeaders())->post('https://api.pawapay.io/deposits', $payload);

            // Check if the request was successful and return the response
            if ($response->successful()) {
                return response()->json(['message' => 'Payment submitted successfully', 'data' => $response->json()]);
            }

            // If unsuccessful, throw an exception with detailed info
            throw new Exception("API request failed with status {$response->status()} and message: " . $response->body());

        } catch (Exception $e) {
            Log::error('Payment submission failed', [
                'exception' => $e
            ]);
            // Catch any exception and return the detailed error message
            return response()->json(['error' => 'Failed to submit payment', 'details' => $e->getMessage()], 500);
        }
    }

    private function preparePayload(Request $request, string $depositId): array
    {
        return [
            "depositId" => $depositId,
            "amount" => (string)$request->input('amount'),
            "currency" => "ZMW",
            "correspondent" => (string)$request->input('correspondent'),
            "payer" => [
                "address" => [
                    "value" => (string)$request->input('phone')
                ],
                "type" => "MSISDN"
            ],
            "customerTimestamp" => now()->toIso8601String(),
            "statementDescription" => "Payment of item on SQr",
            "country" => "ZMB",
            "preAuthorisationCode" => "PMxQYqfDx",
            "metadata" => [
                [
                    "plan_id" => (string)$request->input('plan_id'),
                    "post_id" => (string)$request->input('post_id'),
                    "user_id" => (string)$request->input('user_id'),
                    "type"=> (string)$request->input('payingFor'),
                    "boost"=> (string)$request->input('boost'),
                    "isPII" => true,
                ]
            ]
        ];
    }

    private function getHeaders(): array
    {
        return [
            'Content-Digest' => 'Twalitso Innovation Square',
            'Authorization' => 'Bearer eyJraWQiOiIxIiwiYWxnIjoiRVMyNTYifQ.eyJ0dCI6IkFBVCIsInN1YiI6IjkzNSIsImV4cCI6MjA0NDc5MzI2NiwiaWF0IjoxNzI5MjYwNDY2LCJwbSI6IkRBRixQQUYiLCJqdGkiOiIzOTU5NmMyOS02MWJlLTQ2MjMtOTczZS1lMGE3Yzg3MzE0NDgifQ.mhcRvNtSGalGqzWqeqzFopLf1D1kmVxOjWyCb_7jCibrCMlPDbK5HunE7BbtKOYnGSsB_66ovRFsTV8b93xoqg',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        try {
            Log::info('Reached...');
            Log::info($request);
            $randomStr = Str::random(5);
            $transRef = Str::random(7);
            // UUID ID generator
            $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
            $post = PropertyPost::where('id', $request->input('propertyId'))->first();

            Log::info('Property..:: '.$post);
            // Prepare request payload
            $payload = [
                'user_id' => $post->user_id,
                'post_id' => $request->input('propertyId'),
                'form_id' => '7bccf4c',
                'referer_title' => 'Square',
                'queried_id' => 7,
                'customerFirstName' => $post->user->name,
                'customerLastName' => $post->user->name,
                'customerEmail' => $post->user->email,
                'wallet' => $post->user->phone,
                'qty' => 1,
                'callback' => 'http://localhost/realestserver/est-server/payment-callback/' . $uuid . '/',
                'uuid' => $uuid,
                'amount' => $request->input('selectedPackage').'00',
                'currency' => 'ZMW',
                'item' => 'Top Listing Bid',
                'merchantPublicKey' => '4c291f8d64eb49d7a4b62a098c4b9abd',
                'transactionName' => 'SQ.' . $randomStr,
                'transactionReference' => $transRef,
                'chargeMe' => 'true',
            ];
            // Further processing logic here
            $data = $this->collectPayment($payload);

            Log::info('Data URL...'.$data->paymentUrl);
            if ($data !== null) {
                return response()->json(['url' => $data->paymentUrl], 200);
            }else{
                return response()->json(['url' => ''], 200);
            }
        } catch (\Throwable $th) {
            Log::info('Catch..::'.$th);
            return response()->json(['url'=> '', 'msg'=>$th->getMessage(), 500]);
        }
    }

    public function collectPayment(array $request){
        Log::info('Collecting...');
        try {
            $total_amount = $request['amount'] * $request['qty'];
            $randomStr = Str::random(5);
            // Create the Ticket
            $payment = Payment::create([
                'user_id' => $request['user_id'],
                'post_id' => $request['post_id'],
                'description' => 'Top Listing Bid',
                'amount' => $total_amount,
                'item' => $request['item'],
                'txn_fee' => 0,
                'txn_ref' => $randomStr,
                'txn_status' => 'false',
                'status' => 'false',
            ]);

            $curl = curl_init();
            $var = true;

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://checkout.broadpay.io/gateway/api/v1/checkout',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "transactionName": "In-app purchase",
                    "amount": "'.$total_amount.'",
                    "currency": "'.$request['currency'].'",
                    "chargeMe": "true",
                    "wallet":  "'.$request['wallet'].'",
                    "customerAddr": "Test",
                    "customerCity": "Lusaka",
                    "customerState": "Lusaka",
                    "customerCountryCode": "ZM",
                    "customerPostalCode": "10101",
                    "transactionReference": "'.$request['uuid'].'",
                    "customerFirstName": "'.$request['customerFirstName'].'",
                    "customerLastName": "'.$request['customerLastName'].'",
                    "customerEmail": "'.$request['customerEmail'].'",
                    "customerPhone": "'.$request['wallet'].'",
                    "returnUrl": "'.$request['callback'].$payment->id.'",
                    "autoReturn": '.$var.',
                    "webhookUrl": "https://2150-165-58-129-124.ngrok.io/webhook?src=test",
                    "merchantPublicKey": "4c291f8d64eb49d7a4b62a098c4b9abd"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwdWJLZXkiOiJkZTdhZmQ2MTc2YmI0ZWZmOTkzMTZkY2Y1MDhlNWJlNiIsImlhdCI6MTY5MjcwNzIwOH0.Qi6KFBzFy7iST0bFylG-Vb5cpzVJ710lg1V296uRKck',
                    'X-PUB-KEY; 4c291f8d64eb49d7a4b62a098c4b9abd'
                ),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);
            curl_close($curl);

            // Return checkout link or json data
            return $result;
        } catch (\Throwable $th) {
            Log::info('Broadpay Failure...'.$th->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
