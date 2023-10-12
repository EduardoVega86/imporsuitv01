<!doctype html>
<?php
   session_start();
  if (!isset($_SESSION["comprar"])){
         $session_id = 'user_' . mt_rand();
         $_SESSION["comprar"]=$session_id;
     }else{
       $session_id= $_SESSION["comprar"];  
     }
     if (isset($_GET['id_cat'])){
        $id_categoria=$_GET['id_cat']; 
     }
   
   require_once "sysadmin/vistas/db.php";
       require_once "sysadmin/vistas/php_conexion.php";
       require_once "sysadmin/vistas/funciones.php";
       
         $id_producto='';  
       $pagina='CATALOGO';   
       include './auditoria.php';
       include './includes/style.php';
       if (isset($_GET['id_cat'])){
           $sql="select * from lineas where online='1' and padre='$id_categoria'";
       
       
                 //echo $sql;
$query = mysqli_query($conexion, $sql);
$categorias='';
while ($row = mysqli_fetch_array($query)) {
    $id_linea         = $row['id_linea'];
            $nombre_linea     = $row['nombre_linea'];
            $padre  = $row['padre'];
            $categorias.="'".$row['id_linea']."',";
}
   }
       ?>
<html class="no-js" lang="es">
   <?php
   include 'includes/head.php'
   ?>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><!-- comment -->
<script id="sections-script" data-sections="header,footer" defer="defer" src="js/scripts.js?84"></script>

<style id="shopify-dynamic-checkout-cart">@media screen and (min-width: 750px) {
  #dynamic-checkout-cart {
    min-height: 50px;
  }
}

@media screen and (max-width: 750px) {
  #dynamic-checkout-cart {
    min-height: 60px;
  }
}
</style>
<script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');</script>

<link href="ccs/style_ini.css" rel="stylesheet" type="text/css"/>
    

    <link href="css/base.css?v=108207397045790613361693673626" rel="stylesheet" type="text/css" media="all" />
