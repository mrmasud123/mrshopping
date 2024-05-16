<!-- footer starts -->

<div class="footer container-fluid mt-5">
       <div class="container">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="col-3">
                    <h5 class="mb-3 fw-bold text-uppercase">Super Market</h5>
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, perspiciatis quia repudiandae sapiente sed sunt.
                    </span>
                </div>
                <div class="col-3">
                    <h5 class="mb-3 fw-bold text-uppercase">categories</h5>
                    <ul>
                        <li ><a class="nav-link p-0" href="category.php">MOBILES</a></li>
                        <li ><a class="nav-link p-0" href="category.php">LIVING ROOM</a></li>
                        <li ><a class="nav-link p-0" href="category.php">BEDS</a></li>
                        <li ><a class="nav-link p-0" href="category.php">MEN'S T-SHIRTS</a></li>
                        <li ><a class="nav-link p-0" href="category.php">KURTI'S</a></li>
                        <li ><a class="nav-link p-0" href="category.php">SAREES</a></li>
                    </ul>
                </div>
                <div class="col-3">
                    <h5 class="mb-3 fw-bold text-uppercase">useful links</h5>
                    <ul>
                        <li ><a class="nav-link p-0" href="index.php">HOME</a></li>
                        <li ><a class="nav-link p-0" href="popular-products.php">POPULAR PRODUCTS</a></li>
                        <li ><a class="nav-link p-0" href="latest-products.php">LATEST PRODUCTS</a></li>
                        <li ><a class="nav-link p-0" href="all-products.php">ALL PRODUCTS</a></li>
                    </ul>
                </div>
                <div class="col-3">
                    <h5 class="mb-3 fw-bold text-uppercase">Contact us</h5>
                    <ul>
                        <li>
                            <span><i class="fa fa-home"></i></span>
                            <span class="">: #123, Lorem Ipsum</span>
                        </li>
                        <li>
                            <span><i class="fa fa-phone"></i></span>
                            <span class="">: 0987654321</span>
                        </li>
                        <li>
                            <span><i class="fa fa-envelope"></i></span>
                            <span class="">: shopping@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
       </div>
</div>

<!-- footer ends -->

<!-- script files -->
<script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/okzoom.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/actions.js"></script>
    <script>
        $(document).ready(function(){
            console.log("Jquer");
            $('.banner-carousel').owlCarousel({
            loop: true,
            margin: 0,
            autoplay:true,
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });

            $('.popular-content').owlCarousel({
            loop:true,
            margin:10,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
            $('.latest-content').owlCarousel({
            loop:true,
            margin:10,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })

        $('#product-img').okzoom({
            width: 200,
            height: 200,
            scaleWidth: 800
        });
            $("#sidebarOpen").click(function(){
                $("#sidebar").css("transition","0.5s");
                $("#sidebar").css("right","0");
            });
            $("#sidebarClose").click(function(){
                $("#sidebar").css("transition","0.5s");
                $("#sidebar").css("right","-50%");
            });
        });
    </script>
</body>
</html>