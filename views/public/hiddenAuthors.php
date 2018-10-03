<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?require_once(head);?> 
   </head>
   <body>
      <?require_once(header);?> 
      <main>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-3 col-lg-3 col-sm-3">
                  <?require_once(sidebar);?> 
               </div>
               <div class="col-md-6 col-lg-6 col-sm-6 ">
                  <div class="content">
                     <div class="title categoryttl">Авторы</div>
                     <div class="author text-center">
                        <?$authors=$showAll->ShowAuthors();?>
                        <?if (empty($authors)) {
                           echo "Ни одного автора в библиотеке не найдено";
                           }else{?>
                     <div class="row">
                        <?$first = array_slice($authors,0,ceil(count($authors)/3));
                         $second = array_slice($authors,ceil(count($authors)/3),ceil(count($authors)/3));
                         $third = array_slice($authors,count($authors)-ceil(count($authors)/3),count($authors));?>
                     <div class="col-md-4">
                        <ul>
                           <?foreach ($first as $key => $value){?>
                              <li><a href="<?=pathcategory?>?authors=<?echo urlencode($value['author']);?>&page=1"><?=$value['author'];?></a></li>
                           <?}?>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <ul>
                           <?foreach ($second as $key => $value){?>
                              <li><a href="<?=pathcategory?>?authors=<?echo urlencode($value['author']);?>&page=1"><?=$value['author'];?></a></li>
                           <?}?>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <ul>
                           <?foreach ($third as $key => $value){?>
                              <li><a href="<?=pathcategory?>?authors=<?echo urlencode($value['author']);?>&page=1"><?=$value['author'];?></a></li>
                           <?}?>
                        </ul>
                      </div>
                     </div>
                     <?}?>
                     </div>
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