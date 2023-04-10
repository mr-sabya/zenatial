@extends('layouts.main-ecommerce')

@section('content')
<!-- Contact start -->
<section class="contact-page">
    <div class="page-content">
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14710.069205870368!2d89.5531815!3d22.8203432!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5d9a97f01675c4b!2s"
                allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="contact-form container">

            <div class="row">
                <div class="col-lg-4 mb-30">
                    <div class="phone h-100 shadow-light">
                        <h4>Phone/Fax</h4>
                        <i class="flaticon-phone-call"></i>
                        @if($ps->phone != null && $ps->fax != null)
                        <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                        <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>
                        @elseif($ps->phone != null)
                        <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                        @else
                        <a href="tel:{{$gs->call_us_no}}">{{$gs->call_us_no}}</a>
                        @endif
                    </div>
                </div>                                  
                <div class="col-lg-4 mb-30">
                    <div class="email h-100 shadow-light">
                        <h4>Email</h4>
                        <i class="flaticon-at"></i>
                        @if($ps->site != null && $ps->email != null) 
                        <a href="{{$ps->site}}" target="_blank">{{$ps->site_anchor}}</a>
                        <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>
                        @elseif($ps->site != null)
                        <a href="{{$ps->site}}" target="_blank">{{$ps->site_anchor}}</a>
                        @else
                        <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>
                        @endif                        
                    </div>
                </div>
                <div class="col-lg-4 mb-30">
                    <div class="address h-100 shadow-light">
                        <h4>Location</h4>
                        <i class="flaticon-location"></i>
                        <span>                                                
                        @if($ps->street != null) 
                            {!! $ps->street !!}
                        @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="white-bg pt-80 pb-80 pl-70 pr-70 shadow-light">
                <h2 class="text-center mb-50">Leave us a message</h2>
                <form action="{{route('front.contact.submit')}}" method="POST">
                {{csrf_field()}}
                @include('partials.message')
                    <div class="row basic-form">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="full-name">Name<span class="text-theme">*</span></label>
                                <input type="text" name="name" class="form-control" id="full-name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Email<span class="text-theme">*</span></label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="comment">Your Message<span class="text-theme">*</span></label>
                                <textarea name="text" class="form-control" id="comment" rows="3" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <input type="hidden" name="to" value="{{ $ps->contact_email }}">
                            <button class="btn">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact end -->
@endsection