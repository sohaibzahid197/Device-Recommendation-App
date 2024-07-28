<?php
session_start();
include '../partials/header.php';

class give_review {
    private $reviewsFile;
    private $devicesFile;
    
    public function __construct($reviewsFile, $devicesFile) {
        $this->reviewsFile = $reviewsFile;
        $this->devicesFile = $devicesFile;
    }
    
    public function submitReview($deviceId, $rating, $comment) {
        
        $deviceData = json_decode(file_get_contents($this->devicesFile), true);
        if ($deviceData === null && json_last_error() !== JSON_ERROR_NONE) {
            die('Error reading the devices file.');
        }
        
        $deviceExists = false;
        foreach ($deviceData['devices'] as $device) {
            if ($device['id'] === $deviceId) {
                $deviceExists = true;
                break;
            }
        }
        
        if (!$deviceExists) {
            echo "<p>Device not found. Please enter a valid device ID. Redirecting in 5 Seconds </p>";
            echo "<script>setTimeout(() => { window.location.href = 'give_review.php'; }, 4000);</script>";
            return;
        }
        
        
        
        $reviewsJson = file_get_contents($this->reviewsFile);
        $reviewsData = json_decode($reviewsJson, true) ?? ['reviews' => []];
        $reviews = &$reviewsData['reviews'];
        
        $existingReviewIndex = null;
        foreach ($reviews as $index => $review) {
            if ($review['deviceId'] === $deviceId && $review['user'] === $_SESSION['user']) {
                $existingReviewIndex = $index;
                break;
            }
        }
        
        $reviewData = [
            'deviceId' => $deviceId,
            'user' => $_SESSION['user'],
            'rating' => intval($rating),
            'comment' => $comment
        ];
        
       
        if (is_null($existingReviewIndex)) {
            $reviews[] = $reviewData;
        } else {
            $reviews[$existingReviewIndex] = $reviewData;
        }
        
        
        file_put_contents($this->reviewsFile, json_encode($reviewsData, JSON_PRETTY_PRINT));
        
        echo "<p>Review submitted successfully. Redirecting in 5 seconds...</p>";
        echo "<script>setTimeout(() => { window.location.href = 'give_review.php'; }, 5000);</script>";
    }
}

$reviewsFile = '../data/reviews.json';
$devicesFile = '../data/devices.json';
$reviewManager = new give_review($reviewsFile, $devicesFile);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reviewManager->submitReview($_POST['deviceId'], $_POST['rating'], $_POST['comment']);
}
?>

<style>
.review-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f8f8;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group textarea 
{
    width: 100%;
    padding: 8px;
    
    border: 1px solid #ccc;
    
    border-radius: 4px;
    box-sizing: border-box;
}

.submit-button {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

.submit-button:hover {
    background-color: #0056b3;
}

h2 {
    text-align: center;
    
    color: #333;
    margin-bottom: 20px;
}

</style>

<main>
    <h2>Give a Review</h2>
    
    <?php if (!isset($_SESSION['user'])): ?>
        <p>Please <a href="login.php">login</a> to give a review.</p>
    <?php else: ?>
        <form action="give_review.php" method="post" class="review-form">
            <div class="form-group">
                <label for="deviceId">Device ID:</label>
                <input type="text" id="deviceId" name="deviceId" required>
            </div>
            
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating" min="1" max="10" required>
            </div>
            
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" cols="50" required></textarea>
            </div>
            
            <button type="submit" class="submit-button">Submit Review</button>
        </form>
    <?php endif; ?>
</main>

<?php include '../partials/footer.php'; ?>
