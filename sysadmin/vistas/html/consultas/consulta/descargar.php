<?php
 //Creamos el archivo
 $zip = new \ZipArchive();

 //abrimos el archivo y lo preparamos para agregarle archivos
 $zip->open("comprobantes.zip", \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

 //indicamos cual es la carpeta que se quiere comprimir
 $origen = realpath('comprobantes');

 //Ahora usando funciones de recursividad vamos a explorar todo el directorio y a enlistar todos los archivos contenidos en la carpeta
 $files = new \RecursiveIteratorIterator(
    new \RecursiveDirectoryIterator($origen),
    \RecursiveIteratorIterator::LEAVES_ONLY
 );
 //Ahora recorremos el arreglo con los nombres los archivos y carpetas y se adjuntan en el zip
 foreach ($files as $name => $file)
 {
   if (!$file->isDir())
   {
       $filePath = $file->getRealPath();
       $relativePath = substr($filePath, strlen($origen) + 1);

       $zip->addFile($filePath, $relativePath);
   }
 }

 //Se cierra el Zip
 $zip->close();
 //then send the headers to force download the zip file
 header("Content-type: application/zip"); 
 header("Content-Disposition: attachment; filename=comprobantes.zip"); 
 header("Pragma: no-cache"); 
 header("Expires: 0"); 
 readfile("comprobantes.zip");

?>