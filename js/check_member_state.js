//確認會員登入狀態
//登出按鈕 設定為 #logout_btn
//會員名稱設定為  #login_member

function check_member_state() {
  if (getCookie("MUID01") != "" && getCookie("MUID02") != "") {
    //傳遞至後端驗證UID
    var JSONdata = {};
    JSONdata["uid01"] = getCookie("MUID01");
    JSONdata["uid02"] = getCookie("MUID02");
    // console.log(JSON.stringify(JSONdata));
    $.ajax({
      type: "POST",
      url: "mem_uid_check_api.php",
      dataType: "json",
      data: JSON.stringify(JSONdata),
      async: false, //渲染要關閉非同步
      success: showdata_uid_check,
      erroe: function () {
        alert("err-mem_uid_check_api.php");
      },
    });
  } else {
    location.href = "../member/member_login.html";
  }
  //登出按鈕s2_logout_btn監聽
  $("#s2_logout_btn").bind("click", function () {
    console.log("test");
    setCookie("MUID01", "", 7);
    setCookie("MUID02", "", 7);
    location.href = "front_page.html";
  });
}

function showdata_uid_check(data) {
  console.log(data);
  if (data.state) {
    //UID驗證合法
    //顯示會員帳號相關訊息
    $("#login_member").text(data.data[0].Mname + "會員您好!");

    //顯示登出按鈕
    $("#s2_logout_btn").show();
    //秀出後台管理
    if (data.data[0].Mname == "admin") {
      $("#contropanel").show();
    }
  } else {
    location.href = "../member/member_login.html";
  }
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
