<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Caja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%;
            max-width: 400px;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Formulario de Caja</h2>
        <form action="#" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="tarjeta">Número de Tarjeta:</label>
            <input type="text" id="tarjeta" name="tarjeta" required>

            <label for="vencimiento">Fecha de Vencimiento:</label>
            <input type="text" id="vencimiento" name="vencimiento" placeholder="MM/AA" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <label for="tipo_tarjeta">Tipo de Tarjeta:</label>
            <select id="tipo_tarjeta" name="tipo_tarjeta" required>
                <option value="visa">Visa</option>
                <option value="mastercard">MasterCard</option>
                <option value="amex">American Express</option>
            </select>

            <button type="submit">Pagar</button>
        </form>
    </div>

</body>
</html>
