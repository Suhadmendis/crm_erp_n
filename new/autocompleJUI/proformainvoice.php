 <script>
 
  $( function() {


    $( "#Settlement_Due" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SettlementDue_pro&keyword=" + document.getElementById('Settlement_Due').value,
     minLength: 0
    });

 $( "#Customer_Order_No" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=CustomerOrderNo_pro&keyword=" + document.getElementById('Customer_Order_No').value,
     minLength: 0
    });

 $( "#Customer_Name" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=Customer_Name_pro&keyword=" + document.getElementById('Customer_Name').value,
     minLength: 0
    });

 $( "#Customer_Address" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=CustomerAddress_pro&keyword=" + document.getElementById('Customer_Address').value,
     minLength: 0
    });

 $( "#NBT" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=NBT_pro&keyword=" + document.getElementById('NBT').value,
     minLength: 0
    });

 $( "#VAT" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=VAT_pro&keyword=" + document.getElementById('VAT').value,
     minLength: 0
    });

 $( "#SVAT" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SVAT_pro&keyword=" + document.getElementById('SVAT').value,
     minLength: 0
    });
   

  } );


  </script>



