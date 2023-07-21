<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Bukti Pembayaran Pendaftaran Santri Baru</title>

    <!-- Favicon -->
    <link rel="favicon icon" href="/assets/img/ponpes.ico" type="image/x-icon">  

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/ponpes.png'))) }}" alt="logo" style="width: 60px;" />
                            </td>

                            <td>
                                <h3><b>Pondok Pesantren</b><br>
                                Jalan Raya Daendels, Kasembon, Madani (62000)</h3>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="width: 40%;">
                                Tanggal: {{ Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                            </td>

                            <td>
                                {{ $data->santris->name }}<br />
                                {{ $data->santris->phone }}<br />
                                {{ $data->santris->address }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Rincian Pembayaran Pendaftaran Santri Baru</td>

                <td></td>
            </tr>

            <tr class="heading">
                <td>Item</td>

                <td>Biaya</td>
            </tr>

            <tr class="item">
                <td>Biaya Pembangunan</td>

                <td>Rp. {{ number_format($data->construction, 2, ',', '.') }}</td>
            </tr>

            <tr class="item">
                <td>Biaya Fasilitas</td>

                <td>Rp. {{ number_format($data->facilities, 2, ',', '.') }}</td>
            </tr>

            <tr class="item last">
                <td>Biaya Alokasi Almari</td>

                <td>Rp. {{ number_format($data->wardrobe, 2, ',', '.') }}</td>
            </tr>

            <tr class="total">
                <td></td>

                <td>Total: Rp. {{ number_format($total, 2, ',', '.') }}</td>
            </tr>

            <tr>
                <td colspan="2">
                    <br /><br /><br />
                    <table>
                        <tr>
                            <td>
                            </td>

                            <td>
                                Mengetahui,<br /><br /><br />
                                {{ auth()->user()->santris->name }}<br />
                                {{ auth()->user()->role }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>