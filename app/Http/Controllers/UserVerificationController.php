<?php

namespace App\Http\Controllers;

use App\Models\Log as ModelsLog;
use App\Models\Seller\Seller;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;


class UserVerificationController extends Controller
{

//     public function validateWebHook(Request $request): void
// {
//     $algo = match($request->headers->get('X-Payload-Digest-Alg')) {
//       'HMAC_SHA1_HEX' => 'sha1',
//       'HMAC_SHA256_HEX' => 'sha256',
//       'HMAC_SHA512_HEX' => 'sha512',

//     };

//     $res = $request->headers->get('X-Signature') === hash_hmac(
//         $algo,
//         $request,
//         'Sbs0999xRGM10ZKc8G83ZcQKtpNWh3IE'
//     );

//     if (!$res) {
//         Log::error('webhook samsub sign'. $request);
//     }
//     else{
//         Log::error('signature verified');
//     }
// }

    public function webhook(Request $request){
        Log::error($request);
       $sellerId = $request['externalUserId'];
       if(isset($sellerId)){
            $sellerId = explode('-',$request['externalUserId']);
            $sellerId = $sellerId[1];
            $seller = Seller::find($sellerId);
            if($request['type'] == 'applicantReviewed' && $request['reviewStatus'] == 'completed'){
                $status = $request['reviewResult']['reviewAnswer'];
                if($status == 'GREEN'){
                    $seller->verification_status = 'passed';
                    $seller->save();
                } elseif($status == 'RED'){
                    $seller->verification_status = 'failed';
                    $seller->save();
                    ModelsLog::create([
                        'title' => isset($request['reviewResult']['clientComment']) ? $request['reviewResult']['clientComment'] : 'Account Verification Failed',
                        'description' => isset($request['reviewResult']['moderationComment']) ? $request['reviewResult']['moderationComment'] : 'See details on samsub account for applicant# '.$request['applicantId'],
                        'content_type' => 'seller',
                        'content_id' => $sellerId
                    ]);
                }

            }
            elseif($request['type'] == 'applicantCreated' || $request['type'] == 'applicantPending'){
                $seller->verification_status = 'pending';
                $seller->save();
            }
       }
    }


}
