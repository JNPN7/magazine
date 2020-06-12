<?php include 'inc/header.php'; ?>

<?php
flashmessage();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Category</h3>
      </div>

      <div class="title_right">
        
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List of Category</h2>
            <ul class="nav navbar-rignt panel_toolbox">
              <a href="javascript:;" class="btn btn-primary" onclick="addCategory();">Add Category</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <th>S.N</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Action</th> 
              </thead>
              <tbody>
                <?php
                  $category = new Category;
                  $categories = $category->getAllCategory();
                  // debugger($categories);
                  if ($categories){
                          foreach ($categories as $key => $category) {
                ?>
                <tr>
                  <td><?=$key+1?></td>
                  <td><?=$category->categoryname?></td>
                  <td><?=html_entity_decode($category->description)?></td>
                  <td>
                    <a href="javascript:;" class="btn" onclick="editCategory(this);" data-category_info='<?=json_encode($category)?>'><i class='fa fa-pencil-square-o'></i></a>
                    <a href="process/category.php?categoryid=<?=$category->id?>&amp;act=<?=substr(sha1('Delete-category:'.$category->id.$_SESSION['token']),5,17)?>" class="btn"><i class='fa fa-trash' onclick="return confirm('Are you sure you want to delete this blog?');"></i></a>
                  </td>
                </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>

            <div class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="title">Add Category</h4>
                  </div>
                  <form action="process/category.php" method="POST">
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Category Name</label><br/>
                        <input id="categoryname" type="text" class="form-control" name="categoryname" placeholder="Category Name" required="" />
                      </div>
                      <div class="form-group">
                        <label for="">Category Description</label><br/>
                        <textarea class="form-control" id="description" name="categorydescription" ></textarea>
                      </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" >Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'inc/footer.php'?>

<script src="assets/js/datatable.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<script type="text/javascript">
  function editCategory(element){
    var category_info = $(element).data("category_info");

    if (typeof(category_info) != "object"){
      category_info = JSON.parse(category_info);
    }
     console.log(category_info);

    $('#title').html('Edit Category');
    $('#categoryname').val(category_info.categoryname);
    $('#id').val(category_info.id);
    // document.getElementById('formy').st
    showModal(category_info.description);
  }
  function addCategory(data=""){
    $('#title').html('ADD Category');
    $('#categoryname').val('');
    $('#id').removeAttr('value');
    showModal(data);
  }
  function showModal(data=""){
    $('.modal').modal();
    ckeditor(data);
  }
  function ckeditor(data=""){
    $('.ck').remove();
    ClassicEditor
      .create(document.querySelector('#description'))
      .then(editor =>{
        editor.setData(data);
      })
      .catch(error =>{
        console.error( error );
      });
  }
</script>

