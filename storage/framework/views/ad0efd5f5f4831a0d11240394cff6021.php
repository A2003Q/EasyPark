<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>ParkEasy</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/css/bootstrap.min.css')); ?>">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/css/style.css')); ?>">
      <!-- Responsive-->
      <link rel="stylesheet" href="<?php echo e(asset('landing/css/responsive.css')); ?>">
      <!-- fevicon -->
      <link rel="icon" href="<?php echo e(asset('landing/images/fevicon.png')); ?>" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="<?php echo e(asset('landing/css/jquery.mCustomScrollbar.min.css')); ?>">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- font awesome css -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body data-spy="scroll" data-target="#navbarSupportedContent" data-offset="90">
      <?php echo $__env->make('landing.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      <!-- end header section -->
      <!-- banner section start --> 
      <div class="banner_section layout_padding" id="home">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div id="banner_slider" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="banner_taital_main">
                              <h1 class="banner_taital">Find<br> Parking Spots</h1>
                              <p class="banner_text">A smart-city parking finder that shows available outdoor spots near you, with clear status and location guidance.</p>
                              <form class="form-group pe-hero-search" method="GET" action="<?php echo e(url('/parkings')); ?>">
                                 <input type="text" class="update_mail pe-search-input" placeholder="Search area (e.g., Downtown, Amman)" name="place">
                                 <div class="subscribe_bt">
                                    <button type="submit" class="pe-search-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        </div>
                        <div class="carousel-item">
                           <div class="banner_taital_main">
                              <h1 class="banner_taital">Park<br> Faster</h1>
                              <p class="banner_text">See free spots in real time, navigate to the closest area, and save your car location with one tap.</p>
                              <form class="form-group pe-hero-search" method="GET" action="<?php echo e(url('/parkings')); ?>">
                                 <input type="text" class="update_mail pe-search-input" placeholder="Search by street / landmark" name="place">
                                 <div class="subscribe_bt">
                                    <button type="submit" class="pe-search-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        </div>
                        <div class="carousel-item">
                           <div class="banner_taital_main">
                              <h1 class="banner_taital">Smart<br> City Ready</h1>
                              <p class="banner_text">Designed for outdoor parking lots and streets—simple for drivers, powerful for operators, scalable for cities.</p>
                              <form class="form-group pe-hero-search" method="GET" action="<?php echo e(url('/parkings')); ?>">
                                 <input type="text" class="update_mail pe-search-input" placeholder="Search parking zone" name="place">
                                 <div class="subscribe_bt">
                                    <button type="submit" class="pe-search-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
                     <i class="fa fa-angle-left"></i>
                     </a>
                     <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
                     <i class="fa fa-angle-right"></i>
                     </a>
                  </div>
                  <div class="banner_img hero_img_placeholder"><img src="<?php echo e(asset('landing/images/banner-img.png')); ?>" class="hero_img_placeholder_img" alt="" /></div>
               </div>
</div>
         </div>
      </div>
      <!-- banner section end -->
      <!-- about section start -->
      <div class="about_section layout_padding" id="about">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6">
                  <div class="about_img"><img src="https://i.pinimg.com/736x/ba/e8/d7/bae8d7ba0e67bac95880925c0086fa08.jpg" loading="lazy" referrerpolicy="no-referrer"></div>
               </div>
               <div class="col-md-6">
                  <h3 class="about_taital">About ParkEasy</h3>
                    <p class="about_text">ParkEasy helps drivers find available outdoor parking spots quickly. It highlights nearby parking areas, shows spot availability, and supports a modern smart-city experience for both users and operators.</p>
                    <div class="readmore_btn"><a href="#">Learn More<span class="arrow_icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <!-- divider section start (reuse the stats container but show 2 key stats) -->
      <div class="choose_section_2">
         <div class="container">
            <div class="row justify-content-center text-center">
               <div class="col-lg-3 col-sm-6">
                  <h1 class="rated_text"><span class="padding_10"><img src="<?php echo e(asset('landing/images/icon-1.png')); ?>"></span><span class="countup" data-target="3700">0</span></h1>
                  <p class="house_text">Active Users</p>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <h1 class="rated_text"><span class="padding_10"><img src="<?php echo e(asset('landing/images/icon-2.png')); ?>"></span><span class="countup" data-target="5700">0</span></h1>
                  <p class="house_text">Tracked Spots</p>
               </div>
            </div>
         </div>
      </div>
      <!-- divider section end -->
      <!-- models section start -->
      <div class="models_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="models_taital">How It Works</h1>
               </div>
            </div>
            <div class="models_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="models_img"><img src="https://i.pinimg.com/736x/ec/47/de/ec47de66394028736a8519514982a7c3.jpg" loading="lazy" referrerpolicy="no-referrer"></div>
                  </div>
                  <div class="col-md-6 how_card">
                     <h3 class="carolo_text"><span class="number_text">01</span> Search Nearby Areas</h3>
                     <p class="ullamco_text">Type a location or use GPS to find the closest outdoor parking zones around you—fast, simple, and clear.</p>
                     <div class="price_main">
                        <p class="price_text"><span style="color: #3a3a5e;">Benefit</span> Less time searching</p>
                        <div class="read_btn"><a href="#">See Details<span class="arrow_icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="models_section_2">
               <div class="row">
                  <div class="col-md-6 how_card">
                     <h3 class="carolo_text"><span class="number_text">02</span> Check Spot Status</h3>
                     <p class="ullamco_text">See which spots are available, occupied, or limited. Choose the best option and navigate right to it.</p>
                     <div class="price_main">
                        <p class="price_text"><span style="color: #3a3a5e;">Benefit</span> Clear availability</p>
                        <div class="read_btn"><a href="#">See Details<span class="arrow_icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="models_img"><img src="https://i.pinimg.com/736x/f5/94/54/f59454cc32ba919c364664f85026972b.jpg" loading="lazy" referrerpolicy="no-referrer"></div>
                  </div>
               </div>
            </div>
            <div class="models_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="models_img"><img src="https://i.pinimg.com/736x/ec/47/de/ec47de66394028736a8519514982a7c3.jpg" loading="lazy" referrerpolicy="no-referrer"></div>
                  </div>
                  <div class="col-md-6 how_card">
                     <h3 class="carolo_text"><span class="number_text">03</span> Save Your Car Location</h3>
                     <p class="ullamco_text">After you park, save your spot instantly and get guided back later—perfect for busy streets and large outdoor lots.</p>
                     <div class="price_main">
                        <p class="price_text"><span style="color: #3a3a5e;">Benefit</span> Never forget where you parked</p>
                        <div class="read_btn"><a href="#">See Details<span class="arrow_icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- models section end -->
      <div class="choose_section_2">
         <div class="container">
            <div class="row justify-content-center text-center">
               <div class="col-lg-3 col-sm-6">
                  <h1 class="rated_text"><span class="padding_10"><img src="<?php echo e(asset('landing/images/icon-3.png')); ?>"></span><span class="countup" data-target="124">0</span></h1>
                  <p class="house_text">Parking Areas</p>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <h1 class="rated_text"><span class="padding_10"><img src="<?php echo e(asset('landing/images/icon-4.png')); ?>"></span><span class="countup" data-target="704">0</span></h1>
                  <p class="house_text">Operator Updates</p>
               </div>
            </div>
         </div>
      </div>
      <!-- blog section start -->
      <div class="blog_section layout_padding" id="parkings">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="blog_taital">FEATURED PARKING AREAS</h1>
               </div>
            </div>
            <div class="blog_section_2">
               <div class="row">
                  <div class="col-md-4">
                     <div class="blog_img"><img src="<?php echo e(asset('landing/images/img-4.png')); ?>"></div>
                     <div class="btn_main">
                        <div class="date_text"><a href="#">Availability: Live</a></div>
                     </div>
                     <div class="blog_box">
                        <h3 class="blog_text">Downtown Zone</h3>
                        <p class="lorem_text">Quick access to the busiest streets, with nearby available spots updated by operators.</p>
                     </div>
                     <div class="read_bt"><a href="#">View Area<span class="arrow_icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a></div>
                  </div>
                  <div class="col-md-4">
                     <div class="blog_img"><img src="<?php echo e(asset('landing/images/img-5.png')); ?>"></div>
                     <div class="btn_main">
                        <div class="date_text active"><a href="#">Availability: High</a></div>
                     </div>
                     <div class="blog_box">
                        <h3 class="blog_text">Campus Parking</h3>
                        <p class="lorem_text">Designed for students and staff—save your car location and get guided back anytime.</p>
                     </div>
                     <div class="read_bt active"><a href="#">View Area<span class="arrow_icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a></div>
                  </div>
                  <div class="col-md-4">
                     <div class="blog_img"><img src="<?php echo e(asset('landing/images/img-6.png')); ?>"></div>
                     <div class="btn_main">
                        <div class="date_text"><a href="#">Availability: Limited</a></div>
                     </div>
                     <div class="blog_box">
                        <h3 class="blog_text">Hospital Area</h3>
                        <p class="lorem_text">Find the closest spot quickly when every minute matters—clear status and easy navigation.</p>
                     </div>
                     <div class="read_bt"><a href="#">View Area<span class="arrow_icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- blog section end -->
      <!-- client section start -->
      <div class="client_section layout_padding" id="testimonials">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="client_taital">What Users Say</h1>
                  <p class="client_text">Real feedback from drivers who park faster and stress less with live spot status.</p>
               </div>
            </div>
            <div class="customer_section_2">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="box_main">
                           <div class="customer_main">
                              <div class="customer_left">
                                 <div class="customer_img"><img src="<?php echo e(asset('landing/images/client-img.png')); ?>"></div>
                              </div>
                              <div class="customer_right">
                                 <h3 class="customer_name">Dana M.</h3>
                                 <p class="enim_text">I used to waste so much time driving around looking for a spot. With ParkEasy I can see nearby availability and save where I parked. It feels like a real smart-city feature.</p>
                                 <div class="quick_icon"><img src="<?php echo e(asset('landing/images/quick-icon.png')); ?>"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- client section end -->
      <!-- footer (compact) start -->
      <div class="footer_compact" id="footer">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-6">
                  <p class="footer_text">
                     <i class="fa fa-envelope" aria-hidden="true"></i>
                     <span class="padding_left_10">support@parkeasy.app</span>
                     <span class="footer_sep">|</span>
                     <i class="fa fa-phone" aria-hidden="true"></i>
                     <span class="padding_left_10">+962 7X XXX XXXX</span>
                  </p>
               </div>
               <div class="col-md-6">
                  <div class="footer_social">
                     <a href="#" aria-label="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                     <a href="#" aria-label="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                     <a href="#" aria-label="LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                     <a href="#" aria-label="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer (compact) end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free Html Templates</a>. DIstributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="<?php echo e(asset('landing/js/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('landing/js/popper.min.js')); ?>"></script>
      <script src="<?php echo e(asset('landing/js/bootstrap.bundle.min.js')); ?>"></script>
      <script src="<?php echo e(asset('landing/js/jquery-3.0.0.min.js')); ?>"></script>
      <script src="<?php echo e(asset('landing/js/plugin.js')); ?>"></script>
      <!-- sidebar -->
      <script src="<?php echo e(asset('landing/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
      <script src="<?php echo e(asset('landing/js/custom.js')); ?>"></script>
   </body>
</html>
<?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/landing/index.blade.php ENDPATH**/ ?>