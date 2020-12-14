@extends('layouts.frontend')

@section('content')
    <section class="main-wrapper">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-11 col-md-12 col-xs-12 col-sm-12">
                    <div class="contact-div shadow-sm">
                        <div class="contact-side-img pl-5">
                            <ul style="margin-top: calc(100% - 45%);">
                                <li class="bold-text"><i class="fa fa-map-marker" aria-hidden="true" style="padding-right: 1.5rem;"></i> Address</li>
                                <li style="padding-left: 3.3rem;">Mada Center 8th floor, 379 Hudson St, New York, NY 10018 US</li>
                            </ul>

                            <ul style="margin-top: 2rem;">
                                <li class="bold-text"><i class="fa fa-phone" aria-hidden="true" style="padding-right: 1.5rem;"></i> Lets Talk</li>
                                <li style="padding-left: 3.4rem;color: #00AD4F;">+1 800 1236879</li>
                            </ul>

                            <ul style="margin-top: 2rem;">
                                <li class="bold-text"><i class="fa fa-envelope" aria-hidden="true" style="padding-right: 1.5rem;"></i> General Support</li>
                                <li style="padding-left: 3.5rem;color: #00AD4F;">contact@example.com</li>
                            </ul>

                        </div>
                        <div class="contact-form text-center">
                            <h3 style="margin-top: 20px;margin-bottom: 40px;">Send Us A Message</h3>
                            <form action="" id="contact-form">
                                <div class="form-group row" style="padding-bottom: 25px">
                                    <label for="fname" class="col-md-12 col-lg-12 col-sm-12 col-xs-12 col-form-label text-md-left">Tell us your name *</label>

                                    <div class="col-md-6">
                                        <input id="fname" type="text" placeholder="First name" class="form-control fname" name="fname" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="fname" type="text" placeholder="Last name" class="form-control lname" name="lname" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label text-md-left">enter your email *</label>

                                    <div class="col-md-12" style="padding-bottom: 25px">
                                        <input id="email" type="email" class="form-control email" placeholder="eg: example@email.com" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-md-12 col-form-label text-md-left">phone number *</label>

                                    <div class="col-md-12" style="padding-bottom: 25px">
                                        <input id="phone" type="text" class="form-control phone" placeholder="98XXXXXXXX" name="phone" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-md-12 col-form-label text-md-left">message *</label>

                                    <div class="col-md-12" style="padding-bottom: 25px">
                                        <textarea id="message" type="text" class="form-control message"   name="message" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" id="contact-btn" onclick="submitForm()">SEND MESSAGE</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection