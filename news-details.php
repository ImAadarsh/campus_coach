<?php
include "include/connect.php";

// Get the blog post ID from the URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific blog post
$post_query = "SELECT b.*, bc.name as category_name 
               FROM blogs b 
               LEFT JOIN blog_categories bc ON b.category_id = bc.id 
               WHERE b.id = $post_id AND b.is_deleted = 0";
$post_result = mysqli_query($connect, $post_query);
$post = mysqli_fetch_assoc($post_result);

// If post not found, redirect to the blog list page
if (!$post) {
    header("Location: news.php");
    exit();
}

// Increment visit count
$update_visit = "UPDATE blogs SET visit = visit + 1 WHERE id = $post_id";
mysqli_query($connect, $update_visit);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/meta.php" ?>
    <title><?php echo htmlspecialchars($post['title']); ?> | Campus Coach</title>
</head>
<body>
    <?php include "include/loader.php" ?>
    <?php include "include/canvas.php" ?>
    <?php include "include/header_sub.php" ?>

    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb.png');">
        <!-- ... (keep existing breadcrumb code) ... -->
        <div class="container">
            <div class="page-heading">
                <h1 class="wow fadeInUp" data-wow-delay=".3s">Blog Details</h1>
                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                    <li><a href="index.php">Home</a></li>
                    <li><i class="fas fa-chevron-right"></i></li>
                    <li>Blog Details</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- News Details Section Start -->
    <section class="news-details fix section-padding">
        <div class="container">
            <div class="news-details-area">
                <div class="row g-5">
                    <div class="col-12 col-lg-8">
                        <div class="blog-post-details">
                            <div class="single-blog-post">
                                <div class="post-featured-thumb bg-cover" style="background-image: url('<?php echo $uri . $post['banner']; ?>');"></div>
                                <div class="post-content">
                                    <ul class="post-list d-flex align-items-center">
                                        <li><i class="fa-regular fa-user"></i> <?php echo htmlspecialchars($post['author_name']); ?></li>
                                        <li><i class="fa-solid fa-calendar-days"></i> <?php echo date('d M, Y', strtotime($post['created_at'])); ?></li>
                                        <li><i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($post['category_name']); ?></li>
                                    </ul>
                                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                                    <div style="text-align: justify;">
                                        <?php
                                        // Process the content to add inline styles to images
                                        $content = $post['content'];
                                        $content = preg_replace('/<img(.*?)>/i', '<img$1 style="max-width: 100%; height: auto;">', $content);
                                        echo $content;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tags and Share -->
                            <div class="row tag-share-wrap mt-4 mb-5">
                                <div class="col-lg-8 col-12">
                                    <div class="tagcloud">
                                        <?php
                                        $tags = explode(',', $post['tags']);
                                        foreach ($tags as $tag) {
                                            echo '<a href="news.php?tag=' . urlencode(trim($tag)) . '">' . htmlspecialchars(trim($tag)) . '</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mt-3 mt-lg-0 text-lg-end">
                                    <div class="social-share">
                                        <span class="me-3">Share:</span>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>                                    
                                    </div>
                                </div>
                            </div>

                            <!-- Comments section can be added here if needed -->

                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="main-sidebar">
                            <!-- Search Widget -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Search</h3>
                                </div>
                                <div class="search-widget">
                                    <form action="news.php" method="GET">
                                        <input type="text" name="search" placeholder="Search here">
                                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </form>
                                </div>
                            </div>

                            <!-- Categories Widget -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="news-widget-categories">
                                    <ul>
                                        <?php
                                        $cat_query = "SELECT bc.id, bc.name, COUNT(b.id) as post_count 
                                                      FROM blog_categories bc 
                                                      LEFT JOIN blogs b ON bc.id = b.category_id 
                                                      GROUP BY bc.id 
                                                      ORDER BY bc.name";
                                        $cat_result = mysqli_query($connect, $cat_query);
                                        while ($category = mysqli_fetch_assoc($cat_result)) {
                                            echo '<li><a href="news.php?category_id=' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</a> <span>(' . $category['post_count'] . ')</span></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recent Post Widget -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Recent Post</h3>
                                </div>
                                <div class="recent-post-area">
                                    <?php
                                    $recent_query = "SELECT * FROM blogs WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT 3";
                                    $recent_result = mysqli_query($connect, $recent_query);
                                    while ($recent_post = mysqli_fetch_assoc($recent_result)) {
                                    ?>
                                        <div class="recent-items">
                                            <div class="recent-thumb">
                                                <img width="90" src="<?php echo $uri . $recent_post['icon']; ?>" alt="<?php echo htmlspecialchars($recent_post['title']); ?>">
                                            </div>
                                            <div class="recent-content">
                                                <ul>
                                                    <li>
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        <?php echo date('d M, Y', strtotime($recent_post['created_at'])); ?>
                                                    </li>
                                                </ul>
                                                <h6>
                                                    <a href="news-details.php?id=<?php echo $recent_post['id']; ?>">
                                                        <?php echo htmlspecialchars($recent_post['title']); ?>
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Tags Widget -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h3>Tags</h3>
                                </div>
                                <div class="news-widget-categories">
                                    <div class="tagcloud">
                                        <?php
                                        $tags_query = "SELECT DISTINCT tags FROM blogs WHERE is_deleted = 0 AND tags != ''";
                                        $tags_result = mysqli_query($connect, $tags_query);
                                        $all_tags = [];
                                        while ($tag_row = mysqli_fetch_assoc($tags_result)) {
                                            $tags = explode(',', $tag_row['tags']);
                                            foreach ($tags as $tag) {
                                                $tag = trim($tag);
                                                if (!empty($tag)) {
                                                    $all_tags[] = $tag;
                                                }
                                            }
                                        }
                                        $all_tags = array_unique($all_tags);
                                        foreach ($all_tags as $tag) {
                                            echo '<a href="news.php?tag=' . urlencode($tag) . '">' . htmlspecialchars($tag) . '</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "include/footer.php" ?>
    <?php include "include/script.php" ?>
</body>
</html>