<script>
      document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
      if (Shopify.designMode) {
        document.documentElement.classList.add('shopify-design-mode');
      }
    </script>
    
    <script>
    window.bucksCC = window.bucksCC || {};
    window.bucksCC.config = {}; window.bucksCC.reConvert = function () {};
    "function"!=typeof Object.assign&&(Object.assign=function(n){if(null==n)throw new TypeError("Cannot convert undefined or null to object");for(var r=Object(n),t=1;t<arguments.length;t++){var e=arguments[t];if(null!=e)for(var o in e)e.hasOwnProperty(o)&&(r[o]=e[o])}return r});
    Object.assign(window.bucksCC.config, {"expertSettings":"{\"css\":\"\"}","_id":"63b1a3855e8fc3681ee509d0","shop":"088f7b.myshopify.com","active":false,"autoSwitchCurrencyLocationBased":true,"autoSwitchOnlyToPreferredCurrency":false,"backgroundColor":"rgba(255,255,255,1)","borderStyle":"boxShadow","cartNotificationBackgroundColor":"rgba(251,245,245,1)","cartNotificationMessage":"We process all orders in {STORE_CURRENCY} and you will be checkout using the most current exchange rates.","cartNotificationStatus":false,"cartNotificationTextColor":"rgba(30,30,30,1)","customOptionsPlacement":false,"customOptionsPlacementMobile":false,"customPosition":"header a[href*=\"/cart\"]","darkMode":false,"defaultCurrencyRounding":false,"displayPosition":"bottom_left","displayPositionType":"floating","flagDisplayOption":"showFlagAndCurrency","flagStyle":"traditional","flagTheme":"rounded","hoverColor":"rgba(255,255,255,1)","instantLoader":false,"mobileCustomPosition":"header a[href*=\"/cart\"]","mobileDisplayPosition":"bottom_left","mobileDisplayPositionType":"floating","mobilePositionPlacement":"after","moneyWithCurrencyFormat":true,"optionsPlacementType":"left_upwards","optionsPlacementTypeMobile":"left_upwards","positionPlacement":"after","priceRoundingType":"roundToDecimal","roundingDecimal":0.95,"selectedCurrencies":"[{\"USD\":\"US Dollar (USD)\"},{\"EUR\":\"Euro (EUR)\"},{\"GBP\":\"British Pound (GBP)\"},{\"CAD\":\"Canadian Dollar (CAD)\"},{\"AFN\":\"Afghan Afghani (AFN)\"},{\"ALL\":\"Albanian Lek (ALL)\"},{\"DZD\":\"Algerian Dinar (DZD)\"},{\"AOA\":\"Angolan Kwanza (AOA)\"},{\"ARS\":\"Argentine Peso (ARS)\"},{\"AMD\":\"Armenian Dram (AMD)\"},{\"AWG\":\"Aruban Florin (AWG)\"},{\"AUD\":\"Australian Dollar (AUD)\"},{\"BBD\":\"Barbadian Dollar (BBD)\"},{\"AZN\":\"Azerbaijani Manat (AZN)\"},{\"BDT\":\"Bangladeshi Taka (BDT)\"},{\"BSD\":\"Bahamian Dollar (BSD)\"},{\"BHD\":\"Bahraini Dinar (BHD)\"},{\"BIF\":\"Burundian Franc (BIF)\"},{\"BYN\":\"Belarusian Ruble (BYN)\"},{\"BYR\":\"Belarusian Ruble (BYR)\"},{\"BZD\":\"Belize Dollar (BZD)\"},{\"BMD\":\"Bermudan Dollar (BMD)\"},{\"BTN\":\"Bhutanese Ngultrum (BTN)\"},{\"BAM\":\"Bosnia-Herzegovina Convertible Mark (BAM)\"},{\"BRL\":\"Brazilian Real (BRL)\"},{\"BOB\":\"Bolivian Boliviano (BOB)\"},{\"BWP\":\"Botswanan Pula (BWP)\"},{\"BND\":\"Brunei Dollar (BND)\"},{\"BGN\":\"Bulgarian Lev (BGN)\"},{\"MMK\":\"Myanmar Kyat (MMK)\"},{\"KHR\":\"Cambodian Riel (KHR)\"},{\"CVE\":\"Cape Verdean Escudo (CVE)\"},{\"KYD\":\"Cayman Islands Dollar (KYD)\"},{\"XAF\":\"Central African CFA Franc (XAF)\"},{\"CLP\":\"Chilean Peso (CLP)\"},{\"CNY\":\"Chinese Yuan (CNY)\"},{\"COP\":\"Colombian Peso (COP)\"},{\"KMF\":\"Comorian Franc (KMF)\"},{\"CDF\":\"Congolese Franc (CDF)\"},{\"CRC\":\"Costa Rican Colón (CRC)\"},{\"HRK\":\"Croatian Kuna (HRK)\"},{\"CZK\":\"Czech Koruna (CZK)\"},{\"DKK\":\"Danish Krone (DKK)\"},{\"DJF\":\"Djiboutian Franc (DJF)\"},{\"DOP\":\"Dominican Peso (DOP)\"},{\"XCD\":\"East Caribbean Dollar (XCD)\"},{\"EGP\":\"Egyptian Pound (EGP)\"},{\"ETB\":\"Ethiopian Birr (ETB)\"},{\"FKP\":\"Falkland Islands Pound (FKP)\"},{\"XPF\":\"CFP Franc (XPF)\"},{\"FJD\":\"Fijian Dollar (FJD)\"},{\"GIP\":\"Gibraltar Pound (GIP)\"},{\"GMD\":\"Gambian Dalasi (GMD)\"},{\"GHS\":\"Ghanaian Cedi (GHS)\"},{\"GTQ\":\"Guatemalan Quetzal (GTQ)\"},{\"GYD\":\"Guyanaese Dollar (GYD)\"},{\"GEL\":\"Georgian Lari (GEL)\"},{\"GNF\":\"Guinean Franc (GNF)\"},{\"HTG\":\"Haitian Gourde (HTG)\"},{\"HNL\":\"Honduran Lempira (HNL)\"},{\"HKD\":\"Hong Kong Dollar (HKD)\"},{\"HUF\":\"Hungarian Forint (HUF)\"},{\"ISK\":\"Icelandic Króna (ISK)\"},{\"INR\":\"Indian Rupee (INR)\"},{\"IDR\":\"Indonesian Rupiah (IDR)\"},{\"ILS\":\"Israeli New Shekel (ILS)\"},{\"IRR\":\"Iranian Rial (IRR)\"},{\"IQD\":\"Iraqi Dinar (IQD)\"},{\"JMD\":\"Jamaican Dollar (JMD)\"},{\"JPY\":\"Japanese Yen (JPY)\"},{\"JEP\":\"Jersey Pound (JEP)\"},{\"JOD\":\"Jordanian Dinar (JOD)\"},{\"KZT\":\"Kazakhstani Tenge (KZT)\"},{\"KES\":\"Kenyan Shilling (KES)\"},{\"KWD\":\"Kuwaiti Dinar (KWD)\"},{\"KGS\":\"Kyrgystani Som (KGS)\"},{\"LAK\":\"Laotian Kip (LAK)\"},{\"LVL\":\"Latvian Lats (LVL)\"},{\"LBP\":\"Lebanese Pound (LBP)\"},{\"LSL\":\"Lesotho Loti (LSL)\"},{\"LRD\":\"Liberian Dollar (LRD)\"},{\"LYD\":\"Libyan Dinar (LYD)\"},{\"MGA\":\"Malagasy Ariary (MGA)\"},{\"MKD\":\"Macedonian Denar (MKD)\"},{\"MOP\":\"Macanese Pataca (MOP)\"},{\"MWK\":\"Malawian Kwacha (MWK)\"},{\"MVR\":\"Maldivian Rufiyaa (MVR)\"},{\"MXN\":\"Mexican Peso (MXN)\"},{\"MYR\":\"Malaysian Ringgit (MYR)\"},{\"MUR\":\"Mauritian Rupee (MUR)\"},{\"MDL\":\"Moldovan Leu (MDL)\"},{\"MAD\":\"Moroccan Dirham (MAD)\"},{\"MNT\":\"Mongolian Tugrik (MNT)\"},{\"MZN\":\"Mozambican Metical (MZN)\"},{\"NAD\":\"Namibian Dollar (NAD)\"},{\"NPR\":\"Nepalese Rupee (NPR)\"},{\"ANG\":\"Netherlands Antillean Guilder (ANG)\"},{\"NZD\":\"New Zealand Dollar (NZD)\"},{\"NIO\":\"Nicaraguan Córdoba (NIO)\"},{\"NGN\":\"Nigerian Naira (NGN)\"},{\"NOK\":\"Norwegian Krone (NOK)\"},{\"OMR\":\"Omani Rial (OMR)\"},{\"PAB\":\"Panamanian Balboa (PAB)\"},{\"PKR\":\"Pakistani Rupee (PKR)\"},{\"PGK\":\"Papua New Guinean Kina (PGK)\"},{\"PYG\":\"Paraguayan Guarani (PYG)\"},{\"PEN\":\"Peruvian Sol (PEN)\"},{\"PHP\":\"Philippine Piso (PHP)\"},{\"PLN\":\"Polish Zloty (PLN)\"},{\"QAR\":\"Qatari Rial (QAR)\"},{\"RON\":\"Romanian Leu (RON)\"},{\"RUB\":\"Russian Ruble (RUB)\"},{\"RWF\":\"Rwandan Franc (RWF)\"},{\"WST\":\"Samoan Tala (WST)\"},{\"SHP\":\"St. Helena Pound (SHP)\"},{\"SAR\":\"Saudi Riyal (SAR)\"},{\"STD\":\"São Tomé & Príncipe Dobra (STD)\"},{\"RSD\":\"Serbian Dinar (RSD)\"},{\"SCR\":\"Seychellois Rupee (SCR)\"},{\"SLL\":\"Sierra Leonean Leone (SLL)\"},{\"SGD\":\"Singapore Dollar (SGD)\"},{\"SDG\":\"Sudanese Pound (SDG)\"},{\"SYP\":\"Syrian Pound (SYP)\"},{\"ZAR\":\"South African Rand (ZAR)\"},{\"KRW\":\"South Korean Won (KRW)\"},{\"SSP\":\"South Sudanese Pound (SSP)\"},{\"SBD\":\"Solomon Islands Dollar (SBD)\"},{\"LKR\":\"Sri Lankan Rupee (LKR)\"},{\"SRD\":\"Surinamese Dollar (SRD)\"},{\"SZL\":\"Swazi Lilangeni (SZL)\"},{\"SEK\":\"Swedish Krona (SEK)\"},{\"CHF\":\"Swiss Franc (CHF)\"},{\"TWD\":\"New Taiwan Dollar (TWD)\"},{\"THB\":\"Thai Baht (THB)\"},{\"TJS\":\"Tajikistani Somoni (TJS)\"},{\"TZS\":\"Tanzanian Shilling (TZS)\"},{\"TOP\":\"Tongan Paʻanga (TOP)\"},{\"TTD\":\"Trinidad & Tobago Dollar (TTD)\"},{\"TND\":\"Tunisian Dinar (TND)\"},{\"TRY\":\"Turkish Lira (TRY)\"},{\"TMT\":\"Turkmenistani Manat (TMT)\"},{\"UGX\":\"Ugandan Shilling (UGX)\"},{\"UAH\":\"Ukrainian Hryvnia (UAH)\"},{\"AED\":\"United Arab Emirates Dirham (AED)\"},{\"UYU\":\"Uruguayan Peso (UYU)\"},{\"UZS\":\"Uzbekistani Som (UZS)\"},{\"VUV\":\"Vanuatu Vatu (VUV)\"},{\"VEF\":\"Venezuelan Bolívar (VEF)\"},{\"VND\":\"Vietnamese Dong (VND)\"},{\"XOF\":\"West African CFA Franc (XOF)\"},{\"YER\":\"Yemeni Rial (YER)\"},{\"ZMW\":\"Zambian Kwacha (ZMW)\"}]","showCurrencyCodesOnly":false,"showInDesktop":true,"showInMobileDevice":false,"showOriginalPriceOnMouseHover":false,"textColor":"rgba(30,30,30,1)","themeType":"default","trigger":"","userCurrency":"","watchUrls":""}, { money_format: "${{amount}}", money_with_currency_format: "${{amount}} USD", userCurrency: "USD" }); window.bucksCC.config.multiCurrencies = [];  window.bucksCC.config.multiCurrencies = "USD".split(',') || ''; window.bucksCC.config.cartCurrency = "USD" || '';
    </script>
    

  




