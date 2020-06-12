<?php include 'inc/header.php'; ?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <?php
      flashmessage();
    ?>
    <div class="page-title">
      <div class="title_left">
        <h3>Blog</h3>
      </div>

      <div class="title_right">
        
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List of Blog</h2>
            <ul class="nav navbar-rignt panel_toolbox">
              <a href="addblog.php" class="btn btn-primary">Add Blog</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <th>S.N</th>
                <th>Blog Title</th>
                <th>Content</th>
                <th>Featured</th>
                <th>Category</th>
                <th>View</th>
                <th>Image</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                  $destination = UPLOAD_URL.'blog-image/';
                  $blog = new Blog;
                  $data = $blog->getAllBlog();
                  if($data){
                    foreach ($data as $key => $blog) {
                       # code...
                       $image = $destination.$blog->image; 
                ?>
                <tr>
                  <th><?=$key+1?></th>
                  <th><?=$blog->title?></th>
                  <th><?=html_entity_decode($blog->content)?></th>
                  <th><?=$blog->featured?></th>
                  <th><?=$blog->category?></th>
                  <th><?=(isset($blog->view)&& !empty($blog->view))?$blog->view:"0"; ?></th>
                  <th><img src="<?=$image?>" style="width: 300px;height: auto;"></th>
                  <th>
                    <a href="addblog.php?id=<?=$blog->id?>&amp;act=<?=substr(md5('Edit-by'.$blog->id.$_SESSION['token']), 2,15)?>" class="btn" ><i class='fa fa-pencil-square-o'></i></a>
                    <a href="process/addblog.php?id=<?php echo($blog->id)?>&amp;act=<?=substr(md5("Delete-Blog-".$blog->id.$_SESSION['token']), 3,15)?> " class="btn" onclick="return confirm('Are you sure you want to delete this blog?');"><i class='fa fa-trash'></i></a>

                  </th>
                </tr>  
                <?php
                     } 
                   }
                ?>
                 
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'inc/footer.php'?>
