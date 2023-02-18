<option value="<?php echo $id;?>"><?php echo $tab . $category[$this->titleName];?></option>
<?php if (isset($category['childs'])): ?>
    <?php echo $this->getMenuHtml($category['childs'],'&nbsp;&nbsp;' . $tab);?>
<?php endif; ?>