<script src="css/datepicker.min.js" defer></script><script src="https://cdn.shopify.com/extensions/f4d444f1-c616-4248-bb30-d4abba91bf9b/0.93.0/assets/get-form-script.min.js" defer></script><script id="rsi-cod-form-product-cache" type="application/json">null</script>
<script id="rsi-cod-form-product-collections-cache" type="application/json">null</script>

  

<!-- BEGIN app snippet: metafields-handlers -->











<!-- END app snippet -->
<link href="ccs/style.min.css" rel="stylesheet" type="text/css"/>
<link href="ccs/datepicker.min.css" rel="stylesheet" type="text/css"/>

<!-- END app app block --><link href="https://monorail-edge.shopifysvc.com" rel="dns-prefetch">

<body class="gradient">
    
   
<script src="js/cart.js?v=139383546597281746371693673626" defer="defer"></script>
<script src="js/product-info.js?v=174806172978439001541693673628" defer="defer"></script>
<script src="js/product-form.js?v=70749256710412210451693673628" defer="defer"></script>




<style>
  .drawer {
    visibility: hidden;
  }
  
</style>

<?php
         include 'includes/carrito.php';
         ?>






<!-- BEGIN sections: header-group -->
<div id="shopify-section-sections--20805847122201__2c2ec774-3430-481f-b927-e9c035b9d24e" class="shopify-section shopify-section-group-header-group">
    
    <link href="ccs/component-tickers.css?v=30346802988262109031693673627" rel="stylesheet" type="text/css" media="all" />

