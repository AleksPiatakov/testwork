<?php
/*
$Id: account_check . js . php,v 1.2 2003 / 09 / 24 13:57:07 wilt Exp $

osCommerce, Open Source E - Commerce Solutions
http://www.oscommerce.com

Copyright(c) 2003 osCommerce

Released under the GNU General Public License*/

?>

<?php
if (substr(basename($PHP_SELF), 0, 12) == 'admin_member') {
?>
<script language="JavaScript">
    function validateForm() {
    var p,z,xEmail,errors='',dbEmail,result=0,i;


    var adminName1 = document.newmember.admin_firstname.value;
    var adminName2 = document.newmember.admin_lastname.value;
    var adminEmail = document.newmember.admin_email_address.value;
    if (adminName1 == '') {
    errors+='<?php echo JS_ALERT_FIRSTNAME; ?>';
} else if (adminName1.length < <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>) {
    errors+='- Firstname length must over  <?php echo(ENTRY_FIRST_NAME_MIN_LENGTH); ?>\n';
}

    if (adminName2 == '') {
    errors+='<?php echo JS_ALERT_LASTNAME; ?>';
} else if (adminName2.length < <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>) {
    errors+='- Lastname length must over  <?php echo(ENTRY_LAST_NAME_MIN_LENGTH);  ?>\n';
}

    if (adminEmail == '') {
    errors+='<?php echo JS_ALERT_EMAIL; ?>';
} else if (adminEmail.indexOf("@") <= 1 || adminEmail.indexOf("@") >= (adminEmail.length - 3) || adminEmail.indexOf(".") >= (adminEmail.length - 2) || adminEmail.indexOf("@.") >= 0 ) {
} else if (adminEmail.indexOf("@") <= 1 || adminEmail.indexOf("@") >= (adminEmail.length - 3) || adminEmail.indexOf(".") <= 3 || adminEmail.indexOf(".") >= (adminEmail.length - 2) || adminEmail.indexOf("@.") >= 0 ) {
    errors+='<?php echo JS_ALERT_EMAIL_FORMAT; ?>';
} else if (adminEmail.length < <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>) {
    errors+='<?php echo JS_ALERT_EMAIL_FORMAT; ?>';
}

    if (errors) alert('The following error(s) occurred:\n'+errors);
    document.returnValue = (errors == '');
}


    function checkGroups(obj) {
    var subgroupID,i;
    subgroupID = eval("this.defineForm.subgroups_"+parseFloat((obj.id).substring(7)));

    if (subgroupID.length > 0) {
    for (i=0; i<subgroupID.length; i++) {
    if (obj.checked == true) { subgroupID[i].checked = true; }
    else { subgroupID[i].checked = false; }
}
} else {
    if (obj.checked == true) { subgroupID.checked = true; }
    else { subgroupID.checked = false; }
}
}

    function checkSub(obj) {
    var groupID,subgroupID,i,num=0;
    groupID = eval("this.defineForm.groups_"+parseFloat((obj.id).substring(10)));
    subgroupID = eval("this.defineForm."+(obj.id));

    if (subgroupID.length > 0) {
    for (i=0; i < subgroupID.length; i++) {
    if (subgroupID[i].checked == true) num++;
}
} else {
    if (subgroupID.checked == true) num++;
}
    if (num>0) { groupID.checked = true; }
    else { groupID.checked = false; }
}
</script>

<?php
} else {
?>

<script language = "JavaScript">

    validate Email function
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};
function validateForm() {
    var p, z, xEmail, errors = '', dbEmail, result = 0, i;
    var adminName1 = document.account.admin_firstname.value;
    var adminName2 = document.account.admin_lastname.value;
    var adminEmail = document.account.admin_email_address.value;

    if (adminName1 == '') {
        errors += '<?php echo JS_ALERT_FIRSTNAME; ?>';
    } else if (adminName1.length < <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>) {
        errors += '<?php echo JS_ALERT_FIRSTNAME_LENGTH . ENTRY_FIRST_NAME_MIN_LENGTH; ?>\n';
    }

    if (adminName2 == '') {
        errors += '<?php echo JS_ALERT_LASTNAME; ?>';
    } else if (adminName2.length < <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>) {
        errors += '<?php echo JS_ALERT_LASTNAME_LENGTH . ENTRY_LAST_NAME_MIN_LENGTH;  ?>\n';
    }

    if (!validateEmail(adminEmail)) {
        errors += '<?php echo JS_ALERT_EMAIL_FORMAT; ?>';
    }
    if (adminEmail == '') {
        errors += '<?php echo JS_ALERT_EMAIL; ?>';
    } else if (adminEmail.indexOf("@") <= 1 || adminEmail.indexOf("@") >= (adminEmail.length - 3) || adminEmail.indexOf(".") <= 3 || adminEmail.indexOf(".") >= (adminEmail.length - 2) || adminEmail.indexOf("@.") >= 0) {
        errors += '<?php echo JS_ALERT_EMAIL_FORMAT; ?>';
    } else if (adminEmail.length < <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>) {
        errors += '<?php echo JS_ALERT_EMAIL_FORMAT; ?>';
    }

    if (adminPass1 == '') {
        errors += '<?php echo JS_ALERT_PASSWORD; ?>';
    } else if (adminPass1.length < <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>) {
        errors += '<?php echo JS_ALERT_PASSWORD_LENGTH . ENTRY_PASSWORD_MIN_LENGTH; ?>\n';
    } else if (adminPass1 != adminPass2) {
        errors += '<?php echo JS_ALERT_PASSWORD_CONFIRM; ?>';
    }

    if (errors) alert('The following error(s) occurred:\n' + errors);
    document.returnValue = (errors == '');
}
var adminPass1 = document.account.admin_password.value;
var adminPass2 = document.account.admin_password_confirm.value;

</script>

<?php
}
?>