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
                <div class="title categoryttl">Регистрация</div>
                <div class="registration">
                 <form data-toggle="validator" role="form" method='post'>
                   <div class="form-group">
                      <label for="reg_login" class="control-label">Введите логин</label>
                      <input type="text" name='reg_login' minlength="3" maxlength="15" class="form-control" id="login" placeholder="Введите логин" required>
                      <span class="help-block loginerror"></span>
                   </div>
                   <div class="form-group">
                      <label for="reg_password" class="control-label">Введите пароль</label>
                      <div>
                        <input type="password" data-toggle="validator" name='reg_password' data-minlength="6" class="form-control" id="reg_password" placeholder="Пароль" required>
                        <span class="help-block passerror"></span>
                      </div>
                   <div>
                     <label for="password2" class="control-label">Повторите пароль пароль</label>
                     <input type="password" name='password2' class="form-control" id="password2" data-match="#inputPassword" data-match-error="Ошибка! Пароли не совпадают!" placeholder="Повторите пароль" required>
                   <div class="help-block condoerror"></div>
                   </div>
                   </div>
                   <div class="form-group">
                      <label for="role">Выберите уровень доступа</label>
                      <select class="form-control" id="role" name="role">
                        <option>Студент</option>
                        <option>Учитель</option>
                        <option>Администратор</option>
                      </select>
                    </div>
                   <div class="form-group text-center">
                   <button type="button" name='register' class="btn btn-primary" id='regbtn' disabled='disabled'style="margin:0.5rem 0rem;">Регистрация</button>
                   <button type="button" class="btn btn-primary" id='generate' style="margin:0.5rem 3rem;">Сгенерировать</button>
                   </div>
                   </form>
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
