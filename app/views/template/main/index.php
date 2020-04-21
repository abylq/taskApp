<div class="container" style="margin-top: 2%;">
  <div class="row">
    <div class="col">
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <?php 
        if(isset($_SESSION['add_success'])){
            echo '
                <div class="alert alert-success" role="alert">
                    Успешно добавлено
                </div>
            ';
            unset($_SESSION['add_success']);
        }elseif(isset($_SESSION['edit_success'])) {
            echo '
                <div class="alert alert-success" role="alert">
                    Успешно обновлено!
                </div>
            ';
            unset($_SESSION['edit_success']);

        }elseif (isset($_SESSION['auth_n'])){
            echo '
                <div class="alert alert-warning" role="alert">
                    Вы успешно авторизовались
                </div>
            ';
            unset($_SESSION['auth_n']);
        }
    ?>
        <thead>
            <tr>
                <th>Пользователь</th>
                <th>email</th>
                <th>Задачи</th>
                 <?php if(isset($_SESSION['loggedin'])):?>
                    <th>Статус</th>
                    <th></th>
                <?php endif;?>
            </tr>
        </thead>
        
        
    </table>

 </div>
</div>
</div>