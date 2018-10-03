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
                  <div class="title categoryttl">Категории</div>
                  <div class="author text-center">
                     <div class="row">
                         <?$category=($showAll->ShowMenu());
                         $first = array_slice($category,0,ceil(count($category)/3));
                         $second = array_slice($category,ceil(count($category)/3),ceil(count($category)/3));
                         $third = array_slice($category,count($category)+1-ceil(count($category)/3),count($category));?>
                     <div class="col-md-4">
                        <ul>
                           <?foreach ($first as $key => $value){?>
                              <li><a href="<?=pathcategory?>?cat=<?= urlencode($key);?>&page=1"><?=$key;?></a></li>
                           <?}?>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          <?foreach ($second as $key => $value){?>
                           <li><a href="<?=pathcategory?>?cat=<?= urlencode($key);?>&page=1"><?=$key;?></a></li>
                          <?}?>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <ul>
                           <?foreach ($third as $key => $value){?>
                              <li><a href="<?=pathcategory?>?cat=<?=urlencode($key);?>&page=1"><?=$key;?></a></li>
                           <?}?>
                        </ul>
                      </div>
                     </div>
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