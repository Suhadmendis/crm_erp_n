
<?php

$mtype = "";
include "header.php";

if (isset($_GET['url'])) {
    if ($_GET['url'] == "Airport") {
        include_once './Airport.php';
    }
    if ($_GET['url'] == "po") {
        include_once './po.php';
    }
    if ($_GET['url'] == "inv_inf") {
        include_once './invoice_info.php';
    }
    if ($_GET['url'] == "vieword") {
        include_once './collect_invoice.php';
    }
    if ($_GET['url'] == "order") {
        include_once './view_order.php';
    }
    if ($_GET['url'] == "cusmas") {
        include_once './cusmas.php';
    }
    if ($_GET['url'] == "Carrier") {
        include_once './Carrier.php';
    }
    if ($_GET['url'] == "Container") {
        include_once './Container.php';
    }
    if ($_GET['url'] == "LoadUnload") {
        include_once './LoadUnload.php';
    }
    if ($_GET['url'] == "Package_type") {
        include_once './Package_type.php';
    }
    if ($_GET['url'] == "Charge_code") {
        include_once './Charge_code.php';
    }
    if ($_GET['url'] == "item-master") {
        include_once './item-master.php';
    }
    if ($_GET['url'] == "item-master1") {
        include_once './item-master_1.php';
    }
    if ($_GET['url'] == "Currency") {
        include_once './Currency.php';
    }
    if ($_GET['url'] == "Vessel") {
        include_once './Vessel.php';
    }
    if ($_GET['url'] == "Sales_rep") {
        include_once './Sales_rep.php';
    }
    if ($_GET['url'] == "helpdesk") {
        include_once './helpdesk.php';
    }
    if ($_GET['url'] == "Debit_note") {
        include_once './Debit_note.php';
        $mtype="A";
    }
    if ($_GET['url'] == "Credit_note") {
        include_once './Credit_note.php';
        $mtype="A";
    }
    if ($_GET['url'] == "Payments") {
        include_once './Payments.php';
        $mtype="A";
    }
    if ($_GET['url'] == "costing") {
        include_once './costing.php';
        $mtype="O";
    }
    if ($_GET['url'] == "inv_opr") {
        include_once './invoice_opr.php';
        $mtype="O";
    }
    if ($_GET['url'] == "Receipt_entry") {
        include_once './Direct_receipt.php';
        $mtype="A";
    }
    if ($_GET['url'] == "Return_Receipt") {
        include_once './Return_Receipt.php';
        $mtype="A";
    }
    if ($_GET['url'] == "Receipt") {
        include_once './Receipt.php';
        $mtype="A";
    }

    if ($_GET['url'] == "lcode") {
        include_once './Account_master.php';
    }
    
    if ($_GET['url'] == "jou") {
        include_once './Journal_Entry.php';
        $mtype="A";
    }
    
    if ($_GET['url'] == "tb") {
        include_once './trailbal.php';
        
    }
    
    if ($_GET['url'] == "out") {
        include_once './rep_outstanding.php';
    }
    
    if ($_GET['url'] == "bank_rec") {
        include_once './bank_rec.php';
    }
    
    if ($_GET['url'] == "inv") {
        include_once './invoice.php';
    }
    
    if ($_GET['url'] == "inv_drc") {
        include_once './invoice_drc.php';
    }
    
    if ($_GET['url'] == "cus") {
        include_once './cusmas.php';
    }

    if ($_GET['url'] == "issu") {
        include_once './issue_note.php';
    }
    
    if ($_GET['url'] == "user") {
        include_once './new_user.php';
    }
    
    if ($_GET['url'] == "user_p") {
        include_once './user_permission.php';
    }
    if ($_GET['url'] == "pnlbs") {
        include_once './rep_pnlbs.php';
    }
    if ($_GET['url'] == "pr") {
        include_once './pr.php';
    }
    if ($_GET['url'] == "bin") {
        include_once './bin.php';
    }

  if ($_GET['url'] == "chq_setup") {
        include_once './cheque_setup.php';
    }
    
    if ($_GET['url'] == "contra") {
        include_once './contra.php';
    }
    
    if ($_GET['url'] == "rcs") {
        include_once './rcs.php';
        $mtype="O";
    }
    if ($_GET['url'] == "rcs_search") {
        include_once './rcs_search.php';
         
    }
    if ($_GET['url'] == "air_job") {
        include_once './air_job_reg.php';
        $mtype="O";
    }
    if ($_GET['url'] == "air_job_search") {
        include_once './air_job_search.php';     
    }
    
    if ($_GET['url'] == "sea_imp") {
        include_once './sea_job.php';     
    }
    if ($_GET['url'] == "GIN") {
        include_once './gin_m.php';     
    }
    
    if ($_GET['url'] == "gin_nt") {
        include_once './gin_note.php';     
    }
    
    if ($_GET['url'] == "gin_is") {
        include_once './gin_note_is.php';     
    }
    
    if ($_GET['url'] == "gin_is_ut") {
        include_once './gin_note_is_ut.php';     
    }
    
    if ($_GET['url'] == "gin_nt_gnrl") {
        include_once './gin_note_general.php';     
    }
    
    if ($_GET['url'] == "gin_nt_gnrl_1") {
        include_once './gin_note_general_1.php';     
    }
    
    if ($_GET['url'] == "qttn") {
        include_once './gin_note_general_1_qttn.php';     
    }
    
    if ($_GET['url'] == "gin_nt_fg") {
        include_once './gin_note_fg.php';     
    }
    
      if ($_GET['url'] == "gin_dpt") {
        include_once './gin_note_dpt.php';     
    }
    
      if ($_GET['url'] == "gin_mrn") {
        include_once './gin_note_mrn.php';     
    }

    if ($_GET['url'] == "gin_mrn_ink") {
        include_once './gin_note_mrn_ink.php';
    }
    
      if ($_GET['url'] == "gin_mrn_x") {
        include_once './gin_note_mrn_ex.php';     
    }
    
      if ($_GET['url'] == "gin_mrn_is") {
        include_once './gin_note_mrn_is.php';     
    }
    
      if ($_GET['url'] == "gin_mrn_gn") {
        include_once './gin_note_mrn_gn.php';     
    }
    
        if ($_GET['url'] == "job_request") {
        include_once './job_request.php';//based on gin_note_mrn_gn
    }
	   if ($_GET['url'] == "job_order") {
        include_once './joborder.php';//based on gin_note_mrn_gn
    }
    
      if ($_GET['url'] == "job_mas") {
        include_once './job_master.php';     
    }
    
    
    
    
    if ($_GET['url'] == "costing_n") {
        include_once './costing.php';
    }
    if ($_GET['url'] == "CostingConfrmation") {
        include_once './CostingConfrmation.php';
    }
    if ($_GET['url'] == "SampleTransfer") {
        include_once './SampleTransfer.php';
    }
    if ($_GET['url'] == "DesignAlocation") {
        include_once './DesignAlocation.php';
    }
    if ($_GET['url'] == "ArtworkCategoryMaster") {
        include_once './ArtworkCategoryMaster.php';
    }
    if ($_GET['url'] == "BrandMaster") {
        include_once './BrandMaster.php';
    }
    if ($_GET['url'] == "TargetAudianceMaster") {
        include_once './TargetAudianceMaster.php';
    }
    if ($_GET['url'] == "overHeadMaster") {
        include_once './overHeadMaster.php';
    }
    if ($_GET['url'] == "StageMaster") {
        include_once './StageMaster.php';
    }
    if ($_GET['url'] == "DailyVisitCategoryMaster") {
        include_once './DailyVisitCategoryMaster.php';
    }
    if ($_GET['url'] == "DesignMaster") {
        include_once './DesignMaster.php';
    }
    if ($_GET['url'] == "ChargeMaster") {
        include_once './ChargeMaster.php';
    }
    if ($_GET['url'] == "StandInkCostMas") {
        include_once './StandInkCostMas.php';
    }
    if ($_GET['url'] == "SizeMaster") {
        include_once './SizeMaster.php';
    }
    if ($_GET['url'] == "MachineMaster") {
        include_once './MachineMaster.php';
    }
    if ($_GET['url'] == "MachineCategoryMaster") {
        include_once './MachineCategoryMaster.php';
    }
    if ($_GET['url'] == "JobProductionConfrmation") {
        include_once './JobProductionConfrmation.php';
    }
    if ($_GET['url'] == "SelectionProductionPlan") {
        include_once './SelectionProductionPlan.php';
    }
    if ($_GET['url'] == "DesignRequationForm") {
        include_once './DesignRequationForm.php';
    }
    if ($_GET['url'] == "inv") {
        include_once './invoice.php';
    }
    if ($_GET['url'] == "inv_1") {
        //debit note
        include_once './invoice_1.php'; //based on invoice
    }    
    if ($_GET['url'] == "Mas_supplier") {
        include_once './Mas_supplier.php';
    }

    if ($_GET['url'] == "I_Mas") {
        include_once './I_Mas.php';
    }
    if ($_GET['url'] == "Mas_location") {
        include_once './Mas_location.php';
    }
    if ($_GET['url'] == "Mar_seg_mas") {
        include_once './Mar_seg_mas.php';
    }
    if ($_GET['url'] == "Mas_CardTyp") {
        include_once './Mas_CardTyp.php';
    }
    if ($_GET['url'] == "Mas_UOM") {
        include_once './Mas_UOM.php';
    }
    if ($_GET['url'] == "Mas_borrower") {
        include_once './Mas_borrower.php';
    }
    if ($_GET['url'] == "Mas_reason") {
        include_once './Mas_reason.php';
    }
    if ($_GET['url'] == "ProductGroupMaster") {
        include_once './ProductGroupMaster.php';
    }
    if ($_GET['url'] == "SalesExecMas") {
        include_once './SalesExecMas.php';
    }
    if ($_GET['url'] == "Mas_ArtWork") {
        include_once './Mas_ArtWork.php';
    }
    if ($_GET['url'] == "Mas_Brand") {
        include_once './Mas_Brand.php';
    }
    if ($_GET['url'] == "Mas_Target") {
        include_once './Mas_Target.php';
    }
    if ($_GET['url'] == "Assesments") {
        include_once './assesments_manager.php';
    }
    if ($_GET['url'] == "Item") {
        include_once './Ass_ItemMasterFile.php';
    }
    if ($_GET['url'] == "Location") {
        include_once './Ass_Location_Mas.php';
    }
    if ($_GET['url'] == "Complain") {
        include_once './Ass_Comments.php';
    }
    if ($_GET['url'] == "Payments") {
        include_once './Payments.php';
    }
    if ($_GET['url'] == "CompleteOrNotcomplete") {
        include_once './Ass_NotComplete.php';
    }
    if ($_GET['url'] == "ComplainProgress") {
        include_once './Ass_ComplaneProgress.php';
    }
    if ($_GET['url'] == "Return_Receipt") {
        include_once './Return_Receipt.php';
    }
    if ($_GET['url'] == "Purchase") {
        include_once './purchase.php';
    }
    if ($_GET['url'] == "History") {
        include_once './history.php';
    }
    if ($_GET['url'] == "DueDate") {
        include_once './due_date_report.php';
    }
    if ($_GET['url'] == "DailyTrans") {
        include_once './daily_trans_report.php';
    }
    if ($_GET['url'] == "StockReport") {
        include_once './stock_reports.php';
    }
    if ($_GET['url'] == "inv") {
        include_once './invoice.php';
    }
    if ($_GET['url'] == "user") {
        include_once './new_user.php';
    }
    if ($_GET['url'] == "pnlbs") {
        include_once './rep_pnlbs.php';
    }
    if ($_GET['url'] == "pr") {
        include_once './pr.php';
    }
    if ($_GET['url'] == "POReq") {
        include_once './POReq.php';
    }
    if ($_GET['url'] == "Stc_PurO_E") {
        include_once './Stc_PurO_E.php';
    }
    if ($_GET['url'] == "Grn") {
        include_once './Grn.php';
    }
    if ($_GET['url'] == "DispathNote") {
        include_once './DispathNote.php';
    }
    if ($_GET['url'] == "DispatchReturn") {
        include_once './DispatchReturn.php';
    }
    if ($_GET['url'] == "IssueNote") {
        include_once './IssueNote.php';
    }
    if ($_GET['url'] == "IssueReturn") {
        include_once './IssueReturn.php';
    }
	if ($_GET['url'] == "manuel_aod") {
        include_once './Manuel_aod.php';
    }
	if ($_GET['url'] == "temporary_manual_invoice") {
        include_once './temporary_manual_invoice.php';
    }
	if ($_GET['url'] == "proforma_invoice") {
        include_once './proforma_invoice.php';
    }
	if ($_GET['url'] == "quotation") {
        include_once './quotation.php';
    }
	


 if ($_GET['url'] == "ink_master") {
        include_once './ink_master.php';
    }
    
    
    
    if ($_GET['url'] == "factory_master") {
        include_once './factry_master.php';
    }
    
    
    
    
    
    //sample job path
    
    if ($_GET['url'] == "sample_job_request") {
        include_once './sample_jobrequest_note.php';
    }
    if ($_GET['url'] == "sample_job_order") {
        include_once './sample_job_order.php';
    }
    if ($_GET['url'] == "sample_job_materials") {
        include_once './sample_jobmaterials_request_note.php';
    }
    if ($_GET['url'] == "sample_job_materials_issue") {
        include_once './sample_jobmaterials_issue_note.php';
    }
    if ($_GET['url'] == "sample_Transfer") {
        include_once './sample_job_transfer.php';
    }
    if ($_GET['url'] == "sample_delivery") {
        include_once './sample_delivery_note.php';
    }
    
    
  if ($_GET['url'] == "material_requirement") {
        include_once './material_requirement .php';
    }
    
       // Purchasing Path
    //viraj
    if ($_GET['url'] == "grned") {
        include_once './Good_received-note_entry_dummy_file.php';
    }
    if ($_GET['url'] == "pornd") {
        include_once './po_requisition_note_dummy_file.php';
    }
    if ($_GET['url'] == "poed") {
        include_once './Purchase_Order_Entry_Dummy_file.php';
    }
    if ($_GET['url'] == "pur_SI") {
        include_once './sarvice_invoice_file.php';
    }
    
    
    //janith
    if ($_GET['url'] == "prn") {
        include_once './po_requistion_note.php';
    }
    if ($_GET['url'] == "pooe") {
        include_once './purchase_order_entry.php';
    }
     if ($_GET['url'] == "grne") {
        include_once './good_received_note_entry.php';
    }
      if ($_GET['url'] == "good_return_note_entry") {
        include_once './good_return_note_entry.php';
    }

    
        
    if ($_GET['url'] == "vehicle_master") {
        include_once './vehicle_master.php';
    }
    
    if ($_GET['url'] == "vehicle_mileage_master") {
        include_once './vehicle_mileage_master.php';
    }
    
    
    if ($_GET['url'] == "service_invoice_data") {
        include_once './service_ invoice_data.php';
    }
    
      if ($_GET['url'] == "sup_mas") {
        include_once './ssupplier_master.php';
    }

    if ($_GET['url'] == "cus_mas") {
        include_once './ccustomer_master.php';
    }
    if ($_GET['url'] == "sup_mas") {
        include_once './ssupplier_master.php';
    }
    
    
    
    
    if ($_GET['url'] == "test") {
        include_once './newEmptyPHP1.php';
         
    }

        //asset_master file 
    
    if ($_GET['url'] == "asset_category_master") {
        include_once './asset_category_master.php';
    }
    if ($_GET['url'] == "asset_user_department_master") {
        include_once './asset_user_department_master.php';
    }
    if ($_GET['url'] == "asset_user_master") {
        include_once './asset_user_master.php';
    }

 if ($_GET['url'] == "mark_ex") {
        include_once './sales_executive_master.php';
    }
 if ($_GET['url'] == "manuel_grn") {
        include_once './manuel_grn.php';
    }

        if ($_GET['url'] == "arf") {
        include_once './advance_requests_fuel.php';
    }

        if ($_GET['url'] == "dep_master") {
        include_once './dept_master.php';
    }

        if ($_GET['url'] == "meal_reim") {
        include_once './meal_reimbursement.php';
    }
    
       if ($_GET['url'] == "sub_contractor_job_confirmation") {
        include_once './sub_con_job_confermation.php';
    }
    


  
    //Other
    if ($_GET['url'] == "petty_iou") {
        include_once './pettycash_iou.php';
    }
  


    //sub mas

    if ($_GET['url'] == "var_over_mas") {
        include_once './variable_over_head_master.php';
    }
    if ($_GET['url'] == "fixed_mas") {
        include_once './fixed_over_head_master.php';
    }
    if ($_GET['url'] == "labour_mas") {
        include_once './labour_master.php';
    }    

    if ($_GET['url'] == "adjustments_addition_deduction") {
        include_once './adjustments_addition_deduction.php';
    }
    
    if ($_GET['url'] == "ledger") {
        include_once './ledger_indicater.php';
    }                                                                                                                                                          
   if ($_GET['url'] == "pro_mas") {
        include_once './product_master.php';
    }

    if ($_GET['url'] == "delnote") {
        include_once './deliverynote.php';
    }

    if ($_GET['url'] == "gen_doc") {
        include_once './general_documents.php';
    }


} else {

    include_once './fpage.php';
}

include_once './footer.php';
?>

</body>
</html>

<!-- <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap-multiselect.js"></script> -->

<script  type="text/javascript">
$(function() {

 


    $(document).ready(function() {
        $('#brand').multiselect();
    });

 
});

</script>
<script type="text/javascript">
    $(function () {
        $('.dt').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
<?php

if ($mtype=="A") {
    include './autocomple_gl.php';
}

if ($mtype=="O") {
    include './autocomple_op.php';
}
?>
<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="js/comman.js"></script>


<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>   <!-- minified -->
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="js/user.js"></script>




<script>
    $("body").addClass("sidebar-collapse");
</script>    



