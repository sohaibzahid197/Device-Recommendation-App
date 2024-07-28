<?php
// Start the session
session_start();

class device {
    public $id;
    public $name;
    public $manufacturer;

    public function __construct($id, $name, $manufacturer) {
        $this->id = $id;
        $this->name = $name;
        $this->manufacturer = $manufacturer;
    }

    public static function getAllDevices() {
        $deviceData = json_decode(file_get_contents("data/devices.json"), true);
        if ($deviceData === null && json_last_error() !== JSON_ERROR_NONE) {
            die('Error reading the devices.json file.');
        }

        $devices = [];
        foreach ($deviceData['devices'] as $device) {
            $devices[] = new device($device['id'], $device['name'], $device['manufacturer']);
        }
        return $devices;
    }
}

$basePath = 'pages/';

$devices = device::getAllDevices();

include 'partials/header.php';
?>

<style>
main 
{
    text-align: center;
    margin: 20px 0;
}

main h1
 {
    font-size: 2.5em;
    color: #007bff;
    margin-bottom: 0.5em;
}

main h2 
{

    font-size: 2em;
    color: #0056b3;
    margin-bottom: 1em;
}

#device-summary 
{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
    margin: auto;
}

.device-card 
{
    background-color: #f0f4f8;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: transform 0.2s ease-in-out;
}

.device-card:hover 
{
    transform: translateY(-5px);
    
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.device-card h3 {
    color: #333;
    font-size: 1.5em;
    margin-bottom: 0.5em;
}

.device-card p 
{
    color: #666;
    font-size: 1em;
    margin-bottom: 1em;
}

.device-card button
 {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 15px;
    cursor: pointer;
    text-transform: uppercase;
    font-weight: bold;
}

.device-card button:hover {
/*     background-color: #0056b3; */
}
.registration-section {
        text-align: center;
        margin-bottom: 30px;
    }

    .registration-section h2 
    {
        color: #007bff;
        font-size: 2em;
        margin-bottom: 10px;
    }

    .registration-section p {
        color: #333;
        font-size: 1.2em;
        margin-bottom: 20px;
    }

    .registration-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
         text-decoration: none;
        
    }



    .login-link {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .login-link:hover {
/*         color: #0056b3; */
    }
    
.greeting-message {
    font-size: 1.8em;
    color: #ffffff; 
    font-weight: bold;
    margin-bottom: 21px;
    padding: 15px 20px;
    background-color: #007bff; 
    border-radius: 15px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    display: inline-block;
    background-image: linear-gradient(120deg, #007bff, #00c6ff);
    animation: pulse 2s infinite alternate;
}

@keyframes pulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.05); }
}



</style>


<main>
    <?php if (!isset($_SESSION['user'])): ?>
        <div class="registration-section">
            <a href="<?php echo $basePath; ?>register.php" class="registration-link">Register</a>
            <p>Already have an account? <a href="<?php echo $basePath; ?>login.php" class="login-link">Login</a></p>
        </div>
    <?php else: ?>
        <div class="greeting-message">
            Welcome, <?php echo $_SESSION['user']; ?>!
        </div>
    <?php endif; ?>

    <h1>Welcome to Our Device Recommendation Site</h1>
    
    <section>
        <h2>Top Devices</h2>
        <div id="device-summary">
            <?php foreach ($devices as $device): ?>
                <div class="device-card">
                    <h3><?php echo $device->name; ?></h3>
                    <p>Manufacturer: <?php echo $device->manufacturer; ?></p>
                    <a href="<?php echo $basePath; ?>device_detail.php?id=<?php echo $device->id; ?>"><button>View Details</button></a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php
// Include the footer partial
include 'partials/footer.php';
?>
