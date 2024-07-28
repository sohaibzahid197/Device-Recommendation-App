<?php
session_start();
include '../partials/header.php';

$osData = json_decode(file_get_contents("../data/os_data.json"), true);
$android = $osData['Android']; 
?>

<style>

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.container h1 {
    color: #4CAF50;
    text-align: center;
    margin-bottom: 20px;
}

.container img
 {
    display: block;
    margin: 20px auto;
}

.container p 
{
    text-align: justify;
    line-height: 1.6;
    margin-bottom: 15px;
}

.container h2 {
    color: #333;
    
    margin-top: 30px;
    margin-bottom: 15px;
}

.container ul {
    list-style-type: disc;
    margin-left: 40px;
    
    margin-bottom: 20px;
}

.container table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.container table, .container th, .container td {
    border: 1px solid #ddd;
    text-align: left;
    
    padding: 8px;
}

.container th {
    background-color: #4CAF50;
    color: white;
}

.container td
 {
    color: #666;
}

.container tr:nth-child(even) {
    background-color: #f2f2f2;
}

</style>

<main class="container">
    <h1>Operating System Overview: <?php echo $android['name']; ?></h1>
<img src="../images/Android.png" alt="Android Logo" style="width: 200px;">
    <p><?php echo $android['description']; ?></p>
    <p>Latest Version: <?php echo $android['latestVersion']; ?></p>
    
    <h2>Key Features of <?php echo $android['latestVersion']; ?>:</h2>
    <ul>
        <?php foreach ($android['features'] as $feature): ?>
            <li><?php echo $feature; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Differences between Android 12 and Android 13:</h2>
    <table>
        <thead>
            <tr>
                <th>Feature</th>
                <th>Android 12</th>
                <th>Android 13</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($android['differences'] as $difference): ?>
                <tr>
                    <td><?php echo $difference['feature']; ?></td>
                    <td><?php echo $difference['android12']; ?></td>
                    <td><?php echo $difference['android13']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<?php include '../partials/footer.php'; ?>