<?php include './includes/flotante.php' ?>

  <!-- <div class="horizontal-ticker__inner"> -->
  <?php
               include 'includes/horizontal_items.php';
               ?>
  <!-- </div> -->



</div>
<div id="shopify-section-sections--20805847122201__header" class="shopify-section shopify-section-group-header-group section-header">
    
    <link rel="stylesheet" href="ccs/component-list-menu.css?v=151968516119678728991693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-search.css?v=184225813856820874251693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-menu-drawer.css?v=183501262910778191901693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-cart-notification.css?v=137625604348931474661693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-cart-items.css?v=68325217056990975251693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-price.css?v=183165605081763449011693673627" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="ccs/component-loading-overlay.css?v=167310470843593579841693673627" media="print" onload="this.media='all'"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-cart-drawer.css?v=103351759924144934211693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="ccs/component-cart.css?v=183883492810467818381693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="ccs/omponent-totals.css?v=54425048278126878361693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="ccs/component-price.css?v=183165605081763449011693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="ccs/component-discounts.css?v=152760482443307489271693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="ccs/component-loading-overlay.css?v=167310470843593579841693673627" rel="stylesheet" type="text/css" media="all" />
<noscript><link href="ccs/component-list-menu.css?v=151968516119678728991693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="ccs/component-search.css?v=184225813856820874251693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="ccs/component-menu-drawer.css?v=183501262910778191901693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="ccs/component-cart-notification.css?v=137625604348931474661693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="ccs/component-cart-items.css?v=68325217056990975251693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<link href="ccs/style_ini.css" rel="stylesheet" type="text/css"/>

