<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="apple-touch-icon.png" rel="apple-touch-icon">
  <link href="favicon.png" rel="icon">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>NGLO - Cakes</title>
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script%7CLora:400,700" rel="stylesheet">
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="plugins/bakery-icon/style.css">
  <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/owl-carousel/assets/owl.carousel.css">
  <link rel="stylesheet" href="plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
  <link rel="stylesheet" href="plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="plugins/slick/slick/slick.css">
  <link rel="stylesheet" href="plugins/lightGallery-master/dist/css/lightgallery.min.css">
  <link rel="stylesheet" href="css/style.css?v=242">
  <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
  <!--WARNING: Respond.js doesn't work if you view the page via file://-->
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
  <!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
  <!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
  <!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @media (min-width:900px) {
      .f-text-right {
        text-align: right !important;
      }
    }

    .ink {
      background: url('images/ink.svg');
    }

    .line {
      position: relative;
      margin-top: -92px;
      width: 400px !important;
    }

    .ps-block__thumbnail img {
      height: 300px;
      width: auto
    }

    .ps-block--product-set .ps-block__thumbnail {
      text-align: unset !important;
    }

    @media (min-width:900px) {
      .ps-block--product-set {
        display: flex;
        align-items: center;
        flex-direction: row-reverse;
      }
    }

    .ps-form--menu {
      max-width: 100% !important;
    }

  body {
    scroll-behavior: smooth;
  }

  .swal2-title{
    font-size: 3rem;
  }

  .swal2-html-container{
    font-size: 2.1rem !important;
  }

  .swal2-popup {
    /* padding: 35px; */
    min-width: 350px;
  }

  .swal2-confirm{
  background-color: #c9981b !important;
  padding: 12px 35px !important;
  }


  
  .centered{
        display: flex;
        justify-content: center;
    }

    @media screen and (min-width:900px) {
        .centered.my2{
            justify-content: start !important
        }
    }

    .centered.my2{
        margin: 20px 0;
    }
    .cartform{
        display: flex;
        align-items: center;
        border-radius: 10px;
        transition: width 2s;
        justify-content: center;
    }

    .cartform input{
        display: none;
    }

    .cartform:hover{
        width:100px;
        border:1px solid rgb(0, 0, 0);
        justify-content: space-between;

    }

    .cartform:hover input{
        /* width:100px; */
        display: inline-block;
    }

    .cartform:hover button>span{
        display: none;
    }

    .cartform input{
        background: transparent;
        border: none !important;
        outline: none;
        width: 70%;
        padding: 2px 10px;
        font-weight: semibold;
    }

    .cartform button{
        padding:  8px 14px;
        border-radius: 10px;
        background:#000 ;
        color: #fff;
        box-shadow: none;
        border:none;
        transition: display .5s;
    }

    .cartform button.btn1, .cartform:hover button.btn2{
        display:none
    }
    .cartform button.btn2, .cartform:hover button.btn1{
        display:inline-block
    }


    .toastr-container{
        position:fixed;
        margin-top:20px;
        width: 100%;
        left:0;
        display:flex;
        justify-content:center;
        z-index: 1000;
    }

    .toastr{
        background:#000;
        border-radius:8px;
        padding:15px 20px;
        font-weight:semibold
    }

    .toastr p{
        color:#fff !important;
    }
    .toastr .btn{
        border-radius:25px;
        background:#eee;
        color:#000;
        padding:5px 10px;
    }

    .flex{
        display:flex
    }

    .flex.center{
        justify-content:center;
    }

    .flex.a-center{
        align-Items:center
    }

    .flex.end{
        justify-content:end
    }

    .fixed-top{
        position: fixed !important;
        width: 100%;
        left:0;
        top:0;
        background:#fff;
        transition:background .5s;
        border-bottom: 1px solid rgb(255, 197, 140)
    }

    .fixed-top .header__top{
        display: none !important;
    }

    .fixed-top .navigation{
        padding: 10px 0;
    }
  </style>
</head>
