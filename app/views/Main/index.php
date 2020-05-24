<!--banner-starts-->
<div class="bnr" id="home">
    <div id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt=""/>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<!--banner-ends-->
<!--Slider-Starts-Here-->
<script src="js/responsiveslides.min.js"></script>
<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider4").responsiveSlides({
            auto: true,
            pager: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>
<!--End-slider-script-->
<?php if ($brands): ?>
    <!--about-starts-->
    <div class="about">
        <div class="container">
            <div class="about-top grid-1">
                <?php foreach ($brands as $brand): ?>
                    <div class="col-md-4 about-left">
                        <figure class="effect-bubba">
                            <img class="img-responsive" src="images/<?= $brand->img ?>" alt=""/>
                            <figcaption>
                                <h2><?= $brand->title ?></h2>
                                <p><?= $brand->description ?></p>
                            </figcaption>
                        </figure>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--about-end-->
<?php endif; ?>
<?php
if (!empty($hits)):
    $curr = \ishop\App::$app->getProperty('currency');
    ?>
    <!--product-starts-->
    <div class="product">
        <div class="container">
            <div class="product-top">
                <div class="product-one">
                    <? foreach ($hits as $product): ?>
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="product/<?= $product->alias ?>" class="mask">
                                    <img class="img-responsive zoom-img" src="images/<?= $product->img ?>" alt=""/>
                                </a>
                                <div class="product-bottom">
                                    <h3><?= $product->title ?></h3>
                                    <p>Explore Now</p>
                                    <h4>
                                        <a class="add-to-cart-link" data-id="<?= $product->id ?>" href="cart/add?id=<?= $product->id ?>"><i></i></a>
                                        <span class=" item_price"><?= $curr['symbol_left'] . $product->price * $curr['value'] . $curr['symbol_right'] ?></span>
                                        <? if (!empty($product->old_price)): ?>
                                            <span class=" item_price"><small><del><?= $curr['symbol_left'] . $product->old_price * $curr['value'] . $curr['symbol_right'] ?></del></small></span>
                                        <? endif; ?>
                                    </h4>
                                </div>
                                <div class="srch">
                                    <? if (!empty($product->old_price)):
                                        $discount = intval(($product->old_price - $product->price) / $product->old_price * 100);
                                        ?>
                                        <span>-<?= $discount ?>%</span>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!--product-end-->
<?php endif; ?>