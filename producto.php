<!doctype html>
<?php 
session_start();
 if (!isset($_SESSION["comprar"])){
         $session_id = 'user_' . mt_rand();
         $_SESSION["comprar"]=$session_id;
     }else{
       $session_id= $_SESSION["comprar"];  
     }
         //echo $session_id;
require_once "sysadmin/vistas/db.php";
    require_once "sysadmin/vistas/php_conexion.php";
    require_once "sysadmin/vistas/funciones.php";
    
    $id_producto=$_GET['id'];
    
    $pagina='PRODUCTO';   
    include './auditoria.php';
     include './includes/style.php';



    $aColumns     = array('codigo_producto', 'nombre_producto'); //Columnas de busqueda
    $sTable       = "productos";
    $sWhere       = "where id_producto=$id_producto ";
    $sql   = "SELECT * FROM  $sTable $sWhere ";
    $query = mysqli_query($conexion, $sql);
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
            $stock_producto       = $row['stock_producto'];
            $stock_min_producto   = $row['stock_min_producto'];
            $precio_normal      = $row['valor4_producto'];
            
           
            
            $online   = $row['pagina_web'];
            $status_producto      = $row['estado_producto'];
            $date_added           = date('d/m/Y', strtotime($row['date_added']));
            $image_path           = $row['image_path'];
         
            $id_imp_producto      = $row['id_imp_producto'];
            $formato      = $row['formato'];
            
          
           
            
        
            }
             ?>
<html class="no-js" lang="en">
  <?php
   include 'includes/head_producto.php'
   ?>
 <?php

      //  include 'modal/comprar.php';
      
   
    ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><!-- comment -->
<script id="sections-script" data-sections="header,footer" defer="defer" src="js/scripts.js?84"></script><!-- comment -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script src="assets/js/bootstrap.bundle.min.js"></script>
    
<body class="gradient">
    <a class="skip-to-content-link button visually-hidden" href="#MainContent">
      Skip to content
    </a>





<style>
  .drawer {
    visibility: hidden;
  }
  
</style>

<cart-drawer class="drawer">
  <div id="CartDrawer" class="cart-drawer">
    <div id="CartDrawer-Overlay" class="cart-drawer__overlay"></div>
    <div
      class="drawer__inner"
      role="dialog"
      aria-modal="true"
      aria-label="Your cart"
      tabindex="-1"
    ><div class="drawer__header">
        <h2 class="drawer__heading">Your cart</h2>
        <button
          class="drawer__close"
          type="button"
          onclick="this.closest('cart-drawer').close()"
          aria-label="Close"
        >
          <svg
  xmlns="http://www.w3.org/2000/svg"
  aria-hidden="true"
  focusable="false"
  class="icon icon-close"
  fill="none"
  viewBox="0 0 18 17"
>
  <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor">
</svg>

        </button>
      </div>
      
      <div class="cart-drawer-items-and-upsell">
        <cart-drawer-items
          
        >
          <form
            action="/cart"
            id="CartDrawer-Form"
            class="cart__contents cart-drawer__form"
            method="post"
          >
            <div id="CartDrawer-CartItems" class="drawer__contents js-contents"><div class="drawer__cart-items-wrapper">
                  <table class="cart-items" role="table">
                    <thead role="rowgroup">
                      <tr role="row">
                        <th id="CartDrawer-ColumnProductImage" role="columnheader">
                          <span class="visually-hidden">Product image</span>
                        </th>
                        <th
                          id="CartDrawer-ColumnProduct"
                          class="caption-with-letter-spacing"
                          scope="col"
                          role="columnheader"
                        >
                          Producto
                        </th>
                        <th
                          id="CartDrawer-ColumnTotal"
                          class="right caption-with-letter-spacing"
                          scope="col"
                          role="columnheader"
                        >
                          Total
                        </th>
                        <th id="CartDrawer-ColumnQuantity" role="columnheader">
                          <span class="visually-hidden">Quantity</span>
                        </th>
                      </tr>
                    </thead>

                    <tbody role="rowgroup"><tr id="CartDrawer-Item-1" class="cart-item" role="row">
                          <td class="cart-item__media" role="cell" headers="CartDrawer-ColumnProductImage">
                            
                              
                              <a href="producto.php?id=<?php echo $id_producto;?>" class="cart-item__link" tabindex="-1" aria-hidden="true"> </a>
                              <img
                                class="cart-item__image"
                                src=" <?php
                $subcadena = "http";

if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
    ?>
    <?php echo  $image_path.'"';?>
    <?php
} else {
    ?>
    sysadmin/<?php echo str_replace ( "../.." , "" , $image_path  )?>"
    <?php
}
?>
                                alt=""
                                loading="lazy"
                                width="150"
                                height="150"
                              >
                            
                          </td>

                          <td class="cart-item__details" role="cell" headers="CartDrawer-ColumnProduct"><a href="/products/brazalete-magico-iris?variant=46049766080793" class="cart-item__name h4 break"><?php echo $nombre_producto;?></a><dl></dl>

                              <p class="product-option"></p><ul
                              class="discounts list-unstyled"
                              role="list"
                              aria-label="Discount"
                            ></ul>
                          </td>

                          <td class="cart-item__totals right" role="cell" headers="CartDrawer-ColumnTotal">
                            <div class="loading-overlay hidden">
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
                            </div>

                            <div class="cart-item__price-wrapper"><span class="price price--end">
                                    $ <?php echo number_format($precio_especial,2);?>
                                </span></div>
                          </td>

                          
                        </tr></tbody>
                  </table>
                </div><p id="CartDrawer-LiveRegionText" class="visually-hidden" role="status"></p>
              <p id="CartDrawer-LineItemStatus" class="visually-hidden" aria-hidden="true" role="status">
                Loading...
              </p>
            </div>
            <div id="CartDrawer-CartErrors" role="alert"></div>
          </form>
        </cart-drawer-items>
        
      </div>
      <div class="drawer__footer">
        
        
<!-- Start blocks -->
        <!-- Subtotals -->

        <div class="cart-drawer__footer" >
          <div class="totals" role="status">
            <h2 class="totals__subtotal">Subtotal</h2>
            <p class="totals__subtotal-value">$<?php echo number_format($precio_especial,2);?></p>
          </div>

          <div></div>
        </div>

        <!-- CTAs -->

        <div class="cart__ctas" >
          <noscript>
            <button type="submit" class="cart__update-button button button--secondary" form="CartDrawer-Form">
              Update
            </button>
          </noscript>

          <button
            type="submit"
            id="CartDrawer-Checkout"
            class="cart__checkout-button button"
            name="checkout"
            form="CartDrawer-Form"
            
          >
            Check out
          </button>
        </div>

        
        
      </div>
    </div>
  </div>
</cart-drawer>





<script>
  document.addEventListener('DOMContentLoaded', function () {
    function isIE() {
      const ua = window.navigator.userAgent;
      const msie = ua.indexOf('MSIE ');
      const trident = ua.indexOf('Trident/');

      return msie > 0 || trident > 0;
    }

    if (!isIE()) return;
    const cartSubmitInput = document.createElement('input');
    cartSubmitInput.setAttribute('name', 'checkout');
    cartSubmitInput.setAttribute('type', 'hidden');
    document.querySelector('#cart').appendChild(cartSubmitInput);
    document.querySelector('#checkout').addEventListener('click', function (event) {
      document.querySelector('#cart').submit();
    });
  });
</script>
<!-- BEGIN sections: header-group -->
<div id="shopify-section-sections--20805847122201__2c2ec774-3430-481f-b927-e9c035b9d24e" class="shopify-section shopify-section-group-header-group"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-tickers.css?v=30346802988262109031693673627" rel="stylesheet" type="text/css" media="all" />

<?php include './includes/flotante.php' ?>
<?php 
include './includes/horizontal_items.php';
?>


</div>
<div id="shopify-section-sections--20805847122201__header" class="shopify-section shopify-section-group-header-group section-header"><link rel="stylesheet" href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-list-menu.css?v=151968516119678728991693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-search.css?v=184225813856820874251693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-menu-drawer.css?v=183501262910778191901693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-cart-notification.css?v=137625604348931474661693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-cart-items.css?v=68325217056990975251693673627" media="print" onload="this.media='all'"><link rel="stylesheet" href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-price.css?v=183165605081763449011693673627" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-loading-overlay.css?v=167310470843593579841693673627" media="print" onload="this.media='all'"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-cart-drawer.css?v=103351759924144934211693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-cart.css?v=183883492810467818381693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-totals.css?v=54425048278126878361693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-price.css?v=183165605081763449011693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-discounts.css?v=152760482443307489271693673627" rel="stylesheet" type="text/css" media="all" />
  <link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-loading-overlay.css?v=167310470843593579841693673627" rel="stylesheet" type="text/css" media="all" />
<noscript><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-list-menu.css?v=151968516119678728991693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-search.css?v=184225813856820874251693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-menu-drawer.css?v=183501262910778191901693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-cart-notification.css?v=137625604348931474661693673627" rel="stylesheet" type="text/css" media="all" /></noscript>
<noscript><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-cart-items.css?v=68325217056990975251693673627" rel="stylesheet" type="text/css" media="all" /></noscript>

<link href="ccs/style_ini.css" rel="stylesheet" type="text/css"/>
<script src="//tiendamiaecu.com/cdn/shop/t/3/assets/details-disclosure.js?v=153497636716254413831693673628" defer="defer"></script>
<script src="//tiendamiaecu.com/cdn/shop/t/3/assets/details-modal.js?v=4511761896672669691693673628" defer="defer"></script>
<script src="//tiendamiaecu.com/cdn/shop/t/3/assets/cart-notification.js?v=160453272920806432391693673626" defer="defer"></script>
<script src="//tiendamiaecu.com/cdn/shop/t/3/assets/search-form.js?v=113639710312857635801693673628" defer="defer"></script><script src="//tiendamiaecu.com/cdn/shop/t/3/assets/cart-drawer.js?v=44260131999403604181693673626" defer="defer"></script><svg xmlns="http://www.w3.org/2000/svg" class="hidden">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    
<?php
$producto_activa="";
$producto_activa="menu_activo texto_boton";
            include 'includes/styky-header.php';
            ?>


</div>
<!-- END sections: header-group -->

    <main id="MainContent" class="content-for-layout focus-none" role="main" tabindex="-1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
               <script src="assets/js/bootstrap.bundle.min.js"></script>

      <section id="shopify-section-template--20805847023897__main" class="shopify-section section"><section
  id="MainProduct-template--20805847023897__main"
  class="page-width section-template--20805847023897__main-padding"
  data-section="template--20805847023897__main"
>
              
  <link href="ccs/section-main-product.css?v=134235731387245433901693673628" rel="stylesheet" type="text/css" media="all" />
 
  
 
  
<style data-shopify>.section-template--20805847023897__main-padding {
      padding-top: 18px;
      padding-bottom: 0px;
    }

    @media screen and (min-width: 750px) {
      .section-template--20805847023897__main-padding {
        padding-top: 24px;
        padding-bottom: 0px;
      }
    }</style><script src="js/product-info.js?v=174806172978439001541693673628" defer="defer"></script>

  


  <div class="product product--medium product--left product--thumbnail_slider product--mobile-hide grid grid--1-col grid--2-col-tablet">
    <div <?php if ($formato==2){echo 'style: display:none';} ?>class="grid__item product__media-wrapper product__column-sticky">
      
<media-gallery
  id="MediaGallery-template--20805847023897__main"
  role="region"
  aria-label="Gallery Viewer"
  data-desktop-layout="thumbnail_slider"
>
  <div id="GalleryStatus-template--20805847023897__main" class="visually-hidden" role="status"></div>
  <slider-component id="GalleryViewer-template--20805847023897__main" class="slider-mobile-gutter"><a class="skip-to-content-link button visually-hidden quick-add-hidden" href="#ProductInfo-template--20805847023897__main">
        Skip to product information
      </a><ul
      id="Slider-Gallery-template--20805847023897__main"
      class="product__media-list contains-media grid grid--peek list-unstyled slider slider--mobile"
      role="list"
    ><li
            id="Slide-template--20805847023897__main-34523778416921"
            class="product__media-item grid__item slider__slide is-active"
            data-media-id="template--20805847023897__main-34523778416921"
          >

