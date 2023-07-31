@extends('layouts.app')

@section("title", "FAQ")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-pt">
        <div class="container">
            <div class="frequently-questions-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-30">
                            <h2>Frequently Questions</h2>
                        </div>
                        <hr>
                        <div class="section-dec mb-40">
                            <h3 class="text-center">Shipping</h3>
                            <hr>
                        </div>
                        <div class="faq-style-wrap section-pb" id="faq-five">
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse1" aria-expanded="true" aria-controls="faq-collapse1"> <span class="button-faq"></span>How do I track my order?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse1" class="collapse show" aria-expanded="true" role="tabpanel" data-parent="#faq-five">
                                    <div class="panel-body">
                                        <p>a. As soon as you place an order through Timepiece, you would get a confirmation email from us with a link to track your order. You can get all details about the status of your shipment by clicking on the link.</p>
                                        <p>b. You can also track you order</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->

                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse2" aria-expanded="false" aria-controls="faq-collapse2"> <span class="button-faq"></span>Delivery -Delivery times will</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse2" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-five">
                                    <div class="panel-body">
                                        <p>Vary depending on country and seller. All delivery details will be provided by the seller to the buyer including costs and delivery time. The shipping company are subjected to custom clearance procedures that may incur a delay in delivery.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->

                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse3" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>When will I receive an order confirmation email after placing the order?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse3" class="collapse" role="tabpanel" data-parent="#faq-five">
                                    <div class="panel-body">
                                        <p>You will receive the order confirmation email immediately with a link to track your shipment just after placing your order.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                        </div>
                        <hr>
                        <div class="section-dec mb-40">
                            <h3 class="text-center">Payment</h3>
                            <hr>
                        </div>
                        <div class="faq-style-wrap section-pb" id="faq-four">
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse9" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>What is the preferred method of payment by Timepiece Haus?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse9" class="collapse " aria-expanded="false" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>Timepiece Haus advise buyers and sellers alike to take advantage the escrow account for the safest and easiest way to pay. The seller is guaranteed funds, knowing the funds are in sitting in s safe escrow account and will be receiving funds on delivery of the watch and the buyer is guaranteed that the watch gets delivered before the funds are released by Escrow. When funds are paid through Timepiece Haus for the purchase of your watch, the payment goes to an escrow account, “Escrow.com”. The escrow company act as a third party and are not connected with Timepiece Haus. The money CAN NOT be accessed by the buyer,seller or even Timepiecehaus. We only advise the Escrow company to release the funds once we have been advised by the buyer. Don’t forget the Timepiece Haus team is are always available to help your watch arrive sooner than later.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->

                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse10" aria-expanded="false" aria-controls="faq-collapse2"> <span class="button-faq"></span>What other charges would I need to pay other than the purchase price?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse10" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>Shipping and insurance charges are additional to the purchase price</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->

                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse11" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>Does Timepiece Haus charge anything extra because of the difference in currency?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse11" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>We do not charge any extra charges apart from payment option charges. Your bank may charge for the difference in currency</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->

                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse12" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>A buyer has paid but I can't see their payment?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse12" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>The buyer might have paid via BPAY which can take 1 to 3 business days to process. Once the payment clears on our end, we will send you both confirmation via email letting you know the funds have been secured in</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->

                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse13" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>Can I make more than 1 payment for the same item?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse13" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>You can only make one transaction per item. You cannot make two separate payments. Example: If the watch advertised sale price is $10,000, you need to pay $10,000 in one transaction, you cannot split the payment in to 2 or 3 payments, e.g. $5000 and $5000 to make up the whole amount.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse14" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>As a seller using Escrow.com, how will I be paid for the sale of my watch?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse14" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>Sellers will be asked to submit their bank account details – this is the account your payment will be transferred to once the buyer has released the funds.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse15" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>How long will it take to receive my payment?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse15" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>Your payment will take between 1 to 3 business days from the time the buyer releases the funds to reach your account depending on your bank’s processing speed.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse16" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>Where are payments held?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse16" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>The Escrow.com holding account is an American bank account managed by our trusted payment services provider. All payments are secured and encrypted.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse17" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>I am a seller who has sold my watch to a buyer via Escrow.com or Timepiece Haus Trust account, Why haven’t I received my payment yet?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse17" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>If paid to your bank account, it's possible that your bank details were entered incorrectly. Please check your email for any correspondence from us. If you haven’t received anything, please contact us for assistance.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse18" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>Will funds paid by credit card be treated as a cash advance?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse18" class="collapse" role="tabpanel" data-parent="#faq-four">
                                    <div class="panel-body">
                                        <p>Credit card payments made to Escrow or Timepiece Haus Trust account are considered an online card payment. The cash advance feature only applies when the credit card is used to withdraw funds from an ATM or over the counter at the bank.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                        </div>

                        <hr>
                        <div class="section-dec mb-40">
                            <h3 class="text-center">Order & Returns</h3>
                            <hr>
                        </div>
                        <div class="faq-style-wrap section-pb" id="faq-six">
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse19" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>How do I buy the Watch?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse19" class="collapse " aria-expanded="false" role="tabpanel" data-parent="#faq-six">
                                    <div class="panel-body">
                                        <p>a. Click on the product you wish to buy.</p>
                                        <p>b. Click on 'Buy Now' button visible on the right hand side of the product.</p>
                                        <p>c. Click on 'Continue Shopping' if you wish to continue or click on 'View Cart & Checkout' to prepare for Check Out.</p>
                                        <p>d. Check all the details on your cart & click on 'Proceed to Check Out'.</p>
                                        <p>e. Now sign in with your user name & password for Timepiece Haus account. If you do not have a Timepiece Haus account, you need to create an account</p>
                                        <p>f. Fill all the details asked in the form for address & click 'Continue'.</p>
                                        <p>g. Choose a shipping method from available shipping methods then click " Continue".</p>
                                        <p>h. Select a payment option from available payment option(s) and then press " Continue".</p>
                                        <p>i. Review the final amount and items of your order and click on " Place order".</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse20" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>How Can I Get Refund (buyer)?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse20" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-six">
                                    <div class="panel-body">
                                        <p>While funds are still in the PayProtect holding account, you can request a full refund (which the seller can then approve) to release the funds back to you. You would receive the full amount you paid including any transaction fees and card fees. We cannot issue a refund without the seller's approval. If you and the seller have agreed to a final sale price less than the amount the buyer has paid into PayProtect (the original listed advert price), the buyer will be refunded that amount to their card used for purchase or will be prompted for the bank details used to send funds via BPAY. Please call our customer service team on 123456 or email us at</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse21" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>What is the procedure if I pay into Escrow.com or Timepiece Haus Trust account and then decide not to buy the watch?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse21" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-six">
                                    <div class="panel-body">
                                        <p>If you have paid into PayProtect, and change your mind about the car, you can request and then receive a full refund as long as you have not taken possession of the watch</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse22" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>Why do I need to provide ID to Escrow.com</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse22" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-six">
                                    <div class="panel-body">
                                        <p>We may require additional verification of your identity to remain in compliance with financial and government regulations. All information and photos supplied are secured and encrypted and are only used for the purpose of verifying your identity. Specifically, the reason we request a photo of you holding your identification (instead of requesting a scanned copy) is to ensure that the person providing the identification matches the person in the photograph. This is to prevent someone unlawfully obtaining a copy of your identification and using it without your knowledge. </p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                        </div>
                        <hr>
                        <div class="section-dec mb-40">
                            <h3 class="text-center">Security & Account</h3>
                            <hr>
                        </div>
                        <div class="faq-style-wrap section-pb" id="faq-seven">
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse23" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>How secure is your Timepiece Haus site?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse23" class="collapse " aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>a. All the payment transaction pages are secured by approved SSL certificates.</p>
                                        <p>b. SSL Certificate can be verified by the following https://www.ubuy.com.kw</p>
                                        <p>c. Our SSL Certificate is provided by GeoTrust Inc, refer to http://www.geotrust.com for more details.</p>
                                        <p>d. All our payment transactions are done on the provider website, which are well known and authorized providers.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse24" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>What methods are used to prevent fraud?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse24" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>a. All Buyers and Sellers details are stored by Timepiece Haus to ensure transparency</p>
                                        <p>b.By using our Escrow System, we can guarantee that the product is delivered in good order to the buyer. Funds are not released until goods have been successfully delivered and confirmed by the buyer. Need to provide more info about buyer protection</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse25" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>How do I Notify TH once I have received my watch and I am satisfied with it?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse25" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>Once you receive your watch, you must advise Timepiece Haus that you have received the watch within 24 hours of delivery. You can do this by clicking onto the home page, clicking onto message Timepiece Haus, then tick the questions, then click submit button.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse26" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>How to use the escrow account through Timepiece Haus?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse26" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>As a buyer, find your dream watch on Timepiece Haus and get in touch with the seller or simply purchase the watch buy clicking onto buy .Once both the buyer and seller agree to use the Escrow safe pay service... Buyer signs in to their Timepiece Haus member account, goes to their enquired watch list and selects PayProtect on their chosen watch. ￼
                                            Buyer: Follow the Escrow prompts to upload funds into the secure Account holding account or Timepiece Haus Trust Account without any transaction fees. TH Trust account is free to use. Seller: You’ll receive a notification to let you know the buyer has done this and be prompted to complete a few details on your end.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default --><!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse27" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>How to create an account?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse27" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>a. Click on "sign in" on the top right corner and select "Create an Account".</p>
                                        <p>b. Enter all the details asked in the form.</p>
                                        <p>c. Check (:heavy_check_mark:) all the boxes at the bottom of the form and click on SUBMIT button.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default --><!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse28" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>When can I contact customer care and how?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse28" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>You can email/call/live chat with us anytime with the details provided on 'Contact us' page.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default --><!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse29" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>How do I contact the seller directly:</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse29" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>If the seller doesn't offer the Escrow account through Timepiece Haus, you should contact them by clicking on the button "Contact seller") . Who is my contract partner when buying a watch? Your contract partner is always the respective dealer or private seller. When you choose to pay via Timepiece Haus, you will be shown the terms of sale during the sales process. If you decide to buy the watch directly from the dealer, please take note of the dealer's terms and conditions</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse30" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>Will you share my bank details with the person I’m transacting with?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse30" class="collapse " aria-expanded="false" role="tabpanel" data-parent="#faq-seven">
                                    <div class="panel-body">
                                        <p>No. All customer bank details are secured and encrypted.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                        </div>
                        <hr>
                        <div class="section-dec mb-40">
                            <h3 class="text-center">Other</h3>
                            <hr>
                        </div>
                        <div class="faq-style-wrap section-pb" id="faq-eight">
                            <!-- Panel-default -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a id="octagon" class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse31" aria-expanded="false" aria-controls="faq-collapse1"> <span class="button-faq"></span>
                                            How does the escrow account work?</a>
                                    </h5>
                                </div>
                                <div id="faq-collapse31" class="collapse " aria-expanded="false" role="tabpanel" data-parent="#faq-eight">
                                    <div class="panel-body">
                                        <p>1 BUYER MAKES PAYMENT – The buyer purchases the watch they want by clicking on BUY. ESCROW</p>
                                        <p>2.The buyer and seller work out who pays for what portion of the escrow fee.</p>
                                        <p>2. BUYER MAKES PAYMENT – payments can be made by credit card, bank transfer.Small fees apply to both buyer and seller, however can be refunded for unsuccessful or cancelled transactions.</p>
                                        <p>3.PAYMENT SECURED – You and the seller will both receive an email confirmation as well as a notification in your Timepiece Haus account letting you know the payment has been secured in Escrow.com </p>
                                        <p>4. FUNDS SAFE- funds are safely transferred and received by Escrow.com and sit safely in the account until further notice.</p>
                                        <p>7 RELEASE PAYMENT – TH can only release the payment once the buyer has received watch safely.</p>
                                        <p>8.The amount (minus escrow fees) will be transferred to the seller and can take between one (1) to five (5) business days to clear in the seller’s account.</p>
                                    </div>
                                </div>
                            </div>
                            <!--// Panel-default -->
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection
