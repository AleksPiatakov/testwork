<form method="post">
    <input type="hidden" name="action" value="confirm_copy_template">
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
    <p class="h3 m-b">Write name for new template</p>
    <div class="form-group">
        <input type="text" name="new_template_name" id="new_template_name" class="form-control" required  placeholder="*required">
    </div>
    <button class="btn btn-info btn-rounded center-block w-full">Submit</button>
</form>