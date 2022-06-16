<?php  
$results = [];
$results[] = [
    'date' => time(),
    'url' => 'https://www.olakaiconsulting.com',
    'score' => 95,
    'type' => 'mobile'
];
$results[] = [
    'date' => time(),
    'url' => 'https://www.olakaiconsulting.com',
    'score' => 70,
    'type' => 'mobile'
];
$results[] = [
    'date' => time(),
    'url' => 'https://www.olakaiconsulting.com',
    'score' => 60,
    'type' => 'mobile'
];
$results[] = [
    'date' => time(),
    'url' => 'https://www.olakaiconsulting.com',
    'score' => 40,
    'type' => 'mobile'
];
?>

<h1>Test History</h1>
<div class="container">
    <table class="table">
        <thead>
            <th>Date</th>
            <th>URL</th>
            <th>Results</th>
        </thead>
        <tbody>
            <?php 
            foreach( $results as $result) {
                $icon_class = 'fa-desktop';
                if ($result['type'] == 'mobile') {
                    $icon_class = 'fa-mobile';
                }
                
                $score = intval(ceil($result['score'] / 100.00 * 10));
                $human = "critical";
                $row_class = 'bg-danger text-light';
                switch ($score) {
                    case 10:
                    case 9:
                    case 8:
                        $row_class = 'bg-success text-light';
                        $human = "excellent";
                        break;
                    case 7:
                        $row_class = 'bg-light text-dark';
                        $human = "good";
                        break;
                    case 6:
                    case 5:
                        $row_class = 'bg-warning text-dark';
                        $human = "okay";
                        break;
                }

                $title = sprintf("Tested %s in %s. The score was %d", 
                    $result['url'],
                    $result['type'],
                    $result['score'],
                );

                $result['date'] = date("d/M/y", $result['date']);
                echo "<tr class='$row_class' title='${title}'>";
                echo "<td><i class='fa-solid $icon_class'></i>&nbsp;&nbsp;{$result['date']}</td>";
                echo "<td>{$result['url']}</td>";
                echo "<td>{$human}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
