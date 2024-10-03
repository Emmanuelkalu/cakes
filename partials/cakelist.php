<div class="row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="ps-home-product bg--cover"
                    data-background="https://warethemes.com/wordpress/bready/wp-content/uploads/2018/09/home-product.jpg"
                    style="background: url(&quot;https://warethemes.com/wordpress/bready/wp-content/uploads/2018/09/home-product.jpg&quot;);">
                    <div class="ps-container">
                        <div class="ps-section__header text-center">
                            <h3 class="ps-section__title">Deal of the day</h3>
                            <p>CAKES FOR EVERY DAY</p> <span><img decoding="async"
                                    src="https://warethemes.com/wordpress/bready/wp-content/themes/bready/assets/images/icons/floral.png"
                                    alt="Deal of the day"></span>
                        </div>
<!-- HERE IS THE COMMENT -->
                        <div class="ps-section__content">
                            <div class="row products">
                                <?php
                                $q = $conn->query("SELECT * FROM cakes ORDER BY id asc limit 6");
                                while ($cake = $q->fetch_assoc()) { ?>
                                 <div data-mh="product" data-id="35"
                                    data-url=""
                                    data-title="Pie topping jelly gummi bears"
                                    class="col-lg-4 col-md-6 col-sm-6 col-xs-12 post-35 product type-product status-publish has-post-thumbnail product_cat-cupcake product_cat-organic first instock taxable shipping-taxable purchasable product-type-simple"
                                    style="height: 214.55px;">
                                    <div class="ps-product ps-product--horizontal">
                                        <div class="ps-product__thumbnail">
                                            <img loading="lazy" decoding="async" width="260" height="200"
                                                src="<?php echo $cake['image']; ?>"
                                                class="attachment-noubready_260x200 size-noubready_260x200" alt=""
                                                srcset="<?php echo $cake['image']; ?> 1040w, <?php echo $cake['image']; ?> 600w"
                                                sizes="(max-width: 260px) 100vw, 260px"> <span class="ps-badge"><i>New</i></span>
                                            <ul class="ps-product__actions">
                                                <li><a href="#quickview-modal" data-product_id="35"
                                                        data-tooltip="Quick View" class="product-quickview popup-modal"
                                                        data-effect="mfp-zoom-out"><i
                                                            class="ba-magnifying-glass"></i></a></li>

                                                <li>
                                                    <a class="ps-product__favorite wishlist" data-product_id="35"
                                                        href="#" data-tooltip="Favorite"><i class="ba-heart"></i></a>
                                                </li>

                                                <li>
                                                    <a rel="nofollow" href="?add-to-cart=35" data-quantity="1"
                                                        data-product_id="35" data-product_sku="CK_012"
                                                        class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                        data-tooltip="Add to cart"><i class="ba-shopping"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ps-product__content">
                                            <a class="ps-product__title"
                                                href=""><?php echo $cake['name']; ?></a>
                                            <p>
                                                <a href="#"
                                                    rel="tag"><?php echo $cake['category']; ?></a>
                                            </p>

                                            <div class="br-wrapper br-theme-fontawesome-stars"><select name="rating"
                                                    class="ps-rating" size="5" style="display: none;">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4" selected="selected">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                
                                            <p class="ps-product__price">
                                                <span class="woocs_price_code" data-currency=""
                                                    data-redraw-id="66e36d6f099fc" data-product-id="35"><span
                                                        class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol">$</span><?php echo $cake['price']; ?></span></span>
                                            </p>
                                                <div class="centered my2">
                                                    <form class="cartform" data-id="<?php echo $cake['id']; ?>">
                                                        <input type="number" min="1" value="1" minlength="1" />
                                                        <button class="btn1" data-tooltip="add to cart">
                                                            <i class="ba-shopping"></i>
                                                        </button>
                                                        <button class="btn2" data-tooltip="add to cart">
                                                            <i class="ba-shopping"></i>
                                                            <span>Add to cart</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                               


                            </div>
                        </div>
                    <div class="flex center">
                        <a href="cakelist" class="ps-btn" style="margin: 40px 0;"> View more. . .</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- add com -->
