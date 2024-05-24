<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body id="sumsub-websdk-container">
    <script src="https://static.sumsub.com/idensic/static/sns-websdk-builder.js"></script>

    <script>

function launchWebSdk(accessToken) {
    let snsWebSdkInstance = snsWebSdk.init(
            accessToken,
            // token update callback, must return Promise
            () => this.getNewAccessToken()
        )
        .withConf({
            lang: 'en', //language of WebSDK texts and comm,
            email: '{{ $data['email'] }}',
            phone: '{{ $data['number'] }}',
            theme: 'light'
        })
        .withOptions({ addViewportTag: false, adaptIframeHeight: true})
        .on('onError', (error) => {
          console.log('onError', payload)
        })
        .onMessage((type, payload) => {
            if(type == 'idCheck.onApplicationStatusChanged'){
                if(payload.reviewStatus == 'pending'){
                    window.location = '{{ url("seller/dashboard") }}'
                }
            }
          console.log('onMessage', type, payload)
        })
        .build();

    // you are ready to go:
    // just launch the WebSDK by providing the container element for it
    snsWebSdkInstance.launch('#sumsub-websdk-container')
}

launchWebSdk('{{ $accessToken }}')
    </script>
</body>
</html>
