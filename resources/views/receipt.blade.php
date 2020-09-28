<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            font-family: sans-serif;
        }

        .receipt-main {
            display: inline-block;
            width: 100%;
            padding: 15px;
            font-size: 12px;
            border: 1px solid #000;
        }

        .receipt-title {
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .receipt-label {
            font-weight: 600;
        }

        .text-large {
            font-size: 16px;
        }

        .receipt-section {
            margin-top: 10px;
        }

        .receipt-footer {
            text-align: center;
        }

        .receipt-signature {
            height: 80px;
            margin: 50px 0;
            padding: 0 50px;
            background: #fff;
        }

        .receipt-signature .receipt-line {
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
        }

        .receipt-signature p {
            text-align: center;
            margin: 0;
        }
    </style>
    <title>Recibo</title>
</head>

<body>
    <div class="receipt-main">

        <p class="receipt-title">Recibo de pagamento</p>

        <div class="receipt-section pull-left">
            <span class="receipt-label text-large">Número:</span>
            <span class="text-large"></span>
        </div>

        <div class="pull-right receipt-section" style="margin-bottom: 10px;">
            <span class="text-large receipt-label">Valor: R$</span>
            <span class="text-large">{{$move->value}}</span>
        </div>

        <div class="clearfix"></div>

        <div class="receipt-section">
            <span class="receipt-label">Beneficiário:</span>
            <span>{{$move->user->name}}</span>
        </div>

        <div class="receipt-section">
            <span class="receipt-label">Responsável:</span>
            <span>Ibirama Badminton - IBAD</span>
        </div>

        <div class="receipt-section">
            <p>Recebi de {{$move->user->name}} a importância de {{$extensiveNumber}}.</p>
            <p>{{$move->description}}.</p>
        </div>

        <div class="receipt-section">
            <p class="pull-right text-large">Ibirama, {{$move->date}}</p>
        </div>


        <div class="receipt-signature col-xs-6">
            <p class="receipt-line"></p>
            <p>Ibirama Badminton - IBAD</p>
            <p>28.538.367/0001-82</p>
            <p>ibad.contato@gmail.com</p>
            <p>R. Laurentino, 85 - Centro</p>
            <p>Ibirama - SC - 89140-000</p>
        </div>

        <div class="receipt-signature col-xs-6">
            <p class="receipt-line"></p>
            <p>{{$move->user->name}}</p>
            <p>{{$move->user->email}}</p>
        </div>
    </div>
</body>

</html>
