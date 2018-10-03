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
                     <div class="title categoryttl">Авторы на букву <?=htmlspecialchars($_GET['author']);?></div>
                     <div class="author text-center">
                        <?$authors=$showAll->getAuthor();?>
                        <?if (empty($authors)) {
                           echo "Ни одного автора в библиотеке не найдено";
                           }else{?>
                        <table>
                           <?foreach ($authors as $key => $value) {?>
                           <?if ($key%3==0) echo "<tr>";?>
                           <td style='padding: 0.3rem 1.5rem;'>
                              <a href="<?=pathcategory?>?authors=<?echo urlencode($value['author']);?>&page=1"><?=$value['author'];?></a>
                           </td>
                           <?if ($key%3==2) echo "</tr>";?>
                           <?}}?>
                        </table>
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