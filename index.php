<?php
get_header();
?>

<section id="slider_panel">
    <div class="wrapper">
    <?php if (is_active_sidebar('slider-sidebar')) {
        dynamic_sidebar('slider-sidebar');
    } else {
    ?>

        <div id="slider">

            <!-- Begin Slider Content -->

                <div class="slide1">
                    <div class="lower_left">

                        <h1>Welcome to the Vein Specialists</h1>

                        <p>At the Vein Specialists Clinic in Monterey we do veins, we only do veins, and we do them all
                            day long every day. In fact, we’re world-renowned – we’ve written the book on it!</p>

                    </div>
                </div>
                <!--End Slider Content -->

        </div>
        <aside id="response_form">
            <h2>Request More Information</h2>

            <form>
                <input type="text" id="name" name="name" value="Name" class="textbox">
                <input type="email" id="email" name="email" value="Email Address" class="textbox">
                <input type="tel" id="phone" name="phone" value="Daytime Telephone" class="textbox">
                <select id="appointment" name="appointment">
                    <option>Preferred Appointment Time</option>
                    <option>Not Applicable</option>
                    <option>Morning (8am&ndash;10am)</option>
                    <option>Late Morning (10am&ndash;12pm)</option>
                    <option>Afternoon (1pm&ndash;3pm)</option>
                    <option>Late Afternoon (3pm&ndash;5pm)</option>
                </select>
                <textarea id="comments" name="comments" class="textbox">Comments</textarea>

                <p><input type="submit" value="Request a Consultation"></p>
            </form>
            <p class="small align_center">Read our <a href="#">No Spam Policy</a></p>
        </aside>

    <?php } ?>
    </div>
    <div class="shadow"/>
</section>

<!--Begin Button Bar -->
<section class="button_bar clearfix">
    <div class="wrapper">
     <?php if (is_active_sidebar('homepage-sidebar')) {
    dynamic_sidebar('homepage-sidebar');
     } ?>
</div>
</section>
<!--End Button Bar-->

<section class="full_width_container clearfix">
    <?php $page = get_posts(
        array(
            'name'      => 'home',
            'post_type' => 'page'
        )
    );
    if ( $page )
    {
        echo do_shortcode($page[0]->post_content);
    }else{
    ?>
    <!--Begin Main Content Block-->
    <div class="one_third">
        <img src="images/feature-1.jpg" alt="" class="frame1"/>

        <h2>We've got the experience to help you look and feel your best.</h2>

        <p>Each year, we help thousands of patients eliminate ugly, embarrassing and painful varicose veins and regain
            their former lifestyles.</p>
        <a class="small_button accent_color1" href="#">MORE</a>
    </div>
    <div class="one_third">
        <img src="images/feature-2.jpg" alt="" class="frame1"/>

        <h2>Advanced technology and specialized training mean excellent results.</h2>

        <p>With the most technologically advanced, highest quality equipment in our area, we offer you state-of-the-art,
            noninvasive treatments for a variety of vascular diseases and disorders.</p>
        <a class="small_button accent_color1" href="#">MORE</a>
    </div>
    <div class="one_third">
        <img src="images/feature-3.jpg" alt="" class="frame1"/>

        <h2>Our team of doctors is the best of the best.</h2>

        <p>Our doctors are highly specialized and have received specialty training in a wide variety of non-invasive,
            non-surgical vein treatments. Each is board certified in vein treatments through a vascular specialty board
            organization.</p>
        <a class="small_button accent_color1" href="#">MORE</a>
    </div>
    <!--End Main Content Block-->
<?php
}
echo '</section>';
get_footer();
?>


