<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?  require_once(head); ?> 
   </head>
   <body>
      <?  require_once(header); ?> 
      <main>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-3">
                  <?  require_once(sidebar); ?> 
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 ">
                <div class="content ajaxpage text-center">
                     <div class="title categoryttl"></div>
                        <div class="alphabet text-left author_sort" style='padding: 1.5rem;'>
                        <span style='font-size: 1.7rem;'><b>Авторы:</b></span>
                        <div class="alphabet">
                           <?$alphabet=array("А","Б","В","Г","Д","Е","Ж","З","И","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Э","Ю","Я");?>
                           <span class='alphabet_val' value=''>Все </span>   
                           <?for ($i=0; $i <count($alphabet) ; $i++) { ?>
                           <span class='alphabet_val' value='<?=$alphabet[$i]?>'><?=$alphabet[$i]?></span>   
                           <?}?>
                           <hr>
                        </div>
                     </div>
                     <div class="somebook">
                        <script src="/public/js/paginate.js"></script>
                     </div>
                     <div class="pagination text-center"></div>
                  </div>
               </div>
               <div class="col-md-3 col-lg-3 col-sm-3">
                  <? require_once(rightbar); ?>
               </div>
            </div>
         </div>
      </main>
      <?require_once(footer);?>
      <?require_once(require_foot);?>
      
   </body>
</html>