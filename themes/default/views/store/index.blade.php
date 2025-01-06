@extends('layouts.main')

@section('content')
    <!-- CONTENT HEADER -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Store') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="" href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a class="text-muted"
                                href="{{ route('store.index') }}">{{ __('Store') }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTENT HEADER -->

    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">

            <div class="text-right mb-3">
                <button type="button" onclick="openPopup('{{ url('top-up-url') }}', 'TopUpPopup', 600, 400);" class="btn btn-primary">
                    <i class="fas fa-money-check-alt mr-2"></i>{{ __('Top Up') }}
                </button>
            </div>

            @if ($isStoreEnabled && $products->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fa fa-video mr-2"></i>{{ __('YouTube Videos') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                                @if ($product->youtube_video_id) <!-- Only display products with YouTube video -->
                                    <div class="col-md-4">
                                        <div class="video-container mb-3">
                                            <a href="https://youtu.be/8gz-3zm7Quc?si=w0tLbu0lyt1BMNqh" target="_blank">
                                                <img src="https://img.youtube.com/vi/8gz-3zm7Quc/0.jpg" class="img-fluid" alt="Watch Video">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i>
                        {{ __('There are no store products with videos!') }}
                    </h4>
                </div>
            @endif

        </div>
    </section>
    <!-- END CONTENT -->

    <script>
        const getUrlParameter = (param) => {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            return urlParams.get(param);
        }
        const voucherCode = getUrlParameter('voucher');
        //if voucherCode not empty, open the modal and fill the input
        if (voucherCode) {
            $(function() {
                $('#redeemVoucherModal').modal('show');
                $('#redeemVoucherCode').val(voucherCode);
            });
        }

        function openPopup(url, title, width, height) {
            const screenX = window.screenX || window.screenLeft;
            const screenY = window.screenY || window.screenTop;
            const outerWidth = window.outerWidth || document.documentElement.clientWidth;
            const outerHeight = window.outerHeight || document.documentElement.clientHeight - 22;
            const left = screenX + (outerWidth - width) / 2;
            const top = screenY + (outerHeight - height) / 2;

            window.open(
                url,
                title,
                `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`
            );
        }
    </script>

@endsection