<div
  class="product-media-container media-type-image media-fit-contain global-media-settings gradient constrain-height"
  style="--ratio: 1.0; --preview-ratio: 1.0;"
>
  
  

  <modal-opener class="product__modal-opener product__modal-opener--image no-js-hidden" data-modal="#ProductModal-template--20805847023897__main">
    <span class="product__media-icon motion-reduce quick-add-hidden product__media-icon--none" aria-hidden="true"><svg
  aria-hidden="true"
  focusable="false"
  class="icon icon-plus"
  width="19"
  height="19"
  viewBox="0 0 19 19"
  fill="none"
  xmlns="http://www.w3.org/2000/svg"
>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M4.66724 7.93978C4.66655 7.66364 4.88984 7.43922 5.16598 7.43853L10.6996 7.42464C10.9758 7.42395 11.2002 7.64724 11.2009 7.92339C11.2016 8.19953 10.9783 8.42395 10.7021 8.42464L5.16849 8.43852C4.89235 8.43922 4.66793 8.21592 4.66724 7.93978Z" fill="currentColor"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M7.92576 4.66463C8.2019 4.66394 8.42632 4.88723 8.42702 5.16337L8.4409 10.697C8.44159 10.9732 8.2183 11.1976 7.94215 11.1983C7.66601 11.199 7.44159 10.9757 7.4409 10.6995L7.42702 5.16588C7.42633 4.88974 7.64962 4.66532 7.92576 4.66463Z" fill="currentColor"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8324 3.03011C10.1255 0.323296 5.73693 0.323296 3.03011 3.03011C0.323296 5.73693 0.323296 10.1256 3.03011 12.8324C5.73693 15.5392 10.1255 15.5392 12.8324 12.8324C15.5392 10.1256 15.5392 5.73693 12.8324 3.03011ZM2.32301 2.32301C5.42035 -0.774336 10.4421 -0.774336 13.5395 2.32301C16.6101 5.39361 16.6366 10.3556 13.619 13.4588L18.2473 18.0871C18.4426 18.2824 18.4426 18.599 18.2473 18.7943C18.0521 18.9895 17.7355 18.9895 17.5402 18.7943L12.8778 14.1318C9.76383 16.6223 5.20839 16.4249 2.32301 13.5395C-0.774335 10.4421 -0.774335 5.42035 2.32301 2.32301Z" fill="currentColor"/>
</svg>
</span>
    <div class="product__media media media--transparent">
      <img src=" <?php
                $subcadena = "http";

if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
    ?>
    <?php echo  $image_path.'"';?>
    <?php
} else {
    ?>
    sysadmin/<?php echo str_replace ( "../.." , "" , $image_path  )?>"
    <?php
}
?> alt="" srcset="sysadmin/<?php  echo str_replace ( "../.." , "" , $image_path  )?>" width="1946" height="1946" class="image-magnify-none" sizes="(min-width: 1400px) 715px, (min-width: 990px) calc(55.0vw - 10rem), (min-width: 750px) calc((100vw - 11.5rem) / 2), calc(100vw / 1 - 4rem)">
    </div>
    <button class="product__media-toggle quick-add-hidden product__media-zoom-none" type="button" aria-haspopup="dialog" data-media-id="34523778416921">
      <span class="visually-hidden">
        Open media 1 in modal
      </span>
    </button>
  </modal-opener></div>

          </li></ul><div class="slider-buttons no-js-hidden quick-add-hidden small-hide">
        <button
          type="button"
          class="slider-button slider-button--prev"
          name="previous"
          aria-label="Slide left"
        >
          <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z" fill="currentColor">
</svg>

        </button>
        <div class="slider-counter caption">
          <span class="slider-counter--current">1</span>
          <span aria-hidden="true"> / </span>
          <span class="visually-hidden">of</span>
          <span class="slider-counter--total">1</span>
        </div>
        <button
          type="button"
          class="slider-button slider-button--next"
          name="next"
          aria-label="Slide right"
        >
          <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z" fill="currentColor">
</svg>

        </button>
      </div></slider-component></media-gallery>

    </div>
    <div class="product__info-wrapper grid__item product__column-sticky" <?php if($formato==2){echo 'style="max-width:100% !important"';} ?>>
      <product-info
        id="ProductInfo-template--20805847023897__main"
        data-section="template--20805847023897__main"
        data-url="/products/brazalete-magico-iris"
        class="product__info-container"
      ><div class="product__title" >
                <h1 class="h1">
                  <?php echo $nombre_producto;?>
                </h1>
                <a href="/products/brazalete-magico-iris" class="product__title">
                  <h2 class="h1">
                   <?php echo $nombre_producto;?>
                  </h2>
                </a>
              </div>
            
<!-- Start Areviews product title Rating Code -->
<div class='areviews_header_stars'></div>
<!-- End Areviews product title Rating Code --><div class="no-js-hidden product-page-price" id="price-template--20805847023897__main" role="status" >
                

<div
  class="
    price price--large price--on-sale  price--show-badge"
>
  <div class="price__container"><div class="price__regular">
      <span class="visually-hidden visually-hidden--inline">Regular price</span>
      <span class="price-item price-item--regular">
        $<?php echo $precio_especial;?>
      </span>
    </div>
    <div class="price__sale ">
      <span class="visually-hidden visually-hidden--inline regular-price-label">Sale price</span>
      <span class="price-item price-item--sale price-item--last">
        $<?php echo $precio_especial;?>
      </span>
        <span class="visually-hidden visually-hidden--inline compare-price-label">Regular price</span>
        <?php
        if ($precio_normal>0){
        ?>
        <span class="price__compare-price">
          <s class="price-item price-item--regular">
            $<?php echo $precio_normal;?>
          </s>
            <?php
        }
        ?>
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
    <?php 
              if($precio_normal>0){
                  ?>
    <span class="badge price__badge-sale color-accent-2">
      
      
      <svg
  aria-hidden="true"
  focusable="false"
  class="icon icon-discount color-foreground-text"
  viewBox="0 0 12 12"
>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0h3a2 2 0 012 2v3a1 1 0 01-.3.7l-6 6a1 1 0 01-1.4 0l-4-4a1 1 0 010-1.4l6-6A1 1 0 017 0zm2 2a1 1 0 102 0 1 1 0 00-2 0z" fill="currentColor">
</svg>
 <span class='nowrap'><?php  echo "AHORRA UN&nbsp";
     echo  100-($precio_especial*100/$precio_normal);
     echo "%";?></span>
    </span>
 <?php 
              }
                  ?>
    <span class="badge price__badge-sold-out color-inverse">
      Sold out
    </span></div>
</div>
              <div ><form method="post" action="/cart/add" id="product-form-installment-template--20805847023897__main" accept-charset="UTF-8" class="installment caption-large" enctype="multipart/form-data"><input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" /><input type="hidden" name="id" value="46049766080793">
                  
</form></div>
              <div <?php if ($formato==2){echo 'style= display:none';} ?> class="emoji-benefits-container">
                <p>🔒 Pago seguro al Recibir</p><p>📦 Envío  24-48  horas</p><p>🤝 Garantía 60 días</p>
              </div>
            



<div >
    <product-form class="product-form">
      <div class="product-form__error-message-wrapper" role="alert" hidden>
        <svg
          aria-hidden="true"
          focusable="false"
          class="icon icon-error"
          viewBox="0 0 13 13"
        >
          <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"/>
          <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7"/>
          <path d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z" fill="white"/>
          <path d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z" fill="white" stroke="#EB001B" stroke-width="0.7">
        </svg>
        <span class="product-form__error-message"></span>
      </div><form method="post" action="/cart/add" id="product-form-template--20805847023897__main" accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate" data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" /><div class="product-form__multiple-variant-ids"></div>
        <input
          type="hidden"
          name="id"
          data-selected-id="46049766080793"
          value="46049766080793"
          disabled
          class="product-variant-id"
          
        >
        <div class="product-form__buttons product-form__buttons--uppercase">
            
            <style>
                @keyframes jump {
    0% {
        transform: translateY(0); /* Sin desplazamiento vertical */
    }
    50% {
        transform: translateY(-5px); /* Desplazamiento hacia arriba */
    }
    100% {
        transform: translateY(0); /* Volver a la posición original */
    }
}

/* Aplicar la animación al botón */
.jump-button {
    animation: jump 3s ease infinite; /* Animación llamada 'jump' que dura 3 segundos y se repite infinitamente */
}
            </style>
           <a style="height: 50px; font-size: 26px; width: 100%; border-radius: 15px" class="jump-button btn boton text-white " href="#" onclick="agregar_tmp(<?php  echo $id_producto;?>, <?php  echo $precio_especial;?>)"   data-bs-toggle="modal" data-bs-target="#exampleModal">
               <span style="margin-top: 10px">COMPRAR AHORA </span></a><!-- comment -->

            
          </div>
      
      </form></product-form>
    



    </div>
<style> body {
     
      }</style>
<div style="">
    <?php
    
            
            $rutaArchivo = 'sysadmin/vistas/ajax/'.get_row('landing', 'contenido', 'id_producto', $id_producto); // Reemplaza con la ruta correcta

        // Verifica si el archivo existe
        if (file_exists($rutaArchivo)) {
            // Carga y muestra el contenido del archivo HTML
             $rutaArchivo = file_get_contents($rutaArchivo);
           echo $rutaArchivo;
        } else {
            
            //echo $rutaArchivo;
            echo get_row('landing', 'contenido', 'id_producto', $id_producto);
        }
    ?>
    
</div>
            
      </product-info>
              <?php
if ($formato==2){?>      
   <div class="product-form__buttons product-form__buttons--uppercase">
            
            <style>
                @keyframes jump {
    0% {
        transform: translateY(0); /* Sin desplazamiento vertical */
    }
    50% {
        transform: translateY(-5px); /* Desplazamiento hacia arriba */
    }
    100% {
        transform: translateY(0); /* Volver a la posición original */
    }
}

/* Aplicar la animación al botón */
.jump-button {
    animation: jump 3s ease infinite; /* Animación llamada 'jump' que dura 3 segundos y se repite infinitamente */
}
            </style>
           <a style="height: 50px; font-size: 26px; width: 100%; border-radius: 15px" class="jump-button btn boton text-white " href="#" onclick="agregar_tmp(<?php  echo $id_producto;?>, <?php  echo $precio_especial;?>)"   data-bs-toggle="modal" data-bs-target="#exampleModal">
               <span style="margin-top: 10px">COMPRAR AHORA </span></a><!-- comment -->

            
          </div>
      <?php
}?> 
    </div>
      

  </div>

  



<script src="assets/js/custom.js"></script>
  

</section>


</section>
        

<!-- comment -->
<?php 
include './includes/horizontal_items.php';
?>


<section id="shopify-section-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9" class="shopify-section section">
    <link href="ccs/section-multicolumn.css" rel="stylesheet" type="text/css"/>
            <link href="ccs/section-multicolumn.css?v=6265525776963667451693673628" rel="stylesheet" type="text/css" media="all" />
            <link href="ccs/section-testimonials.css?v=8614899098275451131693673629" rel="stylesheet" type="text/css" media="all" />
            <link href="ccs/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" />
            <link rel="stylesheet" href="ccs/component-slider.css?v=17305047213098365241693673627" media="print" onload="this.media='all'">
            <noscript>
               <link href="ccs/component-slider.css?v=17305047213098365241693673627" rel="stylesheet" type="text/css" media="all" />
            </noscript>
            <style data-shopify>.section-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9-padding {
               padding-top: 27px;
               padding-bottom: 27px;
               }
               @media screen and (min-width: 750px) {
               .section-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9-padding {
               padding-top: 36px;
               padding-bottom: 36px;
               }
               }
            </style>
            <div class="multicolumn color-background-1 gradient background-primary">
               <div class="page-width section-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9-padding isolate">
                  <div class="title-wrapper-with-link title-wrapper--self-padded-mobile title-wrapper--no-top-margin">
                     <h2 class="title h1">
                        Testimonios
                     </h2>
                  </div>
                  <slider-component class="slider-mobile-gutter">
                     <ul class="multicolumn-list contains-content-container grid grid--1-col-tablet-down grid--3-col-desktop slider slider--mobile grid--peek"
                        id="Slider-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9"
                        role="list" >
                        <?php
                           $sql2="select * from testimonios where id_producto=$id_producto";
                           $query2 = mysqli_query($conexion, $sql2);
                           $contador_testimonio=1;
                           $bandera_testimonio='active';
                            $rowcount=mysqli_num_rows($query2);
                            //echo $rowcount;
                            $i=1;
                           while ($row2 = mysqli_fetch_array($query2)) {
                               
                               
                           //echo $contador_testimonio;
                               $id_testimoniio       = $row2['id_testimonio'];
                                       $nombre    = $row2['nombre'];
                                       $testimonio    = $row2['testimonio'];
                                      
                                       $image_path           = $row2['imagen'];
                                      
                                           ?> 
                        <li id="Slide-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9-1"
                           class="multicolumn-list__item grid__item center" >
                           <div class="multicolumn-card content-container testimonial-card">
                              <div class="multicolumn-card__info">
                                 <p class="testimonial-card__stars">★★★★★</p>
                                 <div class="testimonial-card__quotes testimonial-card__quotes--image-blank">
                                    <img
                                       src="ccs/quotes.png?v=117522929067270552721693673628"
                                       alt="''"
                                       >
                                 </div>
                                 <a href="#">
                                 <img style="border-radius: 75%; height: 100px; width: 100px " class="" src="sysadmin/<?php  echo str_replace ( "../.." , "" , $image_path  )?>" alt="Brand Logo"></a>
                                 <div class="rte">
                                    <p><?php echo $testimonio; ?></p>
                                 </div>
                                 <div class="testimonial-card__author-container">
                                    <p class="testimonial-card__author">
                                       <?php echo $nombre; ?>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <?php
                           //echo $image_path;
                           } 
                           
                           ?>
                     </ul>
                     <div class="slider-buttons no-js-hidden medium-hide">
                        <button
                           type="button"
                           class="slider-button slider-button--prev"
                           name="previous"
                           aria-label="Slide left"
                           >
                           <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z" fill="currentColor">
                           </svg>
                        </button>
                        <div class="slider-counter caption">
                           <span class="slider-counter--current">1</span>
                           <span aria-hidden="true"> / </span>
                           <span class="visually-hidden">of</span>
                           <span class="slider-counter--total">3</span>
                        </div>
                        <button
                           type="button"
                           class="slider-button slider-button--next"
                           name="next"
                           aria-label="Slide right"
                           >
                           <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z" fill="currentColor">
                           </svg>
                        </button>
                     </div>
                  </slider-component>
               </div>
            </div>
         </section>
<!-- comment -->
<div id="shopify-section-template--20805847023897__03c08e95-f0ce-4379-bc05-787da4136202" class="shopify-section">
    
<style data-shopify>.section-template--20805847023897__03c08e95-f0ce-4379-bc05-787da4136202-padding {
    padding-top: 12px;
    padding-bottom: 12px;
  }

  @media screen and (min-width: 750px) {
    .section-template--20805847023897__03c08e95-f0ce-4379-bc05-787da4136202-padding {
      padding-top: 16px;
      padding-bottom: 16px;
    }
  }

  .horizontal-ticker-template--20805847023897__03c08e95-f0ce-4379-bc05-787da4136202 .horizontal-ticker__item {
    font-size: 1.75rem;
    padding: 0 3rem;
  }
  .horizontal-ticker-template--20805847023897__03c08e95-f0ce-4379-bc05-787da4136202 .horizontal-ticker__container {
    animation: horTicker 50s linear infinite forwards;
  }</style>
  
  <?php                             include 'includes/horizontal_items.php'; ?>
  <!-- </div> -->



</div><div id="shopify-section-template--20805847023897__6b7afe89-5595-4016-a10d-f260d82ca9cc" class="shopify-section">
    <link href="ccs/section-comparison-table.css?v=155681902682432648871693673628" rel="stylesheet" type="text/css" media="all" />
