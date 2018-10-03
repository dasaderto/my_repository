<?$showAll=new ContentModel; $front=new AdminModel;$pag=new PaginateController;?>
<header>
   <nav class="navbar navbar-inverse" style="border-radius: 0px;">
      <div class="container-fluid">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=pathindex?>"><?=libraryname?></a>
         </div>
         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
               <li><a href="<?=pathindex?>">Главная</a></li>
               <?if (method_exists('ContentModel','ShowMenu')) {?>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle hidden-sm hidden-xs" data-toggle="dropdown">Жанры<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                     <?
                        $category=array_reverse($showAll->ShowMenu());
                        foreach ($category as $key => $value){
                        if ($key<=10){
                        ?>
                     <li><a href="<?=pathcategory?>?cat=<?=urlencode($key);?>&page=1"><?echo $key;?></a></li>
                     <?}}?>
                  </ul>
               </li>
               <?}?>  
               <?if (method_exists('ContentModel','ShowAuthors')) {?>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle hidden-sm hidden-xs" data-toggle="dropdown">Авторы<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                     <?
                        $author=array_reverse($showAll->ShowAuthors());
                          foreach ($author as $key => $value){
                            if ($key<10){
                        ?>
                     <li><a href="<?=pathcategory?>?authors=<?echo urlencode($value['author']);?>&page=1"><?echo $value['author'];?></a></li>
                     <?}?>
                     <?}?>
                  </ul>
               </li>
               <?}?>
               <li class="hidden-md hidden-lg"><a href="/allAuthors/" >Авторы</a></li>
               <li class="hidden-md hidden-lg"><a href="/categories/" >Категории</a></li>
               <li><a href="/about/">О системе</a></li>
               <?if ((!empty($_SESSION['user_valid']))&&(($_SESSION['user_valid'])>1)){?>
               <li><a href="<?=pathupload?>">Загрузка файла</a></li>
               <li><a href="/admin/">Админка</a></li>
               <?}?> 
            </ul>
            <form class="navbar-form navbar-left" role="search" action="/search/" method="GET" >
               <div class="form-group">
                  <input type="text" name="search_list" class="form-control" placeholder="Поиск..." size='20' autocomplete=off required minlength="3" maxlength="15" >
                  <input type="hidden" name="page" value="1">
               </div>
               <button type="submit" class="btn btn-primary my-2 my-sm-0">Поиск</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>
                  <?if (!empty($_SESSION['user_valid'])){echo 'Здравствуйте, '.$_SESSION['username'];}else{echo "Войти";}?>
                  </b> <span class="caret"></span></a>
                  <ul id="login-dp" class="dropdown-menu">
                     <li>
                        <div class="row">
                           <div class="col-md-12">
                              <form class="form" action='' method="post" accept-charset="UTF-8" id="login-nav">
                                 <?if (empty($_SESSION['user_valid'])){ ?>
                                 <div class="form-group">
                                    <i class='fa fa-user'></i>
                                    <label  for="authlogin">Логин</label>
                                    <input type="text" class="form-control" id="authlogin" placeholder="Логин" name="authlogin" required>
                                 </div>
                                 <div class="form-group">
                                    <i class='fa fa-unlock-alt'></i>
                                    <label  for="pass">Пароль</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Пароль" name="pass" required>
                                 </div>
                               <div class="form-group" >
                                 <button type="button" name="go" class="btn btn-primary btn-block" id="authbtn" style="margin-top:5%;">Войти <i class="fa fa-sign-in"></i></button>
                                </div>
                                 <?}else{?>
                                 <div class="form-group" >
                                    <button type="submit" name="out" class="btn btn-primary btn-block" style='margin-top:5%;'>Выйти <i class="fa fa-sign-out"></i></button>
                                 </div>
                                 <?}?>
                              </form>
                           </div>
                        </div>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
         <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
   </nav>
</header>