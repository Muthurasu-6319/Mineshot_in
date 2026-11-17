<?php
// build_static.php - Static Site Generator for Mineshot
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/cloudinary.php';

// Configure SSL CA cert for local Windows execution
$host = env('DB_HOST');
$port = env('DB_PORT', 4000);
$user = env('DB_USER');
$pass = env('DB_PASSWORD');
$name = env('DB_NAME', 'mineshot_db');
$ca = 'C:\\xampp\\apache\\bin\\curl-ca-bundle.crt';

$dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_TIMEOUT => 10,
    PDO::MYSQL_ATTR_SSL_CA => $ca,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
];

$allGallery = [];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->query("SELECT * FROM projects_gallery ORDER BY display_order ASC, created_at DESC");
    $allGallery = $stmt->fetchAll();
    echo "Fetched " . count($allGallery) . " images from Cloudinary / TiDB Cloud.\n";
} catch (Throwable $e) {
    echo "DB Warning: " . $e->getMessage() . "\n";
}

// 1. Generate index.html
$_SERVER['HTTP_HOST'] = 'mineshot.in';
$_SERVER['HTTPS'] = 'on';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['PHP_SELF'] = '/index.php';

ob_start();
include __DIR__ . '/header.php';
?>
<!-- Main Wrapper-->
<main class="wrapper">
    <!-- Slider Section -->
    <section class="wptb-slider style2">
        <div class="swiper-container wptb-swiper-slider-two">
            <!-- swiper slides -->
            <div class="swiper-wrapper">
                <!-- Slide Item -->
                <div class="swiper-slide">
                    <div class="wptb-slider--item">
                        <div class="wptb-slider--image"
                            style="background-image: url('assets/img/mineshot/banner-1.jpg');">
                        </div>
                        <div class="wptb-slider--inner">
                            <!-- Layer Image -->
                            <div class="wptb-item-layer wptb-item-layer-one">
                                <img src="assets/img/slider/layer-3.png" alt="img">
                            </div>
                            <div class="wptb-heading">
                                <div class="wptb-item--inner">
                                    <h1 class="wptb-item--title">Production Hub</h1>
                                    <h6 class="wptb-item--subtitle">Creative Stories, Perfectly Made</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slide Item -->

                <!-- Slide Item -->
                <div class="swiper-slide">
                    <div class="wptb-slider--item">
                        <div class="wptb-slider--image"
                            style="background-image: url('assets/img/mineshot/photography-men.jpg');">
                        </div>
                        <div class="wptb-slider--inner">
                            <!-- Layer Image -->
                            <div class="wptb-item-layer wptb-item-layer-one">
                                <img src="assets/img/slider/layer-3.png" alt="img">
                            </div>
                            <div class="wptb-heading">
                                <div class="wptb-item--inner">
                                    <h1 class="wptb-item--title">Commercial <br>Photography</h1>
                                    <h6 class="wptb-item--subtitle">Capturing Moments Beautifully</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slide Item -->

                <!-- Slide Item -->
                <div class="swiper-slide">
                    <div class="wptb-slider--item">
                        <div class="wptb-slider--image"
                            style="background-image: url('assets/img/mineshot/banner-4.jpg');">
                        </div>
                        <div class="wptb-slider--inner">
                            <!-- Layer Image -->
                            <div class="wptb-item-layer wptb-item-layer-one">
                                <img src="assets/img/slider/layer-3.png" alt="img">
                            </div>
                            <div class="wptb-heading">
                                <div class="wptb-item--inner">
                                    <h1 class="wptb-item--title">Music & <br>Voice-over</h1>
                                    <h6 class="wptb-item--subtitle">Hear the Difference in Sound</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slide Item -->

                <!-- Slide Item -->
                <div class="swiper-slide">
                    <div class="wptb-slider--item">
                        <div class="wptb-slider--image"
                            style="background-image: url('assets/img/mineshot/banner-3.jpg');">
                        </div>
                        <div class="wptb-slider--inner">
                            <!-- Layer Image -->
                            <div class="wptb-item-layer wptb-item-layer-one">
                                <img src="assets/img/slider/layer-3.png" alt="img">
                            </div>
                            <div class="wptb-heading">
                                <div class="wptb-item--inner">
                                    <h1 class="wptb-item--title">Videography <br>Commercial</h1>
                                    <h6 class="wptb-item--subtitle">Cinematic Commercials, Impactful Storytelling</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slide Item -->

                <!-- Slide Item -->
                <div class="swiper-slide">
                    <div class="wptb-slider--item">
                        <div class="wptb-slider--image"
                            style="background-image: url('assets/img/mineshot/banner-2.jpg');">
                        </div>
                        <div class="wptb-slider--inner">
                            <!-- Layer Image -->
                            <div class="wptb-item-layer wptb-item-layer-one">
                                <img src="assets/img/slider/layer-3.png" alt="img">
                            </div>
                            <div class="wptb-heading">
                                <div class="wptb-item--inner">
                                    <h1 class="wptb-item--title">Editing & CGI</h1>
                                    <h6 class="wptb-item--subtitle">Refining Frames, Redefining Realities</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slide Item -->

            </div>
            <!-- swiper pagination -->
            <div class="wptb-swiper-dots">
                <div class="pagination-dots"></div>
            </div>
        </div>
    </section>
    <!-- End Slider Section -->

    <!-- About Company -->
    <section class="about-company style1" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner">
                            <h6 class="wptb-item--subtitle">About us</h6>
                            <h1 class="wptb-item--title">Behind the Lens of Mineshot Hub</h1>
                            <div class="wptb-item--description">
                                Mineshot Production Hub is a creative media house in Chennai specializing in commercial photography, automotive shoots, product and food photography, advertisement films, corporate videos, and high-end post-production services.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="wptb-item--holder text-start">
                        <p class="wptb-item--text">
                            From concept development to final delivery, we combine cinematic aesthetics with storytelling to produce visuals that elevate brands.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="wptb-services style2" id="services">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">Services</h6>
                    <h1 class="wptb-item--title">What We Offer</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="wptb-service--item">
                        <h4 class="wptb-item--title">Commercial Photography</h4>
                        <p>Automotive, brand campaigns, fashion, and e-commerce catalogue photography designed to capture attention.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="wptb-service--item">
                        <h4 class="wptb-item--title">Commercial Videography</h4>
                        <p>High-end advertisement films, TV commercials, digital promotions, and corporate video production in Chennai.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="wptb-service--item">
                        <h4 class="wptb-item--title">Product & Food Shoots</h4>
                        <p>Precision-lit product shots, menu aesthetics, and commercial packaging imagery tailored for high conversions.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="wptb-service--item">
                        <h4 class="wptb-item--title">Editing & CGI</h4>
                        <p>Advanced color grading, visual effects (VFX), 3D product animation, and comprehensive post-production workflows.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="wptb-service--item">
                        <h4 class="wptb-item--title">Music & Audio Works</h4>
                        <p>Studio recording, mixing, mastering, custom background score, and voice-over production services.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="wptb-service--item">
                        <h4 class="wptb-item--title">Creative Direction</h4>
                        <p>End-to-end production management, location scouting, set design, and creative supervision from concept to wrap.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Portfolio Preview -->
    <section class="wptb-portfolio-grid" id="projects">
        <div class="container">
            <div class="wptb-heading text-center">
                <h6 class="wptb-item--subtitle">Portfolio</h6>
                <h1 class="wptb-item--title">Featured Works</h1>
                <p>A showcase of our recent commercial photography and production projects in Chennai.</p>
            </div>
            <div class="home-portfolio-masonry row">
                <div class="portfolio-grid-sizer col-lg-4 col-md-6 col-12"></div>
                <?php 
                $homeItems = array_slice($allGallery, 0, 9);
                if (!empty($homeItems)):
                    foreach ($homeItems as $item):
                        $imgUrl = optimizeCloudinaryUrl($item['image_url'], 800);
                        $title = htmlspecialchars($item['title'] ?: 'Commercial Photography Portfolio - Mineshot Chennai');
                ?>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= $title ?>" loading="lazy" decoding="async">
                            </div>
                        </div>
                    </div>
                <?php endforeach; else: ?>
                    <!-- Local Fallback Images -->
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image"><img src="assets/img/mineshot/gallery/gallery (2).jpeg" alt="Commercial Photography Chennai"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image"><img src="assets/img/mineshot/gallery/gallery (3).jpeg" alt="Commercial Photography Chennai"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image"><img src="assets/img/mineshot/gallery/gallery (1).jpg" alt="Commercial Photography Chennai"></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="projects" class="btn btn-two">
                    <span class="btn-wrap">
                        <span class="text-first">View All Projects</span>
                        <span class="text-second"><i class="bi bi-arrow-up-right"></i></span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact & Enquiry Section -->
    <section class="wptb-contact-section" id="contact">
        <div class="container">
            <div class="wptb-heading text-center">
                <h6 class="wptb-item--subtitle">Get In Touch</h6>
                <h1 class="wptb-item--title">Let's Create Something Extraordinary</h1>
                <p>Reach out to our team in Chennai for commercial shoots, ad films, and production enquiries.</p>
            </div>
            <div class="row" id="enquiry_form">
                <div class="col-lg-8 offset-lg-2">
                    <div id="enquiryAlert" style="display:none;" class="mb-4"></div>
                    <form class="wptb-form" id="enquiryContactForm">
                        <div class="wptb-form--inner">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="text" name="name" id="eq_name" class="form-control" placeholder="Name*" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="tel" name="phone" id="eq_phone" class="form-control" placeholder="Contact Number*" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="email" name="email" id="eq_email" class="form-control" placeholder="E-mail*" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="date" name="date" id="eq_date" class="form-control" placeholder="Date*" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-4">
                                    <div class="form-group">
                                        <input type="text" name="address" id="eq_address" class="form-control" placeholder="Location / Address">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4">
                                    <div class="form-group">
                                        <textarea name="message" id="eq_message" class="form-control" placeholder="Describe your shoot requirements..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="wptb-item--button text-center">
                                        <button class="btn white-opacity creative text-uppercase" type="submit">
                                            <span class="btn-wrap">
                                                <span class="text-first">Send Enquiry via WhatsApp</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>

