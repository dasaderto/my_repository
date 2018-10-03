<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php"); ?>
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
              <div class="col-md-3 col-lg-3 col-sm-3 bar">
                 <?  require_once(asidebar); ?> 
              </div>

              <div class="col-md-6 col-lg-6 col-sm-6 ">
                <div class="content">
                  <div class="title categoryttl">Панель администрирования <?=libraryname?></div>
                  <div class="somebook">
                    <p><font color='blue'><b>Уважаемый администратор</b></font>,в данном разделе вам предоставляется возможность управления Базой данных сайта <font color='blue'><b><?=libraryname?></b></font> , а именно добавление новых пользователей, добавление, редактирование и удаление данных в таблицах. Будьте очень осторожны, <font color='blue'><b>удаляемые данные будут уничтожены навсегда.</b></font> Спасибо за понимание. Со всеми пожеланиями и проблемами обращаться писать на e-mail <font color='blue'><b>dasaderto@gmail.com</b></font></p>
                  </div>
                </div>

              </div>
              <div class="col-md-3 col-lg-3 col-sm-3 share">
                  <?require_once(rightbar);?>
              </div>
      </div>
        </div>   
    </main>    
  
    <?require_once(footer);?>
 <?require_once(require_foot);?>
</body>
</html>