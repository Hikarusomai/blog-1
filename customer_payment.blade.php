<!DOCTYPE html>
<html lang="EN">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $platformname = \App\Helpers\Helper::getSysConfigPlatformName();
    $assetUrl = \App\Helpers\Helper::getLogoUrl();
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('laravel_assets/css/bootstrap-5.13-dist/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<!--     <link rel="stylesheet" href="{{ asset('laravel_assets/css/payment.css') }}">
    <link rel="stylesheet" href="{{ asset('laravel_assets/css/style.css') }}"> -->
    @include("css.payment")
    @include("css.style")
    <link rel="stylesheet" href="{{ asset('laravel_assets/css/sweetalert.css') }}">
    <link href="{{ asset('laravel_assets/fontawesome-free-6.1.1-web/css/all.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
    <script src="{{ asset('laravel_assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('laravel_assets/js/bootstrap-5.13-dist/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('laravel_assets/js/web_payment.js') }}"></script>
    <script src="{{ asset('laravel_assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('laravel_assets/js/qrcode.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>

    <style>
        #loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/laravel_assets/loader.gif') 50% 50% no-repeat rgb(249,249,249);
        }
        .cancel-button{
            font-size: 16px;
            padding: 12px;
            width: 342px;
            font-weight: 700;
            background-color: #ffffff;
            border-radius: 50px;
            color: #cc3b3b;
            border: 0;
        }
    </style>
</head>

