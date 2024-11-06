<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Hously - Tailwind CSS Real Estate Landing & Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tailwind CSS Saas & Software Landing Page Template">
    <meta name="keywords" content="agency, application, business, clean, creative, cryptocurrency, it solutions, modern, multipurpose, nft marketplace, portfolio, saas, software, tailwind css">
    <meta name="author" content="Shreethemes">
    <meta name="website" content="https://shreethemes.in">
    <meta name="email" content="support@shreethemes.in">
    <meta name="version" content="2.2.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--  Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Unicons -->
    <link href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" rel="stylesheet">


    <!-- favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    @vite(['resources/css/app.css', 'resources/js/app.js'])



</head>

<body class="font-body text-base text-black dark:text-white dark:bg-slate-900">

<x-navbar/>
{{$slot}}
<x-footer/>
<!-- Back to top -->
<a href="#" onclick="topFunction()" id="back-to-top"
   class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-green-600 text-white justify-center items-center">
    <i class="uil uil-arrow-up"></i></a>
<!-- Back to top -->

</body>
</html>
