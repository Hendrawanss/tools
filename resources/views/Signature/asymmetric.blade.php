<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asymetric Without Access Token</title>

    @vite('resources/css/app.css')
    
    <link rel="shortcut icon" type="image/x-icon" href="https://yukk.co.id/images/favicon.ico" />
</head>
<body class="flex justify-center bg-slate-200">
    <form id="form" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-7/12 mt-5" action="{{ route('calculator.asymmetric.generate') }}" method="POST">
        @csrf
        <h3 class="font-bold text-3xl pb-5">Asymmetric Without Access Token Form</h3>
        <hr class="pb-5">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="http_method">
                HTTP Method
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="http_method" type="text" placeholder="http method" value="{{ $request['method'] ?? 'POST' }}" name="method" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="path">
                Relative URL
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="path" type="text" placeholder="Ex: /v1.0/bank-account-inquiry" name="path" value="{{ $request['path'] ?? '' }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="payload">
                Request Body in JSON Format <p id="pretty" class="text-blue-500 text-xs cursor-pointer">Click for make pretty</p>
            </label>
            <textarea rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="payload" placeholder="Ex: /v1.0/bank-account-inquiry" name="payload" required>{{ $request['payload'] ?? '' }}</textarea>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="timestamp">
                X-TIMESTAMP
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="timestamp" type="text" placeholder="Ex: 2024-04-03T10:01:30+07:00" name="timestamp" value="{{ $request['timestamp'] ?? '' }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="private_key">
                Private Key
            </label>
            <textarea rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="private_key" name="private_key" required>{{ $request['private_key'] ?? '' }}</textarea>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="btn-submit">
                Generate
            </button>
        </div>
        @if ($signature)
            <hr class="my-5">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="signature">
                    Signature
                </label>
                <textarea rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="signature" name="signature" readonly>{{ $signature }}</textarea>
            </div>
        @endif
    </form>
    <script>
        const payload = document.getElementById('payload');
        const pretty = document.getElementById('pretty');
        
        payload.onblur = function (e) {
            try {
                payload.value = JSON.stringify(JSON.parse(payload.value));
            } catch (e) {
                alert('JSON format is invalid.');
                payload.value = '';
            }
        };

        pretty.onclick = function () {
            payload.value = JSON.stringify(JSON.parse(payload.value), null, 2);
        }
    </script>
</body>
</html>