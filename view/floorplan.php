<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <title>Document</title>
</head>
<body>
<h2>BI-Kompass Raumplankomponente</h2>
<div id="app">
    <bi-room-plan-navigator></bi-room-plan-navigator>
    <bi-floor-plan></bi-floor-plan>
</div>
    
<script src="<?php echo app('baseUrl'); ?>/view/floorplan.js"></script>
</body>
</html>