<script>
// Instant Client-Side WhatsApp Enquiry Submission
document.getElementById('enquiryContactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var name = document.getElementById('eq_name').value.trim();
    var phone = document.getElementById('eq_phone').value.trim();
    var email = document.getElementById('eq_email').value.trim();
    var date = document.getElementById('eq_date').value.trim();
    var address = document.getElementById('eq_address').value.trim();
    var msg = document.getElementById('eq_message').value.trim();

    var text = "Hello Mineshot Hub! I would like to book/enquire about a shoot:\n\n"
             + "*Name:* " + name + "\n"
             + "*Phone:* " + phone + "\n"
             + "*Email:* " + email + "\n"
             + "*Date:* " + date + "\n";
    if (address) text += "*Location:* " + address + "\n";
    if (msg) text += "*Requirements:* " + msg + "\n";

    var waUrl = "https://wa.me/919962222257?text=" + encodeURIComponent(text);
    
    var alertBox = document.getElementById('enquiryAlert');
    alertBox.className = "alert alert-success";
    alertBox.innerHTML = "<strong>Thank you!</strong> Redirecting to WhatsApp to send your enquiry details directly to Simbhu Sandy (+91 99622 22257)...";
    alertBox.style.display = "block";

    setTimeout(function() {
        window.open(waUrl, '_blank');
    }, 600);
});
</script>
<?php
$indexHtml = ob_get_clean();

