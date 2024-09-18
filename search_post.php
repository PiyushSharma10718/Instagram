<?php include("includes/header.php"); ?>

<?php

include("db/connection.php");

if (isset($_POST['search_input']) && $_POST['search_input'] != "") {

    $search_input = $_POST['search_input'];
    $search_param = "%" . $search_input . "%";

    $stmt = $con->prepare("SELECT * FROM posts WHERE caption LIKE ? OR hashtags LIKE ? LIMIT 12");
    $stmt->bind_param("ss", $search_input, $search_param);
    $stmt->execute();
    $posts = $stmt->get_result();
} else {
    // default kayeord !
    $search_input = "nature";
    $search_param = "%" . $search_input . "%";

    $stmt = $con->prepare("SELECT * FROM  posts WHERE caption LIKE ? OR hashtags LIKE ? LIMIT 12");
    $stmt->bind_param("ss", $search_input, $search_param);
    $stmt->execute();
    $posts = $stmt->get_result();
}

?>

<main>
    <div class="discover-container">
        <div class="gallery">

            <?php foreach ($posts as $post) { ?>

                <div class="gallery-item">
                    <img src="<?php echo "Assets/Images/" . $post['image']; ?>" class="gallery-image" alt="">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes">
                                <span class="hide-gallery-element">
                                    <?php echo $post['likes']; ?>
                                </span>
                                <i class="fas fa-heart"></i>
                            </li>
                            <li class="gallery-item-comments">
                                <span class="hide-gallery-element">
                                    <a href="single_post.php?post_id=<?php echo $post['id']; ?>" style="color: #fff;">
                                        <i class="fas fa-comment"></i>
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</main>


<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/  dist/js/bootstrap.min.js"> </script>
</body>

</html>