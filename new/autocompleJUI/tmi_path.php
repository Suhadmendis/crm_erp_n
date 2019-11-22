 <script>
 
  $( function() {


    $( "#Settlement_Due" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SettlementDue_tmi&keyword=" + document.getElementById('Settlement_Due').value,
     minLength: 0
    });

 $( "#Customer_Order_No" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=CustomerOrderNo_tmi&keyword=" + document.getElementById('Customer_Order_No').value,
     minLength: 0
    });

 $( "#Customer_Name" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=Customer_Name_tmi&keyword=" + document.getElementById('Customer_Name').value,
     minLength: 0
    });

 $( "#Customer_Address" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=CustomerAddress_tmi&keyword=" + document.getElementById('Customer_Address').value,
     minLength: 0
    });

 $( "#NBT" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=NBT_tmi&keyword=" + document.getElementById('NBT').value,
     minLength: 0
    });

 $( "#VAT" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=VAT_tmi&keyword=" + document.getElementById('VAT').value,
     minLength: 0
    });

 $( "#SVAT" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SVAT_tmi&keyword=" + document.getElementById('SVAT').value,
     minLength: 0
    });
   

  } );


  </script>



