
<title>Laporan Jadwal Kegiatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header p {
            font-size: 18px;
            margin: 0;
        }

        h2 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: right;
        }
        .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        }

        .logo {
            margin-right: 20px; /* Jarak antara logo dan teks */
        }

        .logo img {
            width: 100px;
        }

        .title {
            flex-grow: 1; /* Menyebarkan teks secara merata di dalam kolom */
        }

        .title h1 {
            font-size: 24px;
            margin: 0;
        }

        .title p {
            font-size: 18px;
            margin: 0;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('img/Logo/mun.png') }}" alt="">
        </div>
        <div class="title">
            <h1>Laporan Jadwal Kegiatan</h1>
            <p>Nusantara Infrastructure</p>
        </div>
    </div>    

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Lokasi Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwals as $index => $l)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $l->namakegiatan }}</td>
                <td>{{ date('d/m/Y', strtotime($l->tanggalkegiatan)) }}</td>
                <td>
                    @foreach($lokasi as $loc)
                        @if ($l->lokasi_id == $loc->id)
                            {{ $loc->nama }}
                        @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Tanda Tangan</p>
        <p>Tanggal: {{ date('d/m/Y') }}</p>
    </div>
</body>
</html> --}}






<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="author" content="Muh Reza Aldi Irawan" />
    <style type="text/css">
      html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style1 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style1 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style2 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style2 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style3 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style3 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style4 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style4 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style5 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style5 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style8 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style8 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style9 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style9 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style10 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style10 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style11 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style11 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style12 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style12 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style13 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style13 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style14 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      th.style14 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri Light'; font-size:14pt; background-color:white }
      td.style15 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style15 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style16 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      th.style16 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      td.style17 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      th.style17 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      td.style18 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      th.style18 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      td.style19 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style19 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style20 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style20 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style21 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style21 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style24 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style24 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style26 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style26 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style29 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style29 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style30 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style30 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style31 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style31 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style32 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style32 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style33 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style33 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style34 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style34 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style35 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style35 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style36 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style36 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style37 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style37 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style38 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style38 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style39 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style39 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style40 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style40 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style41 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style41 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style42 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style42 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style43 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style43 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style44 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style44 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style45 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style45 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style46 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style46 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style47 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      th.style47 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri Light'; font-size:9pt; background-color:white }
      td.style48 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style48 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style49 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style49 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style50 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style50 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style51 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style51 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style54 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style54 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style55 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style55 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style56 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      th.style56 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:12pt; background-color:white }
      td.style57 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      th.style57 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      td.style58 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      th.style58 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      td.style59 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      th.style59 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      td.style60 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      th.style60 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      td.style61 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      th.style61 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:9pt; background-color:#FFFFCC }
      td.style62 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFCC }
      th.style62 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFCC }
      td.style63 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      th.style63 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      td.style64 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style64 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style65 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      th.style65 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      td.style66 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      th.style66 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      td.style67 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style67 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style68 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      th.style68 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFFF }
      td.style69 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style69 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style70 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style70 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style71 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style71 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style72 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style72 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style73 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style73 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style74 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style74 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style75 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      th.style75 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFFCC }
      td.style76 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style76 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style77 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style77 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style78 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style78 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style79 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style79 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style80 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style80 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style81 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      th.style81 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      td.style82 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      th.style82 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      td.style83 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      th.style83 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      td.style84 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      th.style84 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:#FFFF99 }
      td.style85 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style85 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style86 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style86 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style87 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style87 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style88 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style88 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style89 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style89 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style90 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style90 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style91 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style91 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      td.style92 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      th.style92 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Tahoma'; font-size:10pt; background-color:white }
      table.sheet0 col.col0 { width:42pt }
      table.sheet0 col.col1 { width:42pt }
      table.sheet0 col.col2 { width:42pt }
      table.sheet0 col.col3 { width:42pt }
      table.sheet0 col.col4 { width:42pt }
      table.sheet0 col.col5 { width:42pt }
      table.sheet0 col.col6 { width:42pt }
      table.sheet0 col.col7 { width:42pt }
      table.sheet0 col.col8 { width:42pt }
      table.sheet0 col.col9 { width:42pt }
      table.sheet0 col.col10 { width:42pt }
      table.sheet0 col.col11 { width:42pt }
      table.sheet0 col.col12 { width:42pt }
      table.sheet0 col.col13 { width:42pt }
      table.sheet0 col.col14 { width:42pt }
      table.sheet0 col.col15 { width:42pt }
      table.sheet0 col.col16 { width:42pt }
      table.sheet0 col.col17 { width:42pt }
      table.sheet0 col.col18 { width:42pt }
      table.sheet0 col.col19 { width:42pt }
      table.sheet0 col.col20 { width:42pt }
      table.sheet0 col.col21 { width:42pt }
      table.sheet0 col.col22 { width:42pt }
      table.sheet0 col.col23 { width:42pt }
      table.sheet0 col.col24 { width:42pt }
      table.sheet0 col.col25 { width:42pt }
      table.sheet0 col.col26 { width:42pt }
      table.sheet0 col.col27 { width:42pt }
      table.sheet0 col.col28 { width:42pt }
      table.sheet0 col.col29 { width:42pt }
      table.sheet0 col.col30 { width:42pt }
      table.sheet0 col.col31 { width:42pt }
      table.sheet0 col.col32 { width:42pt }
      table.sheet0 col.col33 { width:42pt }
      table.sheet0 col.col34 { width:42pt }
      table.sheet0 col.col35 { width:42pt }
      table.sheet0 col.col36 { width:42pt }
      table.sheet0 col.col37 { width:42pt }
      table.sheet0 col.col38 { width:42pt }
      table.sheet0 col.col39 { width:42pt }
      table.sheet0 col.col40 { width:42pt }
      table.sheet0 col.col41 { width:42pt }
      table.sheet0 col.col42 { width:42pt }
      table.sheet0 col.col43 { width:42pt }
      table.sheet0 col.col44 { width:42pt }
      table.sheet0 col.col45 { width:42pt }
      table.sheet0 col.col46 { width:42pt }
      table.sheet0 col.col47 { width:42pt }
      table.sheet0 col.col48 { width:42pt }
      table.sheet0 col.col49 { width:42pt }
      table.sheet0 col.col50 { width:42pt }
      table.sheet0 col.col51 { width:42pt }
      table.sheet0 tr { height:15pt }
      table.sheet0 tr.row0 { height:18.75pt }
      table.sheet0 tr.row4 { height:18pt }
      table.sheet0 tr.row6 { height:18pt }
      table.sheet0 tr.row28 { height:15pt }
      table.sheet0 tr.row29 { height:15pt }
    </style>
  </head>

  <body>
   <div>
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <col class="col14">
        <col class="col15">
        <col class="col16">
        <col class="col17">
        <col class="col18">
        <col class="col19">
        <col class="col20">
        <col class="col21">
        <col class="col22">
        <col class="col23">
        <col class="col24">
        <col class="col25">
        <col class="col26">
        <col class="col27">
        <col class="col28">
        <col class="col29">
        <col class="col30">
        <col class="col31">
        <col class="col32">
        <col class="col33">
        <col class="col34">
        <col class="col35">
        <col class="col36">
        <col class="col37">
        <col class="col38">
        <col class="col39">
        <col class="col40">
        <col class="col41">
        <col class="col42">
        <col class="col43">
        <col class="col44">
        <col class="col45">
        <col class="col46">
        <col class="col47">
        <col class="col48">
        <col class="col49">
        <col class="col50">
        <col class="col51">
        <tbody>
          <tr class="row0">
            <td class="column0 style33 null style41" colspan="4" rowspan="4"><img width="100px" src="{{ asset('img/Logo/mun.png') }}" alt=""></td>
            <td class="column4 style1 s style3" colspan="41">FORMULIR</td>
            <td class="column45 style42 s style43" colspan="3">No. Dok</td>
            <td class="column48 style10 s style11" colspan="4">: FO-MMN-MIS-02-02</td>
          </tr>
          <tr class="row1">
            <td class="column4 style4 s style14" colspan="41" rowspan="3">JADWAL MAINTENANCE</td>
            <td class="column45 style44 s style45" colspan="3">Tgl Terbit</td>
            <td class="column48 style46 s style47" colspan="4">: {{ date('d/m/Y') }}</td>
          </tr>
          <tr class="row2">
            <td class="column45 style42 s style43" colspan="3">No. Rev</td>
            <td class="column48 style10 s style11" colspan="4">: 05</td>
          </tr>
          <tr class="row3">
            <td class="column45 style15 null style15" colspan="7"></td>
          </tr>
          <tr class="row4">
            <td class="column0 style48 s style50" colspan="52">Tahun : {{ date('Y') }}</td>
          </tr>
          <tr class="row7">
            <td class="column0 style16 s style18" colspan="52">HADWARE DAN SOFWARE PERALATAN TOL</td>
          </tr>
          <tr class="row8">
            <td class="column0 style19 s style75" colspan="4" rowspan="3">Gerbang Tol</td>
            <td class="column4 style20 null"></td>
            <td class="column5 style20 null"></td>
            <td class="column6 style20 null"></td>
            <td class="column7 style20 null"></td>
            <td class="column8 style20 null"></td>
            <td class="column9 style20 null"></td>
            <td class="column10 style20 null"></td>
            <td class="column11 style20 null"></td>
            <td class="column12 style20 null"></td>
            <td class="column13 style20 null"></td>
            <td class="column14 style20 null"></td>
            <td class="column15 style20 null"></td>
            <td class="column16 style20 null"></td>
            <td class="column17 style20 null"></td>
            <td class="column18 style20 null"></td>
            <td class="column19 style20 null"></td>
            <td class="column20 style20 null"></td>
            <td class="column21 style20 null"></td>
            <td class="column22 style20 null"></td>
            <td class="column23 style20 null"></td>
            <td class="column24 style20 null"></td>
            <td class="column25 style20 null"></td>
            <td class="column26 style20 null"></td>
            <td class="column27 style21 null"></td>
            <td class="column28 style19 null style19" colspan="24"></td>
          </tr>
          <tr class="row9">
            <td class="column4 style22 s style28" colspan="4">Januari</td>
            <td class="column8 style22 s style28" colspan="4">Februari</td>
            <td class="column12 style26 s style28" colspan="4">Maret</td>
            <td class="column16 style22 s style28" colspan="4">April</td>
            <td class="column20 style22 s style28" colspan="4">Mei</td>
            <td class="column24 style22 s style28" colspan="4">Juni</td>
            <td class="column28 style29 s style31" colspan="4">Juli</td>
            <td class="column32 style29 s style31" colspan="4">Agustus</td>
            <td class="column36 style32 s style32" colspan="4">September</td>
            <td class="column40 style29 s style31" colspan="4">Oktober</td>
            <td class="column44 style32 s style32" colspan="4">November</td>
            <td class="column48 style32 s style32" colspan="4">Desember</td>
          </tr>
          <tr class="row10">
            <td class="column4 style57 s">W1</td>
            <td class="column5 style57 s">W2</td>
            <td class="column6 style57 s">W3</td>
            <td class="column7 style57 s">W4</td>
            <td class="column8 style57 s">W1</td>
            <td class="column9 style57 s">W2</td>
            <td class="column10 style57 s">W3</td>
            <td class="column11 style57 s">W4</td>
            <td class="column12 style57 s">W1</td>
            <td class="column13 style57 s">W2</td>
            <td class="column14 style57 s">W3</td>
            <td class="column15 style57 s">W4</td>
            <td class="column16 style57 s">W1</td>
            <td class="column17 style57 s">W2</td>
            <td class="column18 style57 s">W3</td>
            <td class="column19 style57 s">W4</td>
            <td class="column20 style57 s">W1</td>
            <td class="column21 style57 s">W2</td>
            <td class="column22 style57 s">W3</td>
            <td class="column23 style57 s">W4</td>
            <td class="column24 style57 s">W1</td>
            <td class="column25 style57 s">W2</td>
            <td class="column26 style57 s">W3</td>
            <td class="column27 style57 s">W4</td>
            <td class="column28 style57 s">W1</td>
            <td class="column29 style57 s">W2</td>
            <td class="column30 style57 s">W3</td>
            <td class="column31 style57 s">W4</td>
            <td class="column32 style57 s">W1</td>
            <td class="column33 style57 s">W2</td>
            <td class="column34 style57 s">W3</td>
            <td class="column35 style57 s">W4</td>
            <td class="column36 style57 s">W1</td>
            <td class="column37 style57 s">W2</td>
            <td class="column38 style57 s">W3</td>
            <td class="column39 style57 s">W4</td>
            <td class="column40 style57 s">W1</td>
            <td class="column41 style57 s">W2</td>
            <td class="column42 style57 s">W3</td>
            <td class="column43 style57 s">W4</td>
            <td class="column44 style57 s">W1</td>
            <td class="column45 style58 s">W2</td>
            <td class="column46 style59 s">W3</td>
            <td class="column47 style60 s">W4</td>
            <td class="column48 style61 s">W1</td>
            <td class="column49 style62 s">W2</td>
            <td class="column50 style57 s">W3</td>
            <td class="column51 style57 s">W4</td>
          </tr>
          <tr class="row11">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Cambaya</td>
            {{-- <td class="column4 style63" style="background-color: blue;"></td> --}}
            <td class="column4 style63 null" id="lokasi_20_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_20_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_20_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_20_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_20_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_20_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_20_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_20_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_20_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_20_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_20_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_20_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_20_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_20_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_20_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_20_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_20_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_20_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_20_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_20_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_20_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_20_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_20_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_20_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_20_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_20_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_20_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_20_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_20_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_20_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_20_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_20_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_20_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_20_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_20_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_20_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_20_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_20_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_20_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_20_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_20_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_20_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_20_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_20_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_20_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_20_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_20_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_20_des_minggu4"></td>
          </tr>
          <tr class="row12">
            <td class="column4 style63 null" id="lokasi_20_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_20_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_20_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_20_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_20_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_20_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_20_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_20_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_20_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_20_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_20_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_20_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_20_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_20_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_20_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_20_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_20_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_20_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_20_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_20_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_20_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_20_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_20_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_20_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_20_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_20_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_20_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_20_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_20_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_20_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_20_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_20_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_20_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_20_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_20_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_20_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_20_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_20_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_20_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_20_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_20_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_20_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_20_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_20_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_20_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_20_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_20_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_20_des_minggu4_w"></td>
          </tr>
          <tr class="row13">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Kaluku Bodoa</td>
            <td class="column4 style63 null" id="lokasi_30_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_30_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_30_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_30_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_30_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_30_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_30_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_30_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_30_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_30_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_30_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_30_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_30_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_30_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_30_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_30_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_30_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_30_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_30_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_30_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_30_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_30_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_30_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_30_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_30_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_30_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_30_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_30_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_30_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_30_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_30_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_30_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_30_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_30_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_30_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_30_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_30_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_30_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_30_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_30_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_30_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_30_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_30_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_30_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_30_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_30_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_30_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_30_des_minggu4"></td>
          </tr>
          <tr class="row14">
            <td class="column4 style63 null" id="lokasi_30_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_30_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_30_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_30_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_30_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_30_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_30_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_30_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_30_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_30_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_30_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_30_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_30_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_30_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_30_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_30_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_30_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_30_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_30_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_30_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_30_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_30_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_30_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_30_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_30_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_30_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_30_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_30_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_30_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_30_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_30_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_30_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_30_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_30_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_30_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_30_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_30_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_30_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_30_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_30_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_30_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_30_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_30_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_30_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_30_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_30_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_30_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_30_des_minggu4_w"></td>
          </tr>
          <tr class="row15">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Tamalanrea</td>
            <td class="column4 style63 null" id="lokasi_84_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_84_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_84_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_84_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_84_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_84_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_84_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_84_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_84_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_84_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_84_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_84_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_84_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_84_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_84_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_84_apr_minggu4"></td>
            <td class="column84 style63 null" id="lokasi_84_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_84_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_84_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_84_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_84_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_84_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_84_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_84_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_84_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_84_jul_minggu2"></td>
            <td class="column84 style63 null" id="lokasi_84_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_84_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_84_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_84_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_84_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_84_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_84_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_84_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_84_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_84_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_84_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_84_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_84_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_84_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_84_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_84_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_84_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_84_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_84_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_84_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_84_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_84_des_minggu4"></td>
          </tr>
          <tr class="row16">
            <td class="column4 style63 null" id="lokasi_84_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_84_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_84_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_84_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_84_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_84_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_84_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_84_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_84_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_84_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_84_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_84_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_84_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_84_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_84_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_84_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_84_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_84_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_84_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_84_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_84_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_84_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_84_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_84_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_84_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_84_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_84_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_84_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_84_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_84_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_84_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_84_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_84_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_84_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_84_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_84_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_84_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_84_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_84_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_84_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_84_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_84_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_84_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_84_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_84_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_84_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_84_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_84_des_minggu4_w"></td>
          </tr>
          <tr class="row17">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Parangloe</td>
            <td class="column4 style63 null" id="lokasi_43_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_43_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_43_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_43_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_43_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_43_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_43_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_43_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_43_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_43_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_43_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_43_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_43_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_43_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_43_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_43_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_43_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_43_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_43_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_43_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_43_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_43_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_43_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_43_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_43_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_43_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_43_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_43_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_43_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_43_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_43_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_43_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_43_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_43_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_43_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_43_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_43_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_43_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_43_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_43_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_43_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_43_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_43_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_43_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_43_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_43_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_43_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_43_des_minggu4"></td>
          </tr>
          <tr class="row18">
            <td class="column4 style63 null" id="lokasi_43_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_43_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_43_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_43_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_43_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_43_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_43_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_43_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_43_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_43_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_43_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_43_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_43_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_43_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_43_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_43_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_43_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_43_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_43_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_43_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_43_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_43_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_43_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_43_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_43_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_43_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_43_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_43_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_43_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_43_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_43_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_43_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_43_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_43_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_43_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_43_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_43_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_43_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_43_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_43_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_43_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_43_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_43_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_43_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_43_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_43_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_43_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_43_des_minggu4_w"></td>
          </tr>
          <tr class="row19">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Biringkanaya</td>
            <td class="column4 style63 null" id="lokasi_85_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_85_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_85_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_85_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_85_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_85_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_85_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_85_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_85_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_85_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_85_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_85_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_85_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_85_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_85_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_85_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_85_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_85_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_85_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_85_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_85_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_85_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_85_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_85_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_85_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_85_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_85_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_85_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_85_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_85_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_85_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_85_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_85_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_85_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_85_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_85_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_85_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_85_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_85_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_85_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_85_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_85_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_85_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_85_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_85_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_85_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_85_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_85_des_minggu4"></td>
          </tr>
          <tr class="row20">
            <td class="column4 style63 null" id="lokasi_85_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_85_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_85_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_85_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_85_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_85_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_85_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_85_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_85_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_85_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_85_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_85_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_85_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_85_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_85_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_85_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_85_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_85_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_85_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_85_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_85_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_85_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_85_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_85_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_85_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_85_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_85_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_85_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_85_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_85_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_85_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_85_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_85_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_85_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_85_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_85_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_85_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_85_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_85_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_85_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_85_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_85_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_85_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_85_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_85_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_85_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_85_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_85_des_minggu4_w"></td>
          </tr>
          <tr class="row21">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Ramp Tallo Timur</td>
            <td class="column4 style63 null" id="lokasi_60_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_60_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_60_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_60_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_60_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_60_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_60_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_60_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_60_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_60_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_60_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_60_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_60_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_60_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_60_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_60_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_60_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_60_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_60_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_60_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_60_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_60_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_60_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_60_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_60_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_60_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_60_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_60_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_60_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_60_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_60_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_60_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_60_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_60_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_60_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_60_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_60_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_60_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_60_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_60_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_60_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_60_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_60_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_60_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_60_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_60_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_60_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_60_des_minggu4"></td>
          </tr>
          <tr class="row22">
            <td class="column4 style63 null" id="lokasi_60_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_60_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_60_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_60_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_60_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_60_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_60_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_60_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_60_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_60_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_60_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_60_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_60_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_60_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_60_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_60_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_60_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_60_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_60_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_60_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_60_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_60_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_60_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_60_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_60_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_60_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_60_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_60_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_60_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_60_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_60_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_60_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_60_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_60_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_60_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_60_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_60_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_60_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_60_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_60_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_60_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_60_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_60_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_60_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_60_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_60_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_60_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_60_des_minggu4_w"></td>
          </tr>
          <tr class="row23">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Ramp Tallo Barat</td>
            <td class="column4 style63 null" id="lokasi_55_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_55_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_55_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_55_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_55_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_55_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_55_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_55_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_55_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_55_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_55_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_55_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_55_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_55_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_55_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_55_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_55_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_55_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_55_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_55_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_55_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_55_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_55_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_55_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_55_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_55_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_55_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_55_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_55_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_55_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_55_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_55_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_55_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_55_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_55_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_55_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_55_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_55_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_55_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_55_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_55_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_55_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_55_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_55_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_55_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_55_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_55_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_55_des_minggu4"></td>
          </tr>
          <tr class="row24">
            <td class="column4 style63 null" id="lokasi_55_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_55_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_55_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_55_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_55_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_55_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_55_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_55_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_55_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_55_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_55_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_55_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_55_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_55_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_55_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_55_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_55_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_55_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_55_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_55_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_55_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_55_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_55_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_55_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_55_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_55_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_55_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_55_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_55_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_55_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_55_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_55_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_55_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_55_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_55_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_55_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_55_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_55_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_55_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_55_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_55_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_55_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_55_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_55_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_55_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_55_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_55_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_55_des_minggu4_w"></td>
          </tr>
          <tr class="row25">
            <td class="column0 style77 s style74" colspan="4" rowspan="2">Ramp Bira Barat</td>
            <td class="column4 style63 null" id="lokasi_86_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_86_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_86_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_86_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_86_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_86_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_86_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_86_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_86_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_86_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_86_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_86_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_86_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_86_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_86_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_86_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_86_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_86_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_86_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_86_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_86_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_86_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_86_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_86_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_86_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_86_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_86_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_86_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_86_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_86_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_86_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_86_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_86_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_86_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_86_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_86_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_86_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_86_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_86_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_86_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_86_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_86_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_86_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_86_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_86_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_86_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_86_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_86_des_minggu4"></td>
          </tr>
          <tr class="row26">
            <td class="column4 style63 null" id="lokasi_86_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_86_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_86_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_86_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_86_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_86_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_86_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_86_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_86_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_86_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_86_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_86_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_86_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_86_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_86_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_86_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_86_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_86_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_86_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_86_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_86_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_86_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_86_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_86_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_86_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_86_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_86_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_86_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_86_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_86_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_86_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_86_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_86_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_86_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_86_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_86_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_86_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_86_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_86_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_86_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_86_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_86_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_86_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_86_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_86_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_86_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_86_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_86_des_minggu4_w"></td>
          </tr>
          <tr class="row27">
            <td class="column0 style76 s style76" colspan="4" rowspan="2">Ramp Bira Timur</td>
            <td class="column4 style63 null" id="lokasi_14_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_14_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_14_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_14_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_14_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_14_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_14_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_14_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_14_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_14_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_14_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_14_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_14_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_14_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_14_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_14_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_14_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_14_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_14_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_14_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_14_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_14_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_14_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_14_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_14_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_14_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_14_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_14_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_14_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_14_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_14_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_14_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_14_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_14_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_14_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_14_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_14_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_14_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_14_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_14_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_14_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_14_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_14_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_14_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_14_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_14_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_14_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_14_des_minggu4"></td>
          </tr>
          <tr class="row28">
            <td class="column4 style63 null" id="lokasi_14_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_14_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_14_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_14_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_14_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_14_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_14_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_14_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_14_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_14_mar_minggu2_w"></td>
            <td class="column14 style63 null" id="lokasi_14_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_14_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_14_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_14_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_14_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_14_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_14_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_14_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_14_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_14_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_14_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_14_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_14_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_14_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_14_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_14_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_14_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_14_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_14_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_14_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_14_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_14_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_14_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_14_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_14_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_14_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_14_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_14_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_14_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_14_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_14_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_14_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_14_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_14_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_14_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_14_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_14_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_14_des_minggu4_w"></td>
          </tr>
          <tr class="row29">
            <td class="column0 style85 null"></td>
            <td class="column1 style86 null"></td>
            <td class="column2 style86 null"></td>
            <td class="column3 style86 null"></td>
            <td class="column4 style86 null"></td>
            <td class="column5 style86 null"></td>
            <td class="column6 style86 null"></td>
            <td class="column7 style86 null"></td>
            <td class="column8 style86 null"></td>
            <td class="column9 style86 null"></td>
            <td class="column10 style86 null"></td>
            <td class="column11 style86 null"></td>
            <td class="column12 style86 null"></td>
            <td class="column13 style86 null"></td>
            <td class="column14 style86 null"></td>
            <td class="column15 style86 null"></td>
            <td class="column16 style86 null"></td>
            <td class="column17 style86 null"></td>
            <td class="column18 style86 null"></td>
            <td class="column19 style86 null"></td>
            <td class="column20 style86 null"></td>
            <td class="column21 style86 null"></td>
            <td class="column22 style86 null"></td>
            <td class="column23 style86 null"></td>
            <td class="column24 style86 null"></td>
            <td class="column25 style86 null"></td>
            <td class="column26 style86 null"></td>
            <td class="column27 style86 null"></td>
            <td class="column28 style86 null"></td>
            <td class="column29 style86 null"></td>
            <td class="column30 style86 null"></td>
            <td class="column31 style86 null"></td>
            <td class="column32 style86 null"></td>
            <td class="column33 style86 null"></td>
            <td class="column34 style86 null"></td>
            <td class="column35 style86 null"></td>
            <td class="column36 style86 null"></td>
            <td class="column37 style86 null"></td>
            <td class="column38 style86 null"></td>
            <td class="column39 style86 null"></td>
            <td class="column40 style86 null"></td>
            <td class="column41 style86 null"></td>
            <td class="column42 style86 null"></td>
            <td class="column43 style86 null"></td>
            <td class="column44 style86 null"></td>
            <td class="column45 style86 null"></td>
            <td class="column46 style86 null"></td>
            <td class="column47 style86 null"></td>
            <td class="column48 style86 null"></td>
            <td class="column49 style86 null"></td>
            <td class="column50 style86 null"></td>
            <td class="column51 style87 null"></td>
          </tr>
          <tr class="row30">
            <td class="column0 style88 null"></td>
            <td class="column1 style69 null"></td>
            <td class="column2 style69 null"></td>
            <td class="column3 style69 null"></td>
            <td class="column4 style69 null"></td>
            <td class="column5 style69 null"></td>
            <td class="column6 style69 null"></td>
            <td class="column7 style69 null"></td>
            <td class="column8 style69 null"></td>
            <td class="column9 style69 null"></td>
            <td class="column10 style69 null"></td>
            <td class="column11 style69 null"></td>
            <td class="column12 style69 null"></td>
            <td class="column13 style69 null"></td>
            <td class="column14 style69 null"></td>
            <td class="column15 style69 null"></td>
            <td class="column16 style69 null"></td>
            <td class="column17 style69 null"></td>
            <td class="column18 style69 null"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style69 null"></td>
            <td class="column21 style69 null"></td>
            <td class="column22 style69 null"></td>
            <td class="column23 style69 null"></td>
            <td class="column24 style69 null"></td>
            <td class="column25 style69 null"></td>
            <td class="column26 style69 null"></td>
            <td class="column27 style69 null"></td>
            <td class="column28 style69 null"></td>
            <td class="column29 style69 null"></td>
            <td class="column30 style69 null"></td>
            <td class="column31 style69 null"></td>
            <td class="column32 style69 null"></td>
            <td class="column33 style69 null"></td>
            <td class="column34 style69 null"></td>
            <td class="column35 style69 null"></td>
            <td class="column36 style69 null"></td>
            <td class="column37 style69 null"></td>
            <td class="column38 style69 null"></td>
            <td class="column39 style69 null"></td>
            <td class="column40 style69 null"></td>
            <td class="column41 style69 null"></td>
            <td class="column42 style69 null"></td>
            <td class="column43 style69 null"></td>
            <td class="column44 style69 null"></td>
            <td class="column45 style69 null"></td>
            <td class="column46 style69 null"></td>
            <td class="column47 style69 null"></td>
            <td class="column48 style69 null"></td>
            <td class="column49 style69 null"></td>
            <td class="column50 style69 null"></td>
            <td class="column51 style89 null"></td>
          </tr>
          <tr class="row31">
            <td class="column0 style90 null"></td>
            <td class="column1 style91 null"></td>
            <td class="column2 style91 null"></td>
            <td class="column3 style91 null"></td>
            <td class="column4 style91 null"></td>
            <td class="column5 style91 null"></td>
            <td class="column6 style91 null"></td>
            <td class="column7 style91 null"></td>
            <td class="column8 style91 null"></td>
            <td class="column9 style91 null"></td>
            <td class="column10 style91 null"></td>
            <td class="column11 style91 null"></td>
            <td class="column12 style91 null"></td>
            <td class="column13 style91 null"></td>
            <td class="column14 style91 null"></td>
            <td class="column15 style91 null"></td>
            <td class="column16 style91 null"></td>
            <td class="column17 style91 null"></td>
            <td class="column18 style91 null"></td>
            <td class="column19 style91 null"></td>
            <td class="column20 style91 null"></td>
            <td class="column21 style91 null"></td>
            <td class="column22 style91 null"></td>
            <td class="column23 style91 null"></td>
            <td class="column24 style91 null"></td>
            <td class="column25 style91 null"></td>
            <td class="column26 style91 null"></td>
            <td class="column27 style91 null"></td>
            <td class="column28 style91 null"></td>
            <td class="column29 style91 null"></td>
            <td class="column30 style91 null"></td>
            <td class="column31 style91 null"></td>
            <td class="column32 style91 null"></td>
            <td class="column33 style91 null"></td>
            <td class="column34 style91 null"></td>
            <td class="column35 style91 null"></td>
            <td class="column36 style91 null"></td>
            <td class="column37 style91 null"></td>
            <td class="column38 style91 null"></td>
            <td class="column39 style91 null"></td>
            <td class="column40 style91 null"></td>
            <td class="column41 style91 null"></td>
            <td class="column42 style91 null"></td>
            <td class="column43 style91 null"></td>
            <td class="column44 style91 null"></td>
            <td class="column45 style91 null"></td>
            <td class="column46 style91 null"></td>
            <td class="column47 style91 null"></td>
            <td class="column48 style91 null"></td>
            <td class="column49 style91 null"></td>
            <td class="column50 style91 null"></td>
            <td class="column51 style92 null"></td>
          </tr>
          <tr class="row32">
            <td class="column0 style82 s style84" colspan="52">SOFTWARE &amp; HARDWARE NON TOL</td>
          </tr>
          <tr class="row33">
            <td class="column0 style19 s style75" colspan="4" rowspan="3">Kantor</td>
            <td class="column4 style20 null"></td>
            <td class="column5 style20 null"></td>
            <td class="column6 style20 null"></td>
            <td class="column7 style20 null"></td>
            <td class="column8 style20 null"></td>
            <td class="column9 style20 null"></td>
            <td class="column10 style20 null"></td>
            <td class="column11 style20 null"></td>
            <td class="column12 style20 null"></td>
            <td class="column13 style20 null"></td>
            <td class="column14 style20 null"></td>
            <td class="column15 style20 null"></td>
            <td class="column16 style20 null"></td>
            <td class="column17 style20 null"></td>
            <td class="column18 style20 null"></td>
            <td class="column19 style20 null"></td>
            <td class="column20 style20 null"></td>
            <td class="column21 style20 null"></td>
            <td class="column22 style20 null"></td>
            <td class="column23 style20 null"></td>
            <td class="column24 style20 null"></td>
            <td class="column25 style20 null"></td>
            <td class="column26 style20 null"></td>
            <td class="column27 style21 null"></td>
            <td class="column28 style19 null style19" colspan="24"></td>
          </tr>
          <tr class="row34">
            <td class="column4 style22 s style28" colspan="4">Januari</td>
            <td class="column8 style22 s style28" colspan="4">Februari</td>
            <td class="column12 style26 s style28" colspan="4">Maret</td>
            <td class="column16 style22 s style28" colspan="4">April</td>
            <td class="column20 style22 s style28" colspan="4">Mei</td>
            <td class="column24 style22 s style28" colspan="4">Juni</td>
            <td class="column28 style29 s style31" colspan="4">Juli</td>
            <td class="column32 style29 s style31" colspan="4">Agustus</td>
            <td class="column36 style32 s style32" colspan="4">September</td>
            <td class="column40 style29 s style31" colspan="4">Oktober</td>
            <td class="column44 style32 s style32" colspan="4">November</td>
            <td class="column48 style32 s style32" colspan="4">Desember</td>
          </tr>
          <tr class="row35">
            <td class="column4 style57 s">W1</td>
            <td class="column5 style57 s">W2</td>
            <td class="column6 style57 s">W3</td>
            <td class="column7 style57 s">W4</td>
            <td class="column8 style57 s">W1</td>
            <td class="column9 style57 s">W2</td>
            <td class="column10 style57 s">W3</td>
            <td class="column11 style57 s">W4</td>
            <td class="column12 style57 s">W1</td>
            <td class="column13 style57 s">W2</td>
            <td class="column14 style57 s">W3</td>
            <td class="column15 style57 s">W4</td>
            <td class="column16 style57 s">W1</td>
            <td class="column17 style57 s">W2</td>
            <td class="column18 style57 s">W3</td>
            <td class="column19 style57 s">W4</td>
            <td class="column20 style57 s">W1</td>
            <td class="column21 style57 s">W2</td>
            <td class="column22 style57 s">W3</td>
            <td class="column23 style57 s">W4</td>
            <td class="column24 style57 s">W1</td>
            <td class="column25 style57 s">W2</td>
            <td class="column26 style57 s">W3</td>
            <td class="column27 style57 s">W4</td>
            <td class="column28 style57 s">W1</td>
            <td class="column29 style57 s">W2</td>
            <td class="column30 style57 s">W3</td>
            <td class="column31 style57 s">W4</td>
            <td class="column32 style57 s">W1</td>
            <td class="column33 style57 s">W2</td>
            <td class="column34 style57 s">W3</td>
            <td class="column35 style57 s">W4</td>
            <td class="column36 style57 s">W1</td>
            <td class="column37 style57 s">W2</td>
            <td class="column38 style57 s">W3</td>
            <td class="column39 style57 s">W4</td>
            <td class="column40 style57 s">W1</td>
            <td class="column41 style57 s">W2</td>
            <td class="column42 style57 s">W3</td>
            <td class="column43 style57 s">W4</td>
            <td class="column44 style57 s">W1</td>
            <td class="column45 style58 s">W2</td>
            <td class="column46 style59 s">W3</td>
            <td class="column47 style60 s">W4</td>
            <td class="column48 style61 s">W1</td>
            <td class="column49 style62 s">W2</td>
            <td class="column50 style57 s">W3</td>
            <td class="column51 style57 s">W4</td>
          </tr>
          <tr class="row36">
            <td class="column0 style76 s style76" colspan="4" rowspan="2">Kantor Operasional Cambaya</td>
            <td class="column4 style63 null" id="lokasi_78_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_78_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_78_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_78_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_78_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_78_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_78_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_78_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_78_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_78_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_78_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_78_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_78_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_78_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_78_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_78_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_78_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_78_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_78_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_78_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_78_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_78_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_78_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_78_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_78_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_78_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_78_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_78_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_78_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_78_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_78_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_78_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_78_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_78_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_78_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_78_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_78_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_78_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_78_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_78_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_78_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_78_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_78_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_78_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_78_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_78_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_78_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_78_des_minggu4"></td>
          </tr>
          <tr class="row37">
            <td class="column4 style63 null" id="lokasi_78_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_78_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_78_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_78_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_78_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_78_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_78_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_78_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_78_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_78_mar_minggu2_w"></td>
            <td class="column78 style63 null" id="lokasi_78_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_78_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_78_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_78_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_78_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_78_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_78_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_78_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_78_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_78_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_78_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_78_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_78_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_78_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_78_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_78_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_78_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_78_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_78_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_78_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_78_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_78_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_78_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_78_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_78_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_78_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_78_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_78_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_78_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_78_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_78_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_78_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_78_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_78_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_78_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_78_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_78_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_78_des_minggu4_w"></td>
          </tr>
          <tr class="row38">
            <td class="column0 style76 s style76" colspan="4" rowspan="2">Kantor Pusat Menara Bosowa</td>
            <td class="column4 style63 null" id="lokasi_81_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_81_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_81_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_81_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_81_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_81_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_81_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_81_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_81_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_81_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_81_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_81_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_81_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_81_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_81_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_81_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_81_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_81_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_81_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_81_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_81_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_81_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_81_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_81_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_81_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_81_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_81_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_81_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_81_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_81_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_81_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_81_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_81_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_81_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_81_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_81_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_81_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_81_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_81_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_81_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_81_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_81_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_81_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_81_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_81_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_81_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_81_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_81_des_minggu4"></td>
          </tr>
          <tr class="row39">
            <td class="column4 style63 null" id="lokasi_81_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_81_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_81_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_81_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_81_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_81_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_81_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_81_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_81_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_81_mar_minggu2_w"></td>
            <td class="column78 style63 null" id="lokasi_81_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_81_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_81_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_81_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_81_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_81_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_81_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_81_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_81_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_81_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_81_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_81_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_81_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_81_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_81_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_81_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_81_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_81_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_81_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_81_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_81_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_81_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_81_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_81_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_81_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_81_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_81_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_81_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_81_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_81_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_81_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_81_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_81_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_81_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_81_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_81_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_81_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_81_des_minggu4_w"></td>
          </tr>
          <tr class="row40">
            <td class="column0 style76 s style76" colspan="4" rowspan="2">Kantor Pelayanan Lalin</td>
            <td class="column4 style63 null" id="lokasi_79_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_79_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_79_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_79_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_79_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_79_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_79_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_79_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_79_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_79_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_79_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_79_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_79_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_79_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_79_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_79_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_79_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_79_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_79_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_79_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_79_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_79_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_79_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_79_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_79_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_79_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_79_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_79_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_79_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_79_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_79_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_79_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_79_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_79_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_79_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_79_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_79_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_79_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_79_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_79_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_79_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_79_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_79_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_79_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_79_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_79_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_79_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_79_des_minggu4"></td>
          </tr>
          <tr class="row41">
            <td class="column4 style63 null" id="lokasi_79_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_79_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_79_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_79_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_79_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_79_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_79_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_79_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_79_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_79_mar_minggu2_w"></td>
            <td class="column78 style63 null" id="lokasi_79_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_79_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_79_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_79_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_79_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_79_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_79_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_79_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_79_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_79_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_79_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_79_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_79_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_79_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_79_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_79_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_79_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_79_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_79_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_79_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_79_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_79_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_79_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_79_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_79_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_79_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_79_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_79_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_79_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_79_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_79_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_79_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_79_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_79_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_79_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_79_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_79_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_79_des_minggu4_w"></td>
          </tr>
          <tr class="row42">
            <td class="column0 style76 s style76" colspan="4" rowspan="2">Kantor Workshop</td>
            <td class="column4 style63 null" id="lokasi_76_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_76_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_76_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_76_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_76_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_76_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_76_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_76_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_76_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_76_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_76_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_76_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_76_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_76_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_76_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_76_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_76_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_76_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_76_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_76_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_76_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_76_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_76_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_76_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_76_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_76_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_76_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_76_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_76_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_76_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_76_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_76_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_76_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_76_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_76_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_76_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_76_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_76_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_76_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_76_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_76_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_76_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_76_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_76_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_76_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_76_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_76_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_76_des_minggu4"></td>
          </tr>
          <tr class="row43">
            <td class="column4 style63 null" id="lokasi_76_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_76_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_76_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_76_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_76_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_76_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_76_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_76_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_76_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_76_mar_minggu2_w"></td>
            <td class="column78 style63 null" id="lokasi_76_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_76_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_76_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_76_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_76_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_76_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_76_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_76_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_76_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_76_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_76_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_76_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_76_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_76_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_76_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_76_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_76_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_76_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_76_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_76_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_76_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_76_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_76_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_76_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_76_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_76_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_76_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_76_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_76_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_76_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_76_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_76_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_76_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_76_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_76_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_76_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_76_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_76_des_minggu4_w"></td>
          </tr>
          <tr class="row44">
            <td class="column0 style76 s style76" colspan="4" rowspan="2">Kantor Satelit</td>
            <td class="column4 style63 null" id="lokasi_87_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_87_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_87_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_87_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_87_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_87_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_87_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_87_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_87_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_87_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_87_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_87_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_87_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_87_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_87_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_87_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_87_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_87_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_87_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_87_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_87_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_87_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_87_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_87_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_87_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_87_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_87_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_87_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_87_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_87_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_87_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_87_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_87_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_87_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_87_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_87_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_87_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_87_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_87_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_87_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_87_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_87_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_87_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_87_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_87_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_87_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_87_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_87_des_minggu4"></td>
          </tr>
          <tr class="row45">
            <td class="column4 style63 null" id="lokasi_87_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_87_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_87_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_87_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_87_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_87_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_87_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_87_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_87_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_87_mar_minggu2_w"></td>
            <td class="column78 style63 null" id="lokasi_87_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_87_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_87_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_87_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_87_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_87_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_87_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_87_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_87_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_87_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_87_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_87_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_87_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_87_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_87_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_87_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_87_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_87_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_87_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_87_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_87_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_87_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_87_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_87_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_87_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_87_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_87_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_87_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_87_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_87_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_87_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_87_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_87_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_87_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_87_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_87_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_87_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_87_des_minggu4_w"></td>
          </tr>
          <tr class="row46">
            <td class="column0 style76 s style76" colspan="4" rowspan="2">Kantor Project</td>
            <td class="column4 style63 null" id="lokasi_80_jan_minggu1"></td>
            <td class="column5 style63 null" id="lokasi_80_jan_minggu2"></td>
            <td class="column6 style63 null" id="lokasi_80_jan_minggu3"></td>
            <td class="column7 style63 null" id="lokasi_80_jan_minggu4"></td>
            <td class="column8 style63 null" id="lokasi_80_feb_minggu1"></td>
            <td class="column9 style63 null" id="lokasi_80_feb_minggu2"></td>
            <td class="column10 style63 null" id="lokasi_80_feb_minggu3"></td>
            <td class="column11 style63 null" id="lokasi_80_feb_minggu4"></td>
            <td class="column12 style63 null" id="lokasi_80_mar_minggu1"></td>
            <td class="column13 style63 null" id="lokasi_80_mar_minggu2"></td>
            <td class="column14 style63 null" id="lokasi_80_mar_minggu3"></td>
            <td class="column15 style63 null" id="lokasi_80_mar_minggu4"></td>
            <td class="column16 style65 null" id="lokasi_80_apr_minggu1"></td>
            <td class="column17 style65 null" id="lokasi_80_apr_minggu2"></td>
            <td class="column18 style65 null" id="lokasi_80_apr_minggu3"></td>
            <td class="column19 style64 null" id="lokasi_80_apr_minggu4"></td>
            <td class="column20 style63 null" id="lokasi_80_mei_minggu1"></td>
            <td class="column21 style63 null" id="lokasi_80_mei_minggu2"></td>
            <td class="column22 style63 null" id="lokasi_80_mei_minggu3"></td>
            <td class="column23 style63 null" id="lokasi_80_mei_minggu4"></td>
            <td class="column24 style63 null" id="lokasi_80_jun_minggu1"></td>
            <td class="column25 style63 null" id="lokasi_80_jun_minggu2"></td>
            <td class="column26 style63 null" id="lokasi_80_jun_minggu3"></td>
            <td class="column27 style63 null" id="lokasi_80_jun_minggu4"></td>
            <td class="column28 style63 null" id="lokasi_80_jul_minggu1"></td>
            <td class="column29 style63 null" id="lokasi_80_jul_minggu2"></td>
            <td class="column30 style63 null" id="lokasi_80_jul_minggu3"></td>
            <td class="column31 style63 null" id="lokasi_80_jul_minggu4"></td>
            <td class="column32 style65 null" id="lokasi_80_ags_minggu1"></td>
            <td class="column33 style65 null" id="lokasi_80_ags_minggu2"></td>
            <td class="column34 style65 null" id="lokasi_80_ags_minggu3"></td>
            <td class="column35 style64 null" id="lokasi_80_ags_minggu4"></td>
            <td class="column36 style63 null" id="lokasi_80_sep_minggu1"></td>
            <td class="column37 style63 null" id="lokasi_80_sep_minggu2"></td>
            <td class="column38 style63 null" id="lokasi_80_sep_minggu3"></td>
            <td class="column39 style63 null" id="lokasi_80_sep_minggu4"></td>
            <td class="column40 style63 null" id="lokasi_80_okt_minggu1"></td>
            <td class="column41 style63 null" id="lokasi_80_okt_minggu2"></td>
            <td class="column42 style63 null" id="lokasi_80_okt_minggu3"></td>
            <td class="column43 style63 null" id="lokasi_80_okt_minggu4"></td>
            <td class="column44 style63 null" id="lokasi_80_nov_minggu1"></td>
            <td class="column45 style63 null" id="lokasi_80_nov_minggu2"></td>
            <td class="column46 style63 null" id="lokasi_80_nov_minggu3"></td>
            <td class="column47 style63 null" id="lokasi_80_nov_minggu4"></td>
            <td class="column48 style65 null" id="lokasi_80_des_minggu1"></td>
            <td class="column49 style65 null" id="lokasi_80_des_minggu2"></td>
            <td class="column50 style65 null" id="lokasi_80_des_minggu3"></td>
            <td class="column51 style64 null" id="lokasi_80_des_minggu4"></td>
          </tr>
          <tr class="row47">
            <td class="column4 style63 null" id="lokasi_80_jan_minggu1_w"></td>
            <td class="column5 style63 null" id="lokasi_80_jan_minggu2_w"></td>
            <td class="column6 style63 null" id="lokasi_80_jan_minggu3_w"></td>
            <td class="column7 style63 null" id="lokasi_80_jan_minggu4_w"></td>
            <td class="column8 style63 null" id="lokasi_80_feb_minggu1_w"></td>
            <td class="column9 style63 null" id="lokasi_80_feb_minggu2_w"></td>
            <td class="column10 style63 null" id="lokasi_80_feb_minggu3_w"></td>
            <td class="column11 style63 null" id="lokasi_80_feb_minggu4_w"></td>
            <td class="column12 style63 null" id="lokasi_80_mar_minggu1_w"></td>
            <td class="column13 style63 null" id="lokasi_80_mar_minggu2_w"></td>
            <td class="column78 style63 null" id="lokasi_80_mar_minggu3_w"></td>
            <td class="column15 style63 null" id="lokasi_80_mar_minggu4_w"></td>
            <td class="column16 style65 null" id="lokasi_80_apr_minggu1_w"></td>
            <td class="column17 style65 null" id="lokasi_80_apr_minggu2_w"></td>
            <td class="column18 style65 null" id="lokasi_80_apr_minggu3_w"></td>
            <td class="column19 style64 null" id="lokasi_80_apr_minggu4_w"></td>
            <td class="column20 style63 null" id="lokasi_80_mei_minggu1_w"></td>
            <td class="column21 style63 null" id="lokasi_80_mei_minggu2_w"></td>
            <td class="column22 style63 null" id="lokasi_80_mei_minggu3_w"></td>
            <td class="column23 style63 null" id="lokasi_80_mei_minggu4_w"></td>
            <td class="column24 style63 null" id="lokasi_80_jun_minggu1_w"></td>
            <td class="column25 style63 null" id="lokasi_80_jun_minggu2_w"></td>
            <td class="column26 style63 null" id="lokasi_80_jun_minggu3_w"></td>
            <td class="column27 style63 null" id="lokasi_80_jun_minggu4_w"></td>
            <td class="column28 style63 null" id="lokasi_80_jul_minggu1_w"></td>
            <td class="column29 style63 null" id="lokasi_80_jul_minggu2_w"></td>
            <td class="column30 style63 null" id="lokasi_80_jul_minggu3_w"></td>
            <td class="column31 style63 null" id="lokasi_80_jul_minggu4_w"></td>
            <td class="column32 style65 null" id="lokasi_80_ags_minggu1_w"></td>
            <td class="column33 style65 null" id="lokasi_80_ags_minggu2_w"></td>
            <td class="column34 style65 null" id="lokasi_80_ags_minggu3_w"></td>
            <td class="column35 style64 null" id="lokasi_80_ags_minggu4_w"></td>
            <td class="column36 style63 null" id="lokasi_80_sep_minggu1_w"></td>
            <td class="column37 style63 null" id="lokasi_80_sep_minggu2_w"></td>
            <td class="column38 style63 null" id="lokasi_80_sep_minggu3_w"></td>
            <td class="column39 style63 null" id="lokasi_80_sep_minggu4_w"></td>
            <td class="column40 style63 null" id="lokasi_80_okt_minggu1_w"></td>
            <td class="column41 style63 null" id="lokasi_80_okt_minggu2_w"></td>
            <td class="column42 style63 null" id="lokasi_80_okt_minggu3_w"></td>
            <td class="column43 style63 null" id="lokasi_80_okt_minggu4_w"></td>
            <td class="column44 style63 null" id="lokasi_80_nov_minggu1_w"></td>
            <td class="column45 style63 null" id="lokasi_80_nov_minggu2_w"></td>
            <td class="column46 style63 null" id="lokasi_80_nov_minggu3_w"></td>
            <td class="column47 style63 null" id="lokasi_80_nov_minggu4_w"></td>
            <td class="column48 style65 null" id="lokasi_80_des_minggu1_w"></td>
            <td class="column49 style65 null" id="lokasi_80_des_minggu2_w"></td>
            <td class="column50 style65 null" id="lokasi_80_des_minggu3_w"></td>
            <td class="column51 style64 null" id="lokasi_80_des_minggu4_w"></td>
          </tr>
        </tbody>
    </table>
   </div>
  </body>

