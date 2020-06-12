<?php include 'inc/header.php'; ?>

<?php
  $action = "Add";
  if ($_GET){
    if (isset($_GET['id']) && !empty($_GET['id'])){
      $blog_id = $_GET['id'];
      if (isset($_GET['act']) && !empty($_GET['act'])){
        $act = substr(md5('Edit-by'.$blog_id.$_SESSION['token']), 2,15);
        if ($act == $_GET['act']){
          $blog = new Blog;
          $blog_info = $blog->getBlogbyId($blog_id);
          if ($blog_info) {
            $blog_info = $blog_info[0];
            $action="Edit";
          }
        }
      }
    }
  }
?>
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
            <h2><?=$action?> Blog</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="addblog">
              <form action="process/addblog.php" method="POST" enctype="multipart/form-data">
                <div class="form-group col-md-8">
                  <label for="">Blog Title</label>
                  <input type="text" name="blogtitle" class="form-control" value="<?php echo (isset($blog_info->title) && !empty($blog_info->title))?$blog_info->title:"" ?>" required=""/>
                </div>
                <div class="form-group col-md-8">
                  <label for="">Blog Content</label>
                  <textarea id="blogcontent" name="blogcontent" class="form-control" data-content="<?php echo (isset($blog_info->content) && !empty($blog_info->content))?$blog_info->content:"" ?>"></textarea>
                </div>
                <div class="form-group col-md-8">
                  <label for="">Featured</label><br>
                  <input type="radio" name="featured" id="featured" value="Featured" <?php echo (isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured=='Featured')?"Checked":""?> > Featured <br>
                  <input type="radio" name="featured" id="featured" value="notFeatured"<?php echo (isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured=='Featured')?"":"Checked"?>> Not Featured
                </div>
                <div class="form-group col-md-8">
                  <label for="">Category</label><br>
                  <select name="category">
                    <option selected="selected" disabled="disabled">--SELECT CATEGORY--</option>
                    <?php  
                      $category = new Category;
                      $categories = $category->getAllCategory();
                      if($categories){
                        foreach($categories as $key => $category){
                        ?>
                          <option value="<?php echo($category->id)?>" <?php  if(isset($blog_info) && !empty($blog_info)){ echo ($blog_info->categoryid==$category->id)?"selected":""; } ?>><?php echo $category->categoryname;?></option>
                        <?php  
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-8">
                  <label for="">Blog Image</label>
                  <input type="file" name="image" id="image" accept="image/*">
                </div>
                <?php
                  if(isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOAD_PATH."blog-image/".$blog_info->image)){
                    $thumbnail = UPLOAD_URL.'blog-image/'.$blog_info->image;
                  }else{
                    $thumbnail = '';
                  }
                ?>
                <div class="form-group col-md-8">
                  <img src="<?=$thumbnail?>" id="thumbnail" style="width: 350px;">
                </div>
                
                <div class="form-group col-md-8">
                  <input type="hidden" name="blog_id" class="hidden" value="<?=isset($blog_id)&&!empty($blog_id)?$blog_id:''?>">
                  <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($blog_info->image) && !empty($blog_info->image))?"$blog_info->image":""?>">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'inc/footer.php'?>

 <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>

<script type="text/javascript">

  ckeditor($('#blogcontent').data('content'));
  function ckeditor(data=""){
        ClassicEditor
      .create(document.querySelector('#blogcontent'))
      .then(editor =>{
        editor.setData(data);
      })
      .catch(error =>{
        console.error( error );
      });
  }
  $('#image').on("change", function(){
    let reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
      console.log(e.target.result);
      document.getElementById("thumbnail").src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
  });

</script>