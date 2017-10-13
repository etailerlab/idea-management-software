<?php foreach ($errors->all() as $message):?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $message?>
    </div>
<?php endforeach?>