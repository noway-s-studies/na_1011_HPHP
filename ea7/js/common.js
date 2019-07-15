function Load_ChangePasswordForm() {
    $("#middle").load("changepasswordform.php", 
      function() {
          //$("#changepasswordform").hide().show(600, function() { $("#changepasswordform").hide().show(600); });
          $("#changepasswordform").hide().show(600);
      }
    );
}

/*function Save_ChangePasswordForm() {
    var oldpassword = $("#oldpassword").val();
    var password = $("#password").val();
    var password2 = $("#password2").val();
    var o = new Object();
    o.oldpassword = oldpassword;
    o.password = password;
    o.password2 = password2;
    
    $.post( "changepasswordform.php", o,
        function(data) {
            $("#changepasswordform").html(data);
            $("#changepasswordform").hide().show(600);
        }
    );
}*/

function Save_ChangePasswordForm() {
    $.post( "changepasswordform.php", 
    {oldpassword:  $("#oldpassword").val(), password: $("#password").val(), password2: $("#password2").val()},
        function(data) {
            $("#changepasswordform").html(data);
            $("#changepasswordform").hide().show(600);
        }
    );
}

function Load_TesztKerdesForm(tkid) {
    if(typeof tkid =='undefined') tkid=''; else tkid='?tkid='+tkid;
    $("#middle").load("tesztkerdesform.php"+tkid, 
      function() {
          $("#tesztkerdesform").hide().show(600);
      }
    );
}

function Save_TesztKerdesForm() {
    $.post( "tesztkerdesform.php", 
    {tkid:  $("#tkid").val(), kerdestxt:  $("#kerdestxt").val(), tipus: $("#tipus").val(),
        kategoria: $("#kategoria").val(),  nehezseg: $("#nehezseg").val()},
        function(data) {
            $("#tesztkerdesform").html(data);
            $("#tesztkerdesform").hide().show(600);
        }
    );
}

function Load_TesztValaszForm(tkid,tvid) {
    var queryPars = [];
    if(typeof tkid !='undefined') queryPars.push('tkid='+tkid);
    if(typeof tvid !='undefined') queryPars.push('tvid='+tvid);
    var queryString = queryPars.join('&');
    $("#middle").load("tesztvalaszform.php?"+queryString, 
      function() {
          $("#tesztvalaszform").hide().show(600);
      }
    );
}

function Save_TesztValaszForm() {
    // a getElementById-t lecserélni
    $.post( "tesztvalaszform.php", 
    {tkid:  $("#tkid").val(), tvid:  $("#tvid").val(), sorszam: $("#sorszam").val(), valasztxt: $("#valasztxt").val(),
        helyese: document.getElementById('helyese').checked ? 1 : 0 },
        function(data) {
            $("#tesztvalaszform").html(data);
            $("#tesztvalaszform").hide().show(600);
        }
    );
}


function Load_TesztKerdes(tkid) {
    $("#middle").load("tesztkerdes.php?tkid="+tkid, 
      function() {
          $("#tesztkerdes").hide().show(600);
      }
    );
}


function Load_OsszesTesztKerdesForm() {
    $("#middle").load("osszestesztkerdesform.php", 
      function() {
          $("#osszestesztkerdesform").hide().show(600);
      }
    );
}

$(document).ajaxStart(
  function() {
      $.blockUI({message: "<h3><img src='img/indicator.gif'>Kérem várjon...</h3>"});
  }      
);

$(document).ajaxStop(
  function() {
      $.unblockUI();
  }      
);


function SendValasz(tkid,tvid) {
    $.ajax({
        url: "sendvalasz.php",
        type: "GET",
        contentType: "text/html",
        data: { "tkid" : tkid, "tvid": tvid},
        timeout: 20000,
        cache: false,
        complete: function (jqXHR, textStatus) {
            $("#img"+tkid).attr('src', 'img/cmark24.png');
        },
        success: function (data, textStatus, jqXHR) {
            
        },
        error: function (jqXHR, textStatus, error) {
            var status = jqXHR.status;
            alert("AJAX error: "+status);
            //console.log(jqXHR);
            //console.log(error);
        }
    });
}