<script>
  document.addEventListener("DOMContentLoaded", function() {
      @foreach ($jadwals as $jd)
          var lokasiId = "{{ $jd->lokasi_id }}";
          var tanggalKegiatan = new Date("{{ $jd->tanggalkegiatan }}");
          var tanggalSelesai = new Date("{{ $jd->tanggalselesai }}");
          var currentMonth = tanggalKegiatan.getMonth();
          var currentYear = tanggalKegiatan.getFullYear();
          
          var lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
          var daysInMonth = lastDayOfMonth.getDate();
          
          var weeksInMonth = Math.ceil(daysInMonth / 7);

          while (tanggalKegiatan <= tanggalSelesai) {
              var dayOfWeek = tanggalKegiatan.getDay();
              var dayOfMonth = tanggalKegiatan.getDate();

              var firstDayOfMonth = new Date(currentYear, currentMonth, 1);
              var startWeek = Math.ceil((dayOfMonth + firstDayOfMonth.getDay()) / 7);

              var monthString;
              switch (currentMonth) {
                  case 0:
                      monthString = "jan";
                      break;
                  case 1:
                      monthString = "feb";
                      break;
                  case 2:
                      monthString = "mar";
                      break;
                  case 3:
                      monthString = "apr";
                      break;
                  case 4:
                      monthString = "mei";
                      break;
                  case 5:
                      monthString = "jun";
                      break;
                  case 6:
                      monthString = "jul";
                      break;
                  case 7:
                      monthString = "ags";
                      break;
                  case 8:
                      monthString = "sep";
                      break;
                  case 9:
                      monthString = "okt";
                      break;
                  case 10:
                      monthString = "nov";
                      break;
                  case 11:
                      monthString = "des";
                      break;
                  default:
                      monthString = "unknown";
              }

              var kolomId = "lokasi_" + lokasiId + "_" + monthString + "_minggu" + startWeek;
              var kolomTanggal = document.getElementById(kolomId);
              if (kolomTanggal) {
                  kolomTanggal.style.backgroundColor = "yellow";
              }

              tanggalKegiatan.setDate(tanggalKegiatan.getDate() + 1);

              if (tanggalKegiatan.getMonth() !== currentMonth) {
                  currentMonth = tanggalKegiatan.getMonth();
                  weeksInMonth = Math.ceil(lastDayOfMonth.getDate() / 7); 
              }
          }
      @endforeach
  });