<script src="js/details-disclosure.js?v=153497636716254413831693673628" defer="defer"></script>
<script src="js/details-modal.js?v=4511761896672669691693673628" defer="defer"></script>
<script src="js/cart-notification.js?v=160453272920806432391693673626" defer="defer"></script>
<script src="js/search-form.js?v=113639710312857635801693673628" defer="defer"></script>

<script src="js/cart-drawer.js?v=44260131999403604181693673626" defer="defer"></script>
<svg xmlns="http://www.w3.org/2000/svg" class="hidden">
  <symbol id="icon-search" viewbox="0 0 18 19" fill="none">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.03 11.68A5.784 5.784 0 112.85 3.5a5.784 5.784 0 018.18 8.18zm.26 1.12a6.78 6.78 0 11.72-.7l5.4 5.4a.5.5 0 11-.71.7l-5.41-5.4z" fill="currentColor"/>
  </symbol>

  <symbol id="icon-reset" class="icon icon-close"  fill="none" viewBox="0 0 18 18" stroke="currentColor">
    <circle r="8.5" cy="9" cx="9" stroke-opacity="0.2"/>
    <path d="M6.82972 6.82915L1.17193 1.17097" stroke-linecap="round" stroke-linejoin="round" transform="translate(5 5)"/>
    <path d="M1.22896 6.88502L6.77288 1.11523" stroke-linecap="round" stroke-linejoin="round" transform="translate(5 5)"/>
  </symbol>

  <symbol id="icon-close" class="icon icon-close" fill="none" viewBox="0 0 18 17">
    <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor">
  </symbol>
</svg>

<?php
$index_activa="";
$categoria_activa="menu_activo texto_boton";
            include 'includes/styky-header.php';
            ?>


</div>
<!-- END sections: header-group -->

    <main id="MainContent" class="content-for-layout focus-none" role="main" tabindex="-1">
      <div id="shopify-section-template--20805846040857__main-collection-banner" class="shopify-section section">
          
<link href="ccs/component-collection-hero.css?v=40426793502088958311693673627" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>@media screen and (max-width: 749px) {
    .collection-hero--with-image .collection-hero__inner {
      padding-bottom: calc(0px + 2rem);
    }
  }</style><div class="collection-hero color-background-1 gradient">
  <div class="collection-hero__inner page-width">
    <div class="collection-hero__text-wrapper">
      <h1 class="collection-hero__title">
        <span class="visually-hidden">Collection: </span>Productos</h1><div class="collection-hero__description rte"></div></div></div>
</div>


</div><div id="shopify-section-template--20805846040857__main-collection-product-grid" class="shopify-section section"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/template-collection.css?v=145944865380958730931693673629" rel="stylesheet" type="text/css" media="all" />
<link href="ccs/component-loading-overlay.css?v=167310470843593579841693673627" rel="stylesheet" type="text/css" media="all" />
<link href="ccs/component-card.css?v=171622893807557687511693673627" rel="stylesheet" type="text/css" media="all" />
<link href="ccs/component-price.css?v=183165605081763449011693673627" rel="stylesheet" type="text/css" media="all" />

<link
  rel="preload"
  href="ccs/component-rte.css?v=73443491922477598101693673627"
  as="style"
  onload="this.onload=null;this.rel='stylesheet'"
><link rel="stylesheet" href="css/quick-add.css?v=104678793703231887271693673628" media="print" onload="this.media='all'">
  <script src="js/quick-add.js?v=21087258723263848871693673628" defer="defer"></script>
  <script src="js/product-form.js?v=70749256710412210451693673628" defer="defer"></script><noscript><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" /></noscript><style data-shopify>.section-template--20805846040857__main-collection-product-grid-padding {
    padding-top: 0px;
    padding-bottom: 0px;
  }

  @media screen and (min-width: 750px) {
    .section-template--20805846040857__main-collection-product-grid-padding {
      padding-top: 0px;
      padding-bottom: 0px;
    }
  }</style><div class="section-template--20805846040857__main-collection-product-grid-padding">
  
