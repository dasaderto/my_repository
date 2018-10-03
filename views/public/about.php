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
               <div class="title categoryttl">О системе</div>
               <div class="somebook">
                 <span>Электронная библиотека <font color="blue"><b>LFSS(Library for School Students)</b></font> предназначена для обучающихся<font color="blue"><b><?=organisation?></b></font>. Данная библиотека предоставляет возможность ознакомиться с материалами находящимися в свободном и закрытом доступе.</span>
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
