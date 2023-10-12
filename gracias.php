<!doctype html>
  <?php
   session_start();
   
   require_once "sysadmin/vistas/db.php";
       require_once "sysadmin/vistas/php_conexion.php";
       require_once "sysadmin/vistas/funciones.php";
      // echo 'sysadmin/vistas/ajax/banner/'.get_row('perfil', 'banner', 'id_perfil', 1);
         $id_producto=0;  
       $pagina='gracias';   
       include './auditoria.php';
       include './includes/style.php';
   
       ?>

<html class="no-js" lang="es">
   <?php
   include 'includes/head.php'
   ?>
<body class="gradient">
    





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
         <link href="//tiendamiaec.com/cdn/shop/t/3/assets/component-tickers.css?v=30346802988262109031693673627" rel="stylesheet" type="text/css" media="all" />
         <?php include './includes/flotante.php' ?>
         <!-- <div class="horizontal-ticker__inner"> -->
         <?php
            include 'includes/horizontal_items.php';
            ?>
         <!-- </div> -->
      </div>
<!-- comment -->
<div id="shopify-section-sections--20805847122201__header" class="shopify-section shopify-section-group-header-group section-header">
         <link href="ccs/component-list-menu.css" rel="stylesheet" type="text/css"/>
         <link rel="stylesheet" href="ccs/component-list-menu.css?v=151968516119678728991693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="ccs/component-search.css?v=184225813856820874251693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="ccs/component-menu-drawer.css?v=183501262910778191901693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="ccs/component-cart-notification.css?v=137625604348931474661693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="ccs/component-cart-items.css?v=68325217056990975251693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="ccs/component-price.css?v=183165605081763449011693673627" media="print" onload="this.media='all'">
         <link rel="stylesheet" href="ccs/component-loading-overlay.css?v=167310470843593579841693673627" media="print" onload="this.media='all'">
         <link href="ccs/component-cart-drawer.css?v=103351759924144934211693673627" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/component-cart.css?v=183883492810467818381693673627" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/component-totals.css?v=54425048278126878361693673627" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/component-price.css?v=183165605081763449011693673627" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/component-discounts.css?v=152760482443307489271693673627" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/component-loading-overlay.css?v=167310470843593579841693673627" rel="stylesheet" type="text/css" media="all" />
         <noscript>
            <link href="ccs/component-list-menu.css?v=151968516119678728991693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="ccs/component-search.css?v=184225813856820874251693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="ccs/component-menu-drawer.css?v=183501262910778191901693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="ccs/component-cart-notification.css?v=137625604348931474661693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <noscript>
            <link href="ccs/component-cart-items.css?v=68325217056990975251693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <script src="js/details-disclosure.js?v=153497636716254413831693673628" defer="defer"></script>
         <script src="js/details-modal.js?v=4511761896672669691693673628" defer="defer"></script>
         <script src="js/cart-notification.js?v=160453272920806432391693673626" defer="defer"></script>
         <script src="js/cart.js" type="text/javascript"></script>
         <script src="js/search-form.js?v=113639710312857635801693673628" defer="defer"></script>
         <script src="//tiendamiaec.com/cdn/shop/t/3/assets/cart-drawer.js?v=44260131999403604181693673626" defer="defer"></script>
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
         $index_activa="menu_activo texto_boton";
         $categoria_activa="";
            include 'includes/styky-header.php';
            ?>
      </div>
<!-- END sections: header-group -->

    <main id="MainContent" class="content-for-layout focus-none" role="main" tabindex="-1">
      <section id="shopify-section-template--20805846728985__60910267-55e8-4e0d-a9f9-79b26b3533dc" class="shopify-section section">

<?php
         echo get_row('gracias', 'contenido', 'id_gacias', 1);
            ?>
</section>


</section>
    </main>

    <div id="shopify-section-promo-popup" class="shopify-section"><link href="//tiendamiaecu.com/cdn/shop/t/3/assets/section-promo-popup.css?v=175993886525155844911693673629" rel="stylesheet" type="text/css" media="all" />
<link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-newsletter.css?v=180884587654672216131693673627" rel="stylesheet" type="text/css" media="all" />
<link href="//tiendamiaecu.com/cdn/shop/t/3/assets/newsletter-section.css?v=62410470717655853621693673628" rel="stylesheet" type="text/css" media="all" />
<link href="//tiendamiaecu.com/cdn/shop/t/3/assets/component-rte.css?v=73443491922477598101693673627" rel="stylesheet" type="text/css" media="all" />

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




</div>
    <!-- BEGIN sections: footer-group -->
<div id="shopify-section-sections--20805847089433__footer" class="shopify-section shopify-section-group-footer-group">
         <link href="//tiendamiaec.com/cdn/shop/t/3/assets/section-footer.css?v=46383091618275559031693673628" rel="stylesheet" type="text/css" media="all" />
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
      </div>
<!-- END sections: footer-group -->

    <ul hidden>
      <li id="a11y-refresh-page-message">Choosing a selection results in a full page refresh.</li>
      <li id="a11y-new-window-message">Opens in a new window.</li>
    </ul>

    <script>
      window.shopUrl = 'https://tiendamiaecu.com';
      window.routes = {
        cart_add_url: '/cart/add',
        cart_change_url: '/cart/change',
        cart_update_url: '/cart/update',
        cart_url: '/cart',
        predictive_search_url: '/search/suggest'
      };

      window.cartStrings = {
        error: `There was an error while updating your cart. Please try again.`,
        quantityError: `You can only add [quantity] of this item to your cart.`
      }

      window.variantStrings = {
        addToCart: `Add to cart`,
        soldOut: `Sold out`,
        unavailable: `Unavailable`,
        unavailable_with_option: `[value] - Unavailable`,
      }

      window.accessibilityStrings = {
        imageAvailable: `Image [index] is now available in gallery view`,
        shareSuccess: `Link copied to clipboard`,
        pauseSlideshow: `Pause slideshow`,
        playSlideshow: `Play slideshow`,
      }
    </script><script src="//tiendamiaecu.com/cdn/shop/t/3/assets/predictive-search.js?v=16985596534672189881693673628" defer="defer"></script>
      <script>
        window.addEventListener("contextmenu", (e) => {
          e.preventDefault();
        });
        document.addEventListener("selectstart", (e) => {
          e.preventDefault();
        });
        document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('img').forEach(img => {
            img.addEventListener('dragstart', function(e) {
              e.preventDefault();
            })
          })
        })
        function ctrlShiftKey(e, keyCode) {
          return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
        }
        document.addEventListener('keydown', function(e) {
          if (
            event.keyCode === 123 ||
            ctrlShiftKey(e, 'I') ||
            ctrlShiftKey(e, 'J') ||
            ctrlShiftKey(e, 'C') ||
            (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
          ) {
            e.preventDefault();
          }
        })
      </script>
    
  
  <!-- "snippets/revy-bundle-script.liquid" was not rendered, the associated app was uninstalled -->
  
</body>
</html>


