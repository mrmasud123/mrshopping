<?php
    include_once 'header.inc.php';

?>
                <div class="col-9 load-item">
                    <div class="col-md-10 col-sm-9 clearfix" id="admin-content">
                        <div class="admin-content-container">
                            <h2 class="admin-heading">Options</h2>
                            <form id="updateOptions" class="add-post-form row" method="post"
                                enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold" for="">Site Name</label>
                                        <input type="text" class="form-control site_name" name="site_name"
                                            value="Super Market" placeholder="Site Name" />
                                        <input type="hidden" name="s_no" value="2" />
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="fw-bold" for="">Site Title</label>
                                        <input type="text" class="form-control site_title" name="site_title"
                                            value="Online Shopping Project for Mobiles, Clothes, Electronics and many more...."
                                            placeholder="Site Title" />
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="fw-bold">Site Description</label>
                                        <textarea name="site_desc" class="form-control site_desc" cols="30"
                                            rows="3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, perspiciatis quia repudiandae sapiente sed sunt.</textarea>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="fw-bold">Contact Email</label>
                                        <input type="email" class="form-control email" name="contact_email"
                                            value="email@email1.com">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="fw-bold">Contact Phone Number</label>
                                        <input type="text" class="form-control phone" name="contact_phone"
                                            value="9876541230">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label class="fw-bold" for="">Site Logo</label><br>
                                        <input type="file" class="new_logo" name="new_logo" />
                                        <input type="hidden" class="old_logo" name="old_logo"
                                            value="1607398563shopping-logo.png"><br>
                                        <img id="image" src="images/about.jpg" alt=""
                                            width="100px" />
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="fw-bold" for="">Footer Text</label>
                                        <input type="text" class="form-control footer_text" name="footer_text"
                                            value="Copyright 2020">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="fw-bold">Currency Format</label>
                                        <input type="text" class="form-control currency" name="currency_format"
                                            value="Rs.">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="fw-bold">Contact Address</label>
                                        <textarea name="contact_address" class="form-control address" cols="30"
                                            rows="3">#123, Lorem Ipsum</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="bg-primary mt-2 text-light btn add-new" name="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-info">
            <h4 class="text-center">All Copyrights Reserved To mrmasud2023</h4>
        </div>
        <script src="../js/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#toggleAdmin").click(function () {
                    $(".options").toggleClass("sh");
                });

            });
        </script>
</body>

</html>