<body>
    <div id="loader" style="display: none"></div>
      <?php
    $color_code_50 = "#FDF4FF";
    $color_code_100 = "#FAE8FF";
    $color_code_200 = "#F5D0FE";
    $color_code_300 = "#F0ABFC";
    $color_code_400 = "#E879F9";
    $color_code_500 = "#D946EF";
    $color_code_600 = "#C026D3";
    $color_code_700 = "#A21CAF";
    $color_code_800 = "#86198F";
    $color_code_900 = "#701A75";
    $color_code = \App\Helpers\Helper::getSysConfigUiCssColorCode();
    foreach ($color_code as $obj){
        switch ($obj['key']){
            case "platform.ui.css.color.50":
                $color_code_50 = $obj['value'];
                break;
            case "platform.ui.css.color.100":
                $color_code_100 = $obj['value'];
                break;
            case "platform.ui.css.color.200":
                $color_code_200 = $obj['value'];
                break;
            case "platform.ui.css.color.300":
                $color_code_300 = $obj['value'];
                break;
            case "platform.ui.css.color.400":
                $color_code_400 = $obj['value'];
                break;
            case "platform.ui.css.color.500":
                $color_code_500 = $obj['value'];
                break;
            case "platform.ui.css.color.600":
                $color_code_600 = $obj['value'];
                break;
            case "platform.ui.css.color.700":
                $color_code_700 = $obj['value'];
                break;
            case "platform.ui.css.color.800":
                $color_code_800 = $obj['value'];
                break;
            case "platform.ui.css.color.900":
                $color_code_900 = $obj['value'];
                break;
        }
    }
    ?>
    @if (gettype($d) == 'array')
        <div class="container mt-5 billing">
            <div class="row">
                <div class="col-lg-12 mb-5">
                    <div class="row">
                        <div class="col-lg-9 pb-3 text-start">
                            <div class="logo-section">
                            @if($assetUrl!="")
                                <img src="{{ $assetUrl }}" alt="">
                            @endif
                            </div>
                        </div>
                        @if(count($d['installements']) > 0)
                        <div class="col-lg-3 text-center">
                            <div class="size-14 header-time">Time Remaining:&nbsp;
                                <span class="timer">
                                    @if ($d['billPaytime'] > 600)
                                        <span class="font-700" id="time">00:00</span>
                                    @else
                                        <span class="font-700" id="time">10:00</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if(count($d['installements']) > 0)
                <div class="col-lg-7 col-md-12">
                    <div class="card mb-4">
                        <div class="profile d-flex align-items-center mb-3">
                            <img class="profile-pic" src="{{ asset('laravel_assets/image/profile.png') }}"
                                alt="">
                            <div class="font-600 size-16 primary-text">
                                @if ($d['bill_details'] != null && count($d['bill_details']))
                                    @if ($d['bill_details']['get_merchant'] != null && count($d['bill_details']['get_merchant']))
                                        {{ $d['bill_details']['get_merchant']['name'] }}
                                    @endif
                                @endif

                            </div>
                        </div>
                        <div class="d-flex justify-content-space-between mb-1">
                            <div class="size-16 grey-text">Bill Amount</div>
                            <div class="size-16 font-700 primary-text">RM
                                @if ($d['bill_details'] != null && count($d['bill_details']))
                                    {{ $d['bill_details']['amount'] }}
                                @endif
                            </div>
                            <input type="hidden" name="discount_amount" value="" id="discount_amount">
                            <input type="hidden" name="discount_type" value="" id="discount_type">
                            <input type="hidden" name="pay_amount_value" value="" id="pay_amount_value">
                            <input type="hidden" name="voucher_id_value" value="" id="voucher_id_value">
                            <input type="hidden" name="voucher_unique_id_value" value="" id="voucher_unique_id_value">
                        </div>
                        <div class="d-flex justify-content-space-between">
                        <div class="size-16 grey-text">Voucher / Promo Code </div>
                        <a data-bs-toggle="modal" data-bs-target="#modalVoucher" style="display: flex;" class="size-16 font-700 primary-color"><span id="show_select" style="display: block;">Select&nbsp;</span><span id="discount_amount_show"></span><span>
                                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="#">
                                    <path d="M1 1.33334L5.66667 6L1 10.6667" stroke="{{ $color_code_600 }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span></a>
                    </div>
                        <!-- <div class="d-flex justify-content-space-between mb-1" id="voucher_div">
                            <div class="size-16 grey-text">Voucher / Promo Code </div>
                            <a data-bs-toggle="modal" data-bs-target="#modalVoucher"
                                class="size-16 font-700 primary-color">Select<span>
                                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="#">
                                         <path d="M1 1.33334L5.66667 6L1 10.6667" stroke="{{ $color_code_600 }}" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span></a>
                        </div>
                        <div class="d-flex justify-content-space-between mb-1" id="voucher_div">
                            <div class="size-16 grey-text">Discount Amount</div>
                            <div class="size-16 font-700 primary-text">RM
                                <span id="discount_amount_show"></span>
                            </div>
                        </div> -->
                    </div>
                    <div class="size-20 font-600 primary-text mb-2">Select Payment Plan</div>
                    <div class="card mb-4" id="payment_plan_div">
                        <div class="accordion font-600" id="accordionExample">
                          @if (count($d['spending_limit']) > 0)
                            @if (count($d['installements']) > 0)
                                @foreach ($d['installements'] as $int)
                                    @if ($int['installment'] == 1 && $int['minimum_purchase_limit'] <= $d['bill_details']['amount'])
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"
                                                    onclick="getPayAmount(1)">
                                                    <div class="row flex-nowrap align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <span class="payment-checkbox">
                                                                <input type='radio' name='a' checked
                                                                    onchange="getPayAmount(1)" value="1" />
                                                            </span>
                                                            Pay Now
                                                        </div>
                                                        <div class="text-end first" id="firstSequenceAmount">RM
                                                            {{ floor($d['bill_details']['amount']) }}
                                                        </div>

                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="container p-0">
                                                        <ul class="timeline mt-2">
                                                            <li class="timeline-item">
                                                                <div class="timeline-marker"></div>
                                                                <div class="timeline-content">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="time">Pay Today</div>
                                                                            <?php
                                                                            $time = date('Y-m-d');
                                                                            ?>
                                                                        </div>
                                                                        <div class="col"
                                                                            style="text-align: end; padding-right: 17px;">
                                                                            <p id="first1amount">RM
                                                                                {{ floor($d['bill_details']['amount']) }}
                                                                            </p>
                                                                            <input type="hidden" name="first1_date"
                                                                                class="date" value="{{ $time }}"
                                                                                id="first1_date" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="time">Processing Fee
                                                                            </div>
                                                                        </div>
                                                                        <div class="col"
                                                                            style="text-align: end; padding-right: 17px;">
                                                                            <p id="firstprocessingfee_view">RM
                                                                            </p>
                                                                            <input type="hidden"
                                                                                name="firstprocessingfee"
                                                                                id="firstprocessingfee">
                                                                            <input type="hidden"
                                                                                name="firstprocessing_fee_rate_fixed"
                                                                                id="firstprocessing_fee_rate_fixed"
                                                                                value="{{ $int['processing_fee_rate_fixed'] }}">
                                                                            <input type="hidden"
                                                                                name="firstprocessing_fee_rate_percentage"
                                                                                id="firstprocessing_fee_rate_percentage"
                                                                                value="{{ $int['processing_fee_rate_percentage'] }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    @if ($d['spending_limit'][0]['spending_limit'] <= '0')
                                        @break
                                    @endif
                                @endforeach
                            @endif
                          @endif
                            @if (count($d['spending_limit']) > 0)
                                @if ($d['spending_limit'][0]['spending_limit'] > '0')
                                    @if (count($d['installements']) > 0)
                                        @foreach ($d['installements'] as $int)
                                            @if ($int['installment'] == 2 && $int['minimum_purchase_limit'] <= $d['bill_details']['amount'])
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo"
                                                            onclick="getPayAmount(2)">
                                                            <div class="row flex-nowrap align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="payment-checkbox">
                                                                        <input type='radio' name='a'
                                                                            onchange="getPayAmount(2)"
                                                                            value="2" />
                                                                    </span>
                                                                    Pay in 2
                                                                </div>
                                                                <div class="text-end pl-0"
                                                                    id="firstSequenceAmountFor2">RM
                                                                    {{ floor($d['bill_details']['amount'] / 2) }}
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="container p-0">
                                                                <ul class="timeline mt-2">
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Pay Today
                                                                                    </div>
                                                                                    <?php
                                                                                    $time = date('Y-m-d');
                                                                                    ?>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="second1amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 2) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="second1_date"
                                                                                        class="date"
                                                                                        value="{{ $time }}"
                                                                                        id="second1_date" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Instalment
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="secondinstallment_view">RM
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="secondinstallment"
                                                                                        id="secondinstallment">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Processing Fee
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="secondprocessingfee_view">RM
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="secondprocessingfee"
                                                                                        id="secondprocessingfee">
                                                                                    <input type="hidden"
                                                                                        name="secondprocessing_fee_rate_fixed"
                                                                                        id="secondprocessing_fee_rate_fixed"
                                                                                        value="{{ $int['processing_fee_rate_fixed'] }}">
                                                                                    <input type="hidden"
                                                                                        name="secondprocessing_fee_rate_percentage"
                                                                                        id="secondprocessing_fee_rate_percentage"
                                                                                        value="{{ $int['processing_fee_rate_percentage'] }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+1 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+1 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="second2amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 2) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="second2_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="second2_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($d['installements']) > 0)
                                        @foreach ($d['installements'] as $int)
                                            @if ($int['installment'] == 3 && $int['minimum_purchase_limit'] <= $d['bill_details']['amount'])
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                            aria-expanded="false" aria-controls="collapseThree"
                                                            onclick="getPayAmount(3)">
                                                            <div class="row flex-nowrap align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="payment-checkbox">
                                                                        <input type='radio' name='a'
                                                                            onchange="getPayAmount(3)"
                                                                            value="3" />
                                                                    </span>
                                                                    Pay in 3
                                                                </div>
                                                                <div class="text-end pl-0"
                                                                    id="firstSequenceAmountFor3">RM
                                                                    {{ floor($d['bill_details']['amount'] / 3) }}
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="container p-0">
                                                                <ul class="timeline mt-2">
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Pay Today
                                                                                    </div>
                                                                                    <?php
                                                                                    $time = date('Y-m-d');
                                                                                    ?>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="third1amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 3) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="third1_date"
                                                                                        class="date"
                                                                                        value="{{ $time }}"
                                                                                        id="third1_date" />
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Instalment
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="thirdinstallment_view">RM
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="thirdinstallment"
                                                                                        id="thirdinstallment">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Processing Fee
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="thirdprocessingfee_view">RM
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="thirdprocessingfee"
                                                                                        id="thirdprocessingfee">
                                                                                    <input type="hidden"
                                                                                        name="thirdprocessing_fee_rate_fixed"
                                                                                        id="thirdprocessing_fee_rate_fixed"
                                                                                        value="{{ $int['processing_fee_rate_fixed'] }}">
                                                                                    <input type="hidden"
                                                                                        name="thirdprocessing_fee_rate_percentage"
                                                                                        id="thirdprocessing_fee_rate_percentage"
                                                                                        value="{{ $int['processing_fee_rate_percentage'] }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+1 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+1 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="third2amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 3) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="third2_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="third2_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+2 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+2 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="third3amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 3) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="third3_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="third3_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($d['installements']) > 0)
                                        @foreach ($d['installements'] as $int)
                                            @if ($int['installment'] == 6 && $int['minimum_purchase_limit'] <= $d['bill_details']['amount'])
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                            aria-expanded="false" aria-controls="collapseFour"
                                                            onclick="getPayAmount(6)">
                                                            <div class="row flex-nowrap align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="payment-checkbox">
                                                                        <input type='radio' name='a'
                                                                            onchange="getPayAmount(6)"
                                                                            value="6" />
                                                                    </span>
                                                                    Pay in 6
                                                                </div>
                                                                <div class="text-end pl-0"
                                                                    id="firstSequenceAmountFor6">RM
                                                                    {{ floor($d['bill_details']['amount'] / 6) }}
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFour" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="container p-0">
                                                                <ul class="timeline mt-2">
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Pay Today
                                                                                    </div>
                                                                                    <?php
                                                                                    $time = date('Y-m-d');
                                                                                    ?>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixth1amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 6) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixth1_date"
                                                                                        class="date"
                                                                                        value="{{ $time }}"
                                                                                        id="sixth1_date" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Instalment
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixthinstallment_view">RM
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixthinstallment"
                                                                                        id="sixthinstallment">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="time">Processing Fee
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixthprocessingfee_view">RM
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixthprocessingfee"
                                                                                        id="sixthprocessingfee">
                                                                                    <input type="hidden"
                                                                                        name="sixthprocessing_fee_rate_fixed"
                                                                                        id="sixthprocessing_fee_rate_fixed"
                                                                                        value="{{ $int['processing_fee_rate_fixed'] }}">
                                                                                    <input type="hidden"
                                                                                        name="sixthprocessing_fee_rate_percentage"
                                                                                        id="sixthprocessing_fee_rate_percentage"
                                                                                        value="{{ $int['processing_fee_rate_percentage'] }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+1 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+1 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixth2amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 6) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixth2_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="sixth2_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+2 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+2 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixth3amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 6) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixth3_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="sixth3_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+3 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+3 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixth4amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 6) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixth4_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="sixth4_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+4 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+4 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixth5amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 6) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixth5_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="sixth5_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item">
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <?php
                                                                                    $time = strtotime(date('d F Y'));
                                                                                    $final = date('d M Y', strtotime('+5 month', $time));
                                                                                    $final_date = date('Y-m-d', strtotime('+5 month', $time));
                                                                                    ?>
                                                                                    <div class="time">
                                                                                        {{ $final }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col"
                                                                                    style="text-align: end; padding-right: 17px;">
                                                                                    <p id="sixth6amount">RM
                                                                                        {{ floor($d['bill_details']['amount'] / 6) }}
                                                                                    </p>
                                                                                    <input type="hidden"
                                                                                        name="sixth6_date"
                                                                                        class="date"
                                                                                        value="{{ $final_date }}"
                                                                                        id="sixth6_date" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="size-20 font-600 primary-text mb-2">Payment Method</div>
                    <div class="mb-4" style="background: #fff; padding: 15px; border-radius: 6px;">
                        <div class="d-flex justify-content-space-between align-items-center">
                            <div class="size-16 font-600">

                            @if ($d['all_card'] != null && count($d['all_card']))
                            @foreach ($d['all_card'] as $card)
                            @if ($card['is_default'] == 1)
                            @if($card['card_type']!=null)
                            @if($card['card_type']=="Visa")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/visa.svg') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @elseif($card['card_type']=="Master")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/mastercard.svg') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @elseif($card['card_type']=="AmericanExpress")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/American-Express.jpg') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @elseif($card['card_type']=="Discover")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/discover.png') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @elseif($card['card_type']=="Diners")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/diners.jpeg') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @elseif($card['card_type']=="Diners - Carte Blanche")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/Diners.jpeg') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @elseif($card['card_type']=="Jcb")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/jcb.png') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @elseif($card['card_type']=="Visa Electron")
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/visa-electron.png') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @else
                            <span class="mr-1">
                                <img src="{{ asset('laravel_assets/card/other_card.png') }}" id="card_image" alt="" width="28" height="16">
                            </span>
                            <span id="selected_card">{{ $card['card_no'] }}</span>
                            @endif
                            @endif
                            @endif
                            @endforeach
                            @endif
                            </div>
                            <div class="size-16 font-700 primary-color switch">
                                @if ($d['all_card'] != null && count($d['all_card']))
                                    Switch
                                @else
                                    Add
                                @endif

                                <span class="card-tooltip">
                                    <div class="row m-1">
                                        <div class="first-card">
                                            <div class="row flex-nowrap align-items-center">
                                                <div class="col-12">
                                                <div class="size-16 font-600">
                                                    @if ($d['all_card'] != null && count($d['all_card']))
                                                    @foreach ($d['all_card'] as $card)
                                                    <span style="display: flow-root;">
                                                        @if($card['card_type']!=null)
                                                        @if($card['card_type']=="Visa")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/visa.svg') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @elseif($card['card_type']=="Master")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/mastercard.svg') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @elseif($card['card_type']=="AmericanExpress")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/American-Express.jpg') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @elseif($card['card_type']=="Discover")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/discover.png') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @elseif($card['card_type']=="Diners")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/diners.jpeg') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @elseif($card['card_type']=="Diners - Carte Blanche")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/Diners.jpeg') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @elseif($card['card_type']=="Jcb")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/jcb.png') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @elseif($card['card_type']=="Visa Electron")
                                                        <span class="mr-1">
                                                            <img src="{{ asset('laravel_assets/card/visa-electron.png') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @else
                                                        <span class="mr-1">
                                                        <img src="{{ asset('laravel_assets/card/other_card.png') }}" alt="" width="28" height="16">
                                                        </span>
                                                        @if ($card['is_default'] == 1)
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" checked id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @else
                                                        <input type="radio" value="{{ $card['id'] }}" name="payment_method_id" id="card{{ $card['id'] }}" onchange="changeDefaultCard('{{ $card['card_no'] }}','{{$card['card_type']}}')">
                                                        <label for="card{{ $card['id'] }}">{{ $card['card_no'] }}</label>
                                                        @endif
                                                        @endif
                                                        @endif
                                                    </span>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="second-card" onclick="showAddcard()">
                                            <div class="row flex-nowrap align-items-center">
                                                <div class="col-10">
                                                    <div class="size-16 font-600">
                                                        <span>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8 16C10.1217 16 12.1566 15.1571 13.6569 13.6569C15.1571 12.1566 16 10.1217 16 8C16 5.87827 15.1571 3.84344 13.6569 2.34315C12.1566 0.842855 10.1217 0 8 0C5.87827 0 3.84344 0.842855 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8C0 10.1217 0.842855 12.1566 2.34315 13.6569C3.84344 15.1571 5.87827 16 8 16ZM9 5C9 4.73478 8.89464 4.48043 8.70711 4.29289C8.51957 4.10536 8.26522 4 8 4C7.73478 4 7.48043 4.10536 7.29289 4.29289C7.10536 4.48043 7 4.73478 7 5V7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8C4 8.26522 4.10536 8.51957 4.29289 8.70711C4.48043 8.89464 4.73478 9 5 9H7V11C7 11.2652 7.10536 11.5196 7.29289 11.7071C7.48043 11.8946 7.73478 12 8 12C8.26522 12 8.51957 11.8946 8.70711 11.7071C8.89464 11.5196 9 11.2652 9 11V9H11C11.2652 9 11.5196 8.89464 11.7071 8.70711C11.8946 8.51957 12 8.26522 12 8C12 7.73478 11.8946 7.48043 11.7071 7.29289C11.5196 7.10536 11.2652 7 11 7H9V5Z"
                                                                    fill="#94A3B8" />
                                                            </svg>
                                                        </span>
                                                        Add New Card
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span>
                                    @if ($d['all_card'] != null && count($d['all_card']))
                                        <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0.293031 1.29302C0.480558 1.10555 0.734866 1.00023 1.00003 1.00023C1.26519 1.00023 1.5195 1.10555 1.70703 1.29302L5.00003 4.58602L8.29303 1.29302C8.38528 1.19751 8.49562 1.12133 8.61763 1.06892C8.73963 1.01651 8.87085 0.988924 9.00363 0.98777C9.13641 0.986616 9.26809 1.01192 9.39098 1.0622C9.51388 1.11248 9.62553 1.18673 9.71943 1.28062C9.81332 1.37452 9.88757 1.48617 9.93785 1.60907C9.98813 1.73196 10.0134 1.86364 10.0123 1.99642C10.0111 2.1292 9.98354 2.26042 9.93113 2.38242C9.87872 2.50443 9.80254 2.61477 9.70703 2.70702L5.70703 6.70702C5.5195 6.89449 5.26519 6.99981 5.00003 6.99981C4.73487 6.99981 4.48056 6.89449 4.29303 6.70702L0.293031 2.70702C0.10556 2.51949 0.000244141 2.26518 0.000244141 2.00002C0.000244141 1.73486 0.10556 1.48055 0.293031 1.29302Z"
                                                fill="#C026D3" />
                                        </svg>
                                    @else
                                        +
                                    @endif

                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="add-card" style="display:none;">
                        <div class="card mb-5">
                            <div class="d-flex justify-content-space-between mb-3">
                                <div class="size-16 font-600">Add New Card</div>
                                <button class="primary-color add-card-btn" id="add_card_btn"
                                    onclick="addCard()">Add</button>
                            </div>
                            <div class="">
                                <label class="input-check-lebel">Default card</label>
                                <input type="checkbox" class="input-field" id="is_defalut_card"
                                    name="is_defalut_card" />
                            </div>
                            <div class="input">
                                <input type="text" class="input-field" required id="card_holder_name"
                                    name="card_holder_name" />
                                <label class="input-label">Card Holder Name</label>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="input">
                                        <input type="number" class="input-field" required id="card_number"
                                            name="card_number" />
                                        <label class="input-label">Card Number</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="exp-wrapper">
                                        <input autocomplete="off" class="exp" id="month" maxlength="2"
                                            pattern="[0-9]*" inputmode="numerical" placeholder="MM" type="text"
                                            data-pattern-validate class="input-field" />
                                        <input autocomplete="off" class="exp" id="year" maxlength="2"
                                            pattern="[0-9]*" inputmode="numerical" placeholder="YY" type="text"
                                            data-pattern-validate class="input-field" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input">
                                        <input type="password" class="input-field" required id="cvv"
                                            name="cvv" maxlength="3" />
                                        <label class="input-label">CVV <span>
                                                <svg width="16" height="16" viewBox="0 0 18 18"
                                                    fill="none" xmlns="">
                                                    <path
                                                        d="M9.83333 12.3333H9V9H8.16667M9 5.66667H9.00833M16.5 9C16.5 9.98491 16.306 10.9602 15.9291 11.8701C15.5522 12.7801 14.9997 13.6069 14.3033 14.3033C13.6069 14.9997 12.7801 15.5522 11.8701 15.9291C10.9602 16.306 9.98491 16.5 9 16.5C8.01509 16.5 7.03982 16.306 6.12987 15.9291C5.21993 15.5522 4.39314 14.9997 3.6967 14.3033C3.00026 13.6069 2.44781 12.7801 2.0709 11.8701C1.69399 10.9602 1.5 9.98491 1.5 9C1.5 7.01088 2.29018 5.10322 3.6967 3.6967C5.10322 2.29018 7.01088 1.5 9 1.5C10.9891 1.5 12.8968 2.29018 14.3033 3.6967C15.7098 5.10322 16.5 7.01088 16.5 9Z"
                                                        stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span></label>
                                    </div>
                                </div>
                            </div>
                           <div class="grey-text size-12 text-center mt-3">I acknowledge that my card information is saved to my {{ $platformname }} account and a One Time Password (OTP) may not be required for future transactions.
                            </div>
                            <div>
                                <iframe src="" title="auto submit payment form" id="iframeSubmitForm">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="card">


                        @if ($d['bill_details']['billing_stage_id'] != 1)
                            <h5>The bill payment has either been processed or bill status has changed.</h5>
                            <div class="d-flex align-items-center justify-content-center mt-3 mb-4">
                            @else
                                @if ($d['billPaytime'] > 600)
                                    <h5>The payment link has been expired</h5>
                                    <div class="d-flex align-items-center justify-content-center mt-3 mb-4">
                                    @else
                                        <div class="size-16 font-700 primary-text">Pay with the {{ $platformname }} app</div>
                                        <div class="d-flex align-items-center justify-content-center mt-3 mb-4">

                                            @if (!empty($d['bill_details']))

                                                @if ($d['bill_details']['user_id'] == null)
                                                    {{-- <img src="{{ $d['bill_details']['qr_image'] }}" alt="Mobypay" height="131"> --}}
                                                    <div id="bill_qr_image"></div>
                                                    <div class="size-14 font-600 primary-text text-center ml-3">Scan
                                                        this QR with the
                                                        {{ $platformname }}
                                                        app
                                                        to
                                                        pay.
                                                    </div>
                                                @else
                                                    <h5>Bill already in progress</h5>
                                                @endif
                                                {{-- <div class="text-center size-14 grey-text mb-4">or</div> --}}
                                            @endif
                                @endif
                        @endif
                    </div>

                    <div class="size-16 font-700 primary-text mb-2">Pay with the {{ $platformname }} app</div>
                    <div class="d-flex justify-content-space-between">
                        <div class="size-14 grey-text">Payment Plan</div>
                        <div class="size-16 font-700 primary-text" id="pay_secuence">Pay in 1</div>
                    </div>
                    <div class="d-flex justify-content-space-between align-items-center">
                        <div class="size-14 grey-text">Payment Amount</div>
                        <div class="size-24 font-700 primary-color" id="pay_amount">RM
                            {{ floor($d['bill_details']['amount']) }}
                        </div>
                    </div>
                    <div class="action text-center">
                        @if (count($d['all_card']))
                            @if ($d['bill_details']['billing_stage_id'] != 1)
                                <!-- <span class="primary-color">The bill payment has either been processed or bill status has changed.</span> -->
                                <button class="primary-button disabled" id="pay_now">Pay
                                    Now</button>
                            @elseif ($d['billPaytime'] > 600)
                                <!-- <span class="primary-color">The payment link has been expired</span> -->
                                <button class="primary-button disabled" id="pay_now">Pay
                                    Now</button>
                            @elseif ($d['bill_details']['user_id'] != null)
                                <span class="primary-color">Bill already in progress</span>
                                <button class="primary-button disabled" id="pay_now">Pay
                                    Now</button>
                            @else
                                <button class="primary-button" id="pay_now" onclick="paynow('from_page')">Pay
                                    Now</button>
                                <label id="pay_now_warning" style="
                                padding: 10px 13% 0px;
                                color: #b11111c2;
                                font-weight: bold;
                                font-size: 14px;
                                display: none;
                            ">Payment is being proceeded. Please do not refresh the page.</label>
                            @if(isset($d['bill_details']['return_url']))
                                <button class="cancel-button mt-2" id="cancel" onclick="cancelBill('{{$d['bill_details']['bill_code']}}','{{$d['bill_details']['return_url']}}');">Cancel Bill</button>
                            @endif
                            @endif
                        @else
                            <span class="primary-color">Please add a card to continue</span>
                            <button class="primary-button disabled w-100" id="pay_now">Pay
                                Now</button>
                        @endif

                        {{-- <button class="primary-button" data-bs-toggle="modal" data-bs-target="#modal-spendinglimit" id="">Pay
                                Now</button> --}}
                    </div>
                </div>
                <div class="size-14 grey-text mt-3">
                    By proceeding I agree to the <a class="font-700" href="#">terms & conditions</a> of the
                    instalment
                    payment.
                </div>
                    @if ($d['bill_details']['merchant_home_url'])
                      <div class="action">
                          <button onclick="location.href='{{$d['bill_details']['merchant_home_url']}}';" class="button-23 w-100" id="back_to_merchant">← Redirect back to Merchant page</button>
                      </div>
                    @else
                    @endif
                @else
                <div class="col-lg-12 col-md-12">
                    <div id="pageMessages">
                        <div class="alert animated flipInX alert-danger alert-dismissible">
                            <h4><i class="fa ffa fa-exclamation-circle"></i> Opps!</h4>
                            <strong>We are sorry, you are not eligible to proceed with the payment due to merchant payment option not supported.</strong>
                        </div>
                    </div>
                    @if ($d['bill_details']['merchant_home_url'])
                       <div class="text-center" style="margin-top: 60px">
                           <button onclick="location.href='{{$d['bill_details']['merchant_home_url']}}';" class="button-23 w-100" id="back_to_merchant">← Redirect back to Merchant page</button>
                       </div>
                    @else
                    @endif

                </div>
                @endif
            </div>
        </div>
        </div>
        <!-- Modal Spend Responsibly -->
        <div class="modal fade" id="spendResponsibly" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <svg width="35" height="35" viewBox="0 0 40 40" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 28H20V20H18M20 12H20.02M38 20C38 22.3638 37.5344 24.7044 36.6298 26.8883C35.7252 29.0722 34.3994 31.0565 32.7279 32.7279C31.0565 34.3994 29.0722 35.7252 26.8883 36.6298C24.7044 37.5344 22.3638 38 20 38C17.6362 38 15.2956 37.5344 13.1117 36.6298C10.9278 35.7252 8.94353 34.3994 7.27208 32.7279C5.60062 31.0565 4.27475 29.0722 3.37017 26.8883C2.46558 24.7044 2 22.3638 2 20C2 15.2261 3.89642 10.6477 7.27208 7.27208C10.6477 3.89642 15.2261 2 20 2C24.7739 2 29.3523 3.89642 32.7279 7.27208C36.1036 10.6477 38 15.2261 38 20Z"
                                stroke="{{ $color_code_600 }}" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="size-20 font-700 primary-tex mt-2 mb-2">Spend Responsibly</div>
                        <div class="size-14 primary-text mb-2">The option you've selected is completely interest-free.
                            A late payment fee will only be charged if you don't pay on time. At {{ $platformname }}, we want to
                            make it for you to purchase items but in a financially responsible way. Carefully plan your
                            finances and ensure that the instalment payments fit within your monthly budget before
                            proceeding. </div>
                        <div class="size-16 font-600 primary-text mt-4">Late Payment Fee</div>
                        <div class="size-24 font-700 primary-color">RM
                            @if ($d['latefee_details'] != null)
                                {{ $d['latefee_details']['value'] }}
                            @endif
                        </div>
                        <div class="size-12 primary-text">will be charged for every late payment.</div>
                        <div class="size-14 mt-4">
                            By proceeding I agree to the <a class="font-700" href="#">terms & conditions</a> of
                            the instalment payment.
                        </div>
                    </div>
                    <div class="modal-footer border-0 flex-nowrap">
                        <button class="secondary-button" data-bs-dismiss="modal">Cancel</button>
                        @if (count($d['all_card']))
                            @if ($d['bill_details']['billing_stage_id'] != 1)
                                <span class="primary-color">The bill payment has either been processed or bill status
                                    has changed.</span>
                                <button class="primary-button disabled">I understand, proceed to Pay</button>
                            @elseif ($d['billPaytime'] > 600)
                                <span class="primary-color">The payment link has been expired</span>
                                <button class="primary-button disabled">I understand, proceed to Pay</button>
                            @else
                                <button class="primary-button" id="pay_now_btn_modal"
                                    onclick="paynow('from_modal')">I understand, proceed to Pay</button>
                            @endif
                        @else
                            <span class="primary-color">Please add a card to continue</span>
                            <button class="primary-button">I understand, proceed to Pay</button>
                        @endif
                        {{-- <button class="primary-button" data-bs-dismiss="modal">I understand, proceed to Pay</button> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Modal Terms & Condition --> --}}
        <div class="modal fade" id="modal_T_C" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true" style="z-index: 9999;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style="background: #f1f1f1; box-shadow: 8px 8px 8px rgba(0,0,0,0.30);">
                    <div class="modal-body text-center">
                        <div class="size-20 font-700 primary-tex mt-2 mb-2">Terms & Conditions</div>
                        <div class="form">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div id="show_t_c"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="#">
                            <button class="secondary-button" data-bs-dismiss="modal">Continue to Pay</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Modal spending limit --> --}}
        <div class="modal fade" id="modal-spendinglimit" tabindex="-1" aria-labelledby="verifyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="size-20 font-700 primary-tex mt-2 mb-2">Your Available Spending Limit</div>
                        <div class="size-32 font-700 primary-color">RM 150.00</div>
                        <div class="size-14 mt-2">
                             Download the <span class="font-700"> {{ $platformname }} app</span> and verify your MyKad to get up to
                            <span class="font-700">RM3,000</span> spending limit.
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3 mb-3">
                            <div class="social-icon">
                                <img src="{{ asset('laravel_assets/image/apple_store.svg') }}" alt="">
                                <img src="{{ asset('laravel_assets/image/google_play.svg') }}" alt="">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <a href="#">
                            <button class="secondary-button" data-bs-dismiss="modal">Continue to Pay</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Voucher select --}}
        <div class="modal fade" id="modalVoucher" tabindex="-1" aria-labelledby="verifyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style="background: #f1f1f1;">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="size-20 font-700 primary-tex mt-2 mb-2">Select Voucher</div>
                        <div class="form">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="input">
                                        <input type="text" class="input-field" id="input1" required />
                                        <label class="input-label">Enter Promo Code</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="select-button" id="button1" data-bs-dismiss="modal"
                                        onclick="applyVoucher();">Apply</button>
                                </div>
                            </div>
                        </div>
                        <div class="size-14 font-600 primary-text mb-1 text-left" id="platform_voucher_div">Platform
                            Vouchers</div>

                        <div class="size-14 font-600 primary-text mb-1 mt-3 text-left" id="store_vouchers_div">Store
                            Vouchers</div>
                    </div>
                    <div class="modal-footer border-0">
                        <button class="primary-button" id="Okay" onclick="applyVoucher();">Okay</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="passcode_1" tabindex="-1" aria-labelledby="passcode_1"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-title font-700 mb-3">Create Passcode</div>
                        <div class="default-input-label">Enter 6-digit passcode</div>
                        <div class="container mb-4 d-flex justify-content-center align-items-center">
                            <div class="position-relative">
                                <div class="p-2 text-center">
                                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                        <input class="m-2 text-center form-control rounded passcode" type="number"
                                               id="first_passcode_1" maxlength="1" onkeypress="return isNumberKey(event)" required/>
                                        <input class="m-2 text-center form-control rounded passcode" type="number"
                                               id="second_passcode_1" maxlength="1" onkeypress="return isNumberKey(event)" />
                                        <input class="m-2 text-center form-control rounded passcode" type="number"
                                               id="third_passcode_1" maxlength="1" onkeypress="return isNumberKey(event)" />
                                        <input class="m-2 text-center form-control rounded passcode" type="number"
                                               id="fourth_passcode_1" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                        <input class="m-2 text-center form-control rounded passcode" type="number"
                                               id="fifth_passcode_1" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                        <input class="m-2 text-center form-control rounded passcode" type="number"
                                               id="sixth_passcode_1" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="#">
                            <button type="button" class="primary-button" onclick="click_passcode_1_next()">Next</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
                <div class="modal fade" id="passcode_2" tabindex="-1" aria-labelledby="passcode_2"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-title font-700 mb-3">Confirm Passcode</div>
                                <div class="default-input-label">Re-Enter 6-digit passcode</div>
                                <div class="container mb-4 d-flex justify-content-center align-items-center">
                                    <div class="position-relative">
                                        <div class="p-2 text-center">
                                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                                <input class="m-2 text-center form-control rounded passcode" type="number"
                                                       id="first_passcode_2" maxlength="1" onkeypress="return isNumberKey(event)" required/>
                                                <input class="m-2 text-center form-control rounded passcode" type="number"
                                                       id="second_passcode_2" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                                <input class="m-2 text-center form-control rounded passcode" type="number"
                                                       id="third_passcode_2" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                                <input class="m-2 text-center form-control rounded passcode" type="number"
                                                       id="fourth_passcode_2" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                                <input class="m-2 text-center form-control rounded passcode" type="number"
                                                       id="fifth_passcode_2" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                                <input class="m-2 text-center form-control rounded passcode" type="number"
                                                       id="sixth_passcode_2" maxlength="1" onkeypress="return isNumberKey(event)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <a href="#">
                                    <button type="button" class="primary-button" onclick="click_passcode_2_next()">Submit</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    @else
        <script>
            swal("Error!", "{{ $d->message }}", "error");
        </script>
    @endif