<div class="">
    <link href="ccs/component-facets.css?v=85339117615856704561693673627" rel="stylesheet" type="text/css" media="all" />
    
    <script src="js/facets.js?v=5979223589038938931693673628" defer="defer"></script><aside
        aria-labelledby="verticalTitle"
        class="facets-wrapper page-width"
        id="main-collection-filters"
        data-id="template--20805846040857__main-collection-product-grid"
      >
        

<link href="css/component-show-more.css?v=56103980314977906391693673627" rel="stylesheet" type="text/css" media="all" />

<?php include 'includes/filtros.php'; ?>
    

  

  <div class="active-facets active-facets-mobile medium-hide large-up-hide"><facet-remove class="active-facets__button-wrapper">
      <a href="/collections/all" class="active-facets__button-remove underlined-link">
        <span>Remove all</span>
      </a>
    </facet-remove>
  </div>
  
<div
    class="product-count light medium-hide large-up-hide"
    role="status"
  >
    <h2 class="product-count__text text-body">
      <span id="ProductCount"><?php ?>
</span>
    </h2>
    <div class="loading-overlay__spinner">
      <svg
        aria-hidden="true"
        focusable="false"
        class="spinner"
        viewBox="0 0 66 66"
        xmlns="http://www.w3.org/2000/svg"
      >
        <circle class="path" fill="none" stroke-width="6" cx="33" cy="33" r="30"></circle>
      </svg>
    </div>
  </div></div>

      </aside>
    <div class="product-grid-container" id="ProductGridContainer"><div class="collection page-width">
            <div class="loading-overlay gradient"></div>

            <ul
              id="product-grid"
              data-id="template--20805846040857__main-collection-product-grid"
              class="
                grid product-grid grid--2-col-tablet-down
                grid--4-col-desktop
              "
            >
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
               <script src="assets/js/bootstrap.bundle.min.js"></script>
                 <?php
                // echo 'asd';
                 if (isset($_GET['id_cat'])){
                  if (isset($categorias) and $categorias!=''){
                      $lista_cat =substr($categorias, 0, -1);
                      $sql="select * from productos where pagina_web='1' and id_linea_producto in ($lista_cat) or id_linea_producto=$id_categoria";
                     
                    }else{
                       $lista_cat="''";  
                      $sql="select * from productos where pagina_web='1' and id_linea_producto=$id_categoria"; 
                    }
                 }else{
                     $sql="select * from productos where pagina_web='1'";
                 }
                
                           $query = mysqli_query($conexion, $sql);
                           $num_registros = mysqli_num_rows($query);
                           //echo $num_registros, ' Productos';
                           while ($row = mysqli_fetch_array($query)) {
                            $id_producto          = $row['id_producto'];
            $codigo_producto      = $row['codigo_producto'];
            $nombre_producto      = $row['nombre_producto'];
            $descripcion_producto = $row['descripcion_producto'];
            $linea_producto       = $row['id_linea_producto'];
            $med_producto         = $row['id_med_producto'];
            $id_proveedor         = $row['id_proveedor'];
            $inv_producto         = $row['inv_producto'];
            $impuesto_producto    = $row['iva_producto'];
            $costo_producto       = $row['costo_producto'];
            $utilidad_producto    = $row['utilidad_producto'];
            $precio_producto      = $row['valor1_producto'];
            $precio_mayoreo       = $row['valor2_producto'];
            $precio_especial      = $row['valor3_producto'];
            $precio_normal      = $row['valor4_producto'];
            $stock_producto       = $row['stock_producto'];
            $stock_min_producto   = $row['stock_min_producto'];
            $online   = $row['pagina_web'];
            $status_producto      = $row['estado_producto'];
            $date_added           = date('d/m/Y', strtotime($row['date_added']));
            $image_path           = $row['image_path'];
            $id_imp_producto      = $row['id_imp_producto'];
                           
                ?>
                <li class="grid__item">
                  

<link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-rating.css?v=24573085263941240431693673627" rel="stylesheet" type="text/css" media="all" />
<div class="card-wrapper product-card-wrapper underline-links-hover">
    <div
      class="
        card
        card--card
         card--media
         color-background-1 gradient
        
        
        
      "
      style="--ratio-percent: 100.0%;"
    >
      <div
        class="card__inner  ratio"
        style="--ratio-percent: 100.0%;"
      ><div class="card__media">
            <div class="media media--transparent media--hover-effect">
              
              <img
                srcset=" sysadmin/<?php echo str_replace ( "../.." , "" , $image_path  )?>"
                src=" sysadmin/<?php echo str_replace ( "../.." , "" , $image_path  )?>"
                sizes="(min-width: 1400px) 317px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
                alt=""
                class="motion-reduce"
                
                width="1080"
                height="1080"
              >
              
</div>
          </div><div class="card__content">
          <div class="card__information">
            <h3
              class="card__heading"
              
            >
              <a
                href="prodcuto.php?id=<?php echo $id_producto ?>"
                id="StandardCardNoMediaLink-template--20805846040857__main-collection-product-grid-8525627818265"
                class="full-unstyled-link"
                aria-labelledby=""
              >
                <?php echo $nombre_producto;?>
              </a>
            </h3>
          </div>
              
          <div class="card__badge bottom left">
              <?php 
              if($precio_normal>0){
                  ?>
              <span
                id="NoMediaStandardBadge-template--20805846040857__main-collection-product-grid-8525627818265"
                class="badge badge--bottom-left color-accent-2"
              >
                
              
                <svg
  aria-hidden="true"
  focusable="false"
  class="icon icon-discount color-foreground-text"
  viewBox="0 0 12 12"
>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0h3a2 2 0 012 2v3a1 1 0 01-.3.7l-6 6a1 1 0 01-1.4 0l-4-4a1 1 0 010-1.4l6-6A1 1 0 017 0zm2 2a1 1 0 102 0 1 1 0 00-2 0z" fill="currentColor">
</svg>
 <?php
 
     //$precio_especial;
     echo "<span class='nowrap'>";
     echo "AHORRA UN&nbsp";
     echo number_format(100-($precio_especial*100/$precio_normal),2);
     echo "%";
     echo "</span>";
 }
 ?>
  
              </div>
        </div>
      </div>
      <div class="card__content">
        <div class="card__information">
          <h3
            class="card__heading h5"
            
              id="title-template--20805846040857__main-collection-product-grid-8525627818265"
            
          >
            <a
              href="producto.php?id=<?php echo $id_producto ?>"
              id="CardLink-template--20805846040857__main-collection-product-grid-8525627818265"
              class="full-unstyled-link"
              aria-labelledby="CardLink-template--20805846040857__main-collection-product-grid-8525627818265 Badge-template--20805846040857__main-collection-product-grid-8525627818265"
            >
             <?php echo $nombre_producto;?>
            </a>
          </h3>
                            

          <div class="card-information">
              <span class="caption-large light"></span>
<div
  class="
    price  price--on-sale "
>
  <div class="price__container"><div class="price__regular">
      <span class="visually-hidden visually-hidden--inline">Precio Regular</span>
      <span class="price-item price-item--regular">
        <?php echo number_format($precio_especial,2);?>
      </span>
    </div>
    <div class="price__sale ">
      <span class="visually-hidden visually-hidden--inline regular-price-label">Precio Regular</span>
      <span class="price-item price-item--sale price-item--last">
        <?php echo '$'.number_format($precio_especial,2);?>
      </span>
        <span class="visually-hidden visually-hidden--inline compare-price-label">Precio normal</span>
        <span class="price__compare-price">
          <s class="price-item price-item--regular">
           <?php if($precio_normal>0){echo '$'.$precio_normal;}?>
          </s>
        </span>
    
    </div>
    <small class="unit-price caption hidden">
      <span class="visually-hidden">Unit price</span>
      <span class="price-item price-item--last">
        <span></span>
        <span aria-hidden="true">/</span>
        <span class="visually-hidden">&nbsp;per&nbsp;</span>
        <span>
        </span>
      </span>
    </small>
  </div>

</div>
              
          </div>
            
        </div>
          <div class="quick-add no-js-hidden">
              </div>
          <a style="z-index:2; height: 40px; font-size: 16px" class="btn boton text-white mt-2" href="#" onclick="agregar_tmp(<?php  echo $id_producto;?>, <?php  echo $precio_especial;?>)"   data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-cart-plus"></i><span>COMPRAR </span></a><!-- comment -->
      </div>
    </div>
  </div>
                </li>
                <?php
                           }
                           ?>

                
               


