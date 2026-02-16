<?php
// 1. Data Pertanyaan & Kunci Jawaban
$questions = [
    1 => [
        'question' => 'Apa kepanjangan dari PHP?',
        'options' => ['PHP: Hypertext Preprocessor', 'Private Home Page', 'Personal Hypertext Processor'],
        'answer' => 'PHP: Hypertext Preprocessor'
    ],
    2 => [
        'question' => 'Apa kepanjangan dari HTML?',
        'options' => ['HyperText Markup Language', 'HyperText Machine Language', 'HyperText Marking Language'],
        'answer' => 'HyperText Markup Language'
    ],
    3 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ],
    4 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ],
    5 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ],
    6 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ],
    7 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ],
    8 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ],
    9 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ],
    10 => [
        'question' => 'CSS digunakan untuk apa?',
        'options' => ['Struktur', 'Gaya/Tampilan', 'Logika'],
        'answer' => 'Gaya/Tampilan'
    ]
];

$score = 0;
$total = count($questions);
$result_message = "";

// 2. Logika Koreksi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($questions as $id => $q) {
        if (isset($_POST[$id]) && $_POST[$id] == $q['answer']) {
            $score++;
        }
    }
    $result_message = "<h2>Skor Anda: $score / $total</h2>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Kuis PHP</title>
    <style>
        body { font-family: Arial, sans-serif; background-color:rgb(19, 182, 13); padding: 20px; }
        .quiz-container { max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .question { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .options label { display: block; margin-bottom: 5px; cursor: pointer; }
        input[type="submit"] { background-color: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; width: 100%; font-size: 16px; }
        input[type="submit"]:hover { background-color: #218838; }
        .result { text-align: center; font-size: 1.2em; color: #333; padding: 10px; border: 1px solid #ddd; background: #e9ecef; border-radius: 5px; }
    </style>
</head>
<body>

<div class="quiz-container">
<a href="desain_grafis.php" class="btn btn-primary">Kembali</a>
    <h1>Kuis Desain Grafis</h1>
    
    <?php if ($result_message) echo "<div class='result'>$result_message</div><br>"; ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php foreach ($questions as $id => $q): ?>
            <div class="question">
                <p><strong><?php echo $id . ". " . $q['question']; ?></strong></p>
                <div class="options">
                    <?php foreach ($q['options'] as $option): ?>
                        <label>
                            <input type="radio" name="<?php echo $id; ?>" value="<?php echo $option; ?>" required>
                            <?php echo $option; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        
        <input type="submit" value="Kirim Jawaban">
    </form>
</div>

</body>
</html>