<link href="ccs/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>.section-template--20805847023897__6b7afe89-5595-4016-a10d-f260d82ca9cc-padding {
    padding-top: 27px;
    padding-bottom: 27px;
  }

  @media screen and (min-width: 750px) {
    .section-template--20805847023897__6b7afe89-5595-4016-a10d-f260d82ca9cc-padding {
      padding-top: 36px;
      padding-bottom: 36px;
    }
  }</style><div class="color-background-1">
  <div class="page-width section-template--20805847023897__6b7afe89-5595-4016-a10d-f260d82ca9cc-padding">
    <div class="content-and-comparison-table"><div class="content-container center"><h2 class="title h1">
              NUESTRA MARCA
            </h2></div><div class="comparison-table-container">
        <table class="comparison-table">
          <thead>
            <tr>
              <th>&nbsp</th>
              <th align="center" class="comparison-table__logo"><span class="comparison-table__brand-name">
                    
                      <?php echo get_row('perfil', 'nombre_empresa', 'id_perfil', '1')?>
                    
                  </span></th>
              <th class="comparison-table__others" align="center">Otras</th>
            </tr>
          </thead>
          <tbody><tr>
                <td align="center" class="comparison-table__row-name color-accent-1">
                  <h3>Pago Contra Entrega</h3>
                </td>
                <td align="center" class="color-background-1"><svg
                      class="comparison-table__checkmark"
                      id="Layer_3"
                      data-name="Layer 3"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 25.45 25.43"
                    >
                      <defs><style>.cls-1{fill:#53af01;}</style></defs><polygon class="cls-1" points="25.45 0 24.06 0 9.5 15.27 2.12 10.24 0 12.55 9.28 25.43 25.45 2.48 25.45 0"/>
                    </svg></td>
                <td align="center" class="color-background-1"><div class="comparison-table__x"><span></span><span></span></div></td>
              </tr><tr>
                <td align="center" class="comparison-table__row-name color-accent-1">
                  <h3>Envíos en 24 horas</h3>
                </td>
                <td align="center" class="color-background-1"><svg
                      class="comparison-table__checkmark"
                      id="Layer_3"
                      data-name="Layer 3"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 25.45 25.43"
                    >
                      <defs><style>.cls-1{fill:#53af01;}</style></defs><polygon class="cls-1" points="25.45 0 24.06 0 9.5 15.27 2.12 10.24 0 12.55 9.28 25.43 25.45 2.48 25.45 0"/>
                    </svg></td>
                <td align="center" class="color-background-1"><div class="comparison-table__x"><span></span><span></span></div></td>
              </tr><tr>
                <td align="center" class="comparison-table__row-name color-accent-1">
                  <h3>Atención 24/7</h3>
                </td>
                <td align="center" class="color-background-1"><svg
                      class="comparison-table__checkmark"
                      id="Layer_3"
                      data-name="Layer 3"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 25.45 25.43"
                    >
                      <defs><style>.cls-1{fill:#53af01;}</style></defs><polygon class="cls-1" points="25.45 0 24.06 0 9.5 15.27 2.12 10.24 0 12.55 9.28 25.43 25.45 2.48 25.45 0"/>
                    </svg></td>
                <td align="center" class="color-background-1"><div class="comparison-table__x"><span></span><span></span></div></td>
              </tr></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


</div>
<section id="shopify-section-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11" class="shopify-section section">
    

<link rel="stylesheet" href="ccs/component-slider.css?v=17305047213098365241693673627" media="print" onload="this.media='all'">
<noscript><link href="ccs/component-slider.css?v=17305047213098365241693673627" rel="stylesheet" type="text/css" media="all" /></noscript><style data-shopify>.section-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11-padding {
    padding-top: 27px;
    padding-bottom: 27px;
  }

  @media screen and (min-width: 750px) {
    .section-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11-padding {
      padding-top: 36px;
      padding-bottom: 36px;
    }
  }</style><div class="multicolumn color-inverse gradient background-none no-heading">
  <div class="page-width section-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11-padding isolate">
    <slider-component class="slider-mobile-gutter">
      <ul
        class="multicolumn-list contains-content-container grid grid--1-col-tablet-down grid--4-col-desktop"
        id="Slider-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11"
        role="list"
      ><li
            id="Slide-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11-1"
            class="multicolumn-list__item grid__item center"
            
          >
            <div class="icon-bar-card multicolumn-card content-container">
              <div class="icon-bar-card__icon icon-bar-card__icon--medium icon-bar-card__icon--accent-1"><svg
    class="icon icon-accordion color-foreground-text"
    aria-hidden="true"
    focusable="false"
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 20 20"
  ><path d="M11.571 1.05882C11.571 0.750194 11.8198 0.5 12.1266 0.5H13.4572C17.0692 0.5 20 3.45304 20 7.08924C20 10.7255 17.0692 13.6785 13.4572 13.6785L1.89992 13.7105L1.30855 13.1197L1.89992 12.5484L13.4572 12.5608C16.4541 12.5608 18.8889 10.1096 18.8889 7.08924C18.8889 4.06891 16.4541 1.61765 13.4572 1.61765H12.1266C11.8198 1.61765 11.571 1.36745 11.571 1.05882Z"/>
      <path d="M6.00311 7.00677C6.22317 6.7917 6.57489 6.79679 6.78871 7.01815C7.00252 7.2395 6.99746 7.59329 6.7774 7.80836L6.00311 7.00677ZM1.30855 13.1197L6.73968 18.5463C6.9565 18.7647 6.95627 19.1185 6.73917 19.3366C6.52207 19.5547 6.17031 19.5544 5.9535 19.3361L0.162462 13.5034C0.0572388 13.3974 -0.00128425 13.2533 2.13868e-05 13.1036C0.00132703 12.9538 0.0623521 12.8108 0.169407 12.7067C0.3269 12.5535 1.78474 11.1291 3.20439 9.74186L6.00311 7.00677L6.7774 7.80836L3.97862 10.5435C2.95441 11.5444 1.8705 12.5709 1.30855 13.1197Z"/></svg></div>
              
                <div class="multicolumn-card__info"><h3>GARANTÍA</h3><div class="rte"></div></div>
              
            </div>
          </li><li
            id="Slide-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11-2"
            class="multicolumn-list__item grid__item center"
            
          >
            <div class="icon-bar-card multicolumn-card content-container">
              <div class="icon-bar-card__icon icon-bar-card__icon--medium icon-bar-card__icon--accent-1"><svg
    class="icon icon-accordion color-foreground-text"
    aria-hidden="true"
    focusable="false"
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 20 20"
  ><path d="M16.5 7.11819H3.5L3.5 18.9997L16.5 18.9997V7.11819ZM3.5 6.11786C2.94772 6.11786 2.5 6.56573 2.5 7.11819V18.9997C2.5 19.5521 2.94772 20 3.5 20H16.5C17.0523 20 17.5 19.5521 17.5 18.9997V7.11819C17.5 6.56572 17.0523 6.11786 16.5 6.11786H3.5Z" fill-rule="evenodd"/>
      <path d="M11.443 11.9199C11.443 12.7406 10.797 13.406 10.0001 13.406C9.20314 13.406 8.55712 12.7406 8.55712 11.9199C8.55712 11.0992 9.20314 10.4338 10.0001 10.4338C10.797 10.4338 11.443 11.0992 11.443 11.9199Z"/>
      <path d="M10.0187 11.9202C10.3639 11.9202 10.6437 12.2001 10.6437 12.5454V15.6971C10.6437 16.0424 10.3639 16.3223 10.0187 16.3223C9.67354 16.3223 9.39372 16.0424 9.39372 15.6971V12.5454C9.39372 12.2001 9.67354 11.9202 10.0187 11.9202Z"/>
      <path d="M6.2417 3.75956C6.2417 1.68321 7.92435 0 10 0C12.0757 0 13.7583 1.68321 13.7583 3.75956V6.12135H12.7583V3.75956C12.7583 2.23568 11.5234 1.00033 10 1.00033C8.47663 1.00033 7.2417 2.23568 7.2417 3.75956V6.12135H6.2417V3.75956Z"/></svg></div>
              
                <div class="multicolumn-card__info"><h3>PAGO SEGURO</h3><div class="rte"><!--p>Utilizamos Mercado Pago para asegurar en todo momento la seguridad y satisfacción del cliente. </p--></div></div>
              
            </div>
          </li><li
            id="Slide-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11-3"
            class="multicolumn-list__item grid__item center"
            
          >
            <div class="icon-bar-card multicolumn-card content-container">
              <div class="icon-bar-card__icon icon-bar-card__icon--medium icon-bar-card__icon--accent-1"><svg
    class="icon icon-accordion color-foreground-text"
    aria-hidden="true"
    focusable="false"
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 20 20"
  ><path d="M18.5 1.5H1.5L1.5 18.5H18.5V1.5ZM1.5 0.5C0.947715 0.5 0.5 0.947715 0.5 1.5V18.5C0.5 19.0523 0.947715 19.5 1.5 19.5H18.5C19.0523 19.5 19.5 19.0523 19.5 18.5V1.5C19.5 0.947715 19.0523 0.5 18.5 0.5H1.5Z" fill-rule="evenodd"/>
      <path d="M14.9975 6.09084C15.201 6.27746 15.2147 6.59375 15.0281 6.79728L8.91631 13.4627C8.82231 13.5652 8.68987 13.6239 8.55079 13.6247C8.41172 13.6256 8.27857 13.5684 8.18335 13.4671L4.99513 10.0731C4.80606 9.87179 4.81596 9.55536 5.01723 9.3663C5.21849 9.17723 5.53492 9.18713 5.72399 9.3884L8.54335 12.3897L14.291 6.12145C14.4776 5.91791 14.7939 5.90421 14.9975 6.09084Z"/></svg></div>
              
                <div class="multicolumn-card__info"><h3>TIENDA VERIFICADA</h3><div class="rte"><!--p>Llevamos operando más de 5 años, contando actualmente con más de 40.000 clientes </p--></div></div>
              
            </div>
          </li><li
            id="Slide-template--20805847023897__e21ff573-e051-4bf7-867b-94765a3b8f11-4"
            class="multicolumn-list__item grid__item center"
            
          >
            <div class="icon-bar-card multicolumn-card content-container">
              <div class="icon-bar-card__icon icon-bar-card__icon--medium icon-bar-card__icon--accent-1"><svg
    class="icon icon-accordion color-foreground-text"
    aria-hidden="true"
    focusable="false"
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 20 20"
  ><path d="M16.4116 2.07871C16.3845 2.09721 16.3574 2.11565 16.3303 2.13411C16.1517 2.25559 15.9719 2.37791 15.7837 2.52296L15.7773 2.52789C14.8355 3.23007 13.6039 4.27066 12.2818 5.4955C12.1614 5.60703 11.994 5.65239 11.8338 5.61687L3.68598 3.81033C3.60396 3.80009 3.57101 3.79608 3.53891 3.79608C3.32198 3.79608 3.11893 3.92321 3.0302 4.12886C2.92673 4.39247 3.02138 4.67552 3.23628 4.81149L3.24111 4.81454L8.61434 8.30083C8.741 8.38301 8.82374 8.51802 8.83947 8.66819C8.8552 8.81836 8.80223 8.96759 8.69534 9.07423L8.66991 9.09961C7.38122 10.4798 6.31043 11.7361 5.58838 12.7137C5.47003 12.8747 5.36378 13.0195 5.27879 13.1514C5.16553 13.3272 4.95486 13.4139 4.75068 13.3689L2.19767 12.8052C2.11507 12.7948 2.08257 12.7908 2.05053 12.7908C1.83353 12.7908 1.6304 12.918 1.54169 13.1236C1.44423 13.3719 1.52255 13.6375 1.71155 13.7811L4.70992 14.8869C4.84334 14.9361 4.9495 15.0398 5.00183 15.172L6.23217 18.2805C6.33749 18.4229 6.50021 18.5 6.6743 18.5C6.68974 18.5 6.70318 18.4991 6.71409 18.4977C6.75433 18.4624 6.80008 18.4337 6.84965 18.4128C7.09772 18.3083 7.23368 18.0443 7.17792 17.7789L7.17755 17.7772L6.60833 15.2112C6.56292 15.0066 6.65004 14.7953 6.82652 14.6821C6.90797 14.6299 6.97089 14.584 7.04582 14.5293C7.10751 14.4844 7.17733 14.4334 7.27233 14.3682C8.25973 13.6492 9.5053 12.5837 10.8878 11.2987L10.9132 11.2733C11.0198 11.1669 11.1687 11.1143 11.3185 11.13C11.4683 11.1457 11.603 11.2281 11.6853 11.3542L15.1827 16.7203C15.2864 16.8837 15.4603 16.9728 15.6474 16.9728C15.7137 16.9728 15.7958 16.9563 15.866 16.9273C16.1134 16.8225 16.2489 16.5588 16.1933 16.294L14.3782 8.1444C14.3425 7.9844 14.3876 7.8171 14.4987 7.69663C15.7202 6.37288 16.7705 5.15757 17.4604 4.21249L17.4689 4.20111C17.614 4.01381 17.7363 3.83484 17.8578 3.65697C17.8763 3.6299 17.8948 3.60285 17.9133 3.5758C18.0978 3.29428 18.3328 2.929 18.4428 2.55475C18.5482 2.19592 18.5158 1.92451 18.2922 1.70148C18.1713 1.58082 17.9849 1.5 17.7692 1.5C17.4882 1.5 17.1061 1.62056 16.4116 2.07871ZM11.1716 12.3976C9.92929 13.5361 8.79171 14.4994 7.85517 15.1808L7.84395 15.1889C7.79752 15.2208 7.73884 15.2628 7.67606 15.308C7.66979 15.3125 7.66348 15.3171 7.65713 15.3216L8.15558 17.5686C8.30356 18.2625 7.96934 18.9767 7.32384 19.2951C7.10254 19.4742 6.82781 19.5 6.6743 19.5C6.16465 19.5 5.66279 19.2521 5.36533 18.7835C5.34846 18.7569 5.33414 18.7288 5.32255 18.6996L4.15425 15.7478L1.30743 14.6979C1.27444 14.6858 1.24282 14.6701 1.2131 14.6513C0.56351 14.2403 0.341328 13.4303 0.615189 12.7472L0.618547 12.7388C0.868584 12.1463 1.44556 11.7908 2.05053 11.7908C2.15024 11.7908 2.24946 11.8035 2.31873 11.8124C2.32791 11.8136 2.33656 11.8147 2.34462 11.8157C2.36005 11.8177 2.37537 11.8203 2.39055 11.8237L4.63775 12.3198C4.68444 12.255 4.73137 12.1912 4.77648 12.1298L4.78291 12.1211L4.78359 12.1202C5.46491 11.1976 6.42874 10.0567 7.57005 8.81531L2.69897 5.65488C2.05143 5.24337 1.8302 4.43467 2.1037 3.75248L2.10706 3.74411C2.35707 3.15168 2.93387 2.79608 3.53891 2.79608C3.63888 2.79608 3.73821 2.8088 3.80785 2.81773C3.81678 2.81887 3.82523 2.81996 3.83313 2.82094C3.8487 2.82288 3.86417 2.82556 3.87949 2.82895L11.795 4.58399C13.0596 3.4216 14.2446 2.42349 15.1764 1.72853C15.3888 1.56496 15.5937 1.42564 15.7706 1.30538C15.7981 1.28666 15.8249 1.26841 15.851 1.2506L15.8574 1.24625C16.5966 0.758201 17.1851 0.5 17.7692 0.5C18.2292 0.5 18.6761 0.671867 18.9985 0.99357C19.5773 1.57101 19.566 2.27912 19.4022 2.83663C19.2467 3.36596 18.9337 3.8433 18.7575 4.11215L18.7411 4.13711C18.7231 4.16341 18.7045 4.19042 18.6855 4.21819C18.5656 4.39374 18.4268 4.59704 18.2639 4.80777C17.5744 5.7516 16.563 6.92641 15.411 8.182L17.1709 16.0836C17.3254 16.8078 16.9545 17.5539 16.2531 17.8493L16.2509 17.8503C16.0679 17.9263 15.8552 17.9728 15.6474 17.9728C15.1387 17.9728 14.6379 17.7259 14.3402 17.2591L11.1716 12.3976Z"/></svg></div>
              
                <div class="multicolumn-card__info"><h3>ENVÍO EXPRESS</h3><div class="rte"><!--p>Recibirás tu pedido siempre en máximo 24 horas hábiles, sin atrasos. </p--></div></div>
              
            </div>
          </li></ul></slider-component>
  </div>
</div>


</section>
<div id="shopify-section-template--20805847023897__64c96926-2c31-48fe-bd21-30941bc87822" class="shopify-section"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/section-results.css?v=159216015314721216231693673629" rel="stylesheet" type="text/css" media="all" />
<link href="ccs/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>.section-template--20805847023897__64c96926-2c31-48fe-bd21-30941bc87822-padding {
    padding-top: 27px;
    padding-bottom: 27px;
  }

  @media screen and (min-width: 750px) {
    .section-template--20805847023897__64c96926-2c31-48fe-bd21-30941bc87822-padding {
      padding-top: 36px;
      padding-bottom: 36px;
    }
  }</style><div class="color-background-1">
  <!--div class="page-width section-template--20805847023897__64c96926-2c31-48fe-bd21-30941bc87822-padding">
    <div class="content-and-results content-and-results--results-first"><div class="content-container center"><h2 class="title h1">
              Resultados
            </h2><p>Resultados de una encuesta realizada a más de 2000 clientes que compraron en Armonia Vital</p>
</div><div class="results-container">
        <div class="results"><h3 class="title h2 ">
              Sus valoraciones
            </h3><div class="results__rows-container"><div class="results__row">
                <div class="results__percentage" style="--percentage: 99%">
                  <p>99%</p>
                </div>
                <div class="results__text">
                  <p>Servicio y entrega</p>
                </div>
              </div><div class="results__row">
                <div class="results__percentage" style="--percentage: 96%">
                  <p>96%</p>
                </div>
                <div class="results__text">
                  <p>Calidad del producto</p>
                </div>
              </div><div class="results__row">
                <div class="results__percentage" style="--percentage: 94%">
                  <p>94%</p>
                </div>
                <div class="results__text">
                  <p>Atención al cliente recibida</p>
                </div>
              </div></div></div>
      </div>
    </div>
  </div>
</div>


</div-->
    </main>

    <div id="shopify-section-promo-popup" class="shopify-section"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/section-promo-popup.css?v=175993886525155844911693673629" rel="stylesheet" type="text/css" media="all" />
<link href="ccs/component-newsletter.css?v=180884587654672216131693673627" rel="stylesheet" type="text/css" media="all" />
<link href="ccs/newsletter-section.css?v=62410470717655853621693673628" rel="stylesheet" type="text/css" media="all" />
<link href="cs/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" />

</div>
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



<?php

       include 'modal/comprar.php';
      
   
    ?>
</div>
    <!-- BEGIN sections: footer-group -->

<div id="shopify-section-sections--20805847089433__footer" class="shopify-section shopify-section-group-footer-group">
<link href="ccs/section-footer.css?v=46383091618275559031693673628" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="ccs/component-newsletter.css?v=180884587654672216131693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-list-menu.css?v=151968516119678728991693673627" media="print" onload="this.media='all'">

<link rel="stylesheet" href="ccs/component-list-social.css?v=52211663153726659061693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-rte.css?v=73443491922477598101693673627" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/disclosure.css?v=646595190999601341693673628" media="print" onload="this.media='all'">
<link rel="stylesheet" href="ccs/component-card.css?v=171622893807557687511693673627" media="print" onload="this.media='all'">



<!-- <link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-card.css?v=171622893807557687511693673627" rel="stylesheet" type="text/css" media="all" /> --><style data-shopify>.footer {
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
  }</style>
<?php
include 'includes/footer.php'
?>
 <a style="" class=" btn-flotante-producto " href="#" onclick="agregar_tmp(<?php  echo $id_producto;?>, <?php  echo $precio_especial;?>)"   data-bs-toggle="modal" data-bs-target="#exampleModal">
               <span style="margin-top: 10px">COMPRAR AHORA </span></a>  
 </div>

<!-- END sections: footer-group -->

   

    
    
      
    
  
  <!-- "snippets/revy-bundle-script.liquid" was not rendered, the associated app was uninstalled -->
  
</body>
</html>
