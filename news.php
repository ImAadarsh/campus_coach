<?php include "include/connect.php";
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug function
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
function debug_query($connect, $sql) {
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        echo "Query failed: " . mysqli_error($connect) . "<br>";
        echo "SQL: " . $sql . "<br>";
        return false;
    }
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">
    <!--<< Header Area >>-->
    <head>
        <!-- ========== Meta Tags ========== -->
                <?php include "include/meta.php" ?>
        <!-- ======== Page title ============ -->
        <title>Campus Coach | India's Largest In-School Career Mentoring Program for 11th & 12th Grade Students</title>
        
    </head>
    <body>

        <!-- Preloader Start -->
           <?php include "include/loader.php" ?>

        <!-- Offcanvas Area Start -->
  <?php include "include/canvas.php" ?>

        <!-- Header Top Section Start -->
                <?php include "include/header_sub.php" ?>

        <!--<< Breadcrumb Section Start >>-->
        <div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb.png');">
            <div class="line-shape">
                <img src="assets/img/breadcrumb-shape/line.png" alt="shape-img">
            </div>
            <div class="plane-shape float-bob-y">
                <img src="assets/img/breadcrumb-shape/plane.png" alt="shape-img">
            </div>
            <div class="doll-shape float-bob-x">
                <img src="assets/img/breadcrumb-shape/doll.png" alt="shape-img">
            </div>
            <div class="parasuit-shape float-bob-y">
                <img src="assets/img/breadcrumb-shape/parasuit.png" alt="shape-img">
            </div>
            <div class="frame-shape">
                <img src="assets/img/breadcrumb-shape/frame.png" alt="shape-img">
            </div>
            <div class="bee-shape float-bob-x">
                <img src="assets/img/breadcrumb-shape/bee.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="page-heading">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Blog List</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li>
                            Blog 
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="news-standard fix section-padding">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="news-standard-wrapper">
                    <?php
                    // Set the number of results per page
                    $results_per_page = 9;

                    // Get the current page number from the URL, if not set default to 1
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

                    // Calculate the starting limit of the results
                    $start_from = ($page - 1) * $results_per_page;

                    // Build the base SQL query
                    $sql = "SELECT b.*, bc.name as category_name FROM blogs b LEFT JOIN blog_categories bc ON b.category_id = bc.id WHERE b.is_deleted = 0";

                    // Apply filters
                    if (isset($_GET['category_id'])) {
                        $cat = mysqli_real_escape_string($connect, $_GET['category_id']);
                        $sql .= " AND b.category_id = $cat";
                    } elseif (isset($_GET['search'])) {
                        $key = mysqli_real_escape_string($connect, trim($_GET["search"]));
                        $sql .= " AND (b.title LIKE '%$key%' OR b.content LIKE '%$key%' OR b.subtitle LIKE '%$key%' OR b.author_name LIKE '%$key%')";
                    } elseif (isset($_GET['tag'])) {
                        $key = mysqli_real_escape_string($connect, trim($_GET["tag"]));
                        $sql .= " AND b.tags LIKE '%$key%'";
                    }

                    // Get the total number of results
                    $total_results = $connect->query($sql)->num_rows;

                    // Modify the SQL query to limit the number of results per page
                    $sql .= " ORDER BY b.created_at DESC LIMIT $start_from, $results_per_page";
                    $results = $connect->query($sql);

                    if ($results->num_rows > 0) {
                        while ($post = $results->fetch_assoc()) {
                            ?>
                            <div class="news-standard-items">
                                <div class="news-thumb">
                                    <img src="<?php echo $uri . $post['icon'] ?>" alt="<?php echo htmlspecialchars($post['title']) ?>">
                                    <div class="post">
                                        <span><?php echo htmlspecialchars($post['category_name']) ?></span>
                                    </div>
                                </div>
                                <div class="news-content">
                                    <ul>
                                        <li>
                                            <i class="fas fa-calendar-alt"></i>
                                            <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                                        </li>
                                        <li>
                                            <i class="far fa-user"></i>
                                            By <?php echo htmlspecialchars($post['author_name']) ?>
                                        </li>
                                    </ul>
                                    <h3>
                                        <a href="news-details.php?id=<?php echo $post['id'] ?>"><?php echo htmlspecialchars($post['title']) ?></a>
                                    </h3>
                                    <p><?php echo htmlspecialchars($post['subtitle']) ?></p>
                                    <a href="news-details.php?id=<?php echo $post['id'] ?>" class="theme-btn mt-4">
                                        Read More
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }

                        // Pagination
                        $total_pages = ceil($total_results / $results_per_page);
                        if ($total_pages > 1) {
                            ?>
                            <div class="page-nav-wrap pt-5 text-center">
                                <ul>
                                    <?php
                                    $url = '?';
                                    if (isset($_GET['category_id'])) $url .= 'category_id=' . $_GET['category_id'] . '&';
                                    if (isset($_GET['search'])) $url .= 'search=' . urlencode($_GET['search']) . '&';
                                    if (isset($_GET['tag'])) $url .= 'tag=' . urlencode($_GET['tag']) . '&';
                                    
                                    if ($page > 1) {
                                        echo '<li><a class="page-numbers" href="' . $url . 'page=' . ($page - 1) . '"><i class="fa-solid fa-arrow-left-long"></i></a></li>';
                                    }
                                    
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        echo '<li><a class="page-numbers' . ($page == $i ? ' current' : '') . '" href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    
                                    if ($page < $total_pages) {
                                        echo '<li><a class="page-numbers" href="' . $url . 'page=' . ($page + 1) . '"><i class="fa-solid fa-arrow-right-long"></i></a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>No blog posts found.</p>';
                    }
                    ?>
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
                                <form action="" method="GET">
                                    <input type="text" name="search" placeholder="Search here" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>

                        <!-- Categories Widget -->
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

            $cat_result = debug_query($connect, $cat_query);
            if ($cat_result) {
                if (mysqli_num_rows($cat_result) > 0) {
                    while ($category = mysqli_fetch_assoc($cat_result)) {
                        echo '<li><a href="?category_id=' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</a> <span>(' . $category['post_count'] . ')</span></li>';
                    }
                } else {
                    echo '<li>No categories found</li>';
                }
            } else {
                echo '<li>Error fetching categories</li>';
            }
            ?>
        </ul>
    </div>
</div>


                        <!-- Recent Posts Widget -->
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>Recent Post</h3>
                            </div>
                            <div class="recent-post-area">
                                <?php
                                $recent_query = "SELECT * FROM blogs WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT 3";
                                $recent_result = $connect->query($recent_query);
                                while ($recent_post = $recent_result->fetch_assoc()) {
                                    ?>
                                    <div class="recent-items">
                                        <div class="recent-thumb">
                                            <img width="80" src="<?php echo $uri . $recent_post['icon'] ?>" alt="<?php echo htmlspecialchars($recent_post['title']) ?>">
                                        </div>
                                        <div class="recent-content">
                                            <ul>
                                                <li>
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <?php echo date('F j, Y', strtotime($recent_post['created_at'])); ?>
                                                </li>
                                            </ul>
                                            <h6>
                                                <a href="news-details.php?id=<?php echo $recent_post['id'] ?>">
                                                    <?php echo htmlspecialchars($recent_post['title']) ?>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
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
                                    $tags_result = $connect->query($tags_query);
                                    $all_tags = [];
                                    while ($tag_row = $tags_result->fetch_assoc()) {
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
                                        echo '<a href="?tag=' . urlencode($tag) . '">' . htmlspecialchars($tag) . '</a>';
                                    }
                                    ?>
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