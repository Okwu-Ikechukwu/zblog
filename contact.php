<?php
 include 'partials/header.php';
 ?>
 
 
<br><br><br><br> 
 
 <section class="contact">
        <div class="container contact-container">
             <aside class="contact-aside">
                <div class="aside-image">
                    <img src="img/contact.svg" alt="">
                </div>
                <h2>Contact Us</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique enim culpa 
                    corporis mollitia corrupti sint sed hic exercitationem dolorum quasi.
                </p>
                <ul class="contact-details">
                    <li>
                        <i class="uil uil-phone-times"></i>
                        <h5>+2348145979845</h5>                        
                    </li>
                    <li>
                        <i class="uil uil-envelope"></i>
                        <h5>eikechukwu903@gmail.com</h5>
                    </li>
                    <li>
                        <i class="uil uil-location-point"></i>
                        <h5>Imo, Nigeria</h5>
                    </li>
                </ul>
                <ul class="contact-socials">
                    <li>
                        <a href="https://facebook.com"><i class="uil uil-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="https://instagram.com"><i class="uil uil-instagram"></i></a>
                    </li>
                    <li>
                        <a href="https://uil-twitter.com"><i class="uil uil-twitter"></i></a>
                    </li>
                    <li>
                        <a href="https://linkedin.com"><i class="uil uil-linkedin-alt"></i></a>
                    </li>
                </ul>
             </aside>
             <form action="https://formspree.io/f/mjvdbaby" method="POST" class="contact-form">
                <div class="form-name">
                    <input type="text" name="First Name" placeholder="Enter First Name">
                    <input type="text" name="Last Name" placeholder="Enter Last Name">
                </div>
                <input type="email" name="Email Address" placeholder="Enter Email">
                <textarea name="Message" placeholder="Enter Message" rows="7"></textarea>
                <button type="submit" class="btn1 btn-primary1">Send Message</button>
             </form>
        </div>
    </section>

<?php
 include 'partials/footer.php';
 ?>