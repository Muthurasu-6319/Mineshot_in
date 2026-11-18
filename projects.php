<?php 
include("header.php");
require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/config/cloudinary.php";

$dbGallery = [];
$pdo = getDBConnection();
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM projects_gallery ORDER BY display_order ASC, created_at DESC");
        $dbGallery = $stmt->fetchAll();
    } catch (Exception $e) {
        $dbGallery = [];
    }
}
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

    <!-- Our Services -->
    <section class="portfolio-page-section">
        <div class="container">
            <div class="wptb-project--inner">
                <div class="has-radius"> 

                    <div class="portfolio-masonry-container row">
                        <div class="portfolio-grid-sizer col-lg-4 col-md-6 col-12"></div>

                        <?php if (!empty($dbGallery)): ?>
                            <?php foreach ($dbGallery as $item): ?>
                                <div class="col-lg-4 col-md-6 col-12 mb-4">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <img src="<?= htmlspecialchars(optimizeCloudinaryUrl($item['image_url'], 900)) ?>" alt="<?= htmlspecialchars($item['title'] ?: 'Commercial Photography & Video Production Portfolio - Mineshot Chennai') ?>" loading="lazy" decoding="async">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include("footer.php") ?>

<script>
$(window).on('load', function() {
    var $grid = $('.portfolio-masonry-container');
    if ($grid.length) {
        $grid.imagesLoaded(function() {
            $grid.isotope({
                itemSelector: '.portfolio-masonry-container > div[class*="col-"]:not(.portfolio-grid-sizer)',
                percentPosition: true,
                layoutMode: 'masonry',
                masonry: {
                    columnWidth: '.portfolio-grid-sizer'
                }
            });
        });
    }
});
</script>