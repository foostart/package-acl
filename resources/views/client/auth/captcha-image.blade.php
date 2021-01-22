<img src="{!! $captcha->getImageSrcTag() !!}">

@section('footer_scripts')
    @parent

    <script type='text/javascript'>
        $(document).ready(function () {
            //------------------------------------
            // captcha regeneration
            $("#captcha-gen-button").click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "/foostart/public/captcha-ajax",
                    method: "POST",
                    headers: {'X-CSRF-Token': '{!! csrf_token() !!}'}
                }).done(function (image) {
                    $("#captcha-img-container").html(image);
                });
            });
        });
    </script>
@stop