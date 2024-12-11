<?php

namespace App\Http\Controllers\Calculator;

use App\Actions\Signature\Config;
use App\Actions\Signature\PrivateKey;
use App\Actions\Signature\ServiceSignaturePayload;
use App\Actions\Signature\Signature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsymmetricSignatureController extends Controller
{
    public function index()
    {
        return view('Signature.asymmetric', [
            'signature' => null,
            'request' => null,
        ]);
    }

    public function generate(Request $request)
    {
        Config::serviceSignatureUseAsymmetric();

        $signature = Signature::asymmetric(
            new PrivateKey($request->private_key),
            new ServiceSignaturePayload(
                $request->method,
                $request->path,
                '',
                $request->timestamp,
                $request->payload
            )
        );

        return view('Signature.asymmetric', [
            'signature' => $signature,
            'request' => $request->all(),
        ]);;
    }
}