</ul>



</div></div>
  </div>
</div>


</div><section id="shopify-section-template--20805846040857__newsletter" class="shopify-section section"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-newsletter.css?v=180884587654672216131693673627" rel="stylesheet" type="text/css" media="all" />
<link href="//tiendamiaecu.com/cdn/shop/t/3/assets/newsletter-section.css?v=62410470717655853621693673628" rel="stylesheet" type="text/css" media="all" />
<link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>.section-template--20805846040857__newsletter-padding {
    padding-top: 51px;
    padding-bottom: 39px;
  }

  @media screen and (min-width: 750px) {
    .section-template--20805846040857__newsletter-padding {
      padding-top: 68px;
      padding-bottom: 52px;
    }
  }</style><div class="newsletter center ">
  
</div>


</section>
    </main>

    
    <div id="shopify-section-scroll-to-top-btn" class="shopify-section"><style data-shopify>
  .scroll-to-top-btn-scroll-to-top-btn {
    --offset-x: 20px;
    --offset-y: 20px;
  }
</style>




</div>
    <div id="shopify-section-global-music-player" class="shopify-section"><style data-shopify>
  .music-player-global-music-player {
    --offset-x: 20px;
    --offset-y: 20px;
  }
</style>




</div>
 <?php

        include 'modal/comprar.php';
      
   
    ?>

    <!-- BEGIN sections: footer-group -->
      <div id="shopify-section-sections--20805847089433__footer" class="shopify-section shopify-section-group-footer-group">
         <link href="ccs/section-footer.css?v=46383091618275559031693673628" rel="stylesheet" type="text/css" media="all" />
         <link rel="stylesheet" href="//tiendamiaec.com/cdn/shop/t/3/assets/component-newsletter.css?v=180884587654672216131693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="//tiendamiaec.com/cdn/shop/t/3/assets/component-list-menu.css?v=151968516119678728991693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="//tiendamiaec.com/cdn/shop/t/3/assets/component-list-payment.css?v=69253961410771838501693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="//tiendamiaec.com/cdn/shop/t/3/assets/component-list-social.css?v=52211663153726659061693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="//tiendamiaec.com/cdn/shop/t/3/assets/component-rte.css?v=73443491922477598101693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="//tiendamiaec.com/cdn/shop/t/3/assets/disclosure.css?v=646595190999601341693673628" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="//tiendamiaec.com/cdn/shop/t/3/assets/component-card.css?v=171622893807557687511693673627" media="print" onload="this.media='all'">
         <noscript>
            <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-newsletter.css?v=180884587654672216131693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-list-menu.css?v=151968516119678728991693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-list-payment.css?v=69253961410771838501693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-list-social.css?v=52211663153726659061693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="//tiendamiaec.com/cdn/shop/t/3/assets/disclosure.css?v=646595190999601341693673628" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-card.css?v=171622893807557687511693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <!-- <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-card.css?v=171622893807557687511693673627" rel="stylesheet" type="text/css" media="all" /> -->
         <style data-shopify>.footer {
            margin-top: 0px;
            }
            .section-sections--20805847089433__footer-padding {
            padding-top: 24px;
            padding-bottom: 15px;
            }
            @media screen and (min-width: 750px) {
            .footer {
            margin-top: 0px;
            }
            .section-sections--20805847089433__footer-padding {
            padding-top: 32px;
            padding-bottom: 20px;
            }
            }
         </style>
         <?php include './includes/footer.php'; ?>
           <?php  if(get_row('perfil', 'whatsapp', 'id_perfil', '1')) {
                            ?>
           <a href="https://api.whatsapp.com/send?phone=<?php
        echo get_row('perfil', 'whatsapp', 'id_perfil', '1');
    ?>" class="btn-flotante">Podemos ayudarte</a>   
                    <?php  }?>
      </div>
<!-- END sections: footer-group -->

    <ul hidden>
      <li id="a11y-refresh-page-message">Choosing a selection results in a full page refresh.</li>
      <li id="a11y-new-window-message">Opens in a new window.</li>
    </ul>
<script src="assets/js/custom.js"></script>

    
    
  
  <!-- "snippets/revy-bundle-script.liquid" was not rendered, the associated app was uninstalled -->
  
</body>
</html>