<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ClimateService;

$service = new ClimateService();
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $result = $service->calculate($_POST);
    } catch (Exception $e) {
        $result = "Błąd: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator obciążeń klimatycznych</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 20px; padding: 10px 20px; font-size: 16px; }
        .section { margin-top: 20px; padding: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>

<h1>Kalkulator obciążeń klimatycznych</h1>

<form method="post">

    <label>Typ obciążenia</label>
    <select name="type" id="type" onchange="toggleSections()">
        <option value="wind">Wiatr</option>
        <option value="snow">Śnieg</option>
    </select>

    <div id="wind-section" class="section">
        <h3>Parametry wiatru</h3>
        <label>q<sub>b</sub> – ciśnienie prędkości</label>
        <input type="number" step="0.01" name="qb">

        <label>c<sub>e</sub> – współczynnik ekspozycji</label>
        <input type="number" step="0.01" name="ce">

        <label>c<sub>p</sub> – współczynnik aerodynamiczny</label>
        <input type="number" step="0.01" name="cp">
    </div>

    <div id="snow-section" class="section" style="display:none;">
        <h3>Parametry śniegu</h3>
        <label>μ – współczynnik kształtu</label>
        <input type="number" step="0.01" name="mu">

        <label>s<sub>k</sub> – charakterystyczne obciążenie śniegiem</label>
        <input type="number" step="0.01" name="sk">
    </div>

    <button type="submit">Oblicz</button>
</form>

<?php if ($result !== null): ?>
    <h2>Wynik: <?= htmlspecialchars($result) ?></h2>
<?php endif; ?>

<script>
function toggleSections() {
    const type = document.getElementById('type').value;
    document.getElementById('wind-section').style.display = type === 'wind' ? 'block' : 'none';
    document.getElementById('snow-section').style.display = type === 'snow' ? 'block' : 'none';
}
</script>

</body>
</html>
