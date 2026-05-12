<?php
session_start();

class DadoPoker {
    private const FIGURAS = ['As', 'K', 'Q', 'J', '7', '8'];
    private int $valor;
    private static int $total = 0;
    
    public function __construct() {
        $this->valor = rand(0, 5);
        self::$total++;
    }
    
    public function nombreFigura() {
        return self::FIGURAS[$this->valor];
    }
    
    public static function getTiradasTotales() {
        return self::$total;
    }
    
    public static function reiniciar() {
        self::$total = 0;
    }
}

if (isset($_POST['reiniciar'])) {
    DadoPoker::reiniciar();
}

$dados = [];
for ($i = 0; $i < 5; $i++) {
    $dados[] = new DadoPoker();
}
$total = DadoPoker::getTiradasTotales();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dado Póker</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: #333;
        }
        
        .dados {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .dado {
            width: 100px;
            height: 100px;
            background: #e0e0e0;
            border: 2px solid #333;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: bold;
            color: #0066cc;
        }
        
        .stats {
            margin: 20px 0;
            font-size: 18px;
        }
        
        .value {
            font-size: 28px;
            font-weight: bold;
            color: #0066cc;
        }
        
        button {
            padding: 10px 20px;
            font-size: 16px;
            background: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        
        button:hover {
            background: #0052a3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dado Póker</h1>
        
        <div class="dados">
            <?php foreach ($dados as $dado): ?>
                <div class="dado"><?php echo $dado->nombreFigura(); ?></div>
            <?php endforeach; ?>
        </div>
        
        <div class="stats">
            Tiradas totales: <span class="value"><?php echo $total; ?></span>
        </div>
        
        <form method="POST">
            <button type="submit" name="tirar" value="1">Tirar cubilete</button>
            <button type="submit" name="reiniciar" value="1">Reiniciar</button>
        </form>
    </div>
</body>
</html>
