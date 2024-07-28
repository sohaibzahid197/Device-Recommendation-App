<?php
session_start();
include '../partials/header.php';
?>
<style>
.device-rankings {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    
    background-color: #f4f4f4;
}

.device-rankings h2 
{
    text-align: center;
    color: #333;
}

.device-rankings ul {
    list-style: none;
    padding: 0;
}

.device-rankings li {
    background-color: #fff;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.device-rankings strong {
    color: #007bff;
}


</style>
<div class="device-rankings">
    <h2>Device Rankings</h2>
    <ul>
    <?php
    $devicesData = json_decode(file_get_contents("../data/devices.json"), true);
    usort($devicesData['devices'], function ($item1, $item2) {
        return $item2['recommendationScore'] <=> $item1['recommendationScore'];
    });

    
    foreach ($devicesData['devices'] as $device): ?>
        <li>
            <strong><?= htmlspecialchars($device['name']) ?></strong>: Score <?= htmlspecialchars($device['recommendationScore']) ?>
        </li>
    <?php endforeach; ?>
    </ul>
</div>

<?php include '../partials/footer.php'; ?>
