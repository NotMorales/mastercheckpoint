@extends('layouts.home')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::App-->
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

            <!--Begin:: App Aside Mobile Toggle-->
            <button class="kt-app__aside-close" id="kt_chat_aside_close">
                <i class="la la-close"></i>
            </button>

            <!--End:: App Aside Mobile Toggle-->

            <!--Begin:: App Aside-->
            <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--lg kt-app__aside--fit" id="kt_chat_aside">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--users kt-mt-20">
                            <div class="kt-scroll kt-scroll--pull">
                                <div class="kt-widget__items">
                                    <div class="kt-widget__item">
                                        <span class="kt-media kt-media--circle">
                                            <img src="assets/media/users/300_9.jpg" alt="image">
                                        </span>
                                        <div class="kt-widget__info">
                                            <div class="kt-widget__section">
                                                <a href="#" class="kt-widget__username">Matt Pears</a>
                                                <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                            </div>
                                            <span class="kt-widget__desc">
                                                Head of Development
                                            </span>
                                        </div>
                                        <div class="kt-widget__action">
                                            <span class="kt-widget__date">36 Mines</span>
                                            <span class="kt-badge kt-badge--success kt-font-bold">7</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>

            <!--End:: App Aside-->

            <!--Begin:: App Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
                <div class="kt-chat">
                    <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                        <div class="kt-portlet__head">
                            <div class="kt-chat__head ">
                                <div class="kt-chat__left">


                                </div>
                                <div class="kt-chat__center">
                                    <div class="kt-chat__label">
                                        <a href="#" class="kt-chat__title">Jason Muller</a>
                                        <span class="kt-chat__status">
                                            <span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
                                        </span>
                                    </div>
                                    <div class="kt-chat__pic kt-hidden">
                                        <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Jason Muller" data-original-title="Tooltip title">
                                            <img src="assets/media/users/300_12.jpg" alt="image">
                                        </span>
                                        <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Nick Bold" data-original-title="Tooltip title">
                                            <img src="assets/media/users/300_11.jpg" alt="image">
                                        </span>
                                        <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Milano Esco" data-original-title="Tooltip title">
                                            <img src="assets/media/users/100_14.jpg" alt="image">
                                        </span>
                                        <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Teresa Fox" data-original-title="Tooltip title">
                                            <img src="assets/media/users/100_4.jpg" alt="image">
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-chat__right">

                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                                <div class="kt-chat__messages">
                                    <div class="kt-chat__message">
                                        <div class="kt-chat__user">
                                            <span class="kt-media kt-media--circle kt-media--sm">
                                                <img src="assets/media/users/100_12.jpg" alt="image">
                                            </span>
                                            <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                            <span class="kt-chat__datetime">2 Hours</span>
                                        </div>
                                        <div class="kt-chat__text kt-bg-light-success">
                                            How likely are you to recommend our company <br>to your friends and family?
                                        </div>
                                    </div>
                                    <div class="kt-chat__message kt-chat__message--right">
                                        <div class="kt-chat__user">
                                            <span class="kt-chat__datetime">30 Seconds</span>
                                            <a href="#" class="kt-chat__username">You</span></a>
                                            <span class="kt-media kt-media--circle kt-media--sm">
                                                <img src="assets/media/users/300_21.jpg" alt="image">
                                            </span>
                                        </div>
                                        <div class="kt-chat__text kt-bg-light-brand">
                                            Hey there, we’re just writing to let you know <br>that you’ve been subscribed to a repository on GitHub.
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-chat__input">
                                <div class="kt-chat__editor">
                                    <textarea style="height: 50px" placeholder="Type here..."></textarea>
                                </div>
                                <div class="kt-chat__toolbar">

                                    <div class="kt_chat__actions">
                                        <button type="button" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--End:: App Content-->
        </div>

        <!--End::App-->
    </div>

    <!-- end:: Content -->
</div>

<script src="{{asset('js/chat.js')}}" type="text/javascript"></script>

@endsection
