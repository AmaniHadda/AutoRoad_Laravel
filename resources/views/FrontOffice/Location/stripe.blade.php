@extends('FrontOffice.Layout')
@auth
<section class="hero-wrap hero-wrap-2" style="background-image: url('/images/image_1.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">HOME <i
                                class="ion-ios-arrow-forward"></i></a></span> <span>Payment details<i
                            class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Payment Details</h1>
            </div>
        </div>
    </div>
</section>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">


</head>
<style>
    .inlineimage {
        max-width: 470px;
        margin-right: 8px;
        margin-left: 10px
    }

    .images {
        display: inline-block;
        max-width: 98%;
        height: auto;
        width: 22%;
        margin: 1%;
        left: 20px;
        text-align: center
    }
</style>

<body>

    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3 mt-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="inlineimage"> <img class="img-responsive images"
                                        src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png">
                                    <img class="img-responsive images"
                                        src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png">
                                    <img class="img-responsive images"
                                        src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Paypal-Curved.png">
                                    <img class="img-responsive images"
                                        src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png">
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">*</a>
                                <p>{{Session::get("success")}}</p>
                            </div>
                            @endif
                            <form role="form" action="{{ route('stripe.post', ['rentingPrice' => $rentingPrice]) }}" method="POST" class="require-validation"
                                data-stripe-publishable-key="{{env('STRIPE_KEY')}}" id="payment-form"
                                data-cc-on-file="false">
                                @csrf
                                {{-- <input type="hidden" name="rentingPrice" value={{$rentingPrice}}> --}}
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group"> <label>CARD NUMBER</label>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control card-number" placeholder="Valid Card Number" />
                                                <span class="input-group-addon">
                                                    <div class="fa fa-credit-card mt-3"></div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span
                                                    class="visible-xs-inline">EXP</span> Year</label> <input type="text"
                                                class="form-control card-expiry-year" placeholder="YYYY" /> </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group"> <label>CV CODE</label> 
                                            <input type="text" class="form-control card-cvc" placeholder="CVC" /> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="form-group"> <label>CARD OWNER</label> <input type="text"
                                                class="form-control" placeholder="Card Owner Name" required/> </div>
                                    </div>
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span
                                                    class="visible-xs-inline">EXP</span> Month</label> <input type="tel"
                                                class="form-control card-expiry-month" placeholder="MM" /> </div>
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-md-12 error form-group hide">
                                        <div class="alert-danger alert">Please correct the errors and try again</div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-xs-12"> <button style="background-color: orange;color:white"
                                                class="btn  btn-lg btn-block">Confirm
                                                Payment ({{$rentingPrice}}DT)</button> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">

  

    $(function() {
    
    
        var $form = $(".require-validation");
    
         
    
        $('form.require-validation').bind('submit', function(e) {
    
            var $form = $(".require-validation"),
    
            inputSelector = ['input[type=email]', 'input[type=password]',
    
                             'input[type=text]', 'input[type=file]',
    
                             'textarea'].join(', '),
    
            $inputs = $form.find('.required').find(inputSelector),
    
            $errorMessage = $form.find('div.error'),
    
            valid = true;
    
            $errorMessage.addClass('hide');
    
        
    
            $('.has-error').removeClass('has-error');
    
            $inputs.each(function(i, el) {
    
              var $input = $(el);
    
              if ($input.val() === '') {
    
                $input.parent().addClass('has-error');
    
                $errorMessage.removeClass('hide');
    
                e.preventDefault();
    
              }
    
            });
    
         
    
            if (!$form.data('cc-on-file')) {
    
              e.preventDefault();
    
              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
    
              Stripe.createToken({
    
                number: $('.card-number').val(),
    
                cvc: $('.card-cvc').val(),
    
                exp_month: $('.card-expiry-month').val(),
    
                exp_year: $('.card-expiry-year').val()
    
              }, stripeResponseHandler);
    
            }
    
        
    
        });
    
    
        function stripeResponseHandler(status, response) {
    
            if (response.error) {
    
                $('.error')
    
                    .removeClass('hide')
    
                    .find('.alert')
    
                    .text(response.error.message);
    
            } else {
    
                /* token contains id, last4, and card type */
    
                var token = response['id'];
    
                     
    
                $form.find('input[type=text]').empty();
    
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
    
                $form.get(0).submit();
    
            }
    
        }
    
         
    
    });
    
    </script>
</html>
@endauth