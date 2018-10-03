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
               <div class="title categoryttl">Ошибка #403</div>
               <div class="somebook">
                 <div class="newbook">
                   <span>Возникла ошибка доступа, доступ к данному разделу разрешен только зарегистрированным пользователям, или администратору библиотеки!!!</span>
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
