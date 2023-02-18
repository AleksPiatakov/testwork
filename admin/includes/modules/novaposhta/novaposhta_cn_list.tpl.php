<?php

require_once(DIR_WS_LANGUAGES . $language . '/modules/novaposhta/novaposhta.php');

?>
<link rel="stylesheet" type="text/css" href="<?php echo 'includes/modules/novaposhta/novaposhta.css';?>">
<script src="<?= DIR_WS_INCLUDES ?>javascript/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= DIR_WS_INCLUDES ?>javascript/datetimepicker/bootstrap-datetimepicker.min.css"/>
<div class="container-fluid">
    <div class="wrapper-title">
        <div class="bg-light lter ng-scope">
            <h3><i class="fa fa-truck font-thin m-n"></i> <?php echo HEADING_TITLE; ?></h3>
            <div class="bg-light lter ng-scope">
                <div class="btn-group">
                    <a href="<?php echo $data['customized_printing']; ?>" target="_blank" id="button-customized-printing" data-toggle="tooltip" title="<?php echo TEXT_CUSTOMIZED_PRINTING; ?>" class="btn btn-default" disabled="disabled" role="button"><i class="fa fa-print"></i></a>
                    <button type="button" id="button-html-caret" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="disabled"><span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header"><i class="fa fa-file-pdf-o fa-fw"></i> <?php echo TEXT_DOWNLOAD_PDF; ?></li>
                        <li><a href="<?php echo $data['print_cn_pdf']; ?>" target="_blank" id="button-pdf-cn-2"><?php echo TEXT_CN; ?></a></li>
                        <li><a href="<?php echo $data['print_markings_pdf']; ?>" target="_blank" id="button-pdf-m"><?php echo TEXT_MARK; ?></a></li>
                        <li><a href="<?php echo $data['print_markings_zebra_pdf']; ?>" target="_blank" id="button-pdf-mz"><?php echo TEXT_MARK_ZEBRA; ?></a></li>
                        <li><a href="<?php echo $data['print_markings_zebra_100_100_pdf']; ?>" target="_blank" id="button-pdf-mz100x100"><?php echo TEXT_MARK_ZEBRA_100_100; ?></a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header"><i class="fa fa-print fa-fw"></i> <?php echo TEXT_PRINT_HTML; ?></li>
                        <li><a href="<?php echo $data['print_cn_html']; ?>" target="_blank" id="button-html-cn-2"><?php echo TEXT_CN; ?></a></li>
                        <li><a href="<?php echo $data['print_markings_html']; ?>" target="_blank" id="button-html-m"><?php echo TEXT_MARK; ?></a></li>
                        <li><a href="<?php echo $data['print_markings_zebra_html']; ?>" target="_blank" id="button-html-mz"><?php echo TEXT_MARK_ZEBRA; ?></a></li>
                        <li><a href="<?php echo $data['print_markings_zebra_100_100_html']; ?>" target="_blank" id="button-html-mz100x100"><?php echo TEXT_MARK_ZEBRA_100_100; ?></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a onclick="printSettings(this);" style="cursor: pointer;" id="button-print"><i class="fa fa-print fa-fw"></i> <?php echo TEXT_PRINT_SETTINGS; ?></a></li>
                    </ul>
                </div>
                <a id="button-add" data-toggle="tooltip" title="<?php echo BUTTON_ADD; ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i></a>
                <button type="button" id="button-delete" onclick="deleteCN(this);" data-toggle="tooltip" data-value="" title="<?php echo TEXT_DELETE; ?>" class="btn btn-danger" disabled="disabled"><i class="fa fa-trash-o"></i></button>
                <a href="<?php echo $data['back_to_orders']; ?>" data-toggle="tooltip" title="<?php echo BUTTON_BACK_TO_ORDERS; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
        </div>
    </div>
    <?php if ($data['success']) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $data['success']; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo TEXT_CONSIGNMENT_NOTE_LIST; ?></h3>
        </div>
        <div class="panel-body">
            <div class="well">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="control-label" for="input-filter_cn_type"><?php echo ENTRY_CN_NUMBER; ?></label>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label" for="input-filter_cn_type"><?php echo ENTRY_CN_TYPE; ?></label>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label" for="input-filter_departure_date_from"><?php echo ENTRY_DEPARTURE_DATE; ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" name="filter_cn_number" value="<?php echo $data['filter_cn_number']; ?>" placeholder="<?php echo ENTRY_CN_NUMBER; ?>" id="input-filter_cn_number" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                        <select name="filter_cn_type" id="input-filter_cn_type" class="form-control">
                            <option value=""><?php echo TEXT_SELECT; ?></option>
                            <?php foreach ($data['filters'] as $k => $v) { ?>
                                <?php if (in_array($k, $data['filter_cn_type'])) { ?>
                                    <option value="<?php echo $k; ?>" selected><?php echo $v; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <input type="text" name="filter_departure_date_from" value="<?php echo $data['filter_departure_date_from']; ?>" placeholder="<?php echo ENTRY_DEPARTURE_DATE; ?>" data-date-format="DD.MM.YYYY" id="input-filter_departure_date_from" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <input type="text" name="filter_departure_date_to" value="<?php echo $data['filter_departure_date_to']; ?>" placeholder="<?php echo ENTRY_DEPARTURE_DATE; ?>" data-date-format="DD.MM.YYYY" id="input-filter_departure_date_to" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-8">
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i><?php echo BUTTON_FILTER; ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data" id="form">
                <div class="table-responsive" style="overflow-y:visible;">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name^=selected]').prop('checked', this.checked); $('input[name^=selected]').triggerHandler('change');" /></td>
                            <td<?php if (!in_array('cn_identifier', $data['displayed_information'])) { echo ' style="display: none"'; } ?>><?php echo COLUMN_CN_IDENTIFIER; ?></td>
                            <?php if (in_array('cn_number', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_CN_NUMBER; ?></td>
                            <?php } ?>
                            <?php if (in_array('order_number', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_ORDER_NUMBER; ?></td>
                            <?php } ?>
                            <?php if (in_array('create_date', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_CREATE_DATE; ?></td>
                            <?php } ?>
                            <?php if (in_array('actual_shipping_date', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_ACTUAL_SHIPPING_DATE; ?></td>
                            <?php } ?>
                            <?php if (in_array('preferred_shipping_date', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_PREFERRED_SHIPPING_DATE; ?></td>
                            <?php } ?>
                            <?php if (in_array('estimated_shipping_date', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_ESTIMATED_SHIPPING_DATE; ?></td>
                            <?php } ?>
                            <?php if (in_array('recipient_date', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_RECIPIENT_DATE; ?></td>
                            <?php } ?>
                            <?php if (in_array('last_updated_status_date', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_LAST_UPDATED_STATUS_DATE; ?></td>
                            <?php } ?>
                            <?php if (in_array('sender', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_SENDER; ?></td>
                            <?php } ?>
                            <?php if (in_array('sender_address', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_SENDER_ADDRESS; ?></td>
                            <?php } ?>
                            <?php if (in_array('recipient', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_RECIPIENT; ?></td>
                            <?php } ?>
                            <?php if (in_array('recipient_address', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_RECIPIENT_ADDRESS; ?></td>
                            <?php } ?>
                            <?php if (in_array('weight', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_WEIGHT; ?></td>
                            <?php } ?>
                            <?php if (in_array('seats_amount', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_SEATS_AMOUNT; ?></td>
                            <?php } ?>
                            <?php if (in_array('declared_cost', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_DECLARED_COST; ?></td>
                            <?php } ?>
                            <?php if (in_array('shipping_cost', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_SHIPPING_COST; ?></td>
                            <?php } ?>
                            <?php if (in_array('backward_delivery', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_BACKWARD_DELIVERY; ?></td>
                            <?php } ?>
                            <?php if (in_array('service_type', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_SERVICE_TYPE; ?></td>
                            <?php } ?>
                            <?php if (in_array('description', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_DESCRIPTION; ?></td>
                            <?php } ?>
                            <?php if (in_array('additional_information', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_ADDITIONAL_INFORMATION; ?></td>
                            <?php } ?>
                            <?php if (in_array('payer_type', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_PAYER_TYPE; ?></td>
                            <?php } ?>
                            <?php if (in_array('payment_method', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_PAYMENT_METHOD; ?></td>
                            <?php } ?>
                            <?php if (in_array('departure_type', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_DEPARTURE_TYPE; ?></td>
                            <?php } ?>
                            <?php if (in_array('packing_number', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_PACKING_NUMBER; ?></td>
                            <?php } ?>
                            <?php if (in_array('rejection_reason', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_REJECTION_REASON; ?></td>
                            <?php } ?>
                            <?php if (in_array('status', $data['displayed_information'])) { ?>
                                <td><?php echo COLUMN_STATUS; ?></td>
                            <?php } ?>
                            <td class="text-center" width="130px"><?php echo COLUMN_ACTION; ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($data['cns']) { ?>
                            <?php foreach ($data['cns'] as $cn) { ?>
                                <?php if ($cn['DeletionMark']) { ?>
                                    <tr class="danger">
                                <?php } elseif ($cn['Printed']) { ?>
                                    <tr class="active">
                                <?php } else { ?>
                                    <tr>
                                <?php } ?>
                                <td class="text-center">
                                    <input type="checkbox" name="selected[]" value="<?php echo $cn['IntDocNumber']; ?>" />
                                </td>
                                <td<?php if (!in_array('cn_identifier', $data['displayed_information'])) { echo ' style="display: none"'; } ?>>
                                    <?php echo $cn['Ref']; ?>
                                    <input type="hidden" name="refs[]" value="<?php echo $cn['Ref']; ?>" />
                                </td>
                                <?php if (in_array('cn_number', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['IntDocNumber']; ?></td>
                                <?php } ?>
                                <?php if (in_array('order_number', $data['displayed_information'])) { ?>
                                    <td class="text-center">
                                        <?php if (isset($cn['order'])) { ?>
                                            <a href="<?php echo $cn['order']; ?>" target="_blank"><?php echo $cn['order_id']; ?></a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                                <?php if (in_array('create_date', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['create_date']; ?></td>
                                <?php } ?>
                                <?php if (in_array('actual_shipping_date', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['actual_shipping_date']; ?></td>
                                <?php } ?>
                                <?php if (in_array('preferred_shipping_date', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['preferred_shipping_date']; ?></td>
                                <?php } ?>
                                <?php if (in_array('estimated_shipping_date', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['estimated_shipping_date']; ?></td>
                                <?php } ?>
                                <?php if (in_array('recipient_date', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['recipient_date']; ?></td>
                                <?php } ?>
                                <?php if (in_array('last_updated_status_date', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['last_updated_status_date']; ?></td>
                                <?php } ?>
                                <?php if (in_array('sender', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['sender']; ?></td>
                                <?php } ?>
                                <?php if (in_array('sender_address', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['sender_address']; ?></td>
                                <?php } ?>
                                <?php if (in_array('recipient', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['recipient']; ?></td>
                                <?php } ?>
                                <?php if (in_array('recipient_address', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['recipient_address']; ?></td>
                                <?php } ?>
                                <?php if (in_array('weight', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['Weight']; ?></td>
                                <?php } ?>
                                <?php if (in_array('seats_amount', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['SeatsAmount']; ?></td>
                                <?php } ?>
                                <?php if (in_array('declared_cost', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['declared_cost']; ?></td>
                                <?php } ?>
                                <?php if (in_array('shipping_cost', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['shipping_cost']; ?></td>
                                <?php } ?>
                                <?php if (in_array('backward_delivery', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['backward_delivery']; ?></td>
                                <?php } ?>
                                <?php if (in_array('service_type', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['service_type']; ?></td>
                                <?php } ?>
                                <?php if (in_array('description', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['Description']; ?></td>
                                <?php } ?>
                                <?php if (in_array('additional_information', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['AdditionalInformation']; ?></td>
                                <?php } ?>
                                <?php if (in_array('payer_type', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['payer_type']; ?></td>
                                <?php } ?>
                                <?php if (in_array('payment_method', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['payment_method']; ?></td>
                                <?php } ?>
                                <?php if (in_array('departure_type', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['departure_type']; ?></td>
                                <?php } ?>
                                <?php if (in_array('packing_number', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['PackingNumber']; ?></td>
                                <?php } ?>
                                <?php if (in_array('rejection_reason', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['RejectionReason']; ?></td>
                                <?php } ?>
                                <?php if (in_array('status', $data['displayed_information'])) { ?>
                                    <td><?php echo $cn['status']; ?></td>
                                <?php } ?>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="<?php echo $data['customized_printing'], '/orders[]/', $cn['IntDocNumber']; ?>" id="button-customized-printing-<?php echo $cn['IntDocNumber']; ?>" target="_blank" data-toggle="tooltip" title="<?php echo TEXT_CUSTOMIZED_PRINTING; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-print"></i></a>
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-header"><i class="fa fa-file-pdf-o fa-fw"></i> <?php echo TEXT_DOWNLOAD_PDF; ?></li>
                                            <li><a href="<?php echo $data['print_cn_pdf'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_CN; ?></a></li>
                                            <li><a href="<?php echo $data['print_markings_pdf'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_MARK; ?></a></li>
                                            <li><a href="<?php echo $data['print_markings_zebra_pdf'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_MARK_ZEBRA; ?></a></li>
                                            <li><a href="<?php echo $data['print_markings_zebra_100_100_pdf'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_MARK_ZEBRA_100_100; ?></a></li>
                                            <li role="separator" class="divider"></li>
                                            <li class="dropdown-header"><i class="fa fa-print fa-fw"></i> <?php echo TEXT_PRINT_HTML; ?></li>
                                            <li><a href="<?php echo $data['print_cn_html'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_CN; ?></a></li>
                                            <li><a href="<?php echo $data['print_markings_html'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_MARK; ?></a></li>
                                            <li><a href="<?php echo $data['print_markings_zebra_html'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_MARK_ZEBRA; ?></a></li>
                                            <li><a href="<?php echo $data['print_markings_zebra_100_100_html'], '/orders[]/', $cn['IntDocNumber']; ?>" target="_blank"><?php echo TEXT_MARK_ZEBRA_100_100; ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i> <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="<?php echo $data['add'], '&cn_ref=', $cn['Ref']; ?>"><i class="fa fa-pencil text-primary fa-fw"></i> <?php echo TEXT_EDIT; ?></a></li>
                                            <?php if (!isset($cn['order'])) { ?>
                                                <li><a onclick="assignmentOrder('<?php echo $cn['IntDocNumber']; ?>', '<?php echo $cn['Ref']; ?>');" style="cursor: pointer;"><i class="fa fa-plus-square text-success fa-fw" aria-hidden="true"></i> <?php echo TEXT_ASSIGNMENT_ORDER; ?></a></li>
                                            <?php } ?>
                                            <li><a onclick="printSettings(this);" style="cursor: pointer;"><i class="fa fa-print fa-fw"></i> <?php echo TEXT_PRINT_SETTINGS; ?></a></li>
                                            <li><a onclick="deleteCN(this);" style="cursor: pointer;"><i class="fa fa-trash-o text-danger fa-fw"></i> <?php echo TEXT_DELETE; ?></a></li>
                                        </ul>
                                    </div>
                                </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="<?php echo count($data['displayed_information']) + 2; ?>"><?php echo TEXT_NO_RESULTS; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-6 text-left"><?php echo $data['pagination']; ?></div>
                <div class="col-sm-6 text-right"><?php echo $data['results']; ?></div>
            </div>
        </div>
    </div>

    <!-- START Modal assignment order to CN -->
    <div class="modal fade" id="modal-assignment-order-to-cn" tabindex="-1" role="dialog" aria-labelledby="modal-assignment-order-to-cn-label">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-assignment-order-to-cn-label"><?php echo TEXT_ORDER; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group clearfix">
                        <input type="hidden" name="cn_number" value="" id="input-cn_number" />
                        <input type="hidden" name="cn_ref" value="" id="input-cn_ref" />
                        <label class="col-sm-4 control-label" for="input-order_number"><?php echo ENTRY_ORDER_NUMBER; ?></label>
                        <div class="col-sm-8">
                            <input type="text" name="order_number" value="" placeholder="<?php echo ENTRY_ORDER_NUMBER; ?>" id="input-order_number" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="assignmentOrder();"><i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal assignment order to CN -->
    <!-- START Print settings -->
    <div class="modal fade" id="modal-print-settings" tabindex="-1" role="dialog" aria-labelledby="modal-print-settings-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-print-settings-label"><?php echo TEXT_PRINT_SETTINGS; ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" id="input-print_button_id">
                    <div class="form-group clearfix">
                        <label class="col-sm-4 control-label" for="input-print_format"><?php echo ENTRY_PRINT_FORMAT; ?></label>
                        <div class="col-sm-8">
                            <select name="print_format" id="input-print_format" class="form-control">
                                <?php foreach ($data['print_formats'] as $k => $v) { ?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-4 control-label" for="input-number_of_copies"><?php echo ENTRY_NUMBER_OF_COPIES; ?></label>
                        <div class="col-sm-8">
                            <select name="number_of_copies" id="input-number_of_copies" class="form-control">
                                <?php for ($i = 1; $i <= 6; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-4 control-label" for="input-template_type"><?php echo ENTRY_TEMPLATE_TYPE; ?></label>
                        <div class="col-sm-8">
                            <select name="template_type" id="input-template_type" class="form-control">
                                <?php foreach ($data['template_types'] as $k => $v) { ?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-4 control-label" for="input-print_type"><?php echo ENTRY_PRINT_TYPE; ?></label>
                        <div class="col-sm-8">
                            <select name="print_type" id="input-print_type" class="form-control">
                                <?php foreach ($data['print_types'] as $k => $v) { ?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-4 control-label" for="input-print_start"><?php echo ENTRY_PRINT_START; ?></label>
                        <div class="col-sm-8">
                            <div class="btn-group-vertical" id="div-vertical-1" data-toggle="buttons">
                                <?php for ($i = 1; $i <= 8; $i++) { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="print_start" value="<?php echo $i; ?>" id="input-print_start-<?php echo $i; ?>" autocomplete="off"><?php echo $i; ?>
                                    </label>
                                <?php } ?>
                            </div>
                            <div class="btn-group-vertical" id="div-vertical-2" data-toggle="buttons">
                                <?php for ($i = 1; $i <= 8; $i++) { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="print_start" value="<?php echo $i; ?>" id="input-print_start-<?php echo $i; ?>" autocomplete="off"><?php echo $i; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="printSettings();"><i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Print settings -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<script type="text/javascript">
    function assignmentOrder(number, ref) {
        if ($('#modal-assignment-order-to-cn').is(':hidden')) {
            $('#input-cn_number').val(number);
            $('#input-cn_ref').val(ref)

            $('#modal-assignment-order-to-cn').modal('show');
        } else {
            var post_data = 'order_id=' + $('#input-order_number').val() + '&cn_number=' + encodeURIComponent($('#input-cn_number').val()) + '&cn_ref=' + encodeURIComponent($('#input-cn_ref').val());

            $.ajax( {
                url: './includes/modules/novaposhta/novaposhta.php?action=addCNToOrder',
                type: 'POST',
                data: post_data,
                dataType: 'json',
                beforeSend: function () {
                    $('body').fadeTo('fast', 0.7).prepend('<div id="ajax-loader" style="position: fixed; top: 50%;	left: 50%; z-index: 9999;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
                },
                complete: function () {
                    var $alerts = $('.alert-danger, .alert-success');

                    if ($alerts.length !== 0) {
                        setTimeout(function() { $alerts.fadeOut(); }, 5000);
                    }

                    $('body').fadeTo('fast', 1)
                    $('#ajax-loader').remove();
                },
                success: function(json) {
                    if(json['error']) {
                        $('.container-fluid:eq(1)').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }

                    if (json['success']) {
                        $('.container-fluid:eq(1)').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                        setTimeout(function() { location.reload(); }, 2000);
                    }

                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            } );

            $('#modal-assignment-order-to-cn').modal('hide');
        }
    }

    function printSettings(self) {
        if ($('#modal-print-settings').is(':hidden')) {
            var p_id;

            if (self.id == 'button-print') {
                p_id = $(self).parents('div.btn-group').find('#button-customized-printing')[0].id;
            } else {
                p_id = $(self).parents('tr').find('a[id^="button-customized-printing"]')[0].id;
            }

            $('#input-print_button_id').val(p_id);

            $('#modal-print-settings').modal('show');
        } else {
            var
                print_format,
                page_format,
                print_direction,
                position,
                new_href;

            if ($('#input-print_format').val() == 'document_A4') {
                print_format = 'printDocument';
                page_format = 'A4';
            } else if ($('#input-print_format').val() == 'document_A5') {
                print_format = 'printDocument';
                page_format = 'A5';
            } else if ($('#input-print_format').val() == 'markings_A4') {
                print_format = 'printMarkings';
                page_format = 'A4';

                if ($('#input-template_type').val() == 'html') {
                    print_direction = $('#input-print_type').val();
                    position = $('input[id^="input-print_start"]:checked').val();
                }
            }

            new_href = 'https://my.novaposhta.ua/orders/' + print_format + '/apiKey/<?php echo $data['key_api']; ?>/type/' + $('#input-template_type').val() + '/pageFormat/' + page_format + '/copies/' + $('#input-number_of_copies').val();

            if (print_direction) {
                new_href += '/printDirection/' + print_direction + '/position/' + position;
            }

            if ($('#input-print_button_id').val() == 'button-customized-printing') {
                setTimeout(function() { $('input[name^="selected"]').trigger('change'); }, 1000);
            } else {
                new_href += '/orders[]/' + parseInt($('#input-print_button_id').val().replace(/\D/g,''));
            }

            $('#' + $('#input-print_button_id').val()).attr('href', new_href);

            $('#modal-print-settings').modal('hide');
        }
    }

    function deleteCN(self) {
        if (!confirm('<?php echo TEXT_CONFIRM; ?>')) {
            return false;
        }
        var post_data;

        if (self.id == 'button-delete') {
            post_data = $('input[name^="selected"]:checked').parents('tr').find('input[name^="refs"]').serialize();

            $('input[name^="selected"]:checked').parents('tr').find('a[href*="id"]').each(function(i) {
                post_data += '&orders[]=' + $(this).text();
            } );
        } else {
            post_data = $(self).parents('tr').find('input[name^="refs"]').serialize();
            post_data += '&orders[]=' + $(self).parents('tr').find('a[href*="id"]').text();
        }

        $.ajax( {
            type: 'POST',
            url: './includes/modules/novaposhta/novaposhta.php?action=deleteCN',
            data: post_data,
            dataType: 'json',
            beforeSend: function () {
                $(self).find('i').addClass('fa-spin');
                $(self).parents('div.btn-group').find('i').addClass('fa-spin');
            },
            complete: function () {
                var $alerts = $('.alert-danger, .alert-success');

                if ($alerts.length !== 0) {
                    setTimeout(function() { $alerts.fadeOut(); }, 5000);
                }

                $(self).find('i').removeClass('fa-spin');
                $(self).parents('div.btn-group').find('i').removeClass('fa-spin');
            },
            success: function(json) {
                if (json['success']) {
                    for(var i in json['success']['refs']) {
                        $('input[value ="' + json['success']['refs'][i]['Ref'] + '"]').parents('tr').fadeOut('slow');
                    }

                    $('.container-fluid:eq(1)').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success']['text'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                if (json['warning']) {
                    for(var w in json['warning']) {
                        $('.container-fluid:eq(1)').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['warning'][w] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                }
            }
        } );
    }

    function formHandler(element) {
        switch (element.id) {
            case 'input-print_format':
            case 'input-template_type':
                var
                    print_format = $('#input-print_format').val(),
                    template_type = $('#input-template_type').val();

                if (print_format == 'markings_A4' && template_type == 'html') {
                    $('#input-print_type, input[id^="input-print_start"]').parents('div.form-group').fadeIn();
                } else {
                    $('#input-print_type, input[id^="input-print_start"]').parents('div.form-group').fadeOut();
                }

                break;

            case 'input-print_type':
                var
                    $print_start_1 = $('#div-vertical-1'),
                    $print_start_2 = $('#div-vertical-2')

                if (element.value == 'horPrint') {
                    $print_start_1.find('label:odd').hide();
                    $print_start_1.find('label:even').show();
                    $print_start_2.find('label:odd').show();
                    $print_start_2.find('label:even').hide();
                } else {
                    $print_start_1.find('label:lt(4)').show();
                    $print_start_1.find('label:gt(3)').hide();
                    $print_start_2.find('label:lt(4)').hide();
                    $print_start_2.find('label:gt(3)').show();
                }

                break;
        }
    }

    $(function() {
        $('.date').datetimepicker({
            pickTime: false
        } );

        if ('<?php echo $data['cn_number']; ?>') {
            $('tr:contains("<?php echo $data['cn_number']; ?>")').addClass('success');
        }

        $('input[name^="selected"]').on('change', function(e) {
            var
                orders = '',
                selected = $('input[name^="selected"]:checked');

            for(var i = 0; i < selected.length; i++) {
                orders += '/orders[]/' + selected[i].value;
            }

            $('#button-customized-printing, a[id^="button-pdf"], a[id^="button-html"]').each( function(indx) {
                $(this).attr('href', $(this).attr('href').replace(/\/orders\[\]\/.*/g, ''));
                $(this).attr('href', $(this).attr('href') + orders);
            });

            if (selected.length) {
                $('#button-customized-printing, [id^="button-pdf"], [id^="button-html"], #button-delete').attr('disabled', false);
            } else {
                $('#button-customized-printing, [id^="button-pdf"], [id^="button-html"], #button-delete').attr('disabled', true);
            }
        } );

        $('#button-filter').on('click', function() {
            var
                url = './includes/modules/novaposhta/novaposhta.php?action=getCNList',
                post_data = '',
                filter_cn_number = $('#input-filter_cn_number').val(),
                filter_cn_type = $('#input-filter_cn_type').val(),
                filter_departure_date_from = $('#input-filter_departure_date_from').val(),
                filter_departure_date_to = $('#input-filter_departure_date_to').val();

            if (filter_cn_number) {
                post_data += '&filter_cn_number=' + encodeURIComponent(filter_cn_number);
            }

            if (filter_cn_type) {
                post_data += '&filter_cn_type[]=';
                if (filter_cn_type == Array) {
                for (var i in filter_cn_type) {
                        post_data += encodeURIComponent(filter_cn_type[i]) + ', ';
                }
                } else {
                    post_data += encodeURIComponent(filter_cn_type)
                }

            }

            if (filter_departure_date_from) {
                post_data += '&filter_departure_date_from=' + encodeURIComponent(filter_departure_date_from);
            }

            if (filter_departure_date_to) {
                post_data += '&filter_departure_date_to=' + encodeURIComponent(filter_departure_date_to);
            }

            //location = url;

            $.ajax( {
                type: 'GET',
                url: url,
                data: post_data,
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#modal_getCNList').remove();
                },
                success: function(json) {
                    modal({
                        id: 'getCNList',
                        body: json.html,
                        render: true,
                        width: '70%',
                    });
                return false;
                }
            } );

        } );

        $('#input-print_format, #input-template_type, #input-print_type').each(function() {
            formHandler(this);
        } );

        $('input, select, textarea').on('change', function(e) {
            formHandler(e.currentTarget);
        } );

        $('#div-vertical-1, #div-vertical-2').on('click', function (e) {
            $('#div-vertical-1, #div-vertical-2').not('#' + e.currentTarget.id).find('label').removeClass('active').find('input').removeAttr('checked');
        } );

        // addCN
        $('#button-add').on('click', function () {
            $.get('includes/modules/novaposhta/novaposhta.php', {
                action: 'getCNForm'
            }, function(data) {
                modal({
                    id: 'getCNForm',
                    body: data.html,
                    render: true,
                    width: '70%',
                });

            }, 'json');
            return false;
        } );
    } );
</script>