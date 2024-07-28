<?php
session_start();
include '../partials/header.php';

class device_detail {
    private $deviceData;
    private $selectedDevice;
    
    public function __construct($deviceData) {
        $this->deviceData = $deviceData;
        $this->selectedDevice = $this->getSelectedDevice();
    }
    
    private function getSelectedDevice() {
        $deviceId = $_GET['id'] ?? '';
        foreach ($this->deviceData['devices'] as $device) {
            if ($device['id'] === $deviceId) {
                return $device;
            }
        }
        return null;
    }
    
    public function display() {
        if (!$this->selectedDevice) {
            echo "Device not found";
            return;
        }
        ?>
        <style>
            main .content {
                max-width: 600px;
                margin: 40px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                font-family: 'Segoe UI', sans-serif;
            }

            main .content h1 {
                color: #007bff;
                text-align: center;
            }

            main .content .device-info {
                margin: 20px 0;
                line-height: 1.6;
            }

            main .content .device-info p {
                margin: 10px 0;
                color: #555;
            }

            main .content .device-info .manufacturer,
            main .content .device-info .score {
                font-weight: 600;
            }

            main .content .score {
                background-color: #007bff;
                color: #fff;
                padding: 3px 7px;
                border-radius: 5px;
                display: inline-block;
            }

            main .content .specs {
                background-color: #f7f7f7;
                padding: 15px;
                border-radius: 8px;
                margin-top: 20px;
            }

            main .content .specs h3 {
                color: #0056b3;
                margin-bottom: 10px;
            }

            main .content .specs p {
                margin: 5px 0;
            }

            main .content a {
                display: inline-block;
                background-color: #007bff;
                color: #ffffff;
                padding: 10px 15px;
                border-radius: 5px;
                text-decoration: none;
                text-align: center;
                margin-top: 20px;
                width: 100%;
            }

            main .content a:hover {
                background-color: #0056b3;
            }
        </style>

        <main>
            <div class="content">
                <section class="device-info">
                    <h1><?php echo htmlspecialchars($this->selectedDevice['name']); ?></h1>
                    <p>Manufacturer: <span class="manufacturer"><?php echo htmlspecialchars($this->selectedDevice['manufacturer']); ?></span></p>
                    <p>Recommendation Score: <span class="score"><?php echo htmlspecialchars($this->selectedDevice['recommendationScore']); ?></span></p>
                </section>
                <div class="specs">
                    <h3>Specifications:</h3>
                    <p>Memory: <?php echo htmlspecialchars($this->selectedDevice['specs']['memory']); ?></p>
                    <p>Camera: <?php echo htmlspecialchars($this->selectedDevice['specs']['camera']); ?></p>
                    <p>Battery: <?php echo htmlspecialchars($this->selectedDevice['specs']['battery']); ?></p>
                    <p>Screen Size: <?php echo htmlspecialchars($this->selectedDevice['specs']['screenSize']); ?></p>
                    <p>CPU: <?php echo htmlspecialchars($this->selectedDevice['specs']['cpu']); ?></p>
                </div>
                <a href="<?php echo htmlspecialchars($this->selectedDevice['officialSite']); ?>" target="_blank">Visit Official Site</a>
            </div>
        </main>

        <?php include '../partials/footer.php';
    }
}

$deviceData = json_decode(file_get_contents("../data/devices.json"), true);
$deviceDetail = new device_detail($deviceData);
$deviceDetail->display();
?>
