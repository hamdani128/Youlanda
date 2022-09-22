<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?=$title;?></title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
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

    /** RTL **/
    .invoice-box.rtl {
        direction: rtl;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    .invoice-box.rtl table {
        text-align: right;
    }

    .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?=$logo;?>" style="width: 100%; max-width: 150px" />
                            </td>

                            <td>
                                Invoice #: <?=$invoice;?><br />
                                Created: <?=$created_at;?><br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td style="width: 50px;">
                                <b> to : </b><br>
                                <p><?=$tujuan?></p>
                            </td>

                            <td style="width: 120px;text-align: center;">
                                <b>from : </b><br>
                                <?=$from;?>
                            </td>
                            <td>
                                <b>ID Barcode : </b>
                                <?=$barcodebatang?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                <b> Driver to : </b>
                                <?=$supir;?>
                            </td>
                            <td colspan="2">
                                <b>No.Kendaraan : </b><?=$no_driver;?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading" style="border: 1px;">
                <td>Item</td>
                <td>Qty</td>
                <td style="text-align: center;">Code</td>
            </tr>


            <?php foreach ($suratjalandetail as $row): ?>
            <tr class="item" style="border-style: dashed;">
                <td><?=$row->item;?></td>
                <td><?=$row->qty;?></td>
                <td style="text-align: center;"><?=$row->code_product;?></td>
            </tr>
            <?php endforeach;?>
            <tr class="total">
                <td></td>
                <td>Total: <?=$total;?></td>
            </tr>
            <br>
            <br>
            <tr>
                <td style="width: 30%;text-align:center;">
                    <label for="">Admin Unit </label>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                </td>
                <td style="width: 30%;text-align:center;">
                    <label for="">Supir </label>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>