<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Factura</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .factura {
      border: 1px solid #000;
      padding: 20px;
      width: 600px;
    }
    h2 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #000;
    }
    th, td {
      padding: 8px;
      text-align: left;
    }
    .total {
      text-align: right;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div id="factura" class="factura">
    <h2>Factura</h2>
    <p><strong>Cliente:</strong> Juan Pérez</p>
    <p><strong>Fecha:</strong> 26/11/2025</p>

    <table>
      <thead>
        <tr>
          <th>Descripción</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Producto A</td>
          <td>2</td>
          <td>50.000 Gs</td>
          <td>100.000 Gs</td>
        </tr>
        <tr>
          <td>Producto B</td>
          <td>1</td>
          <td>75.000 Gs</td>
          <td>75.000 Gs</td>
        </tr>
      </tbody>
    </table>

    <p class="total">Total a pagar: 175.000 Gs</p>
  </div>

</body>
</html>