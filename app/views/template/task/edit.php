<div class="container">
  <div class="row">
    <div class="col">
<form action="/task/edit" method="post">
 
  <div class="form-group">
    <label for="username">Имя</label>
    <input type="text" name="username" class="form-control" id="username" value="<?php echo $task['username'];?>">
  </div>
   <div class="form-group">
    <label for="email">Email </label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $task['email'];?>">
    
  </div>
  <input type="hidden" name="id" value="<?php echo $task['id'];?>">
  <div class="form-group">
    <label for="text">Задачи</label>
    <textarea class="form-control" id="text" name="description" rows="3">
      <?php echo $task['description'];?>
    </textarea>
  </div>
  <input type="submit" name="submit" class="btn btn-primary">
</form>
</div>
</div>
</div>
