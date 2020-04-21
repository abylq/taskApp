<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Задачи</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Задачи</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
     
      <li class="nav-item">
        <a class="nav-link" href="/task/add">Новая задача</a>
      </li>
     
   
    </ul>
  </div>

      <?php 
        if(!isset($_SESSION['loggedin'])):
      ?>
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"
      onclick="location.href='/login'" 
      >Войти</button>
      <?php else:?>
      
       <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"
      onclick="location.href='/logout'" 
      >Выйти</button>

      <?php endif;?> 
    
</nav>

<?php echo $content; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function(){
       $('#example').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
              'url':'https://wiglike-lantern.000webhostapp.com/task/list'
          },
          'columns': [
             { data: 'username' },
             { data: 'email' },
             { data: 'description'},
             <?php if(isset($_SESSION['loggedin'])):?>
             { data: 'description', "render": statusLink},
             { data: 'status', "render": actionlinks},
           <?php endif;?>
          ]
       });
});
    function actionlinks(data, type, full) {
      var html  = '<a href="task/edit/?id='+full.id+'"  class="btn btn-warning btn-sm mt-1" name="edit_contrib">Редактировать</a>';
      if(full.id !== full.status)
      {
        html += '<br><a href="/task/status/?id='+full.id+'" class="btn btn-success btn-sm mt-1">Отметить как выполненное</a> ';
      }else {
         html += '<br><a href="/task/status/?id='+full.id+'&un=1" class="btn btn-danger btn-sm mt-1">Отметить как не выполненное</a> ';
      }
      return html;
    }
    function statusLink(data, type, full)
    {
       var content = '';
       if(full.id == full.status)
       {
        content += '<span class="badge badge-success">Выполнено</span>';
       }
       if(full.id == full.userLog){
          content += '<br><span class="badge badge-primary">Отредактировано администратором</span>';
       }
       return content;
    }
    </script>
  </body>
</html>
