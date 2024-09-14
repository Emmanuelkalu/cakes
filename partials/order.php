<div class="container">
    <div style="margin:50px"></div>
    <div style="margin:50px"></div>
    <div style="margin:50px"></div>
    <div class="ps-section__header text-center my-4 py-4">
        <h3 class="ps-section__title">Order Form</h3>
        <p>Making people happy</p><span><img src="images/icons/floral.png" alt=""></span>
    </div>
    <div style="margin:50px"></div>
    <div style="margin:50px"></div>

    <div class="col-12 d-lg-flex justify-content-center">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <form id="orderForm" style="box-shadow:0 4px 25px #b8872b20; border-radius: 10px;"
                class="pb-4  ps-form--menu ps-form--order-form" action="https://nouthemes.net/html/bready/do_action"
                method="post">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Your Name <sup>*</sup></label>
                            <input name="name" class="form-control" type="text" placeholder="">
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Email Address <sup>*</sup></label>
                            <input name="emailAddress" class="form-control" type="text" placeholder="">
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Event Date <sup>*</sup></label>
                            <div class="ps-form--icon"><i class="fa fa-calendar-check-o"></i>
                                <input name="date" class="form-control" type="text" placeholder="">
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Delivery Address <sup>*</sup></label>
                            <input name="deliveryAddress" class="form-control" type="text" placeholder="">
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Phone Number <sup>*</sup></label>
                            <input name="phoneNumber" class="form-control" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Type of Event <sup>*</sup></label>
                            <select name="typeOfEvent" class="form-control" type="text">
                                <option value=""></option>
                                <option value="Birthday">Birthday</option>
                                <option value="Wedding">Wedding</option>
                                <option value="Party">Party</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Cake Colors <sup>*</sup></label>
                            <input name="cakeColors" class="form-control" type="text" placeholder="">
                        </div>
                    </div>




                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Number of Servings <sup>*</sup></label>
                            <input name="numberOfServings" class="form-control" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>What is your budget? <sup>*</sup></label>
                            <input name="yourBudget" class="form-control" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                            <label>Image <sup>*</sup></label>
                            <input class="form-control" type="file" accept="image/*" placeholder="">
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 pb-4">
                        <div class="form-group">
                            <label>Notes about your order, e.g. special notes for delivery.</label>
                            <textarea name="enterMessage" class="form-control" rows="8" placeholder=""></textarea>
                        </div>
                        <div class="form-group submit" style="margin-bottom: 80px;">
                            <button class="ps-btn ps-btn--yellow">Order Now</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>

</div>

<style>
    #orderForm,
    #orderForm input {
        border: 1px solid #b8872b53 !important;
    }
</style>