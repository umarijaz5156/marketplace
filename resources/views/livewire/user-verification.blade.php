<div>
    <div id="sumsub-websdk-container">

    </div>
    @push('scripts')
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
    @endpush
</div>
