<?php
session_start();
include '../partials/header.php';

// Path to the reviews JSON file

$reviewsFile = '../data/reviews.json';

function fetchReviews($reviewsFile) {
    $reviewsJson = file_get_contents($reviewsFile);
    $reviewsData = json_decode($reviewsJson, true);
    return $reviewsData['reviews'] ?? [];
}

$reviews = fetchReviews($reviewsFile);
?>

<style>
main {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

main h2 {
    text-align: center;
    
    color: #333;
}

.reviews-container {
    margin-top: 20px;
}

.review {
    background-color: #e9ecef;
    border-radius: 5px;
    padding: 15px;
    
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.review h3 {
    color: #007bff;
    margin-top: 0;
}

.review p {
    margin: 5px 0;
}

main a {
     color: #007bff;
    text-decoration: none;
}

main a:hover {
    text-decoration: underline;
}
</style>

<main>
    <h2>My Reviews</h2>
    
    <?php if (!isset($_SESSION['user'])): ?>
        <p>Please <a href="login.php">login</a> to view your reviews.</p>
    <?php else: ?>
        <div class="reviews-container">
            <?php foreach ($reviews as $review): ?>
                <?php if ($review['user'] === $_SESSION['user']): ?>
                    <div class="review">
                        <h3>Device ID: <?= htmlspecialchars($review['deviceId']) ?></h3>
                        <p>Rating: <?= htmlspecialchars($review['rating']) ?></p>
                        <p>Comment: <?= htmlspecialchars($review['comment']) ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <?php if (empty($reviews)): ?>
                <p>No reviews found.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<?php include '../partials/footer.php'; ?>
