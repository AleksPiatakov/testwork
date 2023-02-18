<style>
    #template_name + button {
        min-width: 150px;
    }
    #templateChanger{
        margin-top: 9px;
    }
</style>

<div id="templateChanger">
    <form action="ajaxChangeTemplate.php" method="post">
        <?= csrf() ?>
        <?=tep_draw_pull_down_menu('template_name', getTemplates(), $template_name, 'onchange="this.form.submit()" id="template_name"');?>
    </form>
</div>