// Replace all .php navigation links with clean URLs
$indexHtml = str_replace('href="projects.php"', 'href="projects"', $indexHtml);
$indexHtml = str_replace("href='projects.php'", "href='projects'", $indexHtml);
$indexHtml = str_replace('href="index.php"', 'href="/"', $indexHtml);
$indexHtml = str_replace("href='index.php'", "href='/'", $indexHtml);

file_put_contents(__DIR__ . '/index.html', $indexHtml);
echo "Successfully generated index.html (" . strlen($indexHtml) . " bytes)\n";


// 2. Generate projects.html
$_SERVER['HTTP_HOST'] = 'mineshot.in';
$_SERVER['HTTPS'] = 'on';
$_SERVER['REQUEST_URI'] = '/projects.php';
$_SERVER['PHP_SELF'] = '/projects.php';

ob_start();
include __DIR__ . '/header.php';
?>
<!-- Main Wrapper-->
<main class="wrapper">
    <!-- Page Header -->
    <div class="wptb-page-heading breadcrumb-sec">
        <div class="wptb-item--inner" style="background-image: url('assets/img/mineshot/gallery/gallery (6).jpg');">
            <div class="wptb-item-layer wptb-item-layer-one">
                <img src="assets/img/more/circle.png" alt="img">
            </div>
            <h2 class="wptb-item--title ">Our Projects</h2>
        </div>
    </div>

    <!-- Our Projects Gallery -->
    <section class="portfolio-page-section">
        <div class="container">
            <div class="wptb-project--inner">
                <div class="has-radius"> 
                    <div class="portfolio-masonry-container row">
                        <div class="portfolio-grid-sizer col-lg-4 col-md-6 col-12"></div>
                        <?php if (!empty($allGallery)): ?>
                            <?php foreach ($allGallery as $item): 
                                $imgUrl = optimizeCloudinaryUrl($item['image_url'], 900);
                                $title = htmlspecialchars($item['title'] ?: 'Commercial Photography & Video Production Portfolio - Mineshot Chennai');
                            ?>
                                <div class="col-lg-4 col-md-6 col-12 mb-4">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= $title ?>" loading="lazy" decoding="async">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Static fallback gallery -->
                            <div class="col-lg-4 col-md-6 col-12 mb-4"><div class="wptb-item--inner"><div class="wptb-item--image"><img src="assets/img/mineshot/gallery/gallery (2).jpeg" alt="Portfolio"></div></div></div>
                            <div class="col-lg-4 col-md-6 col-12 mb-4"><div class="wptb-item--inner"><div class="wptb-item--image"><img src="assets/img/mineshot/gallery/gallery (3).jpeg" alt="Portfolio"></div></div></div>
                            <div class="col-lg-4 col-md-6 col-12 mb-4"><div class="wptb-item--inner"><div class="wptb-item--image"><img src="assets/img/mineshot/gallery/gallery (1).jpg" alt="Portfolio"></div></div></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$projectsHtml = ob_get_clean();

$projectsHtml = str_replace('href="projects.php"', 'href="projects"', $projectsHtml);
$projectsHtml = str_replace("href='projects.php'", "href='projects'", $projectsHtml);
$projectsHtml = str_replace('href="index.php"', 'href="/"', $projectsHtml);
$projectsHtml = str_replace("href='index.php'", "href='/'", $projectsHtml);

file_put_contents(__DIR__ . '/projects.html', $projectsHtml);
echo "Successfully generated projects.html (" . strlen($projectsHtml) . " bytes)\n";