</body>
@if (gettype($d) == 'array')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var bill_amount = parseFloat("{{ $d['bill_details']['amount'] }}").toFixed(2);
        var is_upfront_percentage_avail = parseInt("{{ ($d['bill_details']['get_merchant']['change_upfront_payment'])?$d['bill_details']['get_merchant']['change_upfront_payment']:0 }}");
        var upfront_percentage = parseFloat("{{ $d['bill_details']['get_merchant']['upfront_payment_percentage'] }}").toFixed(2);
        var is_passcode_set = {{ $u['customer_details']['get_user_details']['is_passcode_set'] }}
        var bill_id = "<?php if (!empty($d['bill_details'])) {
            echo $d['bill_details']['id'];
        } else {
            echo '';
        } ?>";
        var payment_method_id = $('input[name="payment_method_id"]:checked').val();
        var spending_limit = parseInt("{{ $d['spending_limit'][0]['spending_limit'] }}");
        var discount = 0;
        var processing_fee_percentage = 0;
        var fixed_processing_fee = 0;
        var processing_fee = 0;
        var whole_amount = 0;
        var decimalStr = '';
        // var fraction_amount = 0.00;
        var sequence_amount = 0;
        var fst_installment = 0;
        var snd_installment = 0;
        var trd_installment = 0;
        var frth_installment = 0;
        var fifth_installment = 0;
        var sixth_installment = 0;
        var pay_amount = 0;
        var net_amount = 0;
        var firstSequenceAmount = 0.00;
        var firstSequenceAmountFor2 = 0.00;
        var firstSequenceAmountFor3 = 0.00;
        var firstSequenceAmountFor6 = 0.00;
        var instAmounts = [0.00, 0.00, 0.00, 0.00, 0.00, 0.00];
        var billing_sequence = $('input[name="a"]:checked').val();
        var is_voucher_applied = $('input[name="check_voucher"]').is(":checked");
        var discountType = 0; //0=deduct on bill amount, 1=deduct on last splits
        var voucher_amount = $('[name="check_voucher"]').attr('voucher_amount');
        var counter = 0;
        var isCancelBillApiCalled = false;
        var isRedirected = false;
        var merchant_code = "{{$d['bill_details']['merchant_id']}}";
        var return_shopify_url = "{{$d['bill_details']['return_url'] != null ? $d['bill_details']['return_url'] : 'null'}}";

        function payment_calculations() {
            var promocode_value = document.getElementById("input1");
            var promocode = promocode_value.value;
            // Checking voucher is applied or not
            is_voucher_applied = $('input[name="check_voucher"]').is(":checked");
            // Getting the billing sequence
            billing_sequence = $('input[name="a"]:checked').val();
            net_amount = bill_amount;
            if (is_voucher_applied || promocode != '') {
                // Getting the discount amount
                discount = $('#discount_amount').val();
                // discount type 0=deduct on bill amount, 1=deduct on last splits
                discountType = $('#discount_type').val();
                // Calculate the net amount if discount type 0 then deduct the amount from bill amount
                if (discountType == 0) {
                    net_amount = bill_amount - discount;
                }
            }
            if (billing_sequence != 1) {
                whole_amount = Math.trunc(net_amount);
                console.log(whole_amount);
                console.log(net_amount);
                // fraction_amount = parseInt((net_amount % 1).toFixed(2).substring(2));
                // console.log(fraction_amount);
                // Calculate the first sequesnce amount
                if( is_upfront_percentage_avail == 1 ) {
                    firstSequenceAmount = net_amount * (upfront_percentage/100);
                    sequence_amount = parseInt((whole_amount-firstSequenceAmount) / (billing_sequence-1)).toFixed(2);
                    firstSequenceAmount = net_amount - (sequence_amount * (billing_sequence - 1));
                } else {
                    sequence_amount = parseInt(whole_amount / billing_sequence).toFixed(2);
                    firstSequenceAmount = net_amount - (sequence_amount * (billing_sequence - 1));
                }
                // Calculate the sequence amount and first sequence amount if net amount is greater than available spending limit
                if (net_amount > spending_limit) {

                    if(spending_limit < 0){
                        sequence_amount = "0.00";
                        firstSequenceAmount = net_amount;
                    }else{
                        var sequence_amount_new = spending_limit / billing_sequence;
                        sequence_amount_new = parseInt(sequence_amount_new).toFixed(2);
                        if( is_upfront_percentage_avail == 1 ) {
                            var sequenceAmt = net_amount - (sequence_amount_new * (billing_sequence - 1));
                            if( firstSequenceAmount < sequenceAmt ) {
                                sequence_amount = sequence_amount_new;
                                firstSequenceAmount = sequenceAmt;
                            }
                        } else {
                            sequence_amount = sequence_amount_new;
                            firstSequenceAmount = net_amount - (sequence_amount_new * (billing_sequence - 1));
                        }
                    }

                }

                // Setting the first installment amount and all other installments
                instAmounts[0] = parseFloat(firstSequenceAmount).toFixed(2);
                for (var i = 1; i < billing_sequence; i++) {
                    console.log("1539: sequence_amount: "+i+": "+sequence_amount);
                    instAmounts[i] = parseFloat(sequence_amount).toFixed(2);
                }
                // Calculate the sequence amount if voucher is applied
                if (is_voucher_applied || promocode != '') {
                    // Checking the discount type of voucher and check if discount is apply to sequence
                    if (discountType == 1) {
                        var tempDis = parseFloat(discount).toFixed(2);
                        for (var i = billing_sequence - 1; i >= 0; i--) {
                            // Check if last installment greater that discount for calculate sequence
                            if (parseFloat(instAmounts[i]) >= parseFloat(tempDis)) {
                                instAmounts[i] = instAmounts[i] - tempDis;
                                break;
                            } else {
                                tempDis = tempDis - instAmounts[i];
                                // instAmounts[i] = instAmounts[i] - tempDis;
                                instAmounts[i] = 0.00;
                            }
                        }
                    }
                }

            } else {
                // Calculate the first sequence amount if voucher is applied
                if (is_voucher_applied || promocode != '') {
                    if (discountType == 1) {
                        instAmounts[0] = net_amount - discount;
                    } else {
                        instAmounts[0] = net_amount;
                    }
                } else {
                    instAmounts[0] = net_amount;
                }
                $('#firstSequenceAmount').html('RM ' + instAmounts[0]);
                $('#pay_amount').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));
                $('#pay_amount_value').val(parseFloat(instAmounts[0]).toFixed(2));
                $('#first1amount').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));

            }
            if (counter == 0) {
                // $('#firstSequenceAmount').html('RM ' + instAmounts[0]);
                // $('#pay_amount').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));
                // $('#pay_amount_value').val(parseFloat(instAmounts[0]).toFixed(2));
                // $('#first1amount').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));
                calculatePayLaterTotalValue(1);
                calculatePayLaterTotalValue(2);
                calculatePayLaterTotalValue(3);
                calculatePayLaterTotalValue(6);
                counter++;
            } else {
                if (billing_sequence != 1) {
                    calculatePayLaterTotalValue(billing_sequence);
                }
            }

        }


        // Calculate total pay later value if voucher is applied and deduct from last split
        function calculatePayLaterTotalValue(sequence) {
            var promocode_value = document.getElementById("input1");
            var promocode = promocode_value.value;
            discountType = $('#discount_type').val();
            is_voucher_applied = $('input[name="check_voucher"]').is(":checked");
            var whole = Math.trunc(net_amount);
            // var fraction = parseInt((net_amount % 1).toFixed(2).substring(2));
            // decimalStr = net_amount.toString().split('.')[1];
            // fraction = Number(decimalStr);
            // parseInt(whole_amount / billing_sequence).toFixed(2)
            var sequenceAmountTemp = parseInt(whole / sequence).toFixed(2);
            var firstSequenceAmountTemp = net_amount - (sequenceAmountTemp * (sequence - 1));
            if( is_upfront_percentage_avail == 1 ) {
                firstSequenceAmountTemp = net_amount * (upfront_percentage/100);
                sequenceAmountTemp = parseInt((whole-firstSequenceAmountTemp) / (sequence-1)).toFixed(2);
                firstSequenceAmountTemp = net_amount - (sequenceAmountTemp * (sequence - 1));
            }
            if (net_amount > spending_limit) {
                if(spending_limit < 0){
                        sequenceAmountTemp = "0.00";
                        firstSequenceAmountTemp = net_amount;
                    }else{
                       // sequenceAmountTemp = spending_limit / sequence;
                        var sequenceAmountTemp_new = parseInt(spending_limit / sequence).toFixed(2);
                        if( is_upfront_percentage_avail == 1 ) {
                            var sequenceAmt = net_amount - (sequenceAmountTemp_new * (sequence - 1));
                            if( firstSequenceAmountTemp < sequenceAmt ) {
                                sequenceAmountTemp = sequenceAmountTemp_new;
                                firstSequenceAmountTemp = sequenceAmt;
                            }
                        } else {
                            sequenceAmountTemp = sequenceAmountTemp_new;
                            firstSequenceAmountTemp = net_amount - (sequenceAmountTemp_new * (sequence - 1));
                        }
                    }

            }
            if (sequence == 1) {
                let net_amount_temp = net_amount;
                if (discountType == 1) {
                    net_amount_temp = net_amount - discount;
                }
                fixed_processing_fee = parseFloat($('#firstprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#firstprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                $('#firstSequenceAmount').html('RM ' + parseFloat(parseFloat(net_amount_temp)+parseFloat(processing_fee)).toFixed(2));
            }
            if (sequence == 2) {
                if (is_voucher_applied || promocode != '') {
                    if (discountType == 1&&sequenceAmountTemp < discount) {
                        // if (sequenceAmountTemp < discount) {
                            firstSequenceAmountFor2 =
                                firstSequenceAmountTemp - (discount - sequenceAmountTemp);
                        } else {
                            firstSequenceAmountFor2 = firstSequenceAmountTemp;
                        }
                    // }

                } else {
                    firstSequenceAmountFor2 = firstSequenceAmountTemp;
                }
                fixed_processing_fee = parseFloat($('#secondprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#secondprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                $('#firstSequenceAmountFor2').html('RM ' + parseFloat(parseFloat(firstSequenceAmountFor2) + parseFloat(
                    processing_fee)).toFixed(2));
            } else if (sequence == 3) {
                if (is_voucher_applied || promocode != '') {
                    if (discountType == 1&&(sequenceAmountTemp * 2) < discount) {
                        // if () {
                            firstSequenceAmountFor3 =
                                firstSequenceAmountTemp - (discount - (sequenceAmountTemp * 2));
                        } else {
                            firstSequenceAmountFor3 = firstSequenceAmountTemp;
                        }
                    // }

                } else {
                    firstSequenceAmountFor3 = firstSequenceAmountTemp;
                }
                fixed_processing_fee = parseFloat($('#thirdprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#thirdprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                $('#firstSequenceAmountFor3').html('RM ' + parseFloat(parseFloat(firstSequenceAmountFor3) + parseFloat(
                    processing_fee)).toFixed(2));
            } else if (sequence == 6) {
                if (is_voucher_applied || promocode != '') {
                    if (discountType == 1&&(sequenceAmountTemp * 5) < discount) {
                        // if ((sequenceAmountTemp * 5) < discount) {
                            firstSequenceAmountFor6 =
                                firstSequenceAmountTemp - (discount - (sequenceAmountTemp * 5));
                        } else {
                            firstSequenceAmountFor6 = firstSequenceAmountTemp;
                        }
                    // }

                } else {
                    firstSequenceAmountFor6 = firstSequenceAmountTemp;
                }
                fixed_processing_fee = parseFloat($('#sixthprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#sixthprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                $('#firstSequenceAmountFor6').html('RM ' + parseFloat(parseFloat(firstSequenceAmountFor6) + parseFloat(
                    processing_fee)).toFixed(2));
            }
            renderHtml(sequence);
        }


        // Rendering the payment value after each calculation
        function renderHtml() {
            // billing_sequence = $('input[name="a"]:checked').val();
            if (billing_sequence == 1) {
                fixed_processing_fee = parseFloat($('#firstprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#firstprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                // alert(instAmounts[0]);
                // $('#firstSequenceAmount').html('RM ' + parseFloat(firstSequenceAmount).toFixed(2));
                // console.log(instAmounts[0]+" in billing sequence ");
                $('#firstSequenceAmount').html('RM ' + parseFloat(parseFloat(instAmounts[0])+parseFloat(processing_fee)).toFixed(2));
                $('#pay_amount').html('RM ' + parseFloat(parseFloat(instAmounts[0])+parseFloat(processing_fee)).toFixed(2));
                $('#pay_amount_value').val(parseFloat(parseFloat(instAmounts[0])+parseFloat(processing_fee)).toFixed(2));
                $('#firstprocessingfee_view').html('RM ' + parseFloat(processing_fee).toFixed(2));
                $('#first1amount').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));
                // $('#pay_amount').html('RM ' + instAmounts[0]);
            } else if (billing_sequence == 2) {
                // $('#firstSequenceAmountFor2').html('RM ' +  parseFloat(firstSequenceAmountFor2).toFixed(2));
                fixed_processing_fee = parseFloat($('#secondprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#secondprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                // processing_fee = processing_fee+fixed_processing_fee;
                $('#firstSequenceAmountFor2').html('RM ' + parseFloat(parseFloat(instAmounts[0]) + parseFloat(
                    processing_fee)).toFixed(2));
                $('#secondinstallment_view').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));
                $('#secondprocessingfee_view').html('RM ' + parseFloat(processing_fee).toFixed(2));
                $('#pay_amount').html('RM ' + parseFloat(parseFloat(instAmounts[0]) + parseFloat(processing_fee)).toFixed(
                    2));
                $('#pay_amount_value').val(parseFloat(parseFloat(instAmounts[0]) + parseFloat(processing_fee)).toFixed(2));
                for (var i = 0; i < billing_sequence; i++) {
                    var id_name = '#second' + (i + 1) + 'amount';
                    if ((i + 1) == 1) {
                        $(id_name).html('RM ' + parseFloat(parseFloat(instAmounts[i]) + parseFloat(processing_fee)).toFixed(
                            2));
                        // instAmounts[i] = parseFloat(parseFloat(instAmounts[i]) + parseFloat(processing_fee)).toFixed(2);
                    } else {
                        $(id_name).html('RM ' + parseFloat(instAmounts[i]).toFixed(2));
                    }
                }

            } else if (billing_sequence == 3) {
                // $('#firstSequenceAmountFor3').html('RM ' + parseFloat(firstSequenceAmountFor3).toFixed(2) );
                fixed_processing_fee = parseFloat($('#thirdprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#thirdprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                // console.log("processing fee for 3 before: "+processing_fee);
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                // processing_fee = processing_fee+fixed_processing_fee;
                // console.log("processing fee for 3 after: "+processing_fee);
                // console.log("net_amount : "+net_amount);
                // console.log("processing_fee_rate_fixed for 3: "+fixed_processing_fee);
                // console.log("processing_fee_percentage for 3: "+processing_fee_percentage);
                $('#firstSequenceAmountFor3').html('RM ' + parseFloat(parseFloat(instAmounts[0]) + parseFloat(
                    processing_fee)).toFixed(2));
                $('#thirdinstallment_view').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));
                $('#thirdprocessingfee_view').html('RM ' + parseFloat(processing_fee).toFixed(2));
                $('#pay_amount').html('RM ' + parseFloat(parseFloat(instAmounts[0]) + parseFloat(processing_fee)).toFixed(
                    2));
                $('#pay_amount_value').val(parseFloat(parseFloat(instAmounts[0]) + parseFloat(processing_fee)).toFixed(2));
                for (var i = 0; i < billing_sequence; i++) {
                    var id_name = '#third' + (i + 1) + 'amount';
                    if ((i + 1) == 1) {
                        $(id_name).html('RM ' + parseFloat(parseFloat(instAmounts[i]) + parseFloat(processing_fee)).toFixed(
                            2));
                        // instAmounts[i] = parseFloat(parseFloat(instAmounts[i]) + parseFloat(processing_fee)).toFixed(2);
                    } else {
                        $(id_name).html('RM ' + parseFloat(instAmounts[i]).toFixed(2));
                    }
                }

            } else if (billing_sequence == 6) {
                // $('#firstSequenceAmountFor6').html('RM ' + parseFloat(firstSequenceAmountFor6).toFixed(2) );
                fixed_processing_fee = parseFloat($('#sixthprocessing_fee_rate_fixed').val());
                processing_fee_percentage = parseFloat($('#sixthprocessing_fee_rate_percentage').val());
                processing_fee = parseFloat(((bill_amount * processing_fee_percentage) / 100));
                processing_fee = parseFloat(processing_fee + fixed_processing_fee).toFixed(2);
                // processing_fee = processing_fee+fixed_processing_fee;
                $('#firstSequenceAmountFor6').html('RM ' + parseFloat(parseFloat(instAmounts[0]) + parseFloat(
                    processing_fee)).toFixed(2));
                $('#sixthinstallment_view').html('RM ' + parseFloat(instAmounts[0]).toFixed(2));
                $('#sixthprocessingfee_view').html('RM ' + parseFloat(processing_fee).toFixed(2));
                $('#pay_amount').html('RM ' + parseFloat(parseFloat(instAmounts[0]) + parseFloat(processing_fee)).toFixed(
                    2));
                $('#pay_amount_value').val(parseFloat(parseFloat(instAmounts[0]) + parseFloat(processing_fee)).toFixed(2));
                for (var i = 0; i < billing_sequence; i++) {
                    var id_name = '#sixth' + (i + 1) + 'amount';
                    if ((i + 1) == 1) {
                        $(id_name).html('RM ' + parseFloat(parseFloat(instAmounts[i]) + parseFloat(processing_fee)).toFixed(
                            2));
                        // instAmounts[i] = parseFloat(parseFloat(instAmounts[i]) + parseFloat(processing_fee)).toFixed(2);
                    } else {
                        $(id_name).html('RM ' + parseFloat(instAmounts[i]).toFixed(2));
                    }

                }
            }
            // $('#firstSequenceAmount').html('RM ' + net_amount);

            // $('#firstSequenceAmountFor3').html('RM ' + firstSequenceAmountFor3);

        }




        // Add card month and year validation starts
        const monthInput = document.querySelector('#month');
        const yearInput = document.querySelector('#year');

        const focusSibling = function(target, direction, callback) {
            const nextTarget = target[direction];
            nextTarget && nextTarget.focus();
            // if callback is supplied we return the sibling target which has focus
            callback && callback(nextTarget);
        }

        // input event only fires if there is space in the input for entry.
        // If an input of x length has x characters, keyboard press will not fire this input event.
        monthInput.addEventListener('input', (event) => {

            const value = event.target.value.toString();
            // adds 0 to month user input like 9 -> 09
            if (value.length === 1 && value > 1) {
                event.target.value = "0" + value;
            }
            // bounds
            if (value === "00") {
                event.target.value = "01";
            } else if (value > 12) {
                event.target.value = "12";
            }
            // if we have a filled input we jump to the year input
            2 <= event.target.value.length && focusSibling(event.target, "nextElementSibling");
            event.stopImmediatePropagation();
        });

        yearInput.addEventListener('keydown', (event) => {
            // if the year is empty jump to the month input
            if (event.key === "Backspace" && event.target.selectionStart === 0) {
                focusSibling(event.target, "previousElementSibling");
                event.stopImmediatePropagation();
            }
        });

        const inputMatchesPattern = function(e) {
            const {
                value,
                selectionStart,
                selectionEnd,
                pattern
            } = e.target;

            const character = String.fromCharCode(e.which);
            const proposedEntry = value.slice(0, selectionStart) + character + value.slice(selectionEnd);
            const match = proposedEntry.match(pattern);

            return e.metaKey || // cmd/ctrl
                e.which <= 0 || // arrow keys
                e.which == 8 || // delete key
                match && match["0"] === match
                .input; // pattern regex isMatch - workaround for passing [0-9]* into RegExp
        };

        document.querySelectorAll('input[data-pattern-validate]').forEach(el => el.addEventListener('keypress', e => {
            if (!inputMatchesPattern(e)) {
                return e.preventDefault();
            }
        }));

        // Add card month and year validation


        // Show add card form
        function showAddcard() {
            if(parseInt(is_passcode_set)==0){
                $("#passcode_1").modal('show');
                return false;
            }
            var x = document.getElementById("add-card");
            if (x.style.display === "none") {
                x.style.display = "block";
            $("#add_card_btn").focus();
            } else {
                x.style.display = "none";
            }
        }

        // Voucher promocode section
        var text1 = document.getElementById("input1");
        var butt1 = document.getElementById("button1");

        text1.addEventListener('keyup', function() {
            if (text1.value == null || text1.value == "") {
                butt1.style.backgroundColor = "#CBD5E1";
                butt1.style.cursor = "pointer";
                $('#button1').css('pointer-events', 'none');
                $('#platformVoucher').css('pointer-events', 'all');
                $('#storeVoucher').css('pointer-events', 'all');
                $('#Okay').css('pointer-events', 'all');
                $('#Okay').css('backgroundColor', '{{ $color_code_600 }}');
                $('#discount_amount').val(0);
            } else {
                butt1.style.backgroundColor = "{{ $color_code_600 }}";
                $('#button1').css('pointer-events', 'all');
                $('#platformVoucher').css('pointer-events', 'none');
                $('#storeVoucher').css('pointer-events', 'none');
                $('#Okay').css('pointer-events', 'none');
                $('#Okay').css('backgroundColor', '#CBD5E1');
                $('input[name="check_voucher"]').prop('checked', false);
                $('#discount_amount').val(0);
            }
        });

        // Voucher apply validation to apply only one voucher at a time
        function onlyOne(checkbox) {
            var checkboxes = document.getElementsByName('check_voucher')
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })
        }


        // Apply voucher
        function applyVoucher() {
            // $('#modalVoucher').modal('hide');
            var promocode = text1.value;
            is_voucher_applied = $('input[name="check_voucher"]').is(":checked");
            if (is_voucher_applied || promocode != '') {
                voucher_id = $('input[name="check_voucher"]:checked').val();
                if (promocode != '') {
                    voucher_id = null;
                } else {
                    promocode = null;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('customer.claim.voucher') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "voucher_id": voucher_id,
                        "bill_amount": bill_amount,
                        "promocode": promocode,
                        "merchant_code": merchant_code

                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status == 'success') {
                            let discount_cal;
                        if (Number.isInteger(data.discount_amount) == false) {
                            discount_cal = data.discount_amount;
                        } else {
                            discount_cal = data.discount_amount.toFixed(2);
                        }
                            swal("Success!", "RM " + discount_cal + " has been applied", "success");
                            $('#discount_amount').val(discount_cal);
                            $('#voucher_id_value').val(data.voucher_id);
                            $('#voucher_unique_id_value').val(data.unique_voucher_id);
                            $('#discount_type').val(parseInt(data.discount_type));
                            // counter=0;
                            payment_calculations();
                            $('#modalVoucher').modal('hide');
                            // $('#voucher_div').css('display', 'block');
                            $('#show_select').css('display', 'none');
                            $('#discount_amount_show').html("RM " + discount_cal + " off &nbsp");
                            all_vouchers();
                        } else {
                            // $('#voucher_div').css('display', 'none');
                            $('#show_select').css('display', 'block');
                            $('#discount_amount_show').html("");
                            // counter=0;
                            payment_calculations();
                            swal("Error!", data.message, "error");
                        }
                        $('#modalVoucher').modal('hide');
                    },
                    error: function(response) {
                        $('#voucher_div').css('display', 'none');
                        // $('#voucher_div').css('display', 'none');
                        $('#show_select').css('display', 'block');
                        $('#discount_amount_show').html("");
                        $('#modalVoucher').modal('hide');
                        swal("Error!", "Some internal error occured", "error");
                        // counter=0;
                        payment_calculations();
                    }
                });
            } else {
                $('#voucher_div').css('display', 'none');
                // $('#voucher_div').css('display', 'none');
                $('#show_select').css('display', 'block');
                $('#discount_amount_show').html("");
                // swal("Warning!", "Please choose voucher to apply", "warning");
                $('#modalVoucher').modal('hide');
                // counter=0;
                payment_calculations();
            }


        }


        // Setting the pay amount after bootstrap accordin click
        function getPayAmount(pay_plan) {
            $("input[name='a'][value='" + pay_plan + "']").prop('checked', true);
            if (pay_plan == 1) {
                $('#pay_secuence').html('Pay in 1');
            }

            if (pay_plan == 2) {
                $('#pay_secuence').html('Pay in 2');
            }

            if (pay_plan == 3) {
                $('#pay_secuence').html('Pay in 3');
            }

            if (pay_plan == 6) {
                $('#pay_secuence').html('Pay in 6');
            }
            payment_calculations();
        }

        function GetCardType(number) {
        // visa
            var re = new RegExp("^4");
            if (number.match(re) != null)
                return "Visa";

            // Mastercard
            // Updated for Mastercard 2017 BINs expansion
            if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
                return "Master";

            // AMEX
            re = new RegExp("^3[47]");
            if (number.match(re) != null)
                return "AmericanExpress";

            // Discover
            re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
            if (number.match(re) != null)
                return "Discover";

            // Diners
            re = new RegExp("^36");
            if (number.match(re) != null)
                return "Diners";

            // Diners - Carte Blanche
            re = new RegExp("^30[0-5]");
            if (number.match(re) != null)
                return "Diners - Carte Blanche";

            // JCB
            re = new RegExp("^35(2[89]|[3-8][0-9])");
            if (number.match(re) != null)
                return "Jcb";

            // Visa Electron
            re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
            if (number.match(re) != null)
                return "Visa Electron";

            return "";
        }

        // Add a new card
        function addCard() {
            var cvv = $('#cvv').val();
            // var expiry_date = $('#expiry_date').val();
            var card_number = $('#card_number').val();
            var card_holder_name = $('#card_holder_name').val();
            var card_exp_mnth = $('#month').val();
            var card_exp_year = $('#year').val();
            var cvv_regx = /[0-9]/;

        }

        // Setting the pay amount after bootstrap accordin click
        function getPayAmount(pay_plan) {
            $("input[name='a'][value='" + pay_plan + "']").prop('checked', true);
            if (pay_plan == 1) {
                $('#pay_secuence').html('Pay in 1');
            }

            if (pay_plan == 2) {
                $('#pay_secuence').html('Pay in 2');
            }

            if (pay_plan == 3) {
                $('#pay_secuence').html('Pay in 3');
            }

            if (pay_plan == 6) {
                $('#pay_secuence').html('Pay in 6');
            }
            payment_calculations();
        }
        function click_passcode_1_next(){
            var first_passcode_1 = $('#first_passcode_1').val();
            var second_passcode_1 = $('#second_passcode_1').val();
            var third_passcode_1 = $('#third_passcode_1').val();
            var fourth_passcode_1 = $('#fourth_passcode_1').val();
            var fifth_passcode_1 = $('#fifth_passcode_1').val();
            var sixth_passcode_1 = $('#sixth_passcode_1').val();
            if (first_passcode_1 == '' || second_passcode_1 == '' || third_passcode_1 == '' ||
                fourth_passcode_1 == '' || fifth_passcode_1 == '' || sixth_passcode_1 == '') {
                swal("Error!", "Please enter passcode", "warning");
            }else{
                $("#passcode_1").modal('toggle');
                $("#passcode_2").modal('show');
            }
        }
        function click_passcode_2_next(){
            var first_passcode_2 = $('#first_passcode_2').val();
            var second_passcode_2 = $('#second_passcode_2').val();
            var third_passcode_2 = $('#third_passcode_2').val();
            var fourth_passcode_2 = $('#fourth_passcode_2').val();
            var fifth_passcode_2 = $('#fifth_passcode_2').val();
            var sixth_passcode_2 = $('#sixth_passcode_2').val();
            var first_passcode_1 = $('#first_passcode_1').val();
            var second_passcode_1 = $('#second_passcode_1').val();
            var third_passcode_1 = $('#third_passcode_1').val();
            var fourth_passcode_1 = $('#fourth_passcode_1').val();
            var fifth_passcode_1 = $('#fifth_passcode_1').val();
            var sixth_passcode_1 = $('#sixth_passcode_1').val();
            if (first_passcode_2 == '' || second_passcode_2 == '' || third_passcode_2 == '' ||
                fourth_passcode_2 == '' || fifth_passcode_2 == '' || sixth_passcode_2 == '') {
                swal("Error!", "Please enter passcode", "warning");
            }else{
                if(
                    first_passcode_1 == first_passcode_2 &&
                    second_passcode_1 == second_passcode_2 &&
                    third_passcode_1 == third_passcode_2 &&
                    fourth_passcode_1 == fourth_passcode_2 &&
                    fifth_passcode_1 == fifth_passcode_2 &&
                    sixth_passcode_1 == sixth_passcode_2
                ){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('customer.passcode.add') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "passcode": first_passcode_1.trim()+
                                second_passcode_1.trim()+
                                third_passcode_1.trim()+
                                fourth_passcode_1.trim()+
                                fifth_passcode_1.trim()+
                                sixth_passcode_1.trim(),
                        },
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.status == 'success') {
                                swal("Success!", res.message, "success");
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal("Error!", "Some internal error occured", "error");
                            }
                        },
                        error: function(response) {
                            console.log(response);
                            swal("Error!", "Some internal error occured", "error");
                        }
                    });
                }else{
                    swal("Error!", "Passcode and confirm passcode are not match", "warning");
                }
            }
        }
        // Add a new card
        function addCard() {
            var cvv = $('#cvv').val();
            // var expiry_date = $('#expiry_date').val();
            var card_number = $('#card_number').val();
            var card_holder_name = $('#card_holder_name').val();
            var card_exp_mnth = $('#month').val();
            var card_exp_year = $('#year').val();
            var cvv_regx = /[0-9]/;

            if (card_exp_mnth == '') {
                swal('Please enter card expiry month');
                return false;
            }

            if (card_exp_year == '') {
                swal('Please enter card expiry year');
                return false;
            }

            if (!(cvv.match(cvv_regx))) {
                swal('Please enter valid cvv');
                return false;
            }

            if (card_number.length != 16) {
                swal("Warning!", 'Please enter valid card number', "warning");
                return false;
            }

            if (card_exp_mnth == '') {
                swal('Please enter card expiry month');
                return false;
            }

            if (card_exp_year == '') {
                swal('Please enter card expiry year');
                return false;
            }

            if (!(cvv.match(cvv_regx))) {
                swal('Please enter valid cvv');
                return false;
            }

            if (card_number.length != 16) {
                swal("Warning!", 'Please enter valid card number', "warning");
                return false;
            } else {
                card_type = GetCardType(card_number);
            }

        // var card_holder_name_regx = /^[A-Za-z] *[A-Za-z/'.@-]{2,120}$/;
        var card_holder_name_regx = /^((?:[A-Za-z]+ ?){1,3})$/;
        if (!(card_holder_name.match(card_holder_name_regx))) {
            swal("Warning!", 'Please enter valid card holder name', "warning");
            return false;
        }
        var is_default = '';
        is_defalut_card = document.getElementById('is_defalut_card');
        if (is_defalut_card.checked) {
            is_default = 1;
        } else {
            is_default = 0;
        }
        $('#add_card_btn').addClass('disabled');
        $("#loader").fadeIn(500);
        $.ajax({
            type: "POST",
            url: "{{ route('customer.card.add') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cvv": cvv,
                "expiry_date": card_exp_mnth + '/' + card_exp_year,
                "card_number": card_number,
                "card_holder_name": card_holder_name,
                "is_default": is_default,
                "card_type": card_type

            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status == 'success') {
                    $('#iframeSubmitForm').attr('src',res.redirect_url);
                    swal("Success!", "New card added successfully", "success");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);

                } else {
                    $("#loader").fadeOut(500);
                    $('#add_card_btn').removeClass('disabled');
                    swal("Error!", "Some internal error occured", "error");
                    setTimeout(function() {
                         location.reload();
                    }, 3000);
                }
            },
            error: function(response) {
                console.log(response);
                $('#add_card_btn').removeClass('disabled');
                swal("Error!", "Some internal error occured", "error");
                $("#loader").fadeOut(500);
                setTimeout(function() {
                    location.reload();
                }, 3000);
            }
        });
    }


        // Web payment
        function payment() {
            var promocode_value = document.getElementById("input1");
            var promocode = promocode_value.value;
            payment_method_id = $('input[name="payment_method_id"]:checked').val();
            let pay_amount = $('#pay_amount_value').val();
            let plan = $('input[name="a"]:checked').val();
            let discount = "0.00";
            let voucher_id = null;
            let unique_voucher_id = null;
            is_voucher_applied = $('input[name="check_voucher"]').is(":checked");
            var credits = [];
            var sequence = '';
            // var processing_fee = processing_fee;
            var amount = '';
            var future_date = '';
            var jsonData = {};
            if (is_voucher_applied || promocode != '') {
                voucher_id = $('#voucher_id_value').val();
                unique_voucher_id = $('#voucher_unique_id_value').val();
                discount = $('#discount_amount').val();
            }
            if (plan == 1) {

                jsonData['sequence'] = 1;
                // jsonData['processing_fee'] = '0.00';
                jsonData['amount'] = instAmounts[0];
                jsonData['future_date'] = $('#first1_date').val();
                credits.push(jsonData);
            }

            if (plan == 2) {
                for (var i = 0; i < plan; i++) {
                    jsonData['sequence'] = (i + 1);
                    // jsonData['processing_fee'] = '0.00';
                    jsonData['amount'] = instAmounts[i];
                    let date_details = '#' + 'second' + (i + 1) + '_date';
                    jsonData['future_date'] = $(date_details).val();
                    credits.push(jsonData);
                    jsonData = {};
                }
            }

            if (plan == 3) {
                for (var i = 0; i < plan; i++) {
                    jsonData['sequence'] = (i + 1);
                    // jsonData['processing_fee'] = '0.00';
                    jsonData['amount'] = instAmounts[i];
                    let date_details = '#' + 'third' + (i + 1) + '_date';
                    jsonData['future_date'] = $(date_details).val();
                    credits.push(jsonData);
                    jsonData = {};
                }
            }

            if (plan == 6) {
                for (var i = 0; i < plan; i++) {
                    jsonData['sequence'] = (i + 1);
                    // jsonData['processing_fee'] = '0.00';
                    jsonData['amount'] = instAmounts[i];
                    let date_details = '#' + 'sixth' + (i + 1) + '_date';
                    jsonData['future_date'] = $(date_details).val();
                    credits.push(jsonData);
                    jsonData = {};
                }
            }
            if(isNaN(processing_fee)){
                processing_fee=0.00;
            }
            var dataTemp = {
                'bill_code': bill_code,
                'qrcode_string': qrcode_string,
                'bill_id': bill_id,
                'bill_amount': bill_amount,
                'pay_amount': pay_amount,
                'plan': plan,
                'discount': discount,
                'voucher_id': voucher_id,
                'unique_voucher_id': unique_voucher_id,
                'payment_method_id': payment_method_id,
                "processing_fee": processing_fee,
                'credit': credits,
                "_token": "{{ csrf_token() }}",
            };
            $('#pay_now').addClass('disabled');
            $('#pay_now_btn_modal').addClass('disabled');
            $.ajax({
                type: "post",
                url: "{{ route('customer.pay.bill') }}",
                data: dataTemp,
                // processdata: false,
                success: function(response) {console.log(response);
                    if (response.status == 'success') {
                        if('chargeNowWithOtpUrl' in response.payment_response) window.location.replace(response.payment_response.chargeNowWithOtpUrl);
                    } else {
                        if('message' in response) swal("Error!", response.message, "error");
                        swal("Error!", "Something went wrong please try after some time", "error");
                    }
                },
                error: function(response) {console.log(response);
                    if('message' in response) swal("Error!", response.message, "error");
                    swal("Error!", "Something went wrong please try after some time", "error");
                    // console.log(response);
                }
            });
        }


        var billPaytime = "<?php if ($d['billPaytime'] != '') {
            echo $d['billPaytime'];
        } else {
            echo 0;
        } ?>";
        var billing_stage_id = "<?php if (!empty($d['bill_details'])) {
            echo $d['bill_details']['billing_stage_id'];
        } else {
            echo '';
        } ?>";
        var bill_code = "<?php if (!empty($d['bill_details'])) {
            echo $d['bill_details']['bill_code'];
        } else {
            echo '';
        } ?>";
        var qrcode_string = "<?php if (!empty($d['bill_details'])) {
            echo $d['bill_details']['qrcode_string'];
        } else {
            echo '';
        } ?>";
        var qr_image = "<?php if (!empty($d['bill_details'])) {
            echo $d['bill_details']['qr_image'];
        } else {
            echo '';
        } ?>";
        if ($("#bill_qr_image").length) {
            // var qrcode = new QRCode(document.getElementById("bill_qr_image"), {
            //     text: qrcode_string,
            //     width: 131,
            //     height: 131,
            //     correctLevel: QRCode.CorrectLevel.H
            // });
            @php
            $client = new \GuzzleHttp\Client();
            $asseturl = env('INT_HOST') . 'api/v1/web/get-sysconfig-by-key';
            $response = $client->request('POST', $asseturl, [
                'headers' => [
                    'Accept' => 'application/json',
                    'API-KEY' => env('WEB_API_KEY')
                ],
                'form_params' => [
                    'key'=> 'platform.qrcode.image.url'
                ]
            ]);
            $res = $response->getBody();

            $asset = json_decode($response->getBody(), true);
            $qr_logo = $asset['data']['value'] ?? '';
            @endphp
            const qrCode = new QRCodeStyling({
                width: 131,
                height: 131,
                type: "svg",
                data: qrcode_string,
                image: '{{$qr_logo}}',
                dotsOptions: {
                    color: "#4d4d4d",
                    type: "dots"
                },
                imageOptions: {
                    crossOrigin: "anonymous",
                    hideBackgroundDots:false
                },
                margin:0,
                qrOptions:{"typeNumber":"0","mode":"Byte","errorCorrectionLevel":"Q"},
                cornersDotOptions:{"type":"square","color": "#000"},
                cornersSquareOptions:{"type":"extra-rounded","color": "#000"},
            });

            qrCode.append(document.getElementById("bill_qr_image"));
            // console.log(qr_image);
        }


        // Checking billing stages
        var base_url = window.location.origin;
        localStorage.setItem("bill_code", bill_code);
        if (billing_stage_id == 1) {
            if (billPaytime < 600) {
                window.onload = function() {
                    // var timecal = 60 * (10 - billPaytime);
                    var timecal = 600 - billPaytime;
                    // console.log('billPaytime' + billPaytime);
                    // console.log('timecal' + timecal);
                    display = document.querySelector('#time');
                    startTimer(timecal, display);
                };

                if (bill_code != '') {
                    var intervalId = window.setInterval(function() {
                        $.ajax({
                            type: "post",
                            url: base_url + '/get-bill-details',
                            data: {
                                'bill_code': bill_code,
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                if (response.billStatus != null) {
                                    if (response.billStatus.billing_stage_id != billing_stage_id) {
                                        if (response.billStatus.billing_stage_id == 8 || response
                                            .billStatus
                                            .billing_stage_id == 2) {
                                            if(response.billStatus.callback_status == '1' && (response.billStatus.callback_url.includes('wc-api') || response.billStatus.callback_url.includes('shopify') || response.billStatus.callback_url.includes('route=payment/airapay/callback_ipn')) && response.callback_res.redirect == true){
                                                if(response.billStatus.callback_url.includes('shopify'))
                                                    window.location.replace(response.billStatus.return_url);
                                                else if (typeof response.callback_res.url !== 'undefined')
                                                    window.location.replace(response.callback_res.url)
                                            }
                                            // var return_url = response.billStatus.return_url;
                                            // if (return_url.indexOf('?') > -1) {
                                            //     var redirect_url = return_url +
                                            //         '&transactionStatus=2&transactionType=1&billStatus=1&ref='+response.billStatus.merchant_ref+'&billCode=' +
                                            //         bill_code;
                                            // } else {
                                            //     var redirect_url = return_url +
                                            //         '?transactionStatus=2&transactionType=1&billStatus=1&ref='+response.billStatus.merchant_ref+'&billCode=' +
                                            //         bill_code;
                                            // }
                                            // if (return_url != '') {
                                            //     if (!isRedirected) {
                                            //         isRedirected = true;
                                            //         window.location.replace(redirect_url);
                                            //     }
                                            // }
                                        } else if (response.billStatus.billing_stage_id != 1) {
                                            if(response.billStatus.callback_status == '1' && (response.billStatus.callback_url.includes('wc-api') || response.billStatus.callback_url.includes('shopify') || response.billStatus.callback_url.includes('route=payment/airapay/callback_ipn')) && response.callback_res.redirect == false){
                                                if(response.billStatus.callback_url.includes('shopify'))
                                                    window.location.replace(response.billStatus.return_url);
                                                    else if (response.callback_res.url !== 'undefined')
                                                    window.location.replace(response.callback_res.url)
                                            }
                                            // var return_url = response.billStatus.return_url;
                                            // if (return_url.indexOf('?') > -1) {
                                            //     var redirect_url = return_url +
                                            //         '&transactionStatus=1&transactionType=1&billStatus=2&ref='+response.billStatus.merchant_ref+'&billCode=' +
                                            //         bill_code;
                                            // } else {
                                            //     var redirect_url = return_url +
                                            //         '?transactionStatus=1&transactionType=1&billStatus=2&ref='+response.billStatus.merchant_ref+'&billCode=' +
                                            //         bill_code;
                                            // }
                                            // if (!isRedirected) {
                                            //     isRedirected = true;
                                            //     window.location.replace(redirect_url);
                                            // }
                                        } else {
                                            if ($('#time').html() == '00:00') {
                                                var return_url = response.billStatus.return_url;
                                                if (return_url.indexOf('?') > -1) {
                                                    var redirect_url = return_url +
                                                        '&transactionStatus=1&transactionType=1&billStatus=2&ref='+response.billStatus.merchant_ref+'&billCode=' +
                                                        bill_code;
                                                } else {
                                                    var redirect_url = return_url +
                                                        '?transactionStatus=1&transactionType=1&billStatus=2&ref='+response.billStatus.merchant_ref+'&billCode=' +
                                                        bill_code;
                                                }
                                                clearInterval(intervalId);
                                                if (!isCancelBillApiCalled) {
                                                    isCancelBillApiCalled = true;
                                                    cancelBill(bill_code, redirect_url);
                                                }
                                            }
                                        }
                                    } else {
                                        if ($('#time').html() == '00:00') {
                                            var return_url = response.billStatus.return_url;
                                            if (return_url.indexOf('?') > -1) {
                                                var redirect_url = return_url +
                                                    '&transactionStatus=1&transactionType=1&billCode=' +
                                                    bill_code;
                                            } else {
                                                var redirect_url = return_url +
                                                    '?transactionStatus=1&transactionType=1&billCode=' +
                                                    bill_code;
                                            }
                                            clearInterval(intervalId);

                                            if (!isCancelBillApiCalled) {
                                                isCancelBillApiCalled = true;
                                                cancelBill(bill_code, redirect_url);
                                            }
                                        }
                                    }
                                }
                            },
                            error: function(response) {
                                // console.log(response);
                                swal("Error!", "Some went wrong. Please try after sometime!", "error");
                            }
                        });
                    }, 5000);
                } else {
                    swal("Error!", "Some went wrong. Please try after sometime!", "error");
                }

            }
        }
        //set interval to check status
        window.setInterval(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('payment_redirect_check') }}",
                data: {
                    'bill_code': bill_code,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if(response.status == true){
                        let redirect_url = "{{ route('payment_redirect_status_page') }}";
                        window.location.replace(redirect_url+'?q='+response.data);
                    }
                }
                ,error: function(data) {
                    console.log(data);
                }
            });
        }, 5000);

        // Timer function
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    // timer = duration;
                    $('#time').html('00:00');
                    clearTimeout();
                }
            }, 1000);
        }

        // Cancel bill
        // Cancel bill
        function cancelBill(billcode, redirect_url) {
            Swal.fire({
                title: 'Do you really want to cancel the payment?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
            }).then((result) => {
                _old_val_isRedirected = isRedirected;
                if (result.isConfirmed) {
                    isRedirected = false;
                    $.ajax({
                        type: "post",
                        url: base_url + '/cancel-bill',
                        data: {
                            'bill_code': bill_code,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                if(return_shopify_url != 'null' && return_shopify_url != '') window.location.replace(return_shopify_url);
                                if (!isRedirected) {
                                    isRedirected = true;
                                    window.location.replace(redirect_url);
                                }
                                isRedirected = _old_val_isRedirected;
                            } else {isRedirected = _old_val_isRedirected;
                                swal("Error!", "Some went wrong. Please try after sometime!", "error");
                            }
                        },
                        error: function(response) {isRedirected = _old_val_isRedirected;
                            swal("Error!", "Some went wrong. Please try after sometime!", "error");
                            if (!isRedirected) {
                                isRedirected = true;
                                window.location.replace(redirect_url);
                            }
                        }
                    });
                } else if (result.isDenied) {isRedirected = _old_val_isRedirected;
                    console.log('denied')
                }
            });

        }


        // Pay now modal show if user choose to pay later and call payment
        function paynow(payment_from) {
            $("#pay_now_warning").show();
            var sequence = $("input[name='a']:checked").val();
            if (sequence != '1') {
                if (payment_from == 'from_page') {
                    $("#spendResponsibly").modal('show');

                } else {

                    $("#spendResponsibly").modal('hide');
                    // Call to payment api
                    payment();
                }

            } else {
                payment();
            }
        }


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                evt.keyCode = 8;
                return false;
            }

            return true;
        }

        function all_vouchers() {
            $.ajax({
                type: "post",
                url: base_url + '/get-platform-vouchers',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "bill_amount": bill_amount,
                    'merchant_code': merchant_code
                },
                success: function(response) {
                    if (response != null) {
                        $("#platform_voucher_div").html('');
                        $("#platform_voucher_div").append('Platform Vouchers');
                        $("#store_vouchers_div").html('');
                        $("#store_vouchers_div").append('Store Vouchers');
                        const data = JSON.parse(response);
                        let platform_vouchers = null;
                        if (data.platform_voucher != null) {
                            platform_vouchers = data.platform_voucher;
                        }
                        let voucher_list = '';
                        if (platform_vouchers != null) {
                            for (i = 0; i < platform_vouchers.length; i++) {
                                let off_percentange = 0;
                                let final_voucher_off_data = '';
                                let amount = 0;
                                let min_purchase_amount = 0;
                                let end_date = '';
                                let terms_and_conditions = '';
                                let discount_amount_of_voucher = 0;
                                let disabled_class = '';
                                let count = 0;
                                let checked = '';
                                if (platform_vouchers[i].percentage != null) {
                                    off_percentange = platform_vouchers[i].percentage
                                    final_voucher_off_data = off_percentange + " % Off";
                                    discount_amount_of_voucher = platform_vouchers[i]
                                        .discount_capped_amount;
                                }
                                if (off_percentange == 0) {
                                    if (platform_vouchers[i].amount != null)
                                        amount = platform_vouchers[i].amount
                                    final_voucher_off_data = "RM " + amount + " Off";
                                    discount_amount_of_voucher = amount;
                                }
                                if (platform_vouchers[i].min_purchase_amount != null)
                                    min_purchase_amount = platform_vouchers[i].min_purchase_amount
                                if (platform_vouchers[i].get_voucher_reusable != null)
                                    end_date = String(platform_vouchers[i].get_voucher_reusable.endDate)
                                if (platform_vouchers[i].terms_and_conditions != null)
                                    terms_and_conditions = platform_vouchers[i].terms_and_conditions
                                    let str = terms_and_conditions;
                                    let res = str.replace("'", "’");
                                let platform_voucher_id = platform_vouchers[i].id
                                voucher_id = $('#voucher_id_value').val();
                                if (platform_voucher_id == voucher_id) {
                                    checked = 'checked';
                                } else {
                                    checked = '';
                                }

                                if ((parseInt(min_purchase_amount) > parseInt(bill_amount)) || (
                                        parseInt(bill_amount) <= parseInt(discount_amount_of_voucher)) || (platform_vouchers[i].disable == "true")) {
                                            disabled_class = 'disabled';
                                }
                                voucher_list = $(`<div class="coupon ${disabled_class}" id="platformVoucher">
                        <div class="card flex-row p-0 align-items-center">
                        <div class="coupon-logo store-coupon">
                                <img src="{{ Session::get('ASSET_URL') }}/platform/logo/voucher.svg" alt="" style="height: 88px; width: 88px; border-radius: 6px 0 0 6px;">
                            </div>
                            <div class="card-inner w-100">
                                <div class="row align-items-center m-0">
                                    <div class="col-9 p-0">
                                        <div class="size-14 font-700 primary-text">
                                            <span>
                                                <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9 1.33334V2.66668M9 5.33334V6.66668M9 9.33334V10.6667M2.33333 1.33334C1.97971 1.33334 1.64057 1.47382 1.39052 1.72387C1.14048 1.97392 1 2.31305 1 2.66668V4.66668C1.35362 4.66668 1.69276 4.80715 1.94281 5.0572C2.19286 5.30725 2.33333 5.64639 2.33333 6.00001C2.33333 6.35363 2.19286 6.69277 1.94281 6.94282C1.69276 7.19287 1.35362 7.33334 1 7.33334V9.33334C1 9.68697 1.14048 10.0261 1.39052 10.2762C1.64057 10.5262 1.97971 10.6667 2.33333 10.6667H11.6667C12.0203 10.6667 12.3594 10.5262 12.6095 10.2762C12.8595 10.0261 13 9.68697 13 9.33334V7.33334C12.6464 7.33334 12.3072 7.19287 12.0572 6.94282C11.8071 6.69277 11.6667 6.35363 11.6667 6.00001C11.6667 5.64639 11.8071 5.30725 12.0572 5.0572C12.3072 4.80715 12.6464 4.66668 13 4.66668V2.66668C13 2.31305 12.8595 1.97392 12.6095 1.72387C12.3594 1.47382 12.0203 1.33334 11.6667 1.33334H2.33333Z"
                                                        stroke="{{ $color_code_600 }}" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>${final_voucher_off_data}
                                        </div>
                                        <div class="size-12">Minimum Spend RM ${min_purchase_amount}.</div>
                                        <div class="size-12">Valid until ${end_date}</div>
                                        <div class="size-12 primary-color font-600"><a onclick="result_t_c('${res}')" > T&C </a></div>
                                    </div>
                                    <div class="col-3 p-0">
                                        <div class="text-center">

                                            <div class="container">
                                                <div class="round">
                                                    <input type="checkbox" name="check_voucher" onclick="onlyOne(this)"
                                                        id="checkbox${platform_voucher_id}" value="${platform_voucher_id}" voucher_amount ="${parseFloat(discount_amount_of_voucher)}"
                                                        ${checked}/>
                                                    <label for="checkbox${platform_voucher_id}"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical_dotted_line"></div>
                            <div class="circle-1"></div>
                            <div class="circle-2"></div>
                        </div>
                    </div>`);
                            $("#platform_voucher_div").append(voucher_list);
                        }
                    }

                    let store_vouchers = null;
                    if (data.shop_voucher != null) {
                        store_vouchers = data.shop_voucher;
                    }
                    let merchant_voucher_list = '';
                    if (store_vouchers != null) {
                        for (i = 0; i < store_vouchers.length; i++) {
                            let off_percentange = 0;
                            let final_voucher_off_data = '';
                            let amount = 0;
                            let min_purchase_amount = 0;
                            let end_date = '';
                            let terms_and_conditions = '';
                            let discount_amount_of_voucher = 0;
                            let disabled_class = '';
                            let checked = '';

                            if (store_vouchers[i].percentage != null) {
                                off_percentange = store_vouchers[i].percentage;
                                final_voucher_off_data = off_percentange + " % Off";
                                discount_amount_of_voucher = store_vouchers[i]
                                    .discount_capped_amount;
                            }
                            if (off_percentange == 0) {
                                if (store_vouchers[i].amount != null)
                                    amount = store_vouchers[i].amount;
                                final_voucher_off_data = "RM " + amount + " Off";
                                discount_amount_of_voucher = amount;
                            }
                            if (store_vouchers[i].min_purchase_amount != null)
                                min_purchase_amount = store_vouchers[i].min_purchase_amount
                            if (store_vouchers[i].get_voucher_reusable != null)
                                end_date = String(store_vouchers[i].get_voucher_reusable
                                    .endDate)
                            if (store_vouchers[i].terms_and_conditions != null)
                                terms_and_conditions = store_vouchers[i].terms_and_conditions
                            let store_voucher_id = store_vouchers[i].id;
                            voucher_id = $('#voucher_id_value').val();
                            if (store_voucher_id == voucher_id) {
                                checked = 'checked';
                            } else {
                                checked = '';
                            }

                            if ((parseInt(min_purchase_amount) > parseInt(bill_amount)) || (
                                    parseInt(bill_amount) <= parseInt(discount_amount_of_voucher)
                                ) || (store_vouchers[i].disable == "true")) {
                                disabled_class = 'disabled';
                            }
                            store_voucher_list = $(`<div class="coupon ${disabled_class}" id="storeVoucher">
                        <div class="card flex-row p-0 align-items-center">
                            <div class="coupon-logo store-coupon">
                            <img class="" src="${store_vouchers[i].logo}" alt="" style="height: 88px; width: 92px; border-radius: 6px 0 0 6px;">
                            </div>
                            <div class="card-inner w-100">
                                <div class="row align-items-center m-0">
                                    <div class="col-9 p-0">
                                        <div class="size-14 font-700 primary-text">
                                            <span>
                                                <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9 1.33334V2.66668M9 5.33334V6.66668M9 9.33334V10.6667M2.33333 1.33334C1.97971 1.33334 1.64057 1.47382 1.39052 1.72387C1.14048 1.97392 1 2.31305 1 2.66668V4.66668C1.35362 4.66668 1.69276 4.80715 1.94281 5.0572C2.19286 5.30725 2.33333 5.64639 2.33333 6.00001C2.33333 6.35363 2.19286 6.69277 1.94281 6.94282C1.69276 7.19287 1.35362 7.33334 1 7.33334V9.33334C1 9.68697 1.14048 10.0261 1.39052 10.2762C1.64057 10.5262 1.97971 10.6667 2.33333 10.6667H11.6667C12.0203 10.6667 12.3594 10.5262 12.6095 10.2762C12.8595 10.0261 13 9.68697 13 9.33334V7.33334C12.6464 7.33334 12.3072 7.19287 12.0572 6.94282C11.8071 6.69277 11.6667 6.35363 11.6667 6.00001C11.6667 5.64639 11.8071 5.30725 12.0572 5.0572C12.3072 4.80715 12.6464 4.66668 13 4.66668V2.66668C13 2.31305 12.8595 1.97392 12.6095 1.72387C12.3594 1.47382 12.0203 1.33334 11.6667 1.33334H2.33333Z"
                                                        stroke="{{ $color_code_600 }}" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>${final_voucher_off_data}
                                        </div>
                                        <div class="size-12">Minimum Spend RM ${min_purchase_amount}.</div>
                                        <div class="size-12">Valid until ${end_date}</div>
                                        <div class="size-12 primary-color font-600"><a onclick="result_t_c('${terms_and_conditions}')" > T&C </a></div>
                                    </div>
                                    <div class="col-3 p-0">
                                        <div class="text-center">
                                            <div class="container">
                                                <div class="round">
                                                    <input type="checkbox" name="check_voucher" onclick="onlyOne(this)"
                                                        id="store_checkbox${store_voucher_id}" value="${store_voucher_id}" voucher_amount ="${parseFloat(discount_amount_of_voucher)}" ${checked}/>
                                                    <label for="store_checkbox${store_voucher_id}"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical_dotted_line"></div>
                            <div class="circle-1"></div>
                            <div class="circle-2"></div>
                        </div>
                    </div>`);
                            $("#store_vouchers_div").append(store_voucher_list);
                        }
                    }

                }
            },
            error: function(response) {
                $("#platform_voucher_div").html('');
                $("#platform_voucher_div").append('Platform Vouchers');
                $("#store_vouchers_div").html('');
                $("#store_vouchers_div").append('Store Vouchers');
            }
            });
        }

    // Getting platform vouchers and stored vouchers
    $(document).ready(function() {
        $('.passcode').bind("cut copy paste drag drop", function(e) {
                e.preventDefault();
            });
            $('.passcode').keydown( function(e){
                if ($(this).val().length >= 1) {
                    $(this).val($(this).val().substr(0, 1));
                }
            });

            $('.passcode').keyup( function(e){
                if ($(this).val().length >= 1) {
                    $(this).val($(this).val().substr(0, 1));
                }
            });
        payment_calculations();
        all_vouchers();
    });


        // Change selected card
       function changeDefaultCard(card_details, card_type) {
        $('#selected_card').html(card_details);
        var visa_card_image = "{{ asset('laravel_assets/card/visa.svg') }}";
        var master_card_image = "{{ asset('laravel_assets/card/mastercard.svg') }}";
        var american_express_card_image = "{{ asset('laravel_assets/card/American-Express.jpg') }}";
        var discover_card_image = "{{ asset('laravel_assets/card/discover.png') }}";
        var diners_card_image = "{{ asset('laravel_assets/card/diners.jpeg') }}";
        var diners_cb_card_image = "{{ asset('laravel_assets/card/Diners.jpeg') }}";
        var jcb_card_image = "{{ asset('laravel_assets/card/jcb.png') }}";
        var visa_electron_card_image = "{{ asset('laravel_assets/card/visa-electron.png') }}";
        var other_card_image="{{ asset('laravel_assets/card/other_card.png') }}";

        if (card_type == 'Visa') {
            $("img#card_image").attr('src', visa_card_image);
        } else if (card_type == 'Master') {
            $("img#card_image").attr('src', master_card_image);
        } else if (card_type == 'AmericanExpress') {
            $("img#card_image").attr('src', american_express_card_image);
        } else if (card_type == 'Discover') {
            $("img#card_image").attr('src', discover_card_image);
        } else if (card_type == 'Diners') {
            $("img#card_image").attr('src', diners_card_image);
        } else if (card_type == 'Diners - Carte Blanche') {
            $("img#card_image").attr('src', diners_cb_card_image);
        } else if (card_type == 'Jcb') {
            $("img#card_image").attr('src', jcb_card_image);
        } else if (card_type == 'Visa Electron') {
            $("img#card_image").attr('src', visa_electron_card_image);
        } else {
            $("img#card_image").attr('src', other_card_image);
        }
    }

         // Terms and conditions view
        function result_t_c(terms_and_conditions) {
        $("#show_t_c").html('');
            if (terms_and_conditions != undefined) {
                $("#modal_T_C").modal('show');
                $("#show_t_c").html(terms_and_conditions);
            } else {
                $("#modal_T_C").modal('hide');
            }
    }
        // function changeDefaultCard(card_details) {
        //     $('#selected_card').html(card_details);
        // }
    </script>
@endif

</html>
