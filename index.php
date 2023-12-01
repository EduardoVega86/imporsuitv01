<!doctype html>
<?php
session_start();

require_once "sysadmin/vistas/db.php";
require_once "sysadmin/vistas/php_conexion.php";
require_once "sysadmin/vistas/funciones.php";
// echo 'sysadmin/vistas/ajax/banner/'.get_row('perfil', 'banner', 'id_perfil', 1);
$id_producto = 0;
$pagina = 'INICIO';

include './includes/style.php';

?>

<html class="no-js" lang="es">
<?php
include 'includes/head.php'
?>

<body class="gradient">
   <img class="load" src="<?php
                           if (empty(get_row('perfil', 'logo_url', 'id_perfil', '1'))) {
                              echo "assets/img/image.png";
                           } else {
                              echo "sysadmin" . str_replace("../..", "", get_row('perfil', 'logo_url', 'id_perfil', '1'));
                           }
                           ?>" alt="Imagen" />

   <div class="loader">
      <img class="loading" width="10px" src="./assets/img/loading.png" alt="">
   </div> <a class="skip-to-content-link button visually-hidden" href="#MainContent">
      Skip to content
   </a>
   <script src="js/cart.js" type="text/javascript"></script>
   <script src="js/product-info.js" type="text/javascript"></script>
   <script src="js/product-form.js" type="text/javascript"></script>
   <script src="js/cart.js?v=139383546597281746371693673626" defer="defer"></script>
   <script src="js/product-info.js?v=174806172978439001541693673628" defer="defer"></script>
   <script>
      function removeElements() {
         document.querySelectorAll(".loader").forEach((loader) => {
            loader.remove();
         });

         // Elimina la imagen
         document.querySelector(".load").remove();
      }

      window.addEventListener("load", () => {
         // Elimina todo después de 2000 milisegundos (2 segundos)
         setTimeout(removeElements, 1500);
      });
   </script>
   <style>
      .drawer {
         visibility: hidden;
      }

      .loader {
         display: flex;
         justify-content: center;
         align-items: center;
         width: 100%;
         height: 100%;
         position: fixed;
         z-index: 10;
         background-color: #fff;
      }

      .load {
         position: absolute;
         top: 10px;

         z-index: 1000;
         right: 40%;

      }

      .loading {
         animation: rotate 1s linear infinite;
         width: 100px;
         filter: brightness(10%)
      }

      @keyframes rotate {
         from {
            transform: rotate(0deg);
         }

         to {
            transform: rotate(360deg);
         }
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
      <link href="ccs/component-list-menu.css" rel="stylesheet" type="text/css" />
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

      <svg xmlns="http://www.w3.org/2000/svg" class="hidden">
         <symbol id="icon-search" viewbox="0 0 18 19" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.03 11.68A5.784 5.784 0 112.85 3.5a5.784 5.784 0 018.18 8.18zm.26 1.12a6.78 6.78 0 11.72-.7l5.4 5.4a.5.5 0 11-.71.7l-5.41-5.4z" fill="currentColor" />
         </symbol>
         <symbol id="icon-reset" class="icon icon-close" fill="none" viewBox="0 0 18 18" stroke="currentColor">
            <circle r="8.5" cy="9" cx="9" stroke-opacity="0.2" />
            <path d="M6.82972 6.82915L1.17193 1.17097" stroke-linecap="round" stroke-linejoin="round" transform="translate(5 5)" />
            <path d="M1.22896 6.88502L6.77288 1.11523" stroke-linecap="round" stroke-linejoin="round" transform="translate(5 5)" />
         </symbol>
         <symbol id="icon-close" class="icon icon-close" fill="none" viewBox="0 0 18 17">
            <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor">
         </symbol>
      </svg>
      <?php
      $index_activa = "menu_activo texto_boton";
      $categoria_activa = "";
      include 'includes/styky-header.php';
      ?>
   </div>
   <!-- END sections: header-group -->
   <main id="MainContent" class="content-for-layout focus-none" role="main" tabindex="-1">


      <section id="shopify-section-template--20805846597913__e6750b05-7703-4f69-ab7c-9ffb0acf18fb" class="shopify-section section">
         <link href="ccs/section-image-banner.css?v=161038461589217244571693673628" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/component-slider.css?v=17305047213098365241693673627" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/component-slideshow.css?v=153704904022007397591693673627" rel="stylesheet" type="text/css" media="all" />
         <slideshow-component style="height: 300px !important" class="slider-mobile-gutter mobile-text-below" role="region" aria-roledescription="Carousel" aria-label="Slideshow about our brand">
            <div class="slideshow banner banner--medium grid grid--1-col slider slider--everywhere banner--mobile-bottom" id="Slider-template--20805846597913__e6750b05-7703-4f69-ab7c-9ffb0acf18fb" aria-live="polite" aria-atomic="true" data-autoplay="false" data-speed="5">
               <style>
                  #Slide-template--20805846597913__e6750b05-7703-4f69-ab7c-9ffb0acf18fb-1 .banner__media::after {
                     opacity: 0.0;
                  }
               </style>
               <div class="slideshow__slide grid__item grid--1-col slider__slide" id="Slide-template--20805846597913__e6750b05-7703-4f69-ab7c-9ffb0acf18fb-1" role="group" aria-roledescription="Slide" aria-label="1 of 1" tabindex="-1">
                  <div class="slideshow__media banner__media media">
                     <img src="<?php echo 'sysadmin/vistas/ajax/' . get_row('perfil', 'banner', 'id_perfil', 1) ?>?v=1693674398&amp;width=3840" alt="" srcset="" height="1000" loading="lazy" sizes="100vw">
                  </div>
                  <div class="slideshow__text-wrapper banner__content banner__content--middle-center page-width">
                  </div>
               </div>
            </div>
         </slideshow-component>
      </section>
      <div id="shopify-section-template--20805846597913__d8b7c7f2-8a7b-486d-b2c1-184eea98110d" class="shopify-section">

         <link href="ccs/component-tickers.css?v=30346802988262109031693673627" rel="stylesheet" type="text/css" media="all" />
         <style data-shopify>
            .section-template--20805846597913__d8b7c7f2-8a7b-486d-b2c1-184eea98110d-padding {
               padding-top: 12px;
               padding-bottom: 12px;
            }

            @media screen and (min-width: 750px) {
               .section-template--20805846597913__d8b7c7f2-8a7b-486d-b2c1-184eea98110d-padding {
                  padding-top: 16px;
                  padding-bottom: 16px;
               }
            }

            .horizontal-ticker-template--20805846597913__d8b7c7f2-8a7b-486d-b2c1-184eea98110d .horizontal-ticker__item {
               font-size: 1.75rem;
               padding: 0 3rem;
            }

            .horizontal-ticker-template--20805846597913__d8b7c7f2-8a7b-486d-b2c1-184eea98110d .horizontal-ticker__container {
               animation: horTicker 50s linear infinite forwards;
            }
         </style>
         <?php
         //include 'includes/horizontal_items.php';
         ?>
      </div>
      <div id="shopify-section-template--20805846597913__eab98bdb-f257-46ac-a548-66c24089d95a" class="shopify-section">

         <style data-shopify>
            .section-template--20805846597913__eab98bdb-f257-46ac-a548-66c24089d95a-padding {
               padding-top: 27px;
               padding-bottom: 27px;
            }

            @media screen and (min-width: 750px) {
               .section-template--20805846597913__eab98bdb-f257-46ac-a548-66c24089d95a-padding {
                  padding-top: 36px;
                  padding-bottom: 36px;
               }
            }
         </style>
         <div class="color-background-1">
            <!--PRODUCTOS -->
            <div class="product-grid-container" id="ProductGridContainer">
               <div class="collection page-width">
                  <div class="loading-overlay gradient"> </div>
                  <div class="title-wrapper-with-link title-wrapper--self-padded-mobile title-wrapper--no-top-margin">
                     <h2 class="title h1">
                        CATEGORÍAS
                     </h2>
                  </div>
                  <ul id="product-grid" data-id="template--20805846040857__main-collection-product-grid" class="grid product-grid grid--2-col-tablet-down  grid--4-col-desktop">
                     <?php
                     include './auditoria.php';
                     $sql = "select * from lineas where tipo='1' and online=1";
                     $query = mysqli_query($conexion, $sql);
                     while ($row = mysqli_fetch_array($query)) {
                        $id_linea        = $row['id_linea'];
                        $nombre_linea      = $row['nombre_linea'];

                        $image_path           = $row['imagen'];
                        //echo $image_path;


                     ?>
                        <li class="grid__item">
                           <link href="ccs/component-rating.css?v=24573085263941240431693673627" rel="stylesheet" type="text/css" media="all" />
                           <div class="card-wrapper product-card-wrapper underline-links-hover">
                              <div class="card card--card card--media color-background-1 gradient" style="--ratio-percent: 100.0%;">
                                 <div class="card__inner  ratio" style="--ratio-percent: 100.0%;">
                                    <div class="card__media">
                                       <div class="media media--transparent media--hover-effect">
                                          <a href="categoria.php?id_cat=<?php echo  $id_linea ?>" id="" type="button"><img src="sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" sizes="(min-width: 1400px) 317px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)" alt="<?php echo  $nombre_linea; ?>" class="motion-reduce" width="1080" height="1080"></a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card__content">
                                    <div class="quick-add no-js-hidden">
                                       <product-form>
                                          <form method="post" action="/cart/add" id="quick-add-template--20805846040857__main-collection-product-grid8525627818265" accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate" data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
                                             <a href="categoria.php?id_cat=<?php echo  $id_linea ?>" id="" type="button" class=" button button--full-width  boton">
                                                <span class="texto_boton"><?php echo  $nombre_linea; ?>
                                                </span>
                                             </a>
                                          </form>
                                       </product-form>
                                    </div>
                                    <div class="card__badge bottom left"></div>
                                 </div>
                              </div>
                           </div>
                        </li>
                     <?php
                     }

                     ?>
                  </ul>
                  <link rel="stylesheet" href="ccs/component-pagination.css?v=136206814810731739951693673627" media="print" onload="this.media='all'">
                  <noscript>


                     <link href="ccs/component-pagination.css?v=136206814810731739951693673627" rel="stylesheet" type="text/css" media="all" />
                  </noscript>
                  <div class="pagination-wrapper">
                  </div>
               </div>
            </div>
         </div>
      </div>


      <div id="shopify-section-template--20805846597913__05db8b15-3aa7-4652-a96c-89ad2a167474" class="shopify-section">

         <link href="ccs/component-tickers.css?v=30346802988262109031693673627" rel="stylesheet" type="text/css" media="all" />
         <style data-shopify>
            .section-template--20805846597913__05db8b15-3aa7-4652-a96c-89ad2a167474-padding {
               padding-top: 12px;
               padding-bottom: 12px;
            }

            @media screen and (min-width: 750px) {
               .section-template--20805846597913__05db8b15-3aa7-4652-a96c-89ad2a167474-padding {
                  padding-top: 16px;
                  padding-bottom: 16px;
               }
            }

            .horizontal-ticker-template--20805846597913__05db8b15-3aa7-4652-a96c-89ad2a167474 .horizontal-ticker__item {
               font-size: 1.75rem;
               padding: 0 3rem;
            }

            .horizontal-ticker-template--20805846597913__05db8b15-3aa7-4652-a96c-89ad2a167474 .horizontal-ticker__container {
               animation: horTicker 50s linear infinite forwards;
            }
         </style>

         <!-- <div class="horizontal-ticker__inner"> -->
         <?php include 'includes/horizontal_tikets.php' ?>
         <!-- </div> -->

      </div>
      <section id="shopify-section-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9" class="shopify-section section">
         <link href="ccs/section-multicolumn.css" rel="stylesheet" type="text/css" />
         <link href="ccs/section-multicolumn.css?v=6265525776963667451693673628" rel="stylesheet" type="text/css" media="all" />
         <link href="ccs/section-testimonials.css" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" href="ccs/component-slider.css?v=17305047213098365241693673627" media="print" onload="this.media='all'">
         <noscript>

            <link href="ccs/component-slider.css?v=17305047213098365241693673627" rel="stylesheet" type="text/css" media="all" />
         </noscript>
         <style data-shopify>
            .section-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9-padding {
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
                     TESTIMONIOS
                  </h2>
               </div>
               <slider-component class="slider-mobile-gutter">
                  <ul class="multicolumn-list contains-content-container grid grid--1-col-tablet-down grid--3-col-desktop slider slider--mobile grid--peek" id="Slider-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9" role="list">
                     <?php
                     $sql2 = "select * from testimonios where id_producto=-1";
                     $query2 = mysqli_query($conexion, $sql2);
                     $contador_testimonio = 1;
                     $bandera_testimonio = 'active';
                     $rowcount = mysqli_num_rows($query2);
                     //echo $rowcount;
                     $i = 1;
                     while ($row2 = mysqli_fetch_array($query2)) {


                        //echo $contador_testimonio;
                        $id_testimoniio       = $row2['id_testimonio'];
                        $nombre    = $row2['nombre'];
                        $testimonio    = $row2['testimonio'];

                        $image_path           = $row2['imagen'];

                     ?>
                        <li id="Slide-template--20805846597913__c65117da-b894-43a0-8d4d-7bd214ab10a9-1" class="multicolumn-list__item grid__item center">
                           <div class="multicolumn-card content-container testimonial-card">
                              <div class="multicolumn-card__info">
                                 <p class="testimonial-card__stars">★★★★★</p>
                                 <div class="testimonial-card__quotes testimonial-card__quotes--image-blank">
                                    <img src="assets/img/quotes.webp?v=117522929067270552721693673628" alt="''">
                                 </div>
                                 <a href="#">
                                    <img style="border-radius: 75%; height: 100px; width: 100px " class="" src="sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" alt="Brand Logo"></a>
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

               </slider-component>
            </div>
         </div>
      </section>
      <section id=" shopify-section-template--20805846597913__0cf14636-438d-4227-b017-3b91b9f6dd17" class="shopify-section section">

         <link href="ccs/section-contact-form.css?v=55230033478288162351693673628" rel="stylesheet" type="text/css" media="all" />
         <style data-shopify>
            .section-template--20805846597913__0cf14636-438d-4227-b017-3b91b9f6dd17-padding {
               padding-top: 27px;
               padding-bottom: 27px;
            }

            @media screen and (min-width: 750px) {
               .section-template--20805846597913__0cf14636-438d-4227-b017-3b91b9f6dd17-padding {
                  padding-top: 36px;
                  padding-bottom: 36px;
               }
            }
         </style>
         <div class="contactos color-background-1 gradient">
            <div class="contact page-width page-width--narrow section-template--20805846597913__0cf14636-438d-4227-b017-3b91b9f6dd17-padding">
               <h2 class="title title-wrapper--no-top-margin h1">
                  Contáctanos
               </h2>
               <form method="post" action="/contact#ContactForm" id="ContactForm" accept-charset="UTF-8" class="isolate">
                  <input type="hidden" name="form_type" value="contact" /><input type="hidden" name="utf8" value="✓" />
                  <div class="contact__fields">
                     <div class="field">
                        <input class="field__input" autocomplete="name" type="text" id="nombre" name="nombre" value="" placeholder="Name">
                        <label class="field__label" for="ContactForm-name">Nombre</label>
                     </div>
                     <div class="field field--with-error">
                        <input autocomplete="email" type="email" id="email" class="field__input" name="email" spellcheck="false" autocapitalize="off" value="" aria-required="true" placeholder="Email">
                        <label class="field__label" for="ContactForm-email">Email
                           <span aria-hidden="true">*</span></label>
                     </div>
                  </div>
                  <div class="field">
                     <input type="tel" id="telefono" class="field__input" autocomplete="tel" name="telefono" pattern="[0-9\-]*" value="" placeholder="Phone number">
                     <label class="field__label" for="ContactForm-phone">Teléfono</label>
                  </div>
                  <div class="field">
                     <textarea rows="10" id="mensaje" class="text-area field__input" name="mensaje" placeholder="Comment"></textarea>
                     <label class="form__label field__label" for="ContactForm-body">Mensaje</label>
                  </div>
                  <div class="contact__button">

                     <a onclick="generarEnlace()" type="button" class="button button--full-width boton" id="generarEnlace">Enviar Mensaje a Whatsapp</a>
                  </div>
               </form>
            </div>
         </div>
      </section>
   </main>
   <div id="shopify-section-promo-popup" class="shopify-section">

   </div>
   <div id="shopify-section-scroll-to-top-btn" class="shopify-section">
      <style data-shopify>
         .scroll-to-top-btn-scroll-to-top-btn {
            --offset-x: 20px;
            --offset-y: 20px;
         }
      </style>
   </div>
   <div id="shopify-section-global-music-player" class="shopify-section">
      <style data-shopify>
         .music-player-global-music-player {
            --offset-x: 20px;
            --offset-y: 20px;
         }
      </style>
   </div>
   <!-- BEGIN sections: footer-group -->
   <div id="shopify-section-sections--20805847089433__footer" class="shopify-section shopify-section-group-footer-group">
      <link href="ccs/section-footer.css?v=46383091618275559031693673628" rel="stylesheet" type="text/css" media="all" />



      <link rel="stylesheet" href="ccs/component-card.css?v=171622893807557687511693673627" media="print" onload="this.media='all'">

      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <script src="assets/js/bootstrap.bundle.min.js"></script>

      <style data-shopify>
         .footer {
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
      <?php if (get_row('perfil', 'whatsapp', 'id_perfil', '1')) {
      ?>
         <a href="https://api.whatsapp.com/send?phone=<?php
                                                      echo get_row('perfil', 'whatsapp', 'id_perfil', '1');
                                                      ?>" class="btn-flotante">Podemos ayudarte</a>
      <?php  } ?>
   </div>


   <!-- END sections: footer-group -->
   <!-- "snippets/revy-bundle-script.liquid" was not rendered, the associated app was uninstalled -->
   <script>
      // Función para generar el enlace de WhatsApp
      function generarEnlace() {
         // Número de teléfono (debe incluir el código de país sin el signo +)
         var numeroTelefono = "<?php
                                 echo get_row('perfil', 'whatsapp', 'id_perfil', '1');
                                 ?>";

         // Mensaje predeterminado (opcional)
         var telefono = document.getElementById("telefono").value;
         var nombre = document.getElementById("nombre").value;
         var email = document.getElementById("email").value;
         var mensaje = document.getElementById("mensaje").value;
         var contenido = '*Nombre:* ' + nombre + '\n*Telefono:* ' + telefono + '\n*Email:* ' + email + '\n*Mensaje:* ' + mensaje;
         // Crear el enlace de WhatsApp
         var enlaceWhatsApp = "https://api.whatsapp.com/send?phone=" + numeroTelefono + "&text=" + encodeURIComponent(contenido);

         // Redirigir a WhatsApp
         window.location.href = enlaceWhatsApp;
      }

      // Asociar la función al botón
      var botonGenerarEnlace = document.getElementById("generarEnlace");
      botonGenerarEnlace.addEventListener("click", generarEnlace);
   </script>
</body>

</html>