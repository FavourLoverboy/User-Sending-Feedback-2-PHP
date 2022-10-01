<?php 

    include('config/dataBaseLink.php');
    $collect = new Solution();

    session_start();

    if($_POST['signUp']){
        extract($_POST);

        $tblquery = "INSERT INTO users VALUES(:id, :name, :email, :username, :password, :date)";
        $tblvalue = array(
            ':id' => null,
            ':name' => htmlspecialchars($name),
            ':email' => htmlspecialchars($email),
            ':username' => htmlspecialchars($username),
            ':password' => htmlspecialchars($password),
            ':date' => date("Y-m-d")
        );
        // print_r($tblvalue);
        $insert = $collect->tbl_insert($tblquery, $tblvalue);
        if($insert){
            echo "
                <div class='alert alert-success text-center text-muted' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Your account</strong> has been created.
                </div>
            ";
        }
    }
    if($_POST['login']){
        extract($_POST);

        $tblquery = "SELECT * FROM users WHERE username = :username && password = :password";
        $tblvalue = array(
            ':username' => htmlspecialchars($username),
            ':password' => htmlspecialchars($password)
        );
        $select = $collect->tbl_select($tblquery, $tblvalue);
        if($select){
            $_SESSION['username'] = $username;
            echo "
                <div class='alert alert-success text-center text-muted' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    Your are logged in.
                </div>
            ";
        }else{
            echo "
                <div class='alert alert-danger text-center text-muted' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    This account doesn't exit, Please Sign Up to create an account thank you.
                </div>
            ";
        }
    }
    if($_POST['send']){

        extract($_POST);

        if($_SESSION['username'] != ''){
            $tblquery = "INSERT INTO msg VALUES(:id, :name, :email, :head, :msg, :date)";
            $tblvalue = array(
                ':id' => null,
                ':name' => htmlspecialchars($name),
                ':email' => htmlspecialchars($email),
                ':head' => htmlspecialchars($subject),
                ':msg' => htmlspecialchars($message),
                ':date' => date("Y-m-d")
            );
            // print_r($tblvalue);
            $insert = $collect->tbl_insert($tblquery, $tblvalue);
            if($insert){
                echo "
                    <div class='alert alert-success text-center text-muted' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        <strong>Your message</strong> has been sent, we will reply you shortly, Thank you.
                    </div>
                ";
            }
        }else{
            echo "
                <div class='alert alert-danger text-center text-muted' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    Please you need to login before you can leave us a message.
                </div>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <!-- Head Section-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
      <title>ARO Tech Compliant and Feedback Analysis</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/unicons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Main Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>

  <!-- Body Section-->
  <body>
    <!-- Navigation Section -->
    <nav class="navbar navbar-expand-sm navbar-light">
      <div class="container">
        <a class="navbar-brand" href="index.html"><i class='uil uil-user'></i> Aro Tech </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a href="#about" class="nav-link"><span data-hover="About Us">About Us</span></a>
            </li>
            <li class="nav-item">
              <a href="#services" class="nav-link"><span data-hover="Our Services">Our Services</span></a>
            </li>
            <li class="nav-item">
              <a href="#project" class="nav-link"><span data-hover="Projects">Projects</span></a>
            </li>
            <li class="nav-item">
              <a href="#contact" class="nav-link"><span data-hover="Contact Us">Contact Us</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#loginModal" aria-hidden="true" style="cursor:pointer;">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#signUpModal" aria-hidden="true" style="cursor:pointer;">Register</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-lg-auto">
            <div class="ml-lg-4">
              <div class="color-mode d-lg-flex justify-content-center align-items-center">
                <i class="color-mode-icon"></i>
                Color Mode
              </div>
            </div>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Modal PopUp for Login and SignUp Section -->
        <!-- Login Modal -->
        <div class="modal fade mt-5" id="loginModal" tabindex="1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <form action="index.php" method="POST" id="login-form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="loginModal">Please Login</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="user">Username:</label>
                            <input type="text" name="username" id="user" placeholder="Enter username..." required>

                            <label for="passw">Password:</label>
                            <input type="password" name="password" id="passw" placeholder="Enter password..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="close-btn" data-dismiss="modal">Close</button>
                            <input type="submit" name="login" value="Login">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Sign Up Modal -->
        <div class="modal fade mt-5" id="signUpModal" tabindex="1" role="dialog" aria-labelledby="signUpModal" aria-hidden="true">
            <form action="index.php" method="POST" id="login-form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="signUpModal">Please Sign Up</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="fullname">FullName:</label>
                            <input type="text" name="name" id="fullname" placeholder="Enter Fullname..." required>

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" placeholder="Enter email..." required>

                            <label for="userName">Username:</label>
                            <input type="text" name="username" id="userName" placeholder="Enter username..." required>

                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" placeholder="Enter password..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="close-btn" data-dismiss="modal">Close</button>
                            <input type="submit" name="signUp" value="Sign Up">
                        </div>
                    </div>
                </div>
            </form>
        </div>


    <!-- About Us Section -->
    <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="about">
      <div class="container">
        <div class="row">         
          <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center">
            <div class="about-text">
              <small class="small-text">Welcome to <span class="mobile-block">Our Website!</span></small>
              <h1 class="animated animated-text">
              <span class="mr-2">We Offer The Best</span><br>
              <div class="animated-info">
                <span class="animated-item">Web and App Development</span>
                <span class="animated-item">Graphics and UX/UI Design</span>
                <span class="animated-item">SEO and Digital Marketing</span>                               
              </div><br>
              <span class="mr-2">Services To Our Customers</span>
              </h1>
              <p>Building a Successful 'Brand' is a Challenge. We Can Help You Build Your Brands with Our Experience Designs and Web Development.</p>
              <p>We Can Help You Advertise and Market Your Brands.</p>
            </div>
          </div>
          <div class="col-lg-5 col-md-12 col-12">
            <div class="about-image svg">
              <img src="images/undraw/undraw_software_engineer_lvl5.svg" class="img-fluid" alt="svg image">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Services Section -->
    <section class="project py-5" id="services">
      <div class="container">
        <div class="text-center">
          <h2 class="subhead">Our Services</h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/web_development.svg" alt="">
              </div>
              <h5>Web Development</h5>
            </div>
          </div>       
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/graphics_design.svg" alt="">
              </div>
              <h5>Graphics Design</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/seo_and_marketing.svg" alt="">
              </div>
              <h5>SEO and Marketing</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/customer_services.svg" alt="">
              </div>
              <h5>Customer Services</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/app_development.svg" alt="">
              </div>
              <h5>App Development</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/ui_ux_design.svg" alt="">
              </div>
              <h5>UX/UI Design</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/product_design.svg" alt="">
              </div>
              <h5>Product Design</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
            <div class="text-center">
              <div class="img-fluid mb-4">
                <img src="images/icons/data_analyst.svg" alt="">
              </div>
              <h5>Data Analytics</h5>
            </div>
          </div>
        </div>
      </div> 
    </section> 

    <!-- Our Recent Projects Section (Sub-Services) -->
    <section class="project py-5" id="project">
      <div class="container">         
        <div class="row">
          <div class="col-lg-11 text-center mx-auto col-12">
            <div class="col-lg-8 mx-auto">
              <h2>Take A Look On Our Recent Projects</h2>
            </div>
            <div class="owl-carousel owl-theme">
              <div class="item">
                <div class="project-info">
                  <img src="images/project/project-image01.png" class="img-fluid" alt="project image">
                </div>
              </div>
              <div class="item">
                <div class="project-info">
                  <img src="images/project/project-image02.png" class="img-fluid" alt="project image">
                </div>
              </div>
              <div class="item">
                <div class="project-info">
                  <img src="images/project/project-image03.png" class="img-fluid" alt="project image">
                </div>
              </div>
              <div class="item">
                <div class="project-info">
                  <img src="images/project/project-image04.png" class="img-fluid" alt="project image">
                </div>
              </div>
              <div class="item">
                <div class="project-info">
                  <img src="images/project/project-image05.png" class="img-fluid" alt="project image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>           
    </section>

    <!-- Testimonial Section-->
    <section class="project py-5" id="testimonials" >
      <div class="container">       
        <div class="text-center">
          <h2 class="subhead">Our Services</h2>
        </div>           
        <div class="row justify-content-center">
          <div class="col-lg-8">          
            <div class="owl-carousel testimonials-carousel wow fadeInUp">               
              <div class="testimonial-item">
                <img src="images/testimonial/testimonial-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <p>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</p>
              </div>                
              <div class="testimonial-item">
                <img src="images/testimonial/testimonial-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <p>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</p>
              </div>                  
              <div class="testimonial-item">
                <img src="images/testimonial/testimonial-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <p>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</p>
              </div>                 
              <div class="testimonial-item">
                <img src="images/testimonial/testimonial-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <p>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</p>
              </div>                  
              <div class="testimonial-item">
                <img src="images/testimonial/testimonial-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <p>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</p>
              </div>
            </div>
          </div>
        </div>             
      </div>
    </section>
              
    <!-- Team Section -->
    <section class="project py-5" id="team">
      <div class="container">
        <div class="section-header">
          <h3>Team</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>             
        <div class="row">            
          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="img/team-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Walter White</h4>
                  <span>Chief Executive Officer</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>           
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="member">
              <img src="img/team-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Sarah Jhonson</h4>
                  <span>Product Manager</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>         
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="member">
              <img src="img/team-3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>William Anderson</h4>
                  <span>CTO</span>
                    <div class="social">
                      <a href=""><i class="fa fa-twitter"></i></a>
                      <a href=""><i class="fa fa-facebook"></i></a>
                      <a href=""><i class="fa fa-google-plus"></i></a>
                      <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
              <div class="member">
                <img src="img/team-4.jpg" class="img-fluid" alt="">
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Amanda Jepson</h4>
                    <span>Accountant</span>
                    <div class="social">
                      <a href=""><i class="fa fa-twitter"></i></a>
                      <a href=""><i class="fa fa-facebook"></i></a>
                      <a href=""><i class="fa fa-google-plus"></i></a>
                      <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>        
          </div>     
        </div>
      </section>
              
      <!-- Clients Section -->
      <section class="project py-5" id="clients">            
        <div class="container">            
          <div class="section-header">
            <h3>Our CLients</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque dere santome nida.</p>
          </div>    
          <div class="row no-gutters clients-wrap clearfix wow fadeInUp">         
            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo">
                <img src="img/clients/client-1.png" class="img-fluid" alt="">
              </div>
            </div>            
            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo">
                <img src="img/clients/client-2.png" class="img-fluid" alt="">
              </div>
            </div>                      
            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo">
                <img src="img/clients/client-3.png" class="img-fluid" alt="">
              </div>
            </div>                  
            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo">
                <img src="img/clients/client-4.png" class="img-fluid" alt="">
              </div>
            </div>                  
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="img/clients/client-5.png" class="img-fluid" alt="">
            </div>
          </div>             
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="img/clients/client-6.png" class="img-fluid" alt="">
            </div>
          </div>                      
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="img/clients/client-7.png" class="img-fluid" alt="">
            </div>
          </div>                      
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="img/clients/client-8.png" class="img-fluid" alt="">
            </div>
          </div>           
        </div>      
      </div>              
    </section>

    <!-- Contact Section -->
    <section class="contact py-5" id="contact">
      <div class="container">
        <div class="row">
          <!-- Reviews Form-->
          <div class="col-lg-6 col-12">
            <div class="contact-form">
              <h2 class="mb-4">Send Your Reviews</h2>          
              <form action="index.php" method="POST">
                <div class="row">
                  <div class="col-12">
                    <input type="text" class="form-control" name="name" placeholder="Your Name" id="name">
                  </div>
                  <div class="col-12">
                    <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                  </div>
                  <div class="col-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" id="text">
                  </div>
                  <div class="col-12">
                    <textarea name="message" rows="24" class="form-control" id="message" placeholder="Message"></textarea>
                  </div>
                  <div class="ml-lg-auto col-lg-5 col-12">
                    <input type="submit" name="send" class="form-control submit-btn" value="Send Message">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>              
    </section>

    <!-- Footer Section -->
    <footer class="footer py-5" id="footer">
      <div class="container">
        <div class="contact-info d-flex justify-content-between align-items-center py-4 px-lg-5">
          <div class="contact-info-item">
            <h3 class="mb-3 text-white">Contact</h3>
            <p><a href="whatsappto:+2340898344373">+2348098344373</a></p>
            <p><a href="mailto:richyamadi@gmail.com">richyamadi@gmail.com</a></p>
          </div>
            <ul class="social-links">
              <li><a href="#" class="uil uil-facebook" data-toggle="tooltip" data-placement="left" title="Facebook"></a></li>
              <li><a href="#" class="uil uil-instagram" data-toggle="tooltip" data-placement="left" title="Instagram"></a></li>
              <li><a href="#" class="uil uil-youtube" data-toggle="tooltip" data-placement="left" title="Youtube"></a></li>
            </ul>
            <p class="copyright-text text-center">Copyright &copy; 2021 ARO Tech. All rights reserved</p> <br>
            <p class="copyright-text text-center">Designed by <a rel="nofollow" href="https://www.arotech.com">Amadi Richman O.</a></p>
          </div>
        </div>              
      </div>
    </footer>

     <!-- JavaScript Links Sections -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>