</script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
      @foreach ($jadwals as $jd)
          var lokasiId = "{{ $jd->lokasi_id }}";
          var tanggalKegiatan = new Date("{{ $jd->waktu_mulai }}");
          var tanggalSelesai = new Date("{{ $jd->waktu_berakhir }}");
          var currentMonth = tanggalKegiatan.getMonth();
          var currentYear = tanggalKegiatan.getFullYear();
          
          var lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
          var daysInMonth = lastDayOfMonth.getDate();
          
          var weeksInMonth = Math.ceil(daysInMonth / 7);

          while (tanggalKegiatan <= tanggalSelesai) {
              var dayOfWeek = tanggalKegiatan.getDay();
              var dayOfMonth = tanggalKegiatan.getDate();

              var firstDayOfMonth = new Date(currentYear, currentMonth, 1);
              var startWeek = Math.ceil((dayOfMonth + firstDayOfMonth.getDay()) / 7);

              var monthString;
              switch (currentMonth) {
                  case 0:
                      monthString = "jan";
                      break;
                  case 1:
                      monthString = "feb";
                      break;
                  case 2:
                      monthString = "mar";
                      break;
                  case 3:
                      monthString = "apr";
                      break;
                  case 4:
                      monthString = "mei";
                      break;
                  case 5:
                      monthString = "jun";
                      break;
                  case 6:
                      monthString = "jul";
                      break;
                  case 7:
                      monthString = "ags";
                      break;
                  case 8:
                      monthString = "sep";
                      break;
                  case 9:
                      monthString = "okt";
                      break;
                  case 10:
                      monthString = "nov";
                      break;
                  case 11:
                      monthString = "des";
                      break;
                  default:
                      monthString = "unknown";
              }

              var kolomId = "lokasi_" + lokasiId + "_" + monthString + "_minggu" + startWeek + "_w";
              var kolomTanggal = document.getElementById(kolomId);
              if (kolomTanggal) {
                  kolomTanggal.style.backgroundColor = "lime";
              }

              tanggalKegiatan.setDate(tanggalKegiatan.getDate() + 1);

              if (tanggalKegiatan.getMonth() !== currentMonth) {
                  currentMonth = tanggalKegiatan.getMonth();
                  weeksInMonth = Math.ceil(lastDayOfMonth.getDate() / 7); 
              }
          }
      @endforeach
  });
</script>

</html>

