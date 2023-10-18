
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="different types of invoice/bill/tally designed with friendly and markup using modern technology, you can use it on any type of website invoice, fully responsive and w3 validated.">
    <meta name="keywords" content="bill , receipt, tally, invoice, cash memo, invoice html, invoice pdf, invoice print, invoice templates, multipurpose invoice, template, booking invoice, general invoice, clean invoice, catalog, estimate, proposal">
    <meta name="author" content="initTheme">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title> invoice</title>
    <link rel="icon" type="image/x-icon" sizes="20x20" href="{{ asset('invoice/images/icon/favicon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('invoice/css/main-style.css') }}">
</head>
<body class="section-bg-one">


    @yield('invoice')

    <!-- invoice Bottom  -->
    <div class="text-center mt-5 mb-4 regular-button">
        <div class="d-print-none d-flex justify-content-center flex-wrap gap-10">
            <button id="bill-download" class="btn-primary-outline">Download</button>
            <a href="javascript:window.print()" class="btn-primary-fill">Print Invoice</a>
        </div>
    </div>

    <!-- jquery-->
    <script src="{{ asset('invoice') }}/js/jquery-3.7.0.min.js"></script>
    <!-- Plugin -->
    <script src="{{ asset('invoice') }}/js/plugin.js"></script>
    <!-- Main js-->
    <script src="{{ asset('invoice') }}/js/mian.js"></script>
</body>
</html>
