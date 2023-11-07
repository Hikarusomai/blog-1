<!doctype html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.min.css"
        integrity="sha512-aB3UdGCt+QZdSlPCgDsJBJ+JytRb8oq/cdMEpLTaypINSyom0h5vcw2HsF1m0eZtWsetJllPtQOfCPM9UrdKYw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @include('includes.head-dashboard')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <title>Edit Business</title>

    <style>
        .input-images-1 .image-uploader {
            min-height: 5rem !important;
        }

        .input-images-2 .image-uploader {
            min-height: 5rem !important;
        }
    </style>

</head>

<body>


    @include('includes.header-dashboard')

    <section>

        @include('includes.service-provider-sidebar-dashboard')

        <div class="col-lg-9">
            @include('includes.service-provider-business-title')




            <form class="needs-validation myprofile-form" action="{{ route('business-profiles-update') }}" method="POST"
                enctype="multipart/form-data">

                <section class="main-sec fmy-right">
                    <div class="container my-5 custom-rounded bg-white p-2 p-lg-5">




                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="business-dashboard-section">




                                    @include('includes.service-provider-edit-business-menu')



                                    <div class="tab-content dashboard_tabcont">




                                        <!--dt-->

                                        <div id="dt_menu6">
                                            @if (array_sum($data['viewCountsByMonths']) == 0)
                                                <div class="alert alert-success">No data</div>
                                            @else
                                                <div class="ant-titl">
                                                    <div class="container-fluid p-0 m-0">
                                                        <div class="row align-items-center ">
                                                            <div class="col-lg-6">
                                                                <h3 class="bsc d-flex align-items-center">Premium</h3>


                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="upld">
                                                                    <a href="{{ route('edit-business-profile-subscriptions', $data['business_id']) }}"
                                                                        class="ud">Update Plan</a>
                                                                    <a href="#" class="ud-img"><img
                                                                            src="assets/images/add.png"
                                                                            alt=""></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <ul class="nav nav-tabs dashboard_tabs tbs-1">
                                                    <li class="active bc1"><a data-toggle="tab" href="#an_1">Views</a>
                                                    </li>
                                                    <!--<li class="bc2"><a data-toggle="tab" href="#an_2">Clicks</a></li>-->
                                                    <li class="bc3"><a data-toggle="tab" href="#an_3">Website
                                                            Clicks</a></li>
                                                    <li class="bc4"><a data-toggle="tab" href="#an_4">Reviews</a>
                                                    </li>
                                                </ul>

                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <div class="tab-content dashboard_tabcont">
                                                                <div id="an_1"
                                                                    class="tab-pane fade in active show">

                                                                    <div class="row">
                                                                        <div class="col-lg-2  col-sm-2 p-0">
                                                                            <div class="lft-tb p-3">
                                                                                <ul
                                                                                    class="nav nav-tabs dashboard_tabs tbs-1 left-tab">
                                                                                    <li class="active"><a
                                                                                            data-toggle="tab"
                                                                                            href="#aa_1">Daily</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#aa_2">Weekly</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#aa_3">Monthly</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-10 col-sm-12"
                                                                            style="padding-left: 5px !important;padding-right: 5px !important;">
                                                                            <div class="tab-content dashboard_tabcont">
                                                                                <div id="aa_1"
                                                                                    class="tab-pane fade in active show">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart"
                                                                                            style="min-height: 220px;width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="aa_2"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChartp1"
                                                                                            style="min-height: 220px; width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="aa_3"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChartp2"
                                                                                            style="min-height: 220px; width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div id="an_2" class="tab-pane fade">


                                                                    <div class="row">
                                                                        <div class="col-lg-2 p-0">
                                                                            <div class="lft-tb p-3">
                                                                                <ul
                                                                                    class="nav nav-tabs dashboard_tabs tbs-1 left-tab">
                                                                                    <li class="active"><a
                                                                                            data-toggle="tab"
                                                                                            href="#ap_1">Daily</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#ap_2">Weekly</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#ap_3">Monthly</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-10">
                                                                            <div class="tab-content dashboard_tabcont">
                                                                                <div id="ap_1"
                                                                                    class="tab-pane fade in active show">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart-2c"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="ap_2"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChartp-3c"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="ap_3"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart-4c"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div id="an_3" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 p-0">
                                                                            <div class="lft-tb p-3">
                                                                                <ul
                                                                                    class="nav nav-tabs dashboard_tabs tbs-1 left-tab">
                                                                                    <li class="active"><a
                                                                                            data-toggle="tab"
                                                                                            href="#ad_1">Daily</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#ad_2">Weekly</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#ad_3">Monthly</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-10">
                                                                            <div class="tab-content dashboard_tabcont">
                                                                                <div id="ad_1"
                                                                                    class="tab-pane fade in active show">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart-2w"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="ad_2"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart_3w"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="ad_3"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart-4w"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div id="an_4" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 p-0">
                                                                            <div class="lft-tb p-3">
                                                                                <ul
                                                                                    class="nav nav-tabs dashboard_tabs tbs-1 left-tab">
                                                                                    <li class="active"><a
                                                                                            data-toggle="tab"
                                                                                            href="#ae_1">Daily</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#ae_2">Weekly</a>
                                                                                    </li>
                                                                                    <li class=""><a
                                                                                            data-toggle="tab"
                                                                                            href="#ae_3">Monthly</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-10">
                                                                            <div class="tab-content dashboard_tabcont">
                                                                                <div id="ae_1"
                                                                                    class="tab-pane fade in active show">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart-2r"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="ae_2"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart-3r"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="ae_3"
                                                                                    class="tab-pane fade in">
                                                                                    <div class="chartbox">
                                                                                        <canvas id="myChart-4r"
                                                                                            style="width:100%;max-width:600px"></canvas>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="lft-tb">
                                                                <ul
                                                                    class="nav nav-tabs dashboard_tabs left-tab d-block">
                                                                    <li class="active cc1"><a data-toggle="tab"
                                                                            class="cc1"href="#at_1">Views</a></li>
                                                                    <!--<li ><a data-toggle="tab" class="cc2" href="#at_2">Clicks</a></li>-->
                                                                    <li><a data-toggle="tab" class="cc3"
                                                                            href="#at_3">Website Clicks</a></li>
                                                                    <li><a data-toggle="tab" class="cc4"
                                                                            href="#at_4">Reviews</a></li>
                                                                </ul>

                                                                <div class="tab-content dashboard_tabcont">
                                                                    <div id="at_1"
                                                                        class="tab-pane fade in active show">
                                                                        <h3>view Result</h3>
                                                                        <p class="pv"><span class="vews"
                                                                                id="myChart-1-count">0</span>Views</p>

                                                                        <div class="exp-btn text-center">
                                                                            <!--<a class="exp" href="#">-->
                                                                            <!--    Export Data-->
                                                                            <!--</a>-->
                                                                        </div>
                                                                    </div>

                                                                    <div id="at_2" class="tab-pane fade">
                                                                        <h3>Clicks Result</h3>
                                                                        <p class="pv"><span class="vews">
                                                                            </span>Clicks Result</p>

                                                                        <div class="exp-btn text-center">
                                                                            <!--<a class="exp" href="#">-->
                                                                            <!--    Export Data-->
                                                                            <!--</a>-->
                                                                        </div>
                                                                    </div>

                                                                    <div id="at_3" class="tab-pane fade">
                                                                        <h3>Website clicks</h3>
                                                                        <p class="pv"><span class="vews"
                                                                                id="myChart-3-count">0</span>Website
                                                                            Clicks</p>

                                                                        <div class="exp-btn text-center">
                                                                            <!--<a class="exp" href="#">-->
                                                                            <!--    Export Data-->
                                                                            <!--</a>-->
                                                                        </div>
                                                                    </div>

                                                                    <div id="at_4" class="tab-pane fade">
                                                                        <h3>Reviews</h3>
                                                                        <p class="pv"><span class="vews"
                                                                                id="myChart-4-count">0</span>Website
                                                                            Clicks</p>

                                                                        <div class="exp-btn text-center">
                                                                            <!--<a class="exp" href="#">-->
                                                                            <!--    Export Data-->
                                                                            <!--</a>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <!--dt-->
                                            @endif


                                            <!--main content div ends -->

                                        </div>





                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </form>










        </div>

        </div>
        </div>
    </section>










    @include('includes.footer-dashboard')

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

    <!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>-->

    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" -->
        <!--        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        -->
    <!--        crossorigin="anonymous"></script>-->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>



    <script type="text/javascript" src="assets/js/image-uploader.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/js/jquery.prettyPhoto.min.js"
        integrity="sha512-IB7NSySDRedVEsYsOVuzN5O5jwRjV2ewVVmkDFIgE0yNu11GreBCOMv07i7hlQck41T+sTXSL05/cG+De4cZDw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(document).ready(function() {

            $("a[rel^='prettyPhoto']").prettyPhoto();

        });
        var closebtns = document.getElementsByClassName("close");
        var i;

        for (i = 0; i < closebtns.length; i++) {
            closebtns[i].addEventListener("click", function() {
                this.parentElement.parentElement.style.display = 'none';
            });
        }
    </script>
    <script type="text/javascript">
        $('#mobile_tabs').on('change', function(e) {
            $('.tab-pane').removeClass('active in')
            $('#' + $(e.currentTarget).val()).addClass("active in");
        })
    </script>

    <script>
        $(function() {

            // $('.input-images-1').imageUploader({
            //      imagesInputName: 'thumbnail',
            //     preloadedInputName: 'oldthumbnail',
            //     maxFiles:1

            // });

            let preloaded = [{
                    id: 1,
                    src: 'assets/images/g1.png'
                },
                {
                    id: 2,
                    src: 'assets/images/g2.png'
                },
                {
                    id: 3,
                    src: 'assets/images/g3.png'
                },
                {
                    id: 4,
                    src: 'assets/images/g4.png'
                },
                {
                    id: 5,
                    src: 'assets/images/g5.png'
                },
                {
                    id: 6,
                    src: 'assets/images/g6.png'
                },
            ];

            // $('.input-images-2').imageUploader({
            //     //preloaded: preloaded,
            //     imagesInputName: 'gallery',
            //     preloadedInputName: 'oldgallery'
            // });

            // $('form').on('submit', function (event) {

            //     // Stop propagation
            //     event.preventDefault();
            //     event.stopPropagation();

            //     // Get some vars
            //     let $form = $(this),
            //         $modal = $('.modal');

            //     // Set name and description
            //     $modal.find('#display-name span').text($form.find('input[id^="name"]').val());
            //     $modal.find('#display-description span').text($form.find('input[id^="description"]').val());

            //     // Get the input file
            //     let $inputImages = $form.find('input[name^="images"]');
            //     if (!$inputImages.length) {
            //         $inputImages = $form.find('input[name^="photos"]')
            //     }

            //     // Get the new files names
            //     let $fileNames = $('<ul>');
            //     for (let file of $inputImages.prop('files')) {
            //         $('<li>', {text: file.name}).appendTo($fileNames);
            //     }

            //     // Set the new files names
            //     $modal.find('#display-new-images').html($fileNames.html());

            //     // Get the preloaded inputs
            //     let $inputPreloaded = $form.find('input[name^="old"]');
            //     if ($inputPreloaded.length) {

            //         // Get the ids
            //         let $preloadedIds = $('<ul>');
            //         for (let iP of $inputPreloaded) {
            //             $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
            //         }

            //         // Show the preloadede info and set the list of ids
            //         $modal.find('#display-preloaded-images').show().html($preloadedIds.html());

            //     } else {

            //         // Hide the preloaded info
            //         $modal.find('#display-preloaded-images').hide();

            //     }

            //     // Show the modal
            //     $modal.css('visibility', 'visible');
            //     return true;
            // });

            // Input and label handler
            $('input').on('focus', function() {
                $(this).parent().find('label').addClass('active')
            }).on('blur', function() {
                if ($(this).val() == '') {
                    $(this).parent().find('label').removeClass('active');
                }
            });

            // Sticky menu
            let $nav = $('nav'),
                $header = $('header'),
                offset = 4 * parseFloat($('body').css('font-size')),
                scrollTop = $(this).scrollTop();

            // Initial verification
            setNav();

            // Bind scroll
            $(window).on('scroll', function() {
                scrollTop = $(this).scrollTop();
                // Update nav
                setNav();
            });

            function setNav() {
                if (scrollTop > $header.outerHeight()) {
                    $nav.css({
                        position: 'fixed',
                        'top': offset
                    });
                } else {
                    $nav.css({
                        position: '',
                        'top': ''
                    });
                }
            }
            // jQuery('.lu_upload').on('click',function(){
            // jQuery('.input-images-1 input[type="file"]').trigger('click');

            // });
            // jQuery('.ru_upload').on('click',function(){
            // jQuery('.input-images-2 input').trigger('click');

            // });


        });
    </script>




    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $(".alert-auto-hide").fadeOut("slow");
            }, 3000); // 3 secs

        });
    </script>





    <script type="text/javascript" charset="utf-8">
        function getval(sel) {
            //alert(sel.value);
            jQuery('input.inp-feild.am').val(sel.value)
            //var am = document.querySelector('.checkVal').value;
            //console.log('am',am);
            //document.querySelector('.am').innerHTML = am;

        }
    </script>

    <script>
        var closebtns = document.getElementsByClassName("close");
        var i;

        for (i = 0; i < closebtns.length; i++) {
            closebtns[i].addEventListener("click", function() {
                this.parentElement.parentElement.style.display = 'none';
            });
        }


        $('#mobile_tabs').on('change', function(e) {
            $('.tab-pane').removeClass('active in')
            $('#' + $(e.currentTarget).val()).addClass("active in");
        })


        $(function() {

            // $('.input-images-1').imageUploader();

            // let preloaded = [
            //     {id: 1, src: 'assets/images/g1.png'},
            //     {id: 2, src: 'assets/images/g2.png'},
            //     {id: 3, src: 'assets/images/g3.png'},
            //     {id: 4, src: 'assets/images/g4.png'},
            //     {id: 5, src: 'assets/images/g5.png'},
            //     {id: 6, src: 'assets/images/g6.png'},
            // ];

            // $('.input-images-2').imageUploader({
            //     //preloaded: preloaded,
            //     imagesInputName: 'photos',
            //     preloadedInputName: 'old'
            // });

            // $('form').on('submit', function (event) {

            //     // Stop propagation
            //     event.preventDefault();
            //     event.stopPropagation();

            //     // Get some vars
            //     let $form = $(this),
            //         $modal = $('.modal');

            //     // Set name and description
            //     $modal.find('#display-name span').text($form.find('input[id^="name"]').val());
            //     $modal.find('#display-description span').text($form.find('input[id^="description"]').val());

            //     // Get the input file
            //     let $inputImages = $form.find('input[name^="images"]');
            //     if (!$inputImages.length) {
            //         $inputImages = $form.find('input[name^="photos"]')
            //     }

            //     // Get the new files names
            //     let $fileNames = $('<ul>');
            //     for (let file of $inputImages.prop('files')) {
            //         $('<li>', {text: file.name}).appendTo($fileNames);
            //     }

            //     // Set the new files names
            //     $modal.find('#display-new-images').html($fileNames.html());

            //     // Get the preloaded inputs
            //     let $inputPreloaded = $form.find('input[name^="old"]');
            //     if ($inputPreloaded.length) {

            //         // Get the ids
            //         let $preloadedIds = $('<ul>');
            //         for (let iP of $inputPreloaded) {
            //             $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
            //         }

            //         // Show the preloadede info and set the list of ids
            //         $modal.find('#display-preloaded-images').show().html($preloadedIds.html());

            //     } else {

            //         // Hide the preloaded info
            //         $modal.find('#display-preloaded-images').hide();

            //     }

            //     // Show the modal
            //     $modal.css('visibility', 'visible');
            // });

            // Input and label handler
            $('input').on('focus', function() {
                $(this).parent().find('label').addClass('active')
            }).on('blur', function() {
                if ($(this).val() == '') {
                    $(this).parent().find('label').removeClass('active');
                }
            });

            // Sticky menu
            let $nav = $('nav'),
                $header = $('header'),
                offset = 4 * parseFloat($('body').css('font-size')),
                scrollTop = $(this).scrollTop();

            // Initial verification
            setNav();

            // Bind scroll
            $(window).on('scroll', function() {
                scrollTop = $(this).scrollTop();
                // Update nav
                setNav();
            });

            function setNav() {
                if (scrollTop > $header.outerHeight()) {
                    $nav.css({
                        position: 'fixed',
                        'top': offset
                    });
                } else {
                    $nav.css({
                        position: '',
                        'top': ''
                    });
                }
            }
            jQuery('.lu_upload').on('click', function() {
                jQuery('.input-images-1 input').trigger('click');

            });
            jQuery('.ru_upload').on('click', function() {
                jQuery('.input-images-2 input').trigger('click');

            });


        });
    </script>



    <script>
        var viewsDaily = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayDaily'][$i - 1];
                echo '",';
            }
        @endphp];
        var viewsDailyLabel = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayDailyLabel'][$i - 1];
                echo '",';
            }
        @endphp];
        var viewsWeekly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayWeekly'][$i - 1];
                echo '",';
            }
        @endphp];
        var viewsWeeklyLabel = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayWeeklyLabel'][$i - 1];
                echo '",';
            }
        @endphp];
        var viewsMonthly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['viewCountsByMonths'][$i - 1];
                echo '",';
            }
        @endphp];
        var viewsMonthlyLabel = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['monthAndYearLabels'][$i - 1];
                echo '",';
            }
        @endphp];

        var reviewsDaily = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayReviewsDaily'][$i - 1];
                echo '",';
            }
        @endphp];
        var reviewsWeekly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayReviewsWeekly'][$i - 1];
                echo '",';
            }
        @endphp];
        var reviewsMonthly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayReviews'][$i - 1];
                echo '",';
            }
        @endphp];

        var clicksWeekly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayClicksWeekly'][$i - 1];
                echo '",';
            }
        @endphp];
        var clicksDaily = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayClicksDaily'][$i - 1];
                echo '",';
            }
        @endphp];
        var clicksMonthly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayMonthlyClicks'][$i - 1];
                echo '",';
            }
        @endphp];

        var webClicksDaily = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayWebClicksDaily'][$i - 1];
                echo '",';
            }
        @endphp];
        var webClicksWeekly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayWebClicksWeekly'][$i - 1];
                echo '",';
            }
        @endphp];
        var webClicksMonthly = [@php
            for ($i = 12; $i > 0; $i--) {
                echo '"';
                echo $data['dataArrayMonthlyWebClicks'][$i - 1];
                echo '",';
            }
        @endphp];





        //views
        var sum_views = viewsMonthly.reduce(function(a, b) {
            return parseInt(a) + parseInt(b);
        });


        //web clicks
        var sum_clicks = clicksMonthly.reduce(function(a, b) {
            return parseInt(a) + parseInt(b);
        });

        //reviews
        var sum_reviews = webClicksMonthly.reduce(function(a, b) {
            return parseInt(a) + parseInt(b);
        });


        $("#myChart-1-count").text(sum_views);
        $("#myChart-3-count").text(sum_clicks);
        $("#myChart-4-count").text(sum_reviews);


        function triggerChart(id, bgColor, borderColor, chartLabel, chartData) {
            const ctx = document.getElementById(id).getContext('2d');
            //  const images = ["assets/images/ya.png","assets/images/ask.png" , "assets/images/ins.png" , "assets/images/facebook-round-color.png" , "assets/images/gg.png" , "assets/images/tweet.png" , "assets/images/pin.png" , "assets/images/firefox.png" , "assets/images/yout.png" , "assets/images/li.png"];
            const myChart = new Chart(ctx, {
                type: 'bar',
                plugins: [{
                    afterDraw: chart => {
                        var ctx = chart.chart.ctx;
                        var xAxis = chart.scales['x-axis-0'];
                        var yAxis = chart.scales['y-axis-0'];
                        xAxis.ticks.forEach((value, index) => {
                            // var x = xAxis.getPixelForTick(index);
                            // var image = new Image();
                            // image.src = images[index],
                            // ctx.drawImage(image, x - 12, yAxis.bottom + 1);
                        });
                    }
                }],
                data: {
                    labels: chartLabel,
                    datasets: [{
                        label: '',
                        data: chartData,
                        backgroundColor: bgColor,
                        borderColor: borderColor,
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                                display: false,
                            },
                            ticks: {
                                display: false
                            },
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },

                }
            });
        }

        function triggerChart1(id, bgColor, borderColor, chartLabel, chartData) {
            const ctx = document.getElementById(id).getContext('2d');
            //      const images = ["assets/images/ya.png","assets/images/ask.png" , "assets/images/ins.png" , "assets/images/facebook-round-color.png" , "assets/images/gg.png" , "assets/images/tweet.png" , "assets/images/pin.png" , "assets/images/firefox.png" , "assets/images/yout.png" , "assets/images/li.png"];
            const myChart = new Chart(ctx, {
                type: 'bar',
                plugins: [{
                    afterDraw: chart => {
                        var ctx = chart.chart.ctx;
                        var xAxis = chart.scales['x-axis-0'];
                        var yAxis = chart.scales['y-axis-0'];
                        xAxis.ticks.forEach((value, index) => {
                            // var x = xAxis.getPixelForTick(index);
                            // var image = new Image();
                            // image.src = images[index],
                            // ctx.drawImage(image, x - 12, yAxis.bottom + 1);
                        });
                    }
                }],
                data: {
                    labels: chartLabel,
                    datasets: [{
                        label: '',
                        data: chartData,
                        backgroundColor: bgColor,
                        borderColor: borderColor,
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                                display: false,
                            },
                            ticks: {
                                display: false
                            },
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },

                }
            });
        }

        function triggerChart2(id, bgColor, borderColor, chartLabel, chartData) {
            const ctx = document.getElementById(id).getContext('2d');
            // const images = ["assets/images/ya.png","assets/images/ask.png" , "assets/images/ins.png" , "assets/images/facebook-round-color.png" , "assets/images/gg.png" , "assets/images/tweet.png" , "assets/images/pin.png" , "assets/images/firefox.png" , "assets/images/yout.png" , "assets/images/li.png"];
            const myChart = new Chart(ctx, {
                type: 'bar',
                plugins: [{
                    afterDraw: chart => {
                        var ctx = chart.chart.ctx;
                        var xAxis = chart.scales['x-axis-0'];
                        var yAxis = chart.scales['y-axis-0'];
                        xAxis.ticks.forEach((value, index) => {
                            // var x = xAxis.getPixelForTick(index);
                            // var image = new Image();
                            // image.src = images[index],
                            // ctx.drawImage(image, x - 12, yAxis.bottom + 1);
                        });
                    }
                }],
                data: {
                    labels: chartLabel,
                    datasets: [{
                        label: '',
                        data: chartData,
                        backgroundColor: bgColor,
                        borderColor: borderColor,
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                                display: false,
                            },
                            ticks: {
                                display: false
                            },
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },

                }
            });
        }

        function triggerChart3(id, bgColor, borderColor, chartLabel, chartData) {
            const ctx = document.getElementById(id).getContext('2d');
            //const images = ["assets/images/ya.png","assets/images/ask.png" , "assets/images/ins.png" , "assets/images/facebook-round-color.png" , "assets/images/gg.png" , "assets/images/tweet.png" , "assets/images/pin.png" , "assets/images/firefox.png" , "assets/images/yout.png" , "assets/images/li.png"];
            const myChart = new Chart(ctx, {
                type: 'bar',
                plugins: [{
                    afterDraw: chart => {
                        var ctx = chart.chart.ctx;
                        var xAxis = chart.scales['x-axis-0'];
                        var yAxis = chart.scales['y-axis-0'];
                        xAxis.ticks.forEach((value, index) => {
                            // var x = xAxis.getPixelForTick(index);
                            // var image = new Image();
                            // image.src = images[index],
                            // ctx.drawImage(image, x - 12, yAxis.bottom + 1);
                        });
                    }
                }],
                data: {
                    labels: chartLabel,
                    datasets: [{
                        label: '',
                        data: chartData,
                        backgroundColor: bgColor,
                        borderColor: borderColor,
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                drawBorder: false,
                                display: false,
                            },
                            ticks: {
                                display: false
                            },
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },

                }
            });
        }

        var bgColor = ['#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
        ];
        var borderColor = ['#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
            '#F16323',
        ];


        triggerChart('myChart', bgColor, borderColor, viewsDailyLabel, viewsDaily);
        triggerChart('myChartp1', bgColor, borderColor, viewsWeeklyLabel, viewsWeekly);
        triggerChart('myChartp2', bgColor, borderColor, viewsMonthlyLabel, viewsMonthly);


        const bgColor2 = ['#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
        ];
        const borderColor2 = ['#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
            '#EC0023',
        ];

        triggerChart1('myChart-2c', bgColor2, borderColor2, viewsDailyLabel, clicksDaily);
        triggerChart1('myChartp-3c', bgColor2, borderColor2, viewsWeeklyLabel, clicksWeekly);
        triggerChart1('myChart-4c', bgColor2, borderColor2, viewsMonthlyLabel, clicksMonthly);


        const bgColor3 = ['#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D'
        ];
        const borderColor3 = ['#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D',
            '#00934D'
        ];

        triggerChart2('myChart-2w', bgColor3, borderColor3, viewsDailyLabel, webClicksDaily);
        triggerChart2('myChart_3w', bgColor3, borderColor3, viewsWeeklyLabel, webClicksWeekly);
        triggerChart2('myChart-4w', bgColor3, borderColor3, viewsMonthlyLabel, webClicksMonthly);


        const bgColor4 = ['#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000'
        ];
        const borderColor4 = ['#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000',
            '#000000'
        ];

        triggerChart3('myChart-2r', bgColor4, borderColor4, viewsDailyLabel, reviewsDaily);
        triggerChart3('myChart-3r', bgColor4, borderColor4, viewsWeeklyLabel, reviewsWeekly);
        triggerChart3('myChart-4r', bgColor4, borderColor4, viewsMonthlyLabel, reviewsMonthly);
    </script>


    <script>
        $(document).ready(function() {
            function changeOnTrigger(a, b) {
                jQuery(a).on('click', function() {
                    jQuery(b).trigger('click');
                });

            }
            changeOnTrigger('.bc1', '.cc1');
            changeOnTrigger('.bc2', '.cc2');
            changeOnTrigger('.bc3', '.cc3');
            changeOnTrigger('.bc4', '.cc4');





        });
    </script>


</body>

